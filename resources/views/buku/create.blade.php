<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Buku
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-12">
            <div class="container mx-auto mt-10 bg-white p-6 rounded-md">
                <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="judul" class="block text-gray-600">Judul Buku</label>
                        <input type="text" id="judul" name="judul" placeholder="Masukkan Judul Buku" class="border border-gray-300 rounded px-3 py-2 w-full">
                    </div>

                    <div class="mb-4">
                        <label for="penulis" class="block text-gray-600">Penulis</label>
                        <input type="text" id="penulis" name="penulis" placeholder="Masukkan Nama Penulis" class="border border-gray-300 rounded px-3 py-2 w-full">
                    </div>

                    <div class="mb-4">
                        <label for="harga" class="block text-gray-600">Harga</label>
                        <input type="text" id="harga" name="harga" placeholder="Masukkan Harga Buku" class="border border-gray-300 rounded px-3 py-2 w-full">
                    </div>

                    <div class="mb-4">
                        <label for="tgl_terbit" class="block text-gray-600">Tanggal Terbit</label>
                        <input type="date" id="tgl_terbit" name="tgl_terbit" class="border border-gray-300 rounded px-3 py-2 w-full">
                    </div>

                    <div class="mb-4">
                        <label for="thumbnail" class="block text-sm font-medium leading-6 text-gray-900">Thumbnail</label>
                        <div class="mt-2">
                            <input type="file" name="thumbnail" id="thumbnail">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="gallery" class="block text-sm font-medium leading-6 text-gray-900">Gallery</label>
                        <div class="mt-2" id="fileinput_wrapper"></div>
                        <a href="javascript:void(0);" id="tambah" onclick="addFileInput()">Tambah</a>
                        <script type="text/javascript">
                            function addFileInput() {
                                var div = document.getElementById('fileinput_wrapper');
                                div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="block w-full mb-5" style="margin-bottom:5px;">';
                            }
                        </script>
                    </div>

                    <div class="col-span-full mt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Tambah Buku</button>
                        <a href="/buku" class="text-gray-600">Batal</a>
                    </div>
                </form>

                <div class="gallery_items mt-6">
                    @foreach($buku->galleries()->get() as $gallery)
                        <div class="gallery_item mb-4">
                            <img
                                class="rounded-full object-cover object-center"
                                src="{{ asset($gallery->path) }}"
                                alt=""
                                width="400"
                            />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
