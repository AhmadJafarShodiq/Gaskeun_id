<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Gaskeun.IDR</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-premium {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
        }
    </style>
</head>
<body class="antialiased bg-slate-50 min-h-screen flex items-center justify-center p-4">
    
    <div class="absolute inset-0 bg-gradient-premium overflow-hidden z-0">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-500/20 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-cyan-500/20 rounded-full blur-[100px]"></div>
    </div>

    <div class="relative z-10 w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-full shadow-xl shadow-blue-500/20 mb-4 overflow-hidden border-4 border-blue-100 animate-pulse transition-all">
                <img src="/images/logo.png" alt="Gaskeun.IDR Logo" class="w-full h-full object-cover">
            </div>
            <h2 class="text-3xl font-bold text-white tracking-tight">Gaskeun<span class="text-blue-400">.IDR</span></h2>
            <p class="text-blue-200 mt-2 font-medium">Admin Portal</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white rounded-3xl p-8 shadow-2xl border border-white/20 relative backdrop-blur-xl">
            <h3 class="text-2xl font-bold text-slate-900 mb-6">Welcome Back 👋</h3>
            
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 rounded-r-xl">
                        <div class="flex items-center gap-2 text-rose-800 font-bold text-sm">
                            <i class="fa-solid fa-circle-exclamation text-rose-500"></i>
                            Oops! Ada Masalah.
                        </div>
                        <ul class="mt-1 text-rose-600 text-xs font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-envelope text-slate-400"></i>
                        </div>
                        <input type="email" name="email" class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" placeholder="admin@gaskeun.id" required>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-semibold text-slate-700">Password</label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-slate-400"></i>
                        </div>
                        <input type="password" name="password" class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-8">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-sm text-slate-600 font-medium">Remember me</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    Masuk ke Dashboard <i class="fa-solid fa-arrow-right text-sm"></i>
                </button>
            </form>
            
            <div class="mt-8 text-center">
                <a href="/" class="text-sm text-slate-500 hover:text-blue-600 font-medium transition-colors">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
        
        <!-- Decoration -->
        <div class="absolute -z-10 -bottom-6 -right-6 w-24 h-24 bg-gradient-to-br from-blue-400 to-indigo-600 rounded-full blur-2xl opacity-50"></div>
    </div>

</body>
</html>
