<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Berita Desa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Header Tabel & Tombol Tambah -->
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold">Daftar Berita Gunturmadu</h3>
                        <a href="{{ route('admin.berita.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow transition duration-150 ease-in-out">
                            + Tambah Berita
                        </a>
                    </div>

                    <!-- Tabel Data -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b-2 border-gray-200">
                                    <th class="p-3 font-semibold text-gray-600">No</th>
                                    <th class="p-3 font-semibold text-gray-600">Judul Berita</th>
                                    <th class="p-3 font-semibold text-gray-600">Tanggal Upload</th>
                                    <th class="p-3 font-semibold text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($beritas as $index => $berita)
                                <tr class="border-b hover:bg-gray-50 transition duration-150">
                                    <td class="p-3 text-gray-700">{{ $index + 1 }}</td>
                                    <td class="p-3 text-gray-700 font-medium">{{ $berita->judul }}</td>
                                    <td class="p-3 text-gray-500">{{ $berita->created_at->format('d M Y') }}</td>
                                    <td class="p-3 flex space-x-3">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.berita.edit', $berita->id) }}" class="text-yellow-500 hover:text-yellow-700 font-medium">Edit</a>
                                        
                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus berita ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="p-4 text-center text-gray-500">Belum ada berita yang diunggah.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>