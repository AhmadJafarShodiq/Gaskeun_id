    <!-- Portfolio Section -->
    <section id="portfolio" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h6 class="text-blue-600 font-black text-xs uppercase tracking-[0.3em] mb-3">Hasil Karya Kami</h6>
                <h2 class="text-4xl font-black text-slate-900 mb-4 tracking-tight">Karya Terbaik Kami</h2>
                <div class="w-20 h-1.5 bg-blue-600 mx-auto rounded-full"></div>
            </div>
            <!-- ... content remain the same ... -->

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($portfolios as $portfolio)
                <div class="group relative bg-white rounded-[2.5rem] overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-slate-100">
                    <img src="{{ Storage::url($portfolio->image_path) }}" alt="{{ $portfolio->title }}" class="w-full h-64 object-cover transform group-hover:scale-110 transition-duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900 via-blue-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-8">
                        <span class="text-blue-400 text-[10px] font-black uppercase tracking-widest mb-2">{{ $portfolio->category }}</span>
                        <h4 class="text-white text-xl font-bold mb-1">{{ $portfolio->title }}</h4>
                        @if($portfolio->description)
                        <p class="text-blue-100/80 text-xs hidden group-hover:block transition-all line-clamp-2">{{ $portfolio->description }}</p>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-1 md:col-span-3 text-center py-12">
                     <p class="text-slate-400 font-bold italic">Belum ada project yang ditambahkan ke portfolio.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

