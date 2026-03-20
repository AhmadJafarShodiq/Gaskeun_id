@extends('layouts.admin')

@section('header_title', 'Daftar Pesanan')
@section('header_desc', 'Semua riwayat pesanan yang masuk ke Gaskeun.IDR')

@section('content')
<div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-200">
    <div class="flex items-center justify-between mb-10">
        <h4 class="text-xl font-black text-slate-900">Semua Orderan</h4>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left border-b border-slate-100">
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Client & Kontak</th>
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Layanan & Detail</th>
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Harga</th>
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                    <th class="pb-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($orders as $order)
                <tr>
                    <td class="py-6">
                        <p class="font-black text-slate-900 text-sm mb-1">{{ $order->client_name }}</p>
                        <p class="text-[10px] text-slate-400 font-bold tracking-widest mb-1">WA: {{ $order->whatsapp_number }}</p>
                        <p class="text-[10px] text-slate-400 font-bold tracking-widest">REF: #{{ $order->order_number }}</p>
                        <p class="text-[10px] text-slate-400 font-bold tracking-widest">{{ $order->created_at->format('d M Y') }}</p>
                    </td>
                    <td class="py-6 min-w-[200px]">
                        <span class="text-[10px] font-black text-blue-600 bg-blue-50 border border-blue-100 px-3 py-1.5 rounded-lg uppercase italic mb-2 inline-block">{{ $order->service->title ?? 'Layanan' }}</span>
                        <p class="text-sm font-bold text-slate-900">{{ $order->project_title }}</p>
                        <p class="text-[11px] text-slate-500 line-clamp-2 mt-1">{{ $order->project_details }}</p>
                    </td>
                    <td class="py-6 text-right font-black text-slate-950 text-sm">
                        <p>Rp {{ number_format($order->price, 0, ',', '.') }}</p>
                        <p class="text-[9px] text-slate-400 uppercase tracking-widest mt-1">Estimasi: {{ $order->duration_days }} Hari</p>
                    </td>
                    <td class="py-6 text-center">
                        <span class="text-[9px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest border shadow-sm
                            @if($order->status == 'selesai') bg-emerald-500 text-white border-emerald-400
                            @elseif($order->status == 'batal') bg-rose-500 text-white border-rose-400
                            @else bg-orange-400 text-white border-orange-300 @endif">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="py-6 text-center">
                        <div class="flex flex-col gap-2 items-center justify-center">
                            @if($order->status == 'proses')
                                <div class="flex gap-2">
                                    <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="selesai">
                                        <button type="submit" class="text-[10px] font-black px-4 py-2 rounded-xl text-white bg-blue-600 hover:bg-blue-700 shadow-md shadow-blue-600/20 transition-all active:scale-95">
                                            Selesai
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="batal">
                                        <button type="submit" class="text-[10px] font-black px-4 py-2 rounded-xl text-white bg-rose-500 hover:bg-rose-600 shadow-md shadow-rose-500/20 transition-all active:scale-95">
                                            Batal
                                        </button>
                                    </form>
                                </div>
                            @else
                                <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="proses">
                                    <button type="submit" class="text-[10px] font-black px-4 py-2 rounded-xl text-slate-500 bg-slate-100 hover:bg-slate-200 transition-all active:scale-95">
                                        Kembalikan ke Proses
                                    </button>
                                </form>
                            @endif
                            <a href="https://wa.me/{{ $order->whatsapp_number }}" target="_blank" class="w-full text-center text-[10px] font-black text-white bg-green-500 px-4 py-2 rounded-xl transition-all shadow-md shadow-green-500/20 hover:bg-green-600 active:scale-95">
                                Chat WA
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-20 text-center text-slate-400 italic font-medium">Belum ada orderan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
