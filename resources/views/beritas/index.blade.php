<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-sky-500">
                📰 Daftar Berita
            </h2>
            <a href="{{ route('beritas.create') }}"
               class="inline-flex items-center bg-gradient-to-r from-blue-600 to-sky-600 hover:brightness-110 text-white font-semibold py-2 px-4 rounded-lg shadow transition duration-300">
                <i class="fas fa-plus mr-2"></i> Tambah Berita
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-b from-blue-100 via-blue-200 to-sky-100 dark:from-gray-900 dark:via-gray-800 dark:to-black min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg dark:bg-green-800 dark:border-green-600 dark:text-green-200 shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white/60 backdrop-blur-md dark:bg-gray-800/50 shadow-xl sm:rounded-2xl overflow-hidden">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="overflow-x-auto">
                       <table class="min-w-full bg-blue-950 text-white border border-blue-700 rounded-lg overflow-hidden">
                            <thead class="bg-blue-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left font-semibold text-blue-600 dark:text-gray-300 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left font-semibold text-blue-600 dark:text-gray-300 uppercase tracking-wider">Foto</th>
                                    <th class="px-6 py-3 text-left font-semibold text-blue-600 dark:text-gray-300 uppercase tracking-wider">Judul</th>
                                    <th class="px-6 py-3 text-left font-semibold text-blue-600 dark:text-gray-300 uppercase tracking-wider">Penulis</th>
                                    <th class="px-6 py-3 text-left font-semibold text-blue-600 dark:text-gray-300 uppercase tracking-wider">Tanggal Publikasi</th>
                                    <th class="px-6 py-3 text-left font-semibold text-blue-600 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-blue-100 dark:divide-gray-700">
                                @forelse ($beritas as $berita)
                                    <tr class="hover:bg-blue-50 dark:hover:bg-gray-700 transition-all duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-gray-100">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4">
                                            @if($berita->foto)
                                                <img src="{{ asset('storage/' . $berita->foto) }}"
                                                     alt="{{ $berita->judul }}"
                                                     class="w-20 h-20 object-cover rounded-lg shadow-md">
                                            @else
                                                <span class="text-gray-400 dark:text-gray-500 italic">(Tidak ada foto)</span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                            {{ \Illuminate\Support\Str::limit($berita->judul, 70) }}
                                        </td>

                                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                            {{ $berita->penulis }}
                                        </td>

                                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                            {{ $berita->tanggal_publikasi->format('d M Y H:i') }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex space-x-3 text-sm">
                                                <a href="{{ route('beritas.show', $berita->id) }}"
                                                   class="text-blue-600 hover:text-blue-400 font-medium transition">
                                                    Lihat
                                                </a>
                                                <a href="{{ route('beritas.edit', $berita->id) }}"
                                                   class="text-sky-600 hover:text-sky-400 font-medium transition">
                                                    Edit
                                                </a>
                                                <form action="{{ route('beritas.destroy', $berita->id) }}"
                                                      method="POST" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-red-600 hover:text-red-400 font-medium transition">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-400 dark:text-gray-500">
                                            Tidak ada berita yang tersedia.
                                            @if(Auth::user()->role === 'admin')
                                                <a href="{{ route('beritas.create') }}" class="text-blue-500 hover:underline ml-1">Tambah berita baru</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if ($beritas instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="mt-6">
                            {{ $beritas->links() }}
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
