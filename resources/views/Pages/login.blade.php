<x-layout>
	<x-slot:title>
		Login
	</x-slot:title>
	<div class="flex items-center justify-center w-full h-screen">
		<div class="">
			@if(session()->has('success'))
			<p class="px-3 py-5 mb-2 text-2xl border rounded border-emerald-500 bg-emerald-200">{{ session('success') }}
			</p>
			@endif
			@if(session()->has('loginError'))
			<p class="px-3 py-5 mb-2 text-2xl border rounded border-rose-500 bg-rose-200">{{ session('loginError') }}
			</p>
			@endif
			<form action="/login" method="POST" class="px-3 py-5 text-white bg-black rounded-md shadow-lg">
				@csrf
				<h1 class="pb-2 mb-10 text-5xl font-semibold tracking-wide text-center border-b-2 border-dashed font-bodoni">
					Login</h1>
				<div class="grid grid-cols-1 py-2 border-b-2 md:grid-cols-2">
					<label for="email">Email</label>
					<input type="email" name="email" id="email"
						class="text-black px-2 py-1 border-l border-b @error('email') border border-rose-600 @enderror"
						value="{{ old('email') }}" autofocus required>
					@error('email')
					<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>
				<div class="grid grid-cols-1 py-2 border-b-2 md:grid-cols-2">
					<label for="password">Password</label>
					<input required type="password" name="password" id="password"
						class="text-black px-2 py-1 border-l border-b @error('password') border border-rose-600 @enderror" />
					@error('password')
					<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>
				<button type="submit"
					class="w-full py-2 mt-4 text-xl text-black duration-100 bg-white rounded hover:scale-95 hover:bg-white/80 hover:text-black/80">Login</button>
			</form>
			<p class="mt-3 text-center">not have an account?, <a href="/register" class="underline">register</a> <br>or
				enter as <a href="/" class="underline">guest</a></p>
		</div>
	</div>
</x-layout>