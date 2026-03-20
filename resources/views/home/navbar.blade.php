    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-md shadow-sm border-b border-slate-200" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center gap-3">
                    <img src="/images/logo.png" alt="Gaskeun.IDR Logo" class="w-12 h-12 object-cover rounded-full border-2 border-blue-100 shadow-sm animate-pulse transition-all">
                    <span class="font-bold text-2xl text-slate-900 tracking-tight">Gaskeun<span class="text-blue-600">.IDR</span></span>
                </div>
                <div class="hidden md:flex items-center gap-8 lg:gap-12">
                    <a href="#beranda" class="text-slate-700 hover:text-blue-600 font-bold transition-all text-sm tracking-tight">Beranda</a>
                    <a href="#layanan" class="text-slate-700 hover:text-blue-600 font-bold transition-all text-sm tracking-tight">Layanan</a>
                    <a href="#portfolio" class="text-slate-700 hover:text-blue-600 font-bold transition-all text-sm tracking-tight">Projek Kami</a>
                    <a href="#testimoni" class="text-slate-700 hover:text-blue-600 font-bold transition-all text-sm tracking-tight">Testimoni</a>
                    <a href="#cara-order" class="text-slate-700 hover:text-blue-600 font-bold transition-all text-sm tracking-tight">Cara Order</a>
                    
                    <div class="flex items-center gap-3 ml-4">
                        <button onclick="openInquiryModal()" class="px-6 py-3 bg-slate-900 text-white rounded-xl text-[13px] font-black hover:bg-black transition-all shadow-lg shadow-slate-900/20 active:scale-95 flex items-center gap-2">
                            <i class="fa-solid fa-comments text-lg"></i> TANYA ADMIN
                        </button>
                        <a href="https://wa.me/6289525194553" target="_blank" class="px-6 py-3 bg-blue-600 text-white rounded-xl text-[13px] font-black hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20 active:scale-95 flex items-center gap-2">
                            <i class="fa-brands fa-whatsapp text-lg"></i> ORDER VIA WA
                        </a>
                    </div>
                </div>
                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button onclick="toggleMobileMenu()" class="text-slate-900 p-2">
                        <i class="fa-solid fa-bars-staggered text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile Navigation Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-slate-100 p-6 space-y-4 shadow-xl">
            <a href="#beranda" onclick="toggleMobileMenu()" class="block text-slate-700 font-bold text-lg">Beranda</a>
            <a href="#layanan" onclick="toggleMobileMenu()" class="block text-slate-700 font-bold text-lg">Layanan</a>
            <a href="#portfolio" onclick="toggleMobileMenu()" class="block text-slate-700 font-bold text-lg">Projek Kami</a>
            <a href="#testimoni" onclick="toggleMobileMenu()" class="block text-slate-700 font-bold text-lg">Testimoni</a>
            <a href="#cara-order" onclick="toggleMobileMenu()" class="block text-slate-700 font-bold text-lg">Cara Order</a>
            <div class="flex flex-col gap-3 pt-2">
                <button onclick="openInquiryModal(); toggleMobileMenu();" class="w-full block py-4 bg-slate-900 text-white text-center rounded-2xl font-black active:scale-95 transition-all">
                    <i class="fa-solid fa-comments mr-2"></i> TANYA ADMIN
                </button>
                <a href="https://wa.me/6289525194553" target="_blank" class="w-full block py-4 bg-blue-600 text-white text-center rounded-2xl font-black active:scale-95 transition-all">
                    <i class="fa-brands fa-whatsapp mr-2"></i> ORDER VIA WA
                </a>
            </div>
        </div>
    </nav>
    </nav>

