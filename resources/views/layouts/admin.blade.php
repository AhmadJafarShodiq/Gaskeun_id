<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaskeun.IDR | Admin Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .animate-slide-in { animation: slideIn 0.5s cubic-bezier(0.16, 1, 0.3, 1); }
        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-72 bg-white h-screen fixed left-0 top-0 border-r border-slate-100 p-8 hidden lg:flex flex-col z-[50]">
        <div class="flex items-center gap-3 mb-12 px-2">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-600/30">
                <i class="fa-solid fa-bolt-lightning text-lg"></i>
            </div>
            <span class="text-xl font-black text-slate-900 tracking-tighter italic">GASKEUN.IDR</span>
        </div>

        <nav class="flex-grow space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center gap-4 px-5 py-4 rounded-2xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 font-bold shadow-sm shadow-blue-600/5' : 'text-slate-400 hover:bg-slate-50 hover:text-blue-600 font-bold' }}">
                <i class="fa-solid fa-house-chimney"></i> Beranda
            </a>
            <a href="{{ route('admin.orders.index') }}" class="nav-item flex items-center gap-4 px-5 py-4 rounded-2xl transition-all {{ request()->routeIs('admin.orders.*') ? 'bg-blue-50 text-blue-600 font-bold shadow-sm shadow-blue-600/5' : 'text-slate-400 hover:bg-slate-50 hover:text-blue-600 font-bold' }}">
                <i class="fa-solid fa-cart-shopping"></i> Daftar Pesanan
            </a>
            <a href="{{ route('admin.inquiries.index') }}" class="nav-item flex items-center gap-4 px-5 py-4 rounded-2xl transition-all {{ request()->routeIs('admin.inquiries.*') ? 'bg-blue-50 text-blue-600 font-bold shadow-sm shadow-blue-600/5' : 'text-slate-400 hover:bg-slate-50 hover:text-blue-600 font-bold' }}">
                <i class="fa-solid fa-comment-dots"></i> Chat Masuk
                @if(isset($unreadCount) && $unreadCount > 0)
                    <span class="ml-auto w-5 h-5 bg-rose-500 text-[10px] text-white flex items-center justify-center rounded-full animate-bounce">{{ $unreadCount }}</span>
                @endif
            </a>
            <a href="{{ route('admin.services.index') }}" class="nav-item flex items-center gap-4 px-5 py-4 rounded-2xl transition-all {{ request()->routeIs('admin.services.*') ? 'bg-blue-50 text-blue-600 font-bold shadow-sm shadow-blue-600/5' : 'text-slate-400 hover:bg-slate-50 hover:text-blue-600 font-bold' }}">
                <i class="fa-solid fa-layer-group"></i> Kelola Layanan
            </a>
            <a href="{{ route('admin.portfolios.index') }}" class="nav-item flex items-center gap-4 px-5 py-4 rounded-2xl transition-all {{ request()->routeIs('admin.portfolios.*') ? 'bg-blue-50 text-blue-600 font-bold shadow-sm shadow-blue-600/5' : 'text-slate-400 hover:bg-slate-50 hover:text-blue-600 font-bold' }}">
                <i class="fa-solid fa-image"></i> Kelola Portfolio
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="nav-item flex items-center gap-4 px-5 py-4 rounded-2xl transition-all {{ request()->routeIs('admin.testimonials.*') ? 'bg-blue-50 text-blue-600 font-bold shadow-sm shadow-blue-600/5' : 'text-slate-400 hover:bg-slate-50 hover:text-blue-600 font-bold' }}">
                <i class="fa-solid fa-star"></i> Bukti Order / Testi
            </a>
            <a href="/" target="_blank" class="flex items-center gap-4 px-5 py-4 rounded-2xl text-slate-400 hover:bg-slate-50 hover:text-blue-600 font-bold transition-all">
                <i class="fa-solid fa-eye"></i> Lihat Website
            </a>
        </nav>

        <div class="pt-8 border-t border-slate-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-4 px-5 py-4 rounded-2xl text-rose-500 hover:bg-rose-50 font-bold transition-all">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow lg:ml-72 p-8 lg:p-12 min-h-screen bg-slate-50/30">
        <!-- Success Alert -->
        @if(session('success'))
        <div class="fixed top-8 right-8 z-[200] bg-emerald-500 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4 animate-slide-in">
            <i class="fa-solid fa-circle-check text-xl"></i>
            <span class="font-bold text-sm">{{ session('success') }}</span>
        </div>
        @endif

        <!-- Header -->
        <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <h1 class="text-3xl font-black text-slate-900 mb-1">@yield('header_title')</h1>
                <p class="text-slate-400 font-medium italic">@yield('header_desc')</p>
            </div>
            <div class="flex items-center gap-4 bg-white p-2 rounded-2xl border border-slate-200 shadow-sm">
                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white font-black shadow-lg shadow-blue-600/20">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="pr-4">
                    <p class="text-sm font-black text-slate-900 leading-none mb-1">{{ Auth::user()->name ?? 'Admin Gaskeun' }}</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Online Mode
                    </p>
                </div>
            </div>
        </header>

        @yield('content')
        
    </main>

    <style>
        html { scroll-behavior: smooth; }
        .animate-slide-in { animation: slideIn 0.5s cubic-bezier(0.16, 1, 0.3, 1); }
        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
    </style>
</body>
</html>
