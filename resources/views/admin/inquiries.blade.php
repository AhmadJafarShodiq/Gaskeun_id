@extends('layouts.admin')

@section('header_title', 'Chat Masuk')
@section('header_desc', 'Pesan dan pertanyaan dari form Layanan Lainnya.')

@section('content')
<div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-200">
    <div class="flex items-center justify-between mb-10">
        <h4 class="text-xl font-black text-slate-900 italic">Riwayat Chat Masuk</h4>
    </div>
    
    <div class="space-y-12">
        <!-- Section: Butuh Balasan -->
        <div>
            <div class="flex items-center gap-3 mb-6">
                <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                <h5 class="text-lg font-black text-slate-800 uppercase tracking-widest">Butuh Balasan</h5>
            </div>
            
            <div class="space-y-4">
                @forelse($inquiries->where('status', 'unread') as $inq)
                    <div class="p-8 rounded-[2rem] border-2 border-blue-400 bg-blue-50/50 hover:shadow-xl transition-all duration-300 relative group overflow-hidden">
                        <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-100/30 rounded-full blur-2xl"></div>
                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h5 class="font-black text-slate-900 text-sm mb-1">{{ $inq->name }}</h5>
                                    <p class="text-[10px] text-blue-500 font-black uppercase tracking-widest">{{ $inq->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('admin.inquiry.destroy', $inq->id) }}" method="POST" onsubmit="return confirm('Hapus chat ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-8 h-8 rounded-lg bg-white/50 text-rose-500 hover:bg-rose-500 hover:text-white transition-all flex items-center justify-center shadow-sm">
                                            <i class="fa-solid fa-trash text-[10px]"></i>
                                        </button>
                                    </form>
                                    <span class="w-2 h-2 bg-blue-600 rounded-full animate-pulse shadow-[0_0_8px_rgba(37,99,235,0.6)]"></span>
                                </div>
                            </div>
                            <p class="text-slate-600 text-sm leading-relaxed italic mb-8 border-l-4 border-blue-500 pl-4 py-2 bg-white/40 rounded-r-xl">"{{ $inq->message }}"</p>
                            <div class="flex items-center gap-3">
                                <a href="https://wa.me/{{ $inq->whatsapp_number }}?text=Halo%20{{ $inq->name }},%20admin%20Gaskeun.IDR%20di%20sini..." 
                                    target="_blank"
                                    class="text-[11px] font-black text-white bg-green-500 hover:bg-green-600 px-6 py-3 rounded-2xl transition-all flex items-center gap-2 shadow-lg shadow-green-500/20 active:scale-95">
                                    <i class="fa-brands fa-whatsapp text-lg"></i> Balas ke Petugas / Client
                                </a>
                                <form action="{{ route('admin.inquiry.update', $inq->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-[10px] font-black text-slate-500 hover:text-white hover:bg-slate-900 px-6 py-3 border border-slate-200 rounded-2xl transition-all active:scale-95">
                                        Selesai Dibalas
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 bg-slate-50 rounded-[2.5rem] border border-dashed border-slate-200">
                        <i class="fa-solid fa-face-smile-wink text-4xl text-slate-200 mb-4 block"></i>
                        <p class="text-slate-400 font-bold italic uppercase tracking-widest text-xs">Kosong melompong bos!</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Section: Riwayat Chat -->
        <div>
            <button onclick="toggleHistory()" class="flex items-center justify-between w-full p-6 bg-slate-50 hover:bg-slate-100 rounded-2xl transition-all group">
                <div class="flex items-center gap-3">
                    <span class="w-1.5 h-6 bg-slate-300 rounded-full"></span>
                    <h5 class="text-sm font-black text-slate-500 uppercase tracking-widest group-hover:text-slate-700">Riwayat Chat ({{ $inquiries->where('status', 'replied')->count() }})</h5>
                </div>
                <i id="histIcon" class="fa-solid fa-chevron-down text-slate-400 group-hover:text-slate-700 transition-transform"></i>
            </button>
            
            <div id="histContent" class="hidden mt-6 space-y-3 opacity-0 transition-opacity duration-300">
                @foreach($inquiries->where('status', 'replied') as $inq)
                    <div class="p-6 rounded-2xl border border-slate-100 bg-white hover:bg-slate-50/50 transition-all flex flex-col md:flex-row md:items-center justify-between gap-4 group">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="w-10 h-10 bg-emerald-50 text-emerald-500 rounded-xl flex-shrink-0 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-check-double"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <h6 class="font-bold text-slate-900 text-sm truncate">{{ $inq->name }}</h6>
                                    <span class="text-[10px] text-slate-300">•</span>
                                    <p class="text-[10px] text-slate-400 font-medium">{{ $inq->created_at->format('d M') }}</p>
                                </div>
                                <p class="text-xs text-slate-500 truncate italic">"{{ $inq->message }}"</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                             <a href="https://wa.me/{{ $inq->whatsapp_number }}" target="_blank" class="text-[10px] font-black text-slate-400 hover:text-green-500 px-4 py-2">WA</a>
                             <form action="{{ route('admin.inquiry.destroy', $inq->id) }}" method="POST" onsubmit="return confirm('Hapus history ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg bg-orange-50 text-orange-500 hover:bg-rose-500 hover:text-white transition-all flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <i class="fa-solid fa-trash text-[10px]"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    function toggleHistory() {
        const content = document.getElementById('histContent');
        const icon = document.getElementById('histIcon');
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            setTimeout(() => {
                content.classList.replace('opacity-0', 'opacity-100');
            }, 10);
            icon.classList.add('rotate-180');
        } else {
            content.classList.replace('opacity-100', 'opacity-0');
            icon.classList.remove('rotate-180');
            setTimeout(() => {
                content.classList.add('hidden');
            }, 300);
        }
    }
</script>
</div>
@endsection
