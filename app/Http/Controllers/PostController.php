<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
	public function landingPage()
	{
		return view('Pages.landingPage', [
			'posts' => Post::latest()->limit(6)->get()
		]);
	}

	public function allPost()
	{


		// return view('Pages.allPosts', [
		// 	'posts' => Post::oldest()->paginate(8)
		// ]);

		$search = request('search');
		// dd($search);

		// Mulai query
		$posts = Post::latest();

		$query = false;
		// Jika ada input search, tambahkan filter
		if ($search) {
			// $posts->where('title', 'like',
			// 	'%' . $search . '%'
			// );
			$posts = $posts->where(function ($query) use ($search) {
				$query->where('title', 'like', '%' . $search . '%')
					->orWhere('content', 'like', '%' . $search . '%')
					->orWhereHas('user', function ($query) use ($search) {
						$query->where('name', 'like', '%' . $search . '%');
					});
			});
			$query = true;
		}

		// Lanjutkan dengan paginasi
		$posts = $posts->paginate(8);

		return view('Pages.allPosts', [
			'posts' => $posts,
			'query' => $query
		]);
	}

	public function index()
	{

		return view('Posts.index', [
			'posts' => Post::latest()->paginate(8),
			'su' => true
		]);
	}

	public function myPosts()
	{
		$posts = Post::where('user_id', auth()->user()->id)->paginate(8);

		return view('Posts.index', [
			'posts' => $posts
		]);
	}

	public function show(Post $post)
	{
		// dd('show function');
		// dd($post);
		$initials = $this->getInitials($post->user->name);
		return view('Posts.detail', [
			'post' => $post,
			'initial' => $initials
		]);
		// return view('pages.detail2', [
		//     'post' => $post
		// ]);
	}

	public function create()
	{
		// dd('berhasil');
		return view('Posts.addpost');
	}
	public function store(Request $request)
	{

		// dd($request->all());//error insert data
		$request->validate([
			'title' => 'required|string|max:255',
			'image' => 'image|file|max:1024',
			'content' => 'required', //content null
		]);

		$image = null;
		if ($request->file('image')) $image = $request->file('image')->store('post-images');
		Post::create([
			'user_id' => auth()->user()->id,
			'title' => $request->title,
			'image' => $image,
			'content' => $request->content,
		]);

		// return view('Posts.index', [
		//     'posts' => Post::where('user_id', auth()->user()->id)->get()
		// ]);

		return redirect('/myPosts')->with('success', 'added new post successfully!');
	}
	public function edit(Post $post)
	{
		return view('Posts.edit', [
			'post' => $post
		]);
	}
	public function update(Request $request, Post $post)
	{
		$request->validate([
			'title' => 'required|string|max:255',
			'image' => 'image|file|max:1024',
			'content' => 'required',
		]);

		$image = null;
		if ($request->oldImage) {
			$image = $request->oldImage;
		}

		if ($request->file('image')) {
			if ($request->oldImage) {
				Storage::delete($request->oldImage);
			}
			$image = $request->file('image')->store('post-images');
		}
		$post->update([
			'title' => $request->title,
			'image' => $image,
			'content' => $request->content,
		]);

		// return view('Posts.index', [
		//     'posts' => Post::where('user_id', auth()->user()->id)->get()
		// ]);

		return redirect('/myPosts')->with('success', 'updated successfully!');
	}
	public function destroy(Post $post)
	{
		if ($post->image) Storage::delete($post->image);
		$post->delete();

		return redirect('/myPosts')->with('success', 'post deleted successfully!');
	}

	public function postsBy(User $user)
	{
		return view('pages.postsBy', [
			'posts' => $user->posts()->paginate(8)
		]);
	}

	protected function getInitials($name)
	{
		$words = explode(' ', $name);
		$initials = '';

		foreach ($words as $word) {
			$initials .= strtoupper($word[0]);
		}

		return $initials;
	}
}
