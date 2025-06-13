{{-- resources/views/dashboard/user_dashboard.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-white">📰 Berita Terkini</h2>
            <p class="text-indigo-200 mt-2 text-sm">Selalu update dengan informasi terbaru</p>
        </div>
    </x-slot>

    {{-- Ganti latar belakang di sini --}}
    <div class="py-10 bg-gradient-to-b from-blue-800 via-blue-900 to-blue-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-8">
                <h3 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">
                    👋 Halo, {{ Auth::user()->name }}! Selamat datang kembali.
                </h3>

                <h4 class="text-xl font-semibold mb-4 text-gray-700 dark:text-indigo-300">
                    Berita Pilihan Terbaru
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($beritas as $berita)
                        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg shadow-md overflow-hidden transform hover:-translate-y-1 hover:shadow-xl transition duration-300">
                            @if($berita->foto)
                                <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->judul }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-300 dark:bg-gray-600 flex items-center justify-center text-gray-500 dark:text-gray-400">Gambar Tidak Tersedia</div>
                            @endif
                            <div class="p-4">
                                <a href="{{ route('beritas.show', $berita->id) }}" class="block hover:underline">
                                    <h5 class="font-bold text-lg mb-2 text-gray-900 dark:text-white">
                                        {{ \Illuminate\Support\Str::limit($berita->judul, 60) }}
                                    </h5>
                                </a>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-1">
                                    Oleh <span class="font-medium">{{ $berita->penulis }}</span> &middot;
                                    {{ $berita->tanggal_publikasi->format('d M Y') }}
                                </p>
                                <p class="text-sm text-gray-700 dark:text-gray-200 mb-3">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi_berita), 100) }}
                                </p>
                                <a href="{{ route('beritas.show', $berita->id) }}" class="text-indigo-600 dark:text-indigo-400 text-sm font-semibold hover:underline">
                                    Baca Selengkapnya &rarr;
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500 dark:text-gray-400 py-8">
                            <p class="text-lg">Belum ada berita terbaru saat ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
