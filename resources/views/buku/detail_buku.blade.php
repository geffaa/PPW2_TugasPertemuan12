<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="dark:bg-gray-800 overflow-hidden rounded-lg shadow-md m-5">
                <section id="album" class="py-4 text-center bg-light">
                    <div class="container mx-auto">
                        <h2 class="text-3xl font-bold mb-4">{{ $bukus->judul }}</h2>
                        <hr class="my-2">
                        <div class="flex flex-wrap gap-4 overflow-x-auto">
                            @foreach($bukus->galleries as $gallery)
                                <div class="flex-shrink-0 flex flex-col items-center  rounded-md bg-white m-2 p-4">
                                    <a href="{{ asset($gallery->path) }}" data-lightbox="image-1" data-title="{{ $gallery->keterangan }}">
                                        <img src="{{ asset($gallery->path) }}" class="w-200 h-150 object-cover rounded-md" alt="{{ $gallery->nama_galeri }}" width="200" height="150">
                                    </a>
                                    <p class="mt-2 text-sm">{{ $gallery->nama_galeri }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                <a href="{{ route('buku.index') }}" class=" inline-block px-4 py-2 border border-blue-500 text-blue-500 bg-blue-100 rounded mt-4">
                    {{ __('Kembali ke Daftar Buku') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
