<nav class="sticky top-0 z-50 flex flex-col items-center justify-between w-full gap-3 px-8 py-3 bg-white border-b md:gap-0 md:flex-row"
    id="c-dropdown">
    <a href="/" class="text-6xl font-bodoni">NORDIC ROSE</a>
    @auth()
    <div class="relative flex items-center justify-end px-3 py-2 text-center border rounded w-60">
        <button class="flex items-center justify-center truncate duration-100 hover:scale-95" onclick="handleClick()">
            Welcome Back, {{ auth()->user()->name }}
            <svg class="w-5 h-5 -mr-1 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                    clip-rule="evenodd" />
            </svg>
        </button>
        <div class="absolute w-40 bg-white border -right-96 top-10" id="dropdown">
            <div class="border-b-2">
                <div class="py-2 duration-100 hover:bg-black hover:text-white">
                    <a href="/myAccount" class="">
                        My Account
                    </a>
                </div>
                <div class="py-2 duration-100 hover:bg-black hover:text-white">
                    <a href="/myPosts" class="">
                        My Posts
                    </a>
                </div>
                @can('admin')
                {{-- @if(auth()->user()->role == 'su') --}}
                <div class="py-2 duration-100 hover:bg-black hover:text-white">
                    <a href="/posts" class="">All Posts</a>
                </div>
                <div class="py-2 duration-100 hover:bg-black hover:text-white">
                    <a href="/users" class="">All Users</a>
                </div>
                {{-- @endif --}}
                @endcan
            </div>
            <div class="py-2 duration-100 border-b-2 hover:bg-black hover:text-white hover:cursor-pointer">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="">Logout</button>
                </form>
            </div>
        </div>
    </div>
    @else
    <a href="/login"
        class="px-3 py-2 text-center duration-100 border rounded w-60 hover:bg-black hover:text-white">Login</a>
    @endauth
    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('c-dropdown');
            if (window.scrollY > 50) {
                navbar.classList.remove('border-slate-500');
                navbar.classList.add('border-b-2', 'border-slate-500', 'shadow-md');
            } else {
                navbar.classList.remove('border-b-2', 'border-slate-500', 'shadow-md');
                navbar.classList.add('border-slate-500');
            }
        });
        const handleClick = () => {
    			document.getElementById('dropdown').classList.toggle('-right-96')
    		}
    </script>
</nav>