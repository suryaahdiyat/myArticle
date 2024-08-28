<x-admin-navbar>
    <h1>Edit role user here</h1>
    <form action="/users/{{ $user->email }}" method="POST">
        @method('PUT')
        @csrf
        <div class="grid grid-cols-2 p-2 my-2 border">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="p-2 border @error('name') border-rose-600 @enderror"
                value="{{ $user->name}}" disabled>
            @error('name')
            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="grid grid-cols-2 p-2 my-2 border">
            <label for="role">Role</label>
            <select name="role" id="role" class="p-2 border">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="su" {{ $user->role == 'su' ? 'selected' : '' }}>Super User</option>
            </select>
        </div>
        <div class="grid grid-cols-2 p-2 my-2 border">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="p-2 border @error('email') border-rose-600 @enderror"
                value="{{ $user->email}}" disabled>
            @error('email')
            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="grid grid-cols-2 gap-3 text-center">
            <a href="/users"
                class="block px-3 py-2 duration-100 rounded bg-rose-600 text-slate-200 hover:bg-rose-700 hover:text-slate-300 hover:scale-95">Back</a>
            <button type="submit"
                class="px-3 py-2 duration-100 rounded bg-cyan-600 text-slate-200 hover:bg-cyan-700 hover:text-slate-300 hover:scale-95">Save</button>
        </div>
    </form>
</x-admin-navbar>