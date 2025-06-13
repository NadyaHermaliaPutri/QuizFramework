{{-- resources/views/dashboard/admin_dashboard.blade.php --}}

<x-app-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8 text-gray-800 dark:text-gray-100">

                    {{-- Header Selamat Datang --}}
                    <div class="mb-8">
                        <h2 class="text-3xl font-extrabold text-blue-800 dark:text-blue-300">Halo, {{ Auth::user()->name }} 👋</h2>
                        <p class="text-gray-600 dark:text-gray-400 mt-2">Selamat datang di panel manajemen berita!</p>
                    </div>

                    {{-- Akses Cepat --}}
                    <div class="mb-10">
                        <h3 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Akses Cepat</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                            <a href="{{ route('beritas.index') }}"
                                class="bg-blue-100 dark:bg-blue-800 text-blue-900 dark:text-white rounded-lg p-6 shadow-md hover:shadow-lg transition duration-300">
                                <div class="flex items-center justify-center mb-3">
                                    <i class="fas fa-newspaper text-3xl"></i>
                                </div>
                                <h4 class="text-center font-bold text-lg">Lihat Semua Berita</h4>
                            </a>

                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('beritas.create') }}"
                                    class="bg-green-100 dark:bg-green-800 text-green-900 dark:text-white rounded-lg p-6 shadow-md hover:shadow-lg transition duration-300">
                                    <div class="flex items-center justify-center mb-3">
                                        <i class="fas fa-plus text-3xl"></i>
                                    </div>
                                    <h4 class="text-center font-bold text-lg">Tulis Berita Baru</h4>
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Berita Terbaru --}}
                    <div>
                        <h3 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-200">Berita Terbaru</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse ($beritas as $berita)
                                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow hover:shadow-lg transition duration-300">
                                    @if ($berita->foto)
                                        <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->judul }}"
                                            class="w-full h-44 object-cover">
                                    @else
                                        <div class="w-full h-44 flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-gray-500">
                                            Tidak ada gambar
                                        </div>
                                    @endif

                                    <div class="p-4">
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white truncate">{{ $berita->judul }}</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Ditulis oleh <span class="font-medium">{{ $berita->penulis }}</span> · {{ $berita->tanggal_publikasi->diffForHumans() }}</p>
                                        <a href="{{ route('beritas.show', $berita->id) }}"
                                            class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                                            Lihat Selengkapnya &rarr;
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-600 dark:text-gray-400">Tidak ada berita yang tersedia saat ini.</p>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
