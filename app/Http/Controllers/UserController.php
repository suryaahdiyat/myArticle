<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns|max:255',
            'password' => 'required|min:4'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'failed login');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:dns|max:255|unique:users',
            'password' => 'required|string|min:4',
            'rePassword' => 'required|string|min:4'
        ]);

        if ($validatedData['password'] != $validatedData['rePassword']) return back()->with('registerError', 'password does not match');
        $validatedData['password'] = bcrypt($validatedData['password']);

        $validatedData['role'] = 'user';
        $validatedData['initial'] = $this->getInitials($validatedData['name']);
        // dd($validatedData);
        User::create($validatedData);
        return redirect('/login')->with('success', 'register success');
    }

    public function myAccount(Request $request){
        $user = User::find(auth()->user()->id);
        return view('Users.myAccount',[
            'user' => $user
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

    public function index()
    {
        return view('Users.index', [
            'users' => User::where('id', '!=', auth()->user()->id)->latest()->paginate(5),
        ]);
    }
    public function create() {}
    public function store(Request $request) {}
    public function edit(User $user)
    {
        return view('Users.edit', [
            'user' => $user
        ]);
    }
    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return redirect('/users')->with('success', 'updated successfully!');
    }
    public function destroy(User $user) {
        if($user->pp) Storage::delete($user->pp);
        $user->delete();

        return redirect('/users')->with('success', 'deleted successfully!');
    }
    public function eMyAccount(Request $request, User $user) {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $validatedData['initial'] = $this->getInitials($validatedData['name']);

        if($request->removeCheck == "on"){
            Storage::delete($request->oldPP);
            $validatedData['pp'] = null;
        }else{
            // dd($validatedData);
            if ($request->file('pp')) {
                $request->validate([
                    'pp' => 'image|file|max:512'
                ]);
                if ($request->oldPP) {
                    Storage::delete($request->oldPP);
                }
                $validatedData['pp'] = $request->file('pp')->store('user-images');
            }
        }

        // dd($validatedData);

        if($request->cPass != "on"){
            $request->validate([
                'oldPassword' => 'string|min:4'
            ]);
            if(Hash::check($request->oldPassword, auth()->user()->password)){
                $request->validate([
                    'password' => 'string|min:4',
                    'rePassword' => 'string|min:4',
                ]);

                if ($request->password != $request->rePassword) return back()->with('passDMatch', 'password does not match');
                $validatedData['password'] = bcrypt($request->password);

                // dd($validatedData['password']);
            }else{
                return back()->with('errorEdit', 'Your password is incorrect');
            }
        }

        $user->update($validatedData);
        return redirect('/myAccount')->with('success', 'Success update your account');
    }

    public function dMyAccount(User $user) {
        if ($user->pp) Storage::delete($user->pp);
        $user->delete();

        return redirect('/');
    }
}
