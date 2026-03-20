@extends('layouts.admin')

@section('header_title', 'Beranda')
@section('header_desc', 'Monitoring orderan dan chat Gaskeun.IDR hari ini.')

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
    <!-- Total Earned -->
    <div class="bg-blue-600 p-8 rounded-[2.5rem] shadow-2xl shadow-blue-600/30 relative overflow-hidden group border-4 border-white">
        <div class="relative z-10">
            <p class="text-blue-100 text-[10px] font-black uppercase tracking-[0.3em] mb-4">Total Pendapatan</p>
            <h3 class="text-4xl font-black text-white mb-2 tracking-tighter">Rp {{ number_format($totalEarned, 0, ',', '.') }}</h3>
            <p class="text-blue-100/60 text-[10px] font-black uppercase tracking-wider italic">Hanya dari order Selesai</p>
        </div>
        <i class="fa-solid fa-sack-dollar absolute -right-4 -bottom-4 text-9xl text-blue-500/30 rotate-12 group-hover:scale-110 transition-transform"></i>
    </div>
    <!-- Orders -->
    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-200 relative overflow-hidden group">
        <div class="relative z-10">
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mb-4">Total Order</p>
            <h3 class="text-4xl font-black text-slate-900 mb-2 tracking-tighter">{{ $totalOrder }}</h3>
            <div class="flex items-center gap-4">
                <p class="text-blue-600 text-[10px] font-black uppercase tracking-widest">{{ $totalProgres }} Progres</p>
                <p class="text-rose-500 text-[10px] font-black uppercase tracking-widest">{{ $totalBatal }} Batal</p>
            </div>
        </div>
        <i class="fa-solid fa-cart-shopping absolute -right-4 -bottom-4 text-9xl text-slate-100 rotate-12 group-hover:scale-110 transition-transform"></i>
    </div>
    <!-- Chat Masuk -->
    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-200 relative overflow-hidden group">
        <div class="relative z-10" id="inquiries">
            <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em] mb-4">Chat Masuk (Custom)</p>
            <h3 class="text-4xl font-black text-slate-900 mb-2 tracking-tighter">{{ $inquiryCount }}</h3>
            <p class="text-rose-500 text-xs font-black uppercase tracking-widest animate-pulse">{{ $unreadCount }} Pending</p>
        </div>
        <i class="fa-solid fa-comments absolute -right-4 -bottom-4 text-9xl text-slate-100 -rotate-12 group-hover:scale-110 transition-transform"></i>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-12">
    <!-- Latest Orders -->
    <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-200" id="orders">
        <div class="flex items-center justify-between mb-10">
            <h4 class="text-xl font-black text-slate-900">Orderan Terbaru</h4>
            <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-4 py-2 rounded-xl uppercase tracking-widest italic border border-blue-100">Live Update</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-slate-100">
                        <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Client</th>
                        <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Layanan</th>
                        <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Harga</th>
                        <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($orders as $order)
                    <tr>
                        <td class="py-6">
                            <p class="font-black text-slate-900 text-sm mb-1">{{ $order->client_name }}</p>
                            <p class="text-[10px] text-slate-400 font-bold tracking-widest">REF: #{{ $order->order_number }}</p>
                        </td>
                        <td class="py-6">
                            <span class="text-[10px] font-black text-blue-600 bg-blue-50 border border-blue-100 px-3 py-1.5 rounded-lg uppercase italic">{{ $order->service->title ?? 'Layanan' }}</span>
                        </td>
                        <td class="py-6 text-right font-black text-slate-950 text-sm">
                            Rp {{ number_format($order->price, 0, ',', '.') }}
                        </td>
                        <td class="py-6 text-center">
                            <span class="text-[9px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest border shadow-sm
                                @if($order->status == 'selesai') bg-emerald-500 text-white border-emerald-400
                                @elseif($order->status == 'batal') bg-rose-500 text-white border-rose-400
                                @else bg-orange-400 text-white border-orange-300 @endif">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-20 text-center text-slate-400 italic font-medium">Bantu promo bos, belum ada pelaris!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Inquiries (Chat Masuk) -->
    <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-200" id="inquiries_list">
        <div class="flex items-center justify-between mb-10">
            <h4 class="text-xl font-black text-slate-900 italic">Chat Masuk</h4>
            <span class="text-[10px] font-bold text-rose-600 bg-rose-50 px-4 py-2 rounded-xl uppercase tracking-widest border border-rose-100">Butuh Balasan</span>
        </div>
        
        <div class="space-y-6">
            @forelse($inquiries->where('status', 'unread') as $inq)
            <div class="p-8 rounded-[2rem] border border-slate-100 hover:border-blue-400 hover:bg-slate-50 transition-all relative group shadow-sm bg-slate-50/50">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h5 class="font-black text-slate-900 text-sm mb-1">{{ $inq->name }}</h5>
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">{{ $inq->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="w-3 h-3 bg-blue-600 rounded-full animate-ping shadow-lg shadow-blue-600/50"></span>
                </div>
                <p class="text-slate-600 text-sm leading-relaxed italic mb-8 border-l-4 border-blue-500 pl-4 py-2">"{{ $inq->message }}"</p>
                <div class="flex items-center gap-3">
                    <a href="https://wa.me/{{ $inq->whatsapp_number }}?text=Halo%20{{ $inq->name }},%20admin%20Gaskeun.IDR%20di%20sini..." 
                       target="_blank"
                       class="text-[11px] font-black text-white bg-green-500 hover:bg-green-600 px-6 py-3 rounded-2xl transition-all flex items-center gap-2 shadow-lg shadow-green-500/30 active:scale-95">
                       <i class="fa-brands fa-whatsapp text-lg"></i> Balas WhatsApp
                    </a>
                    <form action="{{ route('inquiry.update', $inq->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-[10px] font-black text-slate-500 hover:text-white hover:bg-slate-900 px-6 py-3 border border-slate-200 rounded-2xl transition-all active:scale-95">
                            Tandai Selesai
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="text-center py-24 bg-slate-50 rounded-[2.5rem] border border-dashed border-slate-200">
                <i class="fa-solid fa-face-smile-wink text-5xl text-slate-200 mb-6 block"></i>
                <p class="text-slate-400 font-black italic uppercase tracking-widest">Semua chat sudah dibalas!</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
