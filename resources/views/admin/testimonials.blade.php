@extends('layouts.admin')

@section('header_title', 'Kelola Testimoni')
@section('header_desc', 'Atur bukti transaksi dan ulasan dari klien yang sudah order.')

@section('content')
<div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-200">
    <div class="flex items-center justify-between mb-10">
        <h4 class="text-xl font-black text-slate-900">Daftar Testimoni</h4>
        <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition-all flex items-center gap-2 text-sm shadow-lg shadow-blue-600/20">
            <i class="fa-solid fa-plus"></i> Tambah Testimoni
        </button>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left border-b border-slate-100">
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Bukti Screenshot</th>
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Klien & Project</th>
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Ulasan</th>
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($testimonials as $testi)
                <tr>
                    <td class="py-6">
                        @if($testi->screenshot)
                            <img src="{{ Storage::url($testi->screenshot) }}" alt="Bukti {{ $testi->name }}" class="w-20 h-32 object-contain bg-slate-100 rounded-2xl shadow-sm border border-slate-200">
                        @else
                            <div class="w-20 h-20 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 text-xs font-medium border border-slate-200">
                                No Image
                            </div>
                        @endif
                    </td>
                    <td class="py-6 max-w-xs">
                        <p class="font-black text-slate-900 text-sm mb-1">{{ $testi->name }}</p>
                        <span class="text-[10px] font-black text-blue-600 bg-blue-50 px-3 py-1 rounded-lg border border-blue-100 uppercase">{{ $testi->project_name ?? 'Layanan Umum' }}</span>
                    </td>
                    <td class="py-6">
                        <p class="text-[11px] text-slate-500 italic font-medium leading-relaxed truncate max-w-xs">"{{ $testi->comment }}"</p>
                    </td>
                    <td class="py-6 text-right">
                        <div class="flex justify-end gap-2">
                            <form action="{{ route('admin.testimonials.destroy', $testi->id) }}" method="POST" onsubmit="return confirm('Yakin hapus testimoni ini?');">
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
            <h3 class="text-xl font-bold">Tambah Testimoni/Bukti Baru</h3>
        </div>
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-4">
            @csrf
            <div>
                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama Klien / Pembeli</label>
                <input type="text" name="name" required class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama Project (Opsional)</label>
                <input type="text" name="project_name" placeholder="Cth: Pembuatan Website Undangan" class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2">Pesan Ulasan / Komentar</label>
                <textarea name="comment" required rows="3" placeholder="Sangat mantap, kerjaannya cepet bgt..." class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 outline-none focus:border-blue-500 resize-none"></textarea>
            </div>
            <div>
                <label class="block text-[11px] font-black text-slate-400 uppercase tracking-widest mb-2">Screenshot Bukti Chat/Transfer (Max 2MB)</label>
                <input type="file" name="screenshot" accept="image/*" class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 outline-none text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            <button type="submit" class="w-full py-4 mt-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/30">Simpan Bukti</button>
        </form>
    </div>
</div>
@endsection
