    <!-- Hero Section -->
    <section id="beranda" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-gradient-premium">
        <!-- Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute -top-[30%] -right-[10%] w-[70%] h-[70%] rounded-full bg-blue-500/20 blur-[120px]"></div>
            <div class="absolute -bottom-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-cyan-500/20 blur-[100px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <!-- Animated Logo atop everything -->
            <div class="flex justify-center items-center mb-10">
                <div class="relative">
                    <div class="absolute inset-0 bg-blue-400 rounded-full blur-[60px] opacity-20 animate-pulse"></div>
                    <img src="/images/logo.png?v={{ time() }}" style="filter: brightness(1000%) !important; -webkit-filter: brightness(1000%) !important;" alt="Gaskeun.IDR Logo" class="w-32 h-32 md:w-44 md:h-44 lg:w-56 lg:h-56 object-contain rounded-full border-4 border-white/20 shadow-2xl animate-floating-logo">
                </div>
            </div>

            <div class="space-y-6">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-card text-blue-100 text-sm font-medium border border-white/20">
                    <span class="flex h-2 w-2 rounded-full bg-blue-400"></span>
                    Partner Terbaik Project & Tugas Kamu
                </div>
                
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white leading-tight">
                    Solusi Cerdas<br>
                    <span class="text-gradient">Tugas Digital</span>
                </h1>
                
                <p class="text-lg md:text-xl text-blue-100/80 max-w-2xl mx-auto font-light leading-relaxed">
                    Pengerjaan cepat, aman, dan bergaransi untuk Joki Koding, Tugas Sekolah, hingga Desain Profesional.
                </p>
                
                <div class="flex flex-col sm:flex-row justify-center gap-4 pt-4">
                    <a href="https://wa.me/6289525194553" target="_blank" class="px-8 py-4 bg-blue-500 hover:bg-blue-600 text-white rounded-xl font-bold text-lg transition-all transform hover:-translate-y-1 shadow-lg shadow-blue-500/25 flex items-center justify-center gap-2">
                        <i class="fa-brands fa-whatsapp text-xl"></i> Konsultasi Gratis
                    </a>
                    <a href="#layanan" class="px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white border border-white/20 rounded-xl font-bold text-lg transition-all flex items-center justify-center gap-2">
                        Cek Layanan
                    </a>
                </div>
            </div>
            
            <!-- Trust Indicators -->
            <div class="mt-16 pt-10 border-t border-white/10 grid grid-cols-2 md:grid-cols-4 gap-6 text-white/70">
                <div class="flex flex-col items-center">
                    <h3 class="text-3xl font-bold text-white mb-1">{{ $orderCount }}+</h3>
                    <p class="text-sm">Project Selesai</p>
                </div>
                <div class="flex flex-col items-center">
                    <h3 class="text-3xl font-bold text-white mb-1">100%</h3>
                    <p class="text-sm">Garansi Error</p>
                </div>
                <div class="flex flex-col items-center">
                    <h3 class="text-3xl font-bold text-white mb-1">24/7</h3>
                    <p class="text-sm">Support Admin</p>
                </div>
                <div class="flex flex-col items-center">
                    <h3 class="text-3xl font-bold text-white mb-1">A+</h3>
                    <p class="text-sm">Nilai Tugas</p>
                </div>
            </div>
        </div>
    </section>

