<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-white">📰 Detail Berita</h2>
        </div>
    </x-slot>

    {{-- Ubah warna latar di bagian ini --}}
    <div class="py-12 bg-gradient-to-b from-blue-800 via-blue-900 to-blue-950 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">

                @if($berita->foto)
                    <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->judul }}" class="w-full h-72 object-cover">
                @endif

                <div class="p-6">
                    <h1 class="text-3xl font-bold mb-4 text-gray-900 dark:text-white">
                        {{ $berita->judul }}
                    </h1>

                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-300 mb-6 space-x-4">
                        <span><i class="fas fa-user mr-1"></i>{{ $berita->penulis }}</span>
                        <span><i class="fas fa-calendar-alt mr-1"></i>{{ $berita->tanggal_publikasi->format('d M Y H:i') }}</span>
                    </div>

                    <div class="prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-100">
                        {!! $berita->isi_berita !!}
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
