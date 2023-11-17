<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Buku') }}
            </h2>
            @if(Auth::check() && Auth::user()->role === 'admin')
                <a href="{{ route('buku.create') }}" class="inline-block px-4 py-2 border border-blue-500 text-blue-500 bg-blue-100 rounded">
                    {{ __('Tambah Buku Baru') }}
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="text-gray-900 dark:text-gray-100">
                <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Buku</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Harga</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Tgl. Terbit</th>
                                <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                            @foreach($data_buku as $buku)
                                <tr class="hover:bg-gray-50">
                                    <th class="flex gap-3 px-6 py-4 font-normal text-gray-900">
                                        @if($buku->filepath)
                                            <div class="relative h-24 w-24">
                                                <img
                                                    class="h-full w-full object-cover object-center"
                                                    src="{{ asset($buku->filepath) }}"
                                                    alt=""
                                                    style="padding-right: 20px;"
                                                />
                                            </div>
                                        @endif
                                        <div class="text-sm">
                                        <a href="{{ $buku->buku_seo ? route('galeri.buku', $buku->buku_seo) : '#' }}" class="font-medium text-gray-700">{{ $buku->judul }}</a>
                                            <div class="text-gray-400">{{ $buku->penulis }}</div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                            Rp. {{ number_format($buku->harga, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('j F Y') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-4">
                                            <form action="{{ route('buku.destroy', $buku->id) }}" method="post" id="delete-buku">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Yakin mau dihapus?')" class="btn-delete">Hapus</button>
                                            </form>
                                            <a x-data="{ tooltip: 'Edit' }}" href="{{ route('buku.edit', $buku->id) }}">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke-width="1.5"
                                                    stroke="currentColor"
                                                    class="h-6 w-6"
                                                    x-tooltip="tooltip"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                                                    />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $data_buku->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>