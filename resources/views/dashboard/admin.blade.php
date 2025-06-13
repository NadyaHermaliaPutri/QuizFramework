<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-black py-14 px-6 text-white">
        <div class="max-w-7xl mx-auto space-y-14">

            {{-- Header Welcome --}}
            <div class="text-center space-y-3">
                <h1 class="text-4xl md:text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-sky-500 animate-pulse">
                    Selamat Datang, {{ Auth::user()->name }} 👋
                </h1>
                <p class="text-lg text-gray-300">Kelola berita, pantau perkembangan informasi dengan mudah dan cepat.</p>
            </div>

            {{-- Akses Cepat --}}
            <div class="flex justify-center">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 w-full max-w-2xl text-center">
                    {{-- Lihat Semua Berita --}}
                    <a href="{{ route('beritas.index') }}"
                       class="group rounded-2xl p-6 shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 bg-gradient-to-r from-blue-700 to-blue-500 hover:brightness-110">
                        <div class="flex flex-col items-center text-white">
                            <i class="fas fa-newspaper text-4xl mb-3"></i>
                            <span class="text-lg font-semibold">Lihat Semua Berita</span>
                        </div>
                    </a>

                    {{-- Tulis Berita Baru (Admin Only) --}}
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('beritas.create') }}"
                           class="group rounded-2xl p-6 shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 bg-gradient-to-r from-sky-600 to-cyan-400 hover:brightness-110">
                            <div class="flex flex-col items-center text-white">
                                <i class="fas fa-pen-nib text-4xl mb-3"></i>
                                <span class="text-lg font-semibold">Tulis Berita Baru</span>
                            </div>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Berita Terbaru --}}
            <div>
                <h2 class="text-2xl font-bold text-center text-white border-b border-gray-700 pb-3">
                    🗞️ Berita Terbaru
                </h2>

                @if ($beritas->isEmpty())
                    <p class="text-center text-gray-400 mt-6">Belum ada berita yang dipublikasikan.</p>
                @else
                    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 mt-8">
                        @foreach ($beritas as $berita)
                            <div class="bg-white/5 backdrop-blur border border-white/10 rounded-2xl overflow-hidden shadow hover:shadow-xl transition-all duration-300">
                                @if ($berita->foto)
                                    <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->judul }}"
                                         class="w-full h-48 object-cover object-center">
                                @else
                                    <div class="w-full h-48 bg-gray-700 flex items-center justify-center text-gray-400">
                                        Tidak ada gambar
                                    </div>
                                @endif

                                <div class="p-5">
                                    <h3 class="text-lg font-semibold text-white truncate mb-2">
                                        {{ $berita->judul }}
                                    </h3>
                                    <p class="text-sm text-gray-300 mb-3">
                                        Oleh <span class="text-blue-300 font-medium">{{ $berita->penulis }}</span>
                                        · {{ $berita->tanggal_publikasi->diffForHumans() }}
                                    </p>
                                    <a href="{{ route('beritas.show', $berita->id) }}"
                                       class="inline-block text-blue-400 hover:text-blue-200 font-medium text-sm transition">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
