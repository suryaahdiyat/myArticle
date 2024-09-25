<x-layout>
    <x-slot:title>
        Detail Post
    </x-slot>

    <x-navbar />

    <div class="flex justify-center my-10">
        <div class="flex flex-col justify-center w-2/3 text-center">
            <div class="flex items-center justify-between my-4">
                <a href="/"
                    class="block mt-5 font-semibold text-center duration-100 border-b-2 border-black md:text-2xl hover:translate-x-2 w-fit">Newest
                    Article</a>
                <a href="/allPosts"
                    class="block mt-5 font-semibold text-center duration-100 border-b-2 border-black md:text-2xl hover:translate-x-2 w-fit">All
                    Article</a>
            </div>
            <h1 class="my-4 text-xl">{{ $post->title }}</h1>
            <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://placehold.co/700x400' }}"
                alt="" class="pb-5 border-b-4 border-black">
            <div class="py-3 mb-12 text-start">
                <div class="flex gap-3">
                    @if ($post->user->pp)
                        <img src="{{ asset('storage/' . $post->user->pp) }}"
                            class="object-cover my-2 rounded-full img-preview max-h-10 max-w-10" alt="">
                    @else
                        <div class="flex items-center justify-center w-10 h-10 text-white rounded-full bg-slate-500">
                            {{ $initial }}
                        </div>
                    @endif
                    <div>
                        <h1 class="">Writter <a href="/postsBy/{{ $post->user->email }}"
                                class="underline">{{ $post->user->name }}</a></h1>
                        <p class="text-xs font-light">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <div class="mt-3" id="editor-container">
                    {{-- {!! $post->content !!} --}}
                </div>
                <div class="flex items-center justify-start gap-2 mt-2">
                    <button onclick="handleLike()" class="flex items-center justify-center gap-1 p-1">
                        <span class="">
                            <svg id="like-icon" xmlns="http://www.w3.org/2000/svg"
                                fill="{{ $hasLiked ? '#be123c' : '#fff' }}" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="{{ $hasLiked ? 'none' : '#000' }}" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </span>
                        <span id="likeC">{{ $likesCount }}</span>

                        {{-- {{ $likesCount >= 1 ? ($hasLiked ? 'Liked' : 'Like') : 'Likes' }} --}}
                    </button>
                    <form action="" class="flex items-center justify-center gap-1 p-1">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                            </svg>
                        </button>
                        {{ $commentCount }}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const handleLike = () => {
            let likeCounter = parseInt(document.getElementById('likeC').innerHTML)
            const likeIcon = document.getElementById('like-icon')
            const postId = @json($post->id);
            const data = {
                'post_id': postId
            }
            axios.post('/post/toggle-like', data, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    console.log('berhasil', response.data)
                    if (response.data.message == 'liked') {
                        likeCounter += 1

                        // Ubah atribut fill dan stroke
                        likeIcon.setAttribute('fill', '#be123c'); // Mengubah fill menjadi hijau
                        likeIcon.setAttribute('stroke', 'none'); // Mengubah stroke menjadi hitam

                        document.getElementById('likeC').innerHTML = likeCounter
                    } else {
                        likeCounter -= 1

                        // Ubah atribut fill dan stroke
                        likeIcon.setAttribute('fill', '#fff'); // Mengubah fill menjadi hijau
                        likeIcon.setAttribute('stroke', '#000'); // Mengubah stroke menjadi hitam

                        document.getElementById('likeC').innerHTML = likeCounter
                    }
                    // console.log(likeCounter.innerHTML)
                }).catch(error => {
                    console.error('ada masalah', error)
                })
        }
        const quill = new Quill('#editor-container', {
            theme: 'snow',
            readOnly: true,
            modules: {
                toolbar: false // Tidak menambahkan toolbar
            }
        })
        quill.root.innerHTML = `{!! $post->content !!}`
    </script>
</x-layout>
