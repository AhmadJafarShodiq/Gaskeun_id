    <!-- Order Modal -->
    <div id="orderModal" class="fixed inset-0 hidden" style="z-index: 999999 !important;">
        <div class="absolute inset-0 bg-slate-950/95 backdrop-blur-xl" onclick="closeOrderModal()" style="z-index: -1;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md p-4">
            <div class="relative bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-100" style="z-index: 10;">

                <!-- Header -->
                <div class="relative px-8 pt-8 pb-6 bg-gradient-to-br from-blue-600 to-indigo-600 text-white overflow-hidden">
                    <div class="absolute -top-6 -right-6 w-28 h-28 bg-white/10 rounded-full blur-xl"></div>
                    <div class="absolute bottom-0 left-0 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
                    <div class="relative z-10 flex items-start justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-8 h-8 bg-white/20 rounded-xl flex items-center justify-center">
                                    <i class="fa-solid fa-bolt text-sm"></i>
                                </div>
                                <span class="text-blue-200 text-xs font-bold uppercase tracking-widest">Form Pemesanan</span>
                            </div>
                            <h3 class="text-2xl font-black mb-0.5" id="orderServiceTitle">Layanan Pilihan</h3>
                            <p class="text-blue-200 text-xs">Isi data di bawah dan kami siap membantu!</p>
                        </div>
                        <button onclick="closeOrderModal()" class="w-9 h-9 bg-white/20 hover:bg-white/30 rounded-xl flex items-center justify-center transition-all mt-1">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>
                </div>

                <!-- Form Body -->
                <div class="p-6 max-h-[70vh] overflow-y-auto space-y-4">
                    <form id="orderForm" onsubmit="handleOrderSubmit(event)" class="space-y-4">
                        <input type="hidden" id="serviceInput">
                        <input type="hidden" id="basePriceInput">
                        <input type="hidden" id="totalPriceInput">
                        <input type="hidden" id="waNumberInput">

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Nama Client</label>
                            <input type="text" id="nameInput" required placeholder="Contoh: Andi"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all text-sm font-semibold text-slate-700 placeholder:text-slate-400">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Judul Project</label>
                            <input type="text" id="titleInput" required placeholder="Contoh: Sistem Kasir"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all text-sm font-semibold text-slate-700 placeholder:text-slate-400">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Detail Kebutuhan</label>
                            <textarea id="detailInput" required rows="3" placeholder="Sebutkan fitur atau spesifikasi yang diinginkan..."
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all text-sm font-semibold text-slate-700 placeholder:text-slate-400 resize-none"></textarea>
                        </div>

                        <!-- Durasi -->
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Tenggat Waktu</label>
                            <div class="flex items-center gap-3 bg-slate-50 border border-slate-200 rounded-2xl px-4 py-2">
                                <input type="number" id="durationValue" value="3" min="1" oninput="calculateTotal()"
                                    class="w-16 py-2 bg-transparent outline-none text-center font-black text-xl text-blue-600">
                                <div class="w-px h-8 bg-slate-200"></div>
                                <select id="durationUnitSelect" onchange="calculateTotal()"
                                    class="flex-1 bg-transparent font-bold text-slate-600 text-sm focus:outline-none cursor-pointer">
                                    <option value="Hari">Hari</option>
                                    <option value="Minggu">Minggu</option>
                                    <option value="Bulan">Bulan</option>
                                </select>
                            </div>
                        </div>

                        <!-- Price Display -->
                        <div class="bg-slate-900 rounded-2xl p-5 text-white">
                            <div class="flex justify-between items-baseline mb-3">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Biaya</span>
                                <span class="text-2xl font-black" id="displayTotal">Rp 0</span>
                            </div>
                            <div class="flex justify-between items-center bg-white/10 px-4 py-3 rounded-xl">
                                <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">DP (50%)</span>
                                <span class="font-black text-green-400" id="displayDP">Rp 0</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col gap-2 pt-1">
                            <button type="submit"
                                class="w-full py-4 bg-green-500 hover:bg-green-600 text-white font-black rounded-2xl transition-all shadow-lg shadow-green-500/30 flex items-center justify-center gap-2 active:scale-95">
                                <i class="fa-brands fa-whatsapp text-lg"></i> Gaskeun Order!
                            </button>
                            <button type="button" onclick="closeOrderModal()"
                                class="w-full py-3 bg-slate-100 hover:bg-slate-200 text-slate-500 font-bold text-sm rounded-2xl transition-all active:scale-95">
                                Kembali
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Inquiry Modal -->
    <div id="inquiryModal" class="fixed inset-0 hidden" style="z-index: 999999 !important;">
        <div class="absolute inset-0 bg-slate-950/95 backdrop-blur-xl" onclick="closeInquiryModal()" style="z-index: -1;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md p-4">
            <div class="relative bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-100 flex flex-col" style="z-index: 10;">

                <!-- Header -->
                <div class="relative px-8 pt-10 pb-8 bg-slate-900 text-white overflow-hidden !opacity-100">
                    <div class="absolute -top-6 -right-6 w-28 h-28 bg-white/5 rounded-full blur-xl"></div>
                    <div class="relative z-10 flex items-start justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-8 h-8 bg-white/10 rounded-xl flex items-center justify-center">
                                    <i class="fa-solid fa-headset text-sm"></i>
                                </div>
                                <span class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em]">Tanya Sekarang</span>
                            </div>
                            <h3 class="text-2xl font-black mb-1">Konsultasi Admin</h3>
                            <p class="text-slate-400 text-xs font-medium">Bebas tanya apa aja, admin siap jawab!</p>
                        </div>
                        <button onclick="closeInquiryModal()" class="w-9 h-9 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center transition-all mt-1">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>
                </div>

                <!-- Form Body -->
                <div class="p-6">
                    <form id="inquiryForm" onsubmit="handleInquirySubmit(event)" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Nama Lengkap</label>
                            <input type="text" id="inquiryName" required placeholder="Contoh: Andi"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all text-sm font-semibold text-slate-700 placeholder:text-slate-400">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Nomor WhatsApp</label>
                            <input type="text" id="inquiryWA" required placeholder="0812xxxx"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all text-sm font-semibold text-slate-700 placeholder:text-slate-400">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Pesan / Pertanyaan</label>
                            <textarea id="inquiryMessage" required rows="4" placeholder="Tuliskan pertanyaanmu di sini..."
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all text-sm font-semibold text-slate-700 placeholder:text-slate-400 resize-none"></textarea>
                        </div>

                        <div class="flex flex-col gap-2 pt-1">
                            <button type="submit" id="inquiryBtn"
                                class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl transition-all shadow-lg shadow-blue-600/30 flex items-center justify-center gap-2 active:scale-95">
                                <i class="fa-solid fa-paper-plane"></i> Kirim ke Admin
                            </button>
                            <button type="button" onclick="closeInquiryModal()"
                                class="w-full py-3 bg-slate-100 hover:bg-slate-200 text-slate-500 font-bold text-sm rounded-2xl transition-all active:scale-95">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
