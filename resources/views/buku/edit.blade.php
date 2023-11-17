<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Buku
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 rounded-md">
        <div class="py-12">
            <div class="container mx-auto mt-10 bg-white p-6 rounded-md">
                <h2 class="text-2xl font-semibold mb-4">Edit Buku</h2>

                <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="judul" class="block text-gray-700 font-bold">Judul</label>
                        <input type="text" name="judul" id="judul" value="{{ $buku->judul }}" class="border border-gray-300 rounded px-3 py-2 w-full">
                    </div>

                    <div class="mb-4">
                        <label for="penulis" class="block text-gray-700 font-bold">Penulis</label>
                        <input type="text" name="penulis" id="penulis" value="{{ $buku->penulis }}" class="border border-gray-300 rounded px-3 py-2 w-full">
                    </div>

                    <div class="mb-4">
                        <label for="harga" class="block text-gray-700 font-bold">Harga</label>
                        <input type="text" name="harga" id="harga" value="{{ $buku->harga }}" class="border border-gray-300 rounded px-3 py-2 w-full">
                    </div>

                    <div class="mb-4">
                        <label for="tgl_terbit" class="block text-gray-700 font-bold">Tanggal Terbit</label>
                        <input type="date" name="tgl_terbit" id="tgl_terbit" value="{{ $buku->tgl_terbit }}" class="border border-gray-300 rounded px-3 py-2 w-full">
                    </div>

                    <div class="col-span-full mt-6">
                        <label for="thumbnail" class="block text-sm font-medium leading-6 text-gray-900">Thumbnail</label>
                        <div class="mt-2">
                            <input type="file" name="thumbnail" id="thumbnail">
                        </div>
                    </div>

                    <div class="col-span-full mt-6">
                        <label for="gallery" class="block text-sm font-medium leading-6 text-gray-900">Gallery</label>
                        <div class="mt-2" id="fileinput_wrapper"></div>
                        <a href="javascript:void(0);" id="tambah" onclick="addFileInput()">Tambah</a>
                        <script type="text/javascript">
                            function addFileInput() {
                                var div = document.getElementById('fileinput_wrapper');
                                div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="block w-full mb-5" style="margin-bottom:5px;">';
                            };
                        </script>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                        <a href="/buku" class="text-gray-600 ml-2">Batal</a>
                    </div>
                </form>

                <div class="gallery_items mt-6 flex space-x-4">
                    @foreach($buku->galleries()->get() as $gallery)
                        <div class="gallery_item border-2 border-gray-200 shadow-lg p-2 rounded flex flex-col items-center">
                            <img
                                class="rounded-full object-cover object-center mb-2"
                                src="{{ asset($gallery->path) }}"
                                alt=""
                                width="100"
                                height="100"
                            />
                            <form action="{{ route('buku.deleteGallery', ['buku' => $buku->id, 'gallery' => $gallery->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
