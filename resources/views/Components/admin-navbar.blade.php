<x-layout>
	<div class="p-2 md:flex">
		<div class="sticky top-0 z-50 bg-white md:pr-2 md:border-r-2 md:w-1/3 md:relative">
			<div id="dn-trigger" class="flex flex-col items-center justify-center py-2 mb-3 duration-100 rounded hover:scale-95 md:hidden hover:cursor-pointer bg-rose-500">
				<h1 class="tracking-wider text-white border-b-2 border-white">Menu</h1>
				{{-- <div class="w-20 h-1 mb-2 bg-black rounded"></div>
				<div class="w-20 h-1 mb-2 bg-black rounded"></div>
				<div class="w-20 h-1 bg-black rounded"></div> --}}
			</div>
			<ul id="d-navbar" class="hidden mb-3 md:block md:mb-0">
				<li><a href="/"
						class="block p-2 my-1 text-center duration-100 border-2 border-black rounded hover:bg-black hover:text-white hover:cursor-pointer">Dashboard</a>
				</li>
				{{-- <li><a href="/reports"
						class="my-1 border-2 border-black rounded block p-2 text-center duration-150 hover:bg-black hover:text-white hover:cursor-pointer {{ Request::is('reports*') ? 'bg-black text-white hover:bg-slate-800 hover:border-black hover:text-black' : ''}}">
						Reports</a></li> --}}
				<li><a href="/myAccount"
						class="my-1 border-2 border-black rounded block p-2 text-center duration-150 hover:bg-black hover:text-white hover:cursor-pointer {{ Request::is('myAccount*') ? 'bg-black text-white hover:bg-slate-800 hover:border-black hover:text-black' : ''}}">My
						Account</a></li>
				<li><a href="/myPosts"
						class="my-1 border-2 border-black rounded block p-2 text-center duration-150 hover:bg-black hover:text-white hover:cursor-pointer {{ Request::is('myPost*') ? 'bg-black text-white hover:bg-slate-800 hover:border-black hover:text-black' : ''}}">My
						Posts</a></li>
				@can('admin')
				<li><a href="/posts"
						class="my-1 border-2 border-black rounded block p-2 text-center duration-150 hover:bg-black hover:text-white hover:cursor-pointer {{ Request::is('posts*') ? 'bg-black text-white hover:bg-slate-800 hover:border-black hover:text-black' : ''}}">All
						Posts</a></li>
				<li><a href="/users"
						class="my-1 border-2 border-black rounded block p-2 text-center duration-150 hover:bg-black hover:text-white hover:cursor-pointer {{ Request::is('users*') ? 'bg-black text-white hover:bg-slate-800 hover:border-black hover:text-black' : ''}}">All
						Users</a></li>
				@endcan
				<li
					class="p-2 text-center duration-100 border-2 border-black hover:bg-black hover:text-white hover:cursor-pointer">
					<form action="/logout" method="POST">
						@csrf
						<button type="submit" class="">Logout</button>
					</form>
				</li>
			</ul>
		</div>

		<div class="w-full p-2 md:w-2/3">
			{{ $slot }}
		</div>
	</div>
	<script>
		document.getElementById('dn-trigger').addEventListener('click', () => {
			// console.log('btn-cliked')
			document.getElementById('d-navbar').classList.toggle('hidden')
		})
	</script>
</x-layout>
