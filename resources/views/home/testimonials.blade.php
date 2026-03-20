<!-- Testimonials / Bukti Order -->
<section id="testimoni" class="py-24 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h6 class="text-blue-600 font-black text-xs uppercase tracking-[0.3em] mb-3">Apa Kata Mereka?</h6>
            <h2 class="text-4xl font-black text-slate-900 mb-4 tracking-tight">Bukti Klien Terpercaya</h2>
            <div class="w-20 h-1.5 bg-blue-600 mx-auto rounded-full"></div>
            <p class="text-slate-500 mt-6 max-w-2xl mx-auto">Masih ragu? Ini adalah beberapa bukti nyata dari klien yang telah sukses menyelesaikan project/tugas bersama Gaskeun.IDR.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($testimonials as $testi)
            <div class="bg-slate-50 rounded-[2.5rem] p-8 border border-slate-100 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 flex flex-col group">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-blue-100/50 rounded-full flex items-center justify-center text-blue-600 font-black text-xl border border-blue-200 shadow-sm shadow-blue-200">
                        {{ substr($testi->name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 text-lg leading-tight">{{ $testi->name }}</h4>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $testi->project_name ?? 'Klien Gaskeun.IDR' }}</span>
                    </div>
                </div>

                <div class="flex text-amber-400 mb-4 text-sm drop-shadow-sm">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>

                <p class="text-slate-600 text-sm italic leading-relaxed mb-6 flex-grow">
                    "{{ $testi->comment }}"
                </p>

                @if($testi->screenshot)
                <div class="mt-auto relative rounded-2xl overflow-hidden border border-slate-200 cursor-pointer group-hover:border-blue-300 transition-colors" onclick="window.open('{{ Storage::url($testi->screenshot) }}', '_blank')">
                    <img src="{{ Storage::url($testi->screenshot) }}" alt="Bukti {{ $testi->name }}" class="w-full h-32 object-cover opacity-90 group-hover:opacity-100 transition-opacity">
                    <div class="absolute inset-0 bg-slate-900/10 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all">
                        <span class="bg-white/90 backdrop-blur-sm text-blue-600 text-xs font-black uppercase tracking-widest px-4 py-2 rounded-xl shadow-lg">Lihat Bukti Full</span>
                    </div>
                </div>
                @endif
            </div>
            @empty
            <div class="col-span-1 md:col-span-3 text-center py-12 bg-white rounded-3xl border border-dashed border-slate-200">
                <p class="text-slate-400 font-bold italic py-8">Belum ada testimoni / bukti yang ditambahkan.</p>
            </div>
            @endforelse
        </div>
        
    </div>
</section>
