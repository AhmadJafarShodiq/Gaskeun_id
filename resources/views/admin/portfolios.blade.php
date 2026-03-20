@extends('layouts.admin')

@section('header_title', 'Kelola Portfolio')
@section('header_desc', 'Atur proyek yang pernah dibuat untuk halaman depan.')

@section('content')
<div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-200">
    <div class="flex items-center justify-between mb-10">
        <h4 class="text-xl font-black text-slate-900">Daftar Project</h4>
        <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition-all flex items-center gap-2 text-sm shadow-lg shadow-blue-600/20">
            <i class="fa-solid fa-plus"></i> Tambah Project
        </button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left border-b border-slate-100">
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Gambar</th>
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Judul & Kategori</th>
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Deskripsi</th>
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($portfolios as $portfolio)
                <tr>
                    <td class="py-6">
                        <img src="{{ Storage::url($portfolio->image_path) }}" alt="{{ $portfolio->title }}" class="w-20 h-20 object-cover rounded-2xl shadow-sm border border-slate-200">
                    </td>
                    <td class="py-6 max-w-xs">
                        <p class="font-black text-slate-900 text-sm mb-1">{{ $portfolio->title }}</p>
                        <span class="text-[10px] font-black text-blue-600 bg-blue-50 px-3 py-1 rounded-lg border border-blue-100 uppercase">{{ $portfolio->category ?? 'Umum' }}</span>
                    </td>
                    <td class="py-6">
                        <p class="text-[11px] text-slate-500 font-medium leading-relaxed truncate max-w-xs">{{ $portfolio->description }}</p>
                    </td>
                    <td class="py-6 text-right">
                        <div class="flex justify-end gap-2">
                            <form action="{{ route('admin.portfolios.destroy', $portfolio->id) }}" method="POST" onsubmit="return confirm('Yakin hapus project ini?');">
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
<div id="addModal" class="fixed inset-0 z-[100] hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-[2.5rem] w-full max-w-lg overflow-hidden shadow-2xl">
        <div class="p-8 bg-blue-600 text-white relative">
            <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="absolute top-6 right-6 text-white/50 hover:text-white">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
            <h3 class="text-xl font-bold">Tambah Project Baru</h3>
        </div>
        <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-4">
            @csrf
            <div>
                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2">Judul / Nama Project</label>
                <input type="text" name="title" required class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2">Kategori (Cth: Website / Desain Logo)</label>
                <input type="text" name="category" required class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2">Penjelasan / Deskripsi</label>
                <textarea name="description" required rows="3" class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 outline-none focus:border-blue-500 resize-none"></textarea>
            </div>
            <div>
                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2">Upload Gambar (Max 2MB)</label>
                <input type="file" name="image_path" accept="image/*" required class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 outline-none text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            <button type="submit" class="w-full py-4 mt-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/30">Simpan Project</button>
        </form>
    </div>
</div>
@endsection
