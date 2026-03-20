    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-16 border-t border-slate-800 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Col 1: Branding -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                            <i class="fa-solid fa-bolt-lightning text-lg"></i>
                        </div>
                        <span class="text-xl font-black text-white italic">GASKEUN.IDR</span>
                    </div>
                    <p class="text-sm leading-relaxed text-slate-500 mb-6">
                        Solusi joki berkualitas tinggi untuk koding, tugas IT, desain, dan video editing nomor satu di Indonesia.
                    </p>
                    <div class="flex gap-3">
                        <a href="https://instagram.com/gaskeun.idr" target="_blank" class="w-10 h-10 bg-white/5 hover:bg-gradient-to-tr hover:from-orange-500 hover:to-purple-600 text-white rounded-xl flex items-center justify-center transition-all border border-white/10 hover:border-transparent scale-hover">
                            <i class="fa-brands fa-instagram text-xl"></i>
                        </a>
                        <a href="https://tiktok.com/@gaskeun.idr" target="_blank" class="w-10 h-10 bg-white/5 hover:bg-black text-white rounded-xl flex items-center justify-center transition-all border border-white/10 hover:border-transparent scale-hover">
                            <i class="fa-brands fa-tiktok text-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Services -->
                <div>
                    <h5 class="text-white font-black text-[10px] uppercase tracking-[0.2em] mb-8 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span> Layanan Kami
                    </h5>
                    <ul class="space-y-4 text-sm font-bold">
                        @foreach($services->take(6) as $service)
                            <li>
                                <a href="#layanan" class="text-slate-500 hover:text-white hover:translate-x-2 transition-all flex items-center gap-2">
                                    <i class="fa-solid fa-chevron-right text-[10px] text-blue-500/50"></i>
                                    {{ $service->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Col 3: Support -->
                <div>
                    <h5 class="text-white font-black text-[10px] uppercase tracking-[0.2em] mb-8 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span> Bantuan
                    </h5>
                    <ul class="space-y-4 text-sm font-bold">
                        <li><a href="#portfolio" class="text-slate-500 hover:text-white hover:translate-x-2 transition-all flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-blue-500/50"></i> Projek Kami</a></li>
                        <li><a href="javascript:void(0)" onclick="openInquiryModal()" class="text-slate-500 hover:text-white hover:translate-x-2 transition-all flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-blue-500/50"></i> Tanya Admin</a></li>
                        <li><a href="{{ route('login') }}" class="text-slate-500 hover:text-white hover:translate-x-2 transition-all flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-blue-500/50"></i> Staff Login</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact -->
                <div>
                    <h5 class="text-white font-black text-[10px] uppercase tracking-[0.2em] mb-8 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span> Kontak Resmi
                    </h5>
                    <div class="space-y-6">
                        <a href="https://wa.me/6289525194553" target="_blank" class="flex items-center gap-4 bg-white/[0.03] p-5 rounded-[1.5rem] border border-white/5 hover:bg-white/[0.07] hover:border-blue-500/30 transition-all group">
                            <div class="w-12 h-12 bg-green-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-green-500/20 group-hover:scale-110 transition-transform">
                                <i class="fa-brands fa-whatsapp text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Fast Response</p>
                                <span class="font-black text-white text-sm">+62 895-2519-4553</span>
                            </div>
                        </a>
                        <p class="text-xs text-slate-600 italic px-2">
                            *Kami siap membantu project & tugas kamu kapan saja. Gaskeun!
                        </p>
                    </div>
                </div>
            </div>

            <!-- Payment Methods List (THE CLEAN FIX) -->
            <div class="pt-12 border-t border-white/5 flex flex-col items-center gap-6">
                <span class="text-[10px] font-black text-slate-600 uppercase tracking-[0.4em]">Official Payment Partners</span>
                <div class="flex flex-wrap justify-center gap-6 md:gap-10 opacity-70">
                    <div class="flex items-center gap-2 text-white font-black text-xs italic tracking-widest">
                        <i class="fa-solid fa-building-columns text-blue-500"></i> BCA
                    </div>
                    <div class="flex items-center gap-2 text-white font-black text-xs italic tracking-widest">
                        <i class="fa-solid fa-building-columns text-blue-500"></i> BRI
                    </div>
                    <div class="flex items-center gap-2 text-white font-black text-xs italic tracking-widest">
                        <i class="fa-solid fa-building-columns text-blue-500"></i> B. JATIM
                    </div>
                    <div class="flex items-center gap-2 text-white font-black text-xs italic tracking-widest">
                        <i class="fa-solid fa-wallet text-blue-500"></i> DANA
                    </div>
                    <div class="flex items-center gap-2 text-white font-black text-xs italic tracking-widest">
                        <i class="fa-solid fa-wallet text-blue-500"></i> GOPAY
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-12 text-center">
                <p class="text-[9px] font-black text-slate-700 uppercase tracking-widest">
                    &copy; 2026 GASKEUN.IDR | ALL RIGHTS RESERVED
                </p>
            </div>
        </div>
    </footer>
