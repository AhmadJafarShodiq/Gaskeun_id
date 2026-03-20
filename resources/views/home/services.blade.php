    <!-- Services Section -->
    <section id="layanan" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="inline-block text-blue-600 font-bold tracking-widest uppercase text-xs bg-blue-50 border border-blue-100 px-4 py-2 rounded-full mb-4">Layanan Kami</span>
                <h3 class="text-3xl md:text-4xl font-black text-slate-900 mb-3 leading-tight">Apa yang bisa <span class="text-blue-600">kami bantu?</span></h3>
                <p class="text-slate-500">Pilih layanan sesuai kebutuhan Anda. Harga transparan, hasil profesional.</p>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @php
                    function number_get_formatted($num) {
                       return number_format($num, 0, ',', '.');
                    }
                @endphp
                @foreach($services as $index => $service)
                <div class="bg-white border border-slate-200 rounded-3xl p-6 flex flex-col hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">

                    <!-- Top: Icon & Badge -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-lg group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                            <i class="fa-solid {{ $service->icon }}"></i>
                        </div>
                        @if($service->discount_price)
                            <span class="bg-rose-100 text-rose-600 text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full border border-rose-200">
                                Diskon
                            </span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h4 class="text-base font-black text-slate-900 mb-1.5 leading-snug">{{ $service->title }}</h4>

                    <!-- Desc -->
                    <p class="text-slate-500 text-sm leading-relaxed flex-grow mb-5">{{ $service->description }}</p>

                    <!-- Info row: harga + estimasi -->
                    <div class="flex items-end justify-between mb-4 border-t border-slate-100 pt-4">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Mulai dari</p>
                            @if($service->discount_price)
                                <div class="flex flex-col">
                                    <p class="text-[10px] text-slate-400 line-through decoration-rose-500/50 mb-0.5">Rp {{ number_get_formatted($service->base_price) }}</p>
                                    <p class="text-xl font-black text-rose-600">Rp {{ number_get_formatted($service->discount_price) }}</p>
                                </div>
                            @else
                                <p class="text-xl font-black text-blue-600">Rp {{ number_get_formatted($service->base_price) }}</p>
                            @endif
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Estimasi</p>
                            <p class="text-sm font-black text-slate-700">{{ $service->estimated_days }} Hari</p>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    @if($service->title == 'Tugas Lainnya (Custom)')
                    <button onclick="openInquiryModal()"
                            class="w-full py-3 bg-slate-900 hover:bg-black text-white rounded-2xl font-black text-sm transition-all shadow-md active:scale-95 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-comments"></i> Tanya Admin
                    </button>
                    @else
                    <button onclick="openOrderModal('{{ $service->title }}', {{ $service->discount_price ?? $service->base_price }}, '{{ $service->whatsapp_number }}')"
                            class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black text-sm transition-all shadow-md shadow-blue-600/20 active:scale-95 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-bolt"></i> Pesan Sekarang
                    </button>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
