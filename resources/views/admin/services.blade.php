@extends('layouts.admin')

@section('header_title', 'Kelola Layanan')
@section('header_desc', 'Atur layanan yang tampil di halaman depan website.')

@section('content')
<div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-200">
    <div class="flex items-center justify-between mb-10">
        <h4 class="text-xl font-black text-slate-900">Daftar Layanan</h4>
        <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition-all flex items-center gap-2 text-sm shadow-lg shadow-blue-600/20">
            <i class="fa-solid fa-plus"></i> Tambah Layanan
        </button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left border-b border-slate-100">
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Icon</th>
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Judul & Deskripsi</th>
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Harga / Estimasi</th>
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">No WA Petugas</th>
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($services as $service)
                <tr>
                    <td class="py-6">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                            <i class="fa-solid {{ $service->icon }}"></i>
                        </div>
                    </td>
                    <td class="py-6 max-w-xs">
                        <p class="font-black text-slate-900 text-sm mb-1">{{ $service->title }}</p>
                        <p class="text-[11px] text-slate-500 font-medium leading-relaxed truncate">{{ $service->description }}</p>
                    </td>
                    <td class="py-6">
                        @if($service->discount_price)
                            <p class="text-[10px] text-slate-400 line-through mb-0.5">Rp {{ number_format($service->base_price, 0, ',', '.') }}</p>
                            <p class="font-black text-rose-500 text-sm mb-1">Rp {{ number_format($service->discount_price, 0, ',', '.') }}</p>
                        @else
                            <p class="font-black text-blue-600 text-sm mb-1">Rp {{ number_format($service->base_price, 0, ',', '.') }}</p>
                        @endif
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $service->estimated_days }} Hari</p>
                    </td>
                    <td class="py-6">
                        @if($service->whatsapp_number)
                            <div class="flex items-center gap-2">
                                <span class="w-7 h-7 bg-green-100 text-green-600 rounded-lg flex items-center justify-center text-xs"><i class="fa-brands fa-whatsapp"></i></span>
                                <span class="text-sm font-bold text-slate-700">{{ $service->whatsapp_number }}</span>
                            </div>
                        @else
                            <span class="text-[11px] text-slate-400 italic">Belum diset</span>
                        @endif
                    </td>
                    <td class="py-6 text-right">
                        <div class="flex justify-end gap-2">
                            <button onclick="openEditModal({{ $service }})" class="w-10 h-10 rounded-xl bg-orange-50 text-orange-500 hover:bg-orange-500 hover:text-white transition-all flex items-center justify-center">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white transition-all flex items-center justify-center">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div id="addModal" class="fixed inset-0 z-[100] hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 transition-all duration-300">
    <div class="bg-white rounded-[2rem] w-full max-w-xl overflow-hidden shadow-2xl relative">
        <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div>
                    <h3 class="text-xl font-black text-slate-900">Tambah Layanan</h3>
                    <p class="text-xs font-semibold text-slate-500 mt-1">Buat layanan baru untuk website</p>
                </div>
            </div>
            <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="w-10 h-10 bg-slate-100 hover:bg-rose-100 hover:text-rose-600 text-slate-500 rounded-xl flex items-center justify-center transition-all">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        
        <form action="{{ route('admin.services.store') }}" method="POST" class="p-8 space-y-5">
            @csrf
            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Nama Layanan</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa-solid fa-heading"></i>
                    </div>
                    <input type="text" name="title" required placeholder="Contoh: Desain Grafis" class="w-full pl-11 pr-4 py-3.5 bg-slate-50 hover:bg-slate-100 focus:bg-white rounded-2xl border border-slate-200 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-semibold text-slate-700 placeholder:text-slate-400 text-sm">
                </div>
            </div>
            
            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Deskripsi Singkat</label>
                <div class="relative group">
                    <div class="absolute top-4 left-0 pl-4 pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa-solid fa-align-left"></i>
                    </div>
                    <textarea name="description" required rows="2" placeholder="Jelaskan secara ringkas tentang layanan..." class="w-full pl-11 pr-4 py-3.5 bg-slate-50 hover:bg-slate-100 focus:bg-white rounded-2xl border border-slate-200 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-semibold text-slate-700 placeholder:text-slate-400 text-sm resize-none"></textarea>
                </div>
            </div>
            
            <div class="grid grid-cols-3 gap-5">
                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Icon (FontAwesome)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fa-brands fa-font-awesome"></i>
                        </div>
                        <input type="text" name="icon" placeholder="fa-code" required class="w-full pl-11 pr-4 py-3.5 bg-slate-50 hover:bg-slate-100 focus:bg-white rounded-2xl border border-slate-200 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-semibold text-slate-700 placeholder:text-slate-400 text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Harga Dasar (Rp)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fa-solid fa-rupiah-sign"></i>
                        </div>
                        <input type="number" name="base_price" placeholder="50000" required class="w-full pl-11 pr-4 py-3.5 bg-slate-50 hover:bg-slate-100 focus:bg-white rounded-2xl border border-slate-200 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-semibold text-slate-700 placeholder:text-slate-400 text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Diskon (Rp)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <i class="fa-solid fa-tag"></i>
                        </div>
                        <input type="number" name="discount_price" placeholder="Kosongkan jika tak ada" class="w-full pl-11 pr-4 py-3.5 bg-slate-50 hover:bg-slate-100 focus:bg-white rounded-2xl border border-slate-200 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-semibold text-slate-700 placeholder:text-slate-400 text-sm">
                    </div>
                </div>
            </div>
            
            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Estimasi Pengerjaan (Hari)</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <input type="number" name="estimated_days" value="1" required class="w-full pl-11 pr-4 py-3.5 bg-slate-50 hover:bg-slate-100 focus:bg-white rounded-2xl border border-slate-200 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-semibold text-slate-700 text-sm">
                </div>
            </div>

            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">No WA Petugas</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <input type="text" name="whatsapp_number" placeholder="628123456789" class="w-full pl-11 pr-4 py-3.5 bg-slate-50 hover:bg-slate-100 focus:bg-white rounded-2xl border border-slate-200 outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all font-semibold text-slate-700 placeholder:text-slate-400 text-sm">
                </div>
                <p class="text-[10px] text-slate-400 mt-1.5 ml-1">Format: 628xxx (tanpa + atau 0 di depan). Kosongkan jika pakai nomor default.</p>
            </div>
            
            <div class="pt-2">
                <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-black text-sm rounded-2xl transition-all shadow-lg shadow-blue-600/30 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-paper-plane"></i> Simpan Layanan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 z-[100] hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 transition-all duration-300">
    <div class="bg-white rounded-[2rem] w-full max-w-xl overflow-hidden shadow-2xl relative">
        <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center text-xl shadow-inner">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <h3 class="text-xl font-black text-slate-900">Edit Layanan</h3>
                    <p class="text-xs font-semibold text-slate-500 mt-1">Perbarui informasi layanan</p>
                </div>
            </div>
            <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="w-10 h-10 bg-slate-100 hover:bg-rose-100 hover:text-rose-600 text-slate-500 rounded-xl flex items-center justify-center transition-all">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        
        <form id="editForm" method="POST" class="p-8 space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Nama Layanan</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-orange-500 transition-colors">
                        <i class="fa-solid fa-heading"></i>
                    </div>
                    <input type="text" name="title" id="e_title" required class="w-full pl-11 pr-4 py-3.5 bg-slate-50 hover:bg-slate-100 focus:bg-white rounded-2xl border border-slate-200 outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all font-semibold text-slate-700 text-sm">
                </div>
            </div>
            
            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Deskripsi Singkat</label>
                <div class="relative group">
                    <div class="absolute top-4 left-0 pl-4 pointer-events-none text-slate-400 group-focus-within:text-orange-500 transition-colors">
                        <i class="fa-solid fa-align-left"></i>
                    </div>
                    <textarea name="description" id="e_desc" required rows="2" class="w-full pl-11 pr-4 py-3.5 bg-slate-50 hover:bg-slate-100 focus:bg-white rounded-2xl border border-slate-200 outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all font-semibold text-slate-700 text-sm resize-none"></textarea>
                </div>
            </div>
            
            <div class="grid grid-cols-3 gap-5">
                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Icon (FontAwesome)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-orange-500 transition-colors">
                            <i class="fa-brands fa-font-awesome"></i>
                        </div>
                        <input type="text" name="icon" id="e_icon" required class="w-full pl-11 pr-4 py-3.5 bg-slate-50 hover:bg-slate-100 focus:bg-white rounded-2xl border border-slate-200 outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all font-semibold text-slate-700 text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Harga Dasar (Rp)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-orange-500 transition-colors">
                            <i class="fa-solid fa-rupiah-sign"></i>
                        </div>
                        <input type="number" name="base_price" id="e_price" required class="w-full pl-11 pr-4 py-3.5 bg-slate-50 hover:bg-slate-100 focus:bg-white rounded-2xl border border-slate-200 outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all font-semibold text-slate-700 text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Diskon (Rp)</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-orange-500 transition-colors">
                            <i class="fa-solid fa-tag"></i>
                        </div>
                        <input type="number" name="discount_price" id="e_discount" placeholder="Kosongkan jika tak ada" class="w-full pl-11 pr-4 py-3.5 bg-slate-50 hover:bg-slate-100 focus:bg-white rounded-2xl border border-slate-200 outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all font-semibold text-slate-700 placeholder:text-slate-400 text-sm">
                    </div>
                </div>
            </div>
            
            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">Estimasi Pengerjaan (Hari)</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-orange-500 transition-colors">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <input type="number" name="estimated_days" id="e_days" required class="w-full pl-11 pr-4 py-3.5 bg-slate-50 hover:bg-slate-100 focus:bg-white rounded-2xl border border-slate-200 outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all font-semibold text-slate-700 text-sm">
                </div>
            </div>

            <div>
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest mb-2 ml-1">No WA Petugas</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-orange-500 transition-colors">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <input type="text" name="whatsapp_number" id="e_wa" placeholder="628123456789" class="w-full pl-11 pr-4 py-3.5 bg-slate-50 hover:bg-slate-100 focus:bg-white rounded-2xl border border-slate-200 outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all font-semibold text-slate-700 placeholder:text-slate-400 text-sm">
                </div>
                <p class="text-[10px] text-slate-400 mt-1.5 ml-1">Format: 628xxx (tanpa + atau 0 di depan). Kosongkan jika pakai nomor default.</p>
            </div>
            
            <div class="pt-2">
                <button type="submit" class="w-full py-4 bg-orange-500 hover:bg-orange-600 text-white font-black text-sm rounded-2xl transition-all shadow-lg shadow-orange-500/30 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(service) {
        document.getElementById('editForm').action = '/admin/services/' + service.id;
        document.getElementById('e_title').value = service.title;
        document.getElementById('e_desc').value = service.description;
        document.getElementById('e_icon').value = service.icon;
        document.getElementById('e_price').value = service.base_price;
        document.getElementById('e_discount').value = service.discount_price || '';
        document.getElementById('e_days').value = service.estimated_days;
        document.getElementById('e_wa').value = service.whatsapp_number || '';
        document.getElementById('editModal').classList.remove('hidden');
    }
</script>
@endsection
