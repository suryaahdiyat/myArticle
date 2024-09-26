<x-admin-navbar>
	@if(session()->has('success'))
	<p class="px-2 py-3 mb-2 text-xl border rounded border-emerald-500 bg-emerald-200">{{ session('success') }}</p>
	@endif
	@if(session()->has('errorEdit'))
	<p class="px-2 py-3 mb-2 text-xl border rounded border-rose-500 bg-rose-200">{{ session('errorEdit') }}</p>
	@endif
	@if(session()->has('passDMatch'))
	<p class="px-2 py-3 mb-2 text-xl border rounded border-rose-500 bg-rose-200">{{ session('passDMatch') }}</p>
	@endif
	<div class="">
		<form action="/myAccount/{{ $user->email }}" enctype="multipart/form-data" method="POST">
			@csrf
			@method('PUT')
			<div class="flex flex-col items-center justify-center pb-3 mb-3 border-b-2 border-black">
				<div id="tempPP" class="flex items-center justify-center w-24 h-24 text-2xl text-white rounded-full bg-slate-500">
					{{ $user->initial }}
				</div>
				@if($user->pp)
				<img src="{{ asset('storage/' . $user->pp) }}" class="object-cover my-2 rounded-full img-preview max-h-24 max-w-24" alt="">
				@else
				<img class="object-cover my-2 rounded-full img-preview max-h-24 max-w-24" alt="">
				@endif
			</div>
			@if($user->pp)
			<div class="my-2 ml-3 text-slate-600">
				<label for="removeCheck" class="mr-2">Remove Photo Profile</label>
				<input type="checkbox" name="removeCheck" id="removeCheck">
			</div>
			@endif
			<div class="relative grid w-full grid-cols-2 pl-2 mb-1" id="ppDiv">
				<label for="pp">Profile Picture</label>
				<input type="file" name="pp" id="pp" class="p-2 border" onchange="handlePreview()">
				@error('pp')
				<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
				@enderror
				<input type="hidden" name="oldPP" id="oldPP" class="p-2 border" value="{{ $user->pp }}">
				<button id="removeBtn" class="absolute hidden text-sm duration-100 border rounded-full w-7 h-7 top-3 right-3 hover:text-rose-700 hover:border-rose-700" type="button" onclick="handleRemove()">X</button>
			</div>
			<div class="grid w-full grid-cols-2 pl-2 mb-1">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="p-2 border" value="{{ old('name') ?? $user->name }}"
					placeholder="Your name....">
					@error('name')
					<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
			</div>
			<div class="grid w-full grid-cols-2 pl-2 mb-1">
				<label for="email">Email</label>
				<input type="email" disabled readonly name="email" id="email" class="p-2 border text-slate-600"
					value="{{ old('email') ?? $user->email }}">
			</div>
			<div class="mb-2 ml-3 text-slate-600">
				<label for="cPass" class="mr-2">Not Change Password</label>
				<input type="checkbox" name="cPass" id="cPass">
			</div>
			<div class="" id="changeP">
				<div class="grid w-full grid-cols-2 pl-2 mb-1">
					<label for="oldPassword">oldPassword</label>
					<input type="password" placeholder="Your old password...." name="oldPassword" id="oldPassword"
						class="p-2 border">
						@error('oldPassword')
						<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
						@enderror
				</div>
				<h5 class="mb-1 ml-3 text-slate-600">New Password</h5>
				<div class="grid w-full grid-cols-2 pl-2 mb-1">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="p-2 border">
					@error('password')
					<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>
				<div class="grid w-full grid-cols-2 pl-2 mb-3">
					<label for="rePassword">Retype Password</label>
					<input type="password" name="rePassword" id="rePassword" class="p-2 border">
					@error('rePassword')
					<p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
					@enderror
				</div>
			</div>
			<button type="submit"
				class="w-full px-3 py-2 duration-100 rounded bg-cyan-600 text-slate-200 hover:bg-cyan-700 hover:text-slate-300 hover:scale-95">Save</button>
			</form>
			<form action="/myAccount/{{ $user->email }}" method="POST">
				@csrf
				@method('DELETE')
				<button onclick="return handleDelete()"
					class="w-full px-3 py-2 mt-3 duration-100 rounded bg-rose-600 text-slate-200 hover:bg-rose-700 hover:text-slate-300 hover:scale-95">Delete My Account</button>
			</form>
	</div>
	<script>
		// console.log(document.getElementById('cPass'))
		const handleDelete = () => {
		return confirm('Are you want to delete your account?')
		}
        document.getElementById('cPass').addEventListener('change', (e) => {
            if(e.target.checked){
                document.getElementById('changeP').classList.add('hidden')
            }else {
                document.getElementById('changeP').classList.remove('hidden')
            }
        })
		@if($user->pp)
			document.querySelector('#tempPP').style.display = 'none'
			document.getElementById('removeCheck').addEventListener('change', (e) => {
				if(e.target.checked){
					document.getElementById('ppDiv').classList.add('hidden')
				}else {
					document.getElementById('ppDiv').classList.remove('hidden')
				}
			})
		@endif

        const handlePreview = () => {
            const image = document.querySelector('#pp')
            const imagePreview = document.querySelector('.img-preview')

			document.querySelector('#tempPP').style.display = 'none'
			document.querySelector('#removeBtn').style.display = 'block'
            imagePreview.style.display = 'block';

            const oFReader = new FileReader()
            oFReader.readAsDataURL(image.files[0])

            oFReader.onload = function(oFREvent){
                imagePreview.src = oFREvent.target.result
            }

            // Periksa apakah elemen input file dan elemen pratinjau gambar ada
            // if (image && imagePreview) {
            // if (image.files && image.files[0]) {
						// 	document.querySelector('#tempPP').style.display = 'none'
            // 	imagePreview.style.display = 'block'; // Tampilkan elemen pratinjau

            // const oFReader = new FileReader();
            // oFReader.readAsDataURL(image.files[0]); // Baca file yang diunggah

            // oFReader.onload = function(oFREvent) {
            // imagePreview.src = oFREvent.target.result; // Setel src elemen pratinjau dengan hasil pembacaan file
            // };
            // } else {
            // console.error('Tidak ada file yang dipilih.');
            // }
            // } else {
            // console.error('Elemen input file atau pratinjau gambar tidak ditemukan.');
            // }
        }



        const handleRemove = () => {
            document.querySelector('#pp').value = ""
						document.querySelector('.img-preview').style.display = 'none'
						document.querySelector('#tempPP').style.display = 'flex'
						document.querySelector('#removeBtn').style.display = 'none'
        }
	</script>
</x-admin-navbar>
