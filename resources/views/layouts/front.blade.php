<!DOCTYPE html>
<html lang="id" class="scroll-smooth overflow-x-hidden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gaskeun.IDR - Jasa Koding, Desain & Tugas Kuliah Terpercaya</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-gradient-premium {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
        }
        .text-gradient {
            background: linear-gradient(to right, #60a5fa, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        @keyframes floating {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        @keyframes pulse-glow {
            0% { filter: drop-shadow(0 0 10px rgba(59, 130, 246, 0.5)); }
            50% { filter: drop-shadow(0 0 30px rgba(59, 130, 246, 0.8)); }
            100% { filter: drop-shadow(0 0 10px rgba(59, 130, 246, 0.5)); }
        }
        .animate-floating-logo {
            animation: floating 4s ease-in-out infinite, pulse-glow 3s ease-in-out infinite;
        }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-800 overflow-x-hidden">
    
    @include('home.navbar')
    @yield('content')
    @include('home.footer')
    @include('home.modals')
    <script>
        function openOrderModal(serviceTitle, basePrice, whatsappNumber) {
            document.getElementById('orderServiceTitle').innerText = serviceTitle;
            document.getElementById('serviceInput').value = serviceTitle;
            document.getElementById('basePriceInput').value = basePrice;
            document.getElementById('waNumberInput').value = whatsappNumber || '';
            document.getElementById('orderModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            const unitSelect = document.getElementById('durationUnitSelect');
            const durationInput = document.getElementById('durationValue');

            // Default Suggestion
            const longTermKeywords = ['Web', 'App', 'Aplikasi', 'Sistem', 'AI', 'Machine Learning', 'Video', 'Editor', 'Editing'];
            const isLongTerm = longTermKeywords.some(keyword => serviceTitle.includes(keyword));
            
            if (isLongTerm) {
                unitSelect.value = 'Bulan';
                durationInput.value = 1;
            } else {
                unitSelect.value = 'Hari';
                durationInput.value = 3;
            }

            calculateTotal();
        }

        function closeOrderModal() {
            document.getElementById('orderModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function calculateTotal() {
            const basePrice = parseInt(document.getElementById('basePriceInput').value);
            const val = parseFloat(document.getElementById('durationValue').value) || 1;
            const unit = document.getElementById('durationUnitSelect').value;
            
            let multiplier = 1;
            
            if (unit === 'Hari') {
                if (val <= 1) multiplier = 1.25; 
                else if (val <= 2) multiplier = 1.1;
            } else if (unit === 'Minggu') {
                if (val <= 1) multiplier = 1.15;
            } else {
                // Bulan (Harga Normal)
            }

            const total = Math.round(basePrice * multiplier);
            const dp = Math.round(total * 0.5);

            document.getElementById('totalPriceInput').value = total;
            document.getElementById('displayTotal').innerText = "Rp " + total.toLocaleString('id-ID');
            document.getElementById('displayDP').innerText = "Rp " + dp.toLocaleString('id-ID');
        }

        async function handleOrderSubmit(event) {
            event.preventDefault();

            const service = document.getElementById('serviceInput').value;
            const name    = document.getElementById('nameInput').value;
            const title   = document.getElementById('titleInput').value;
            const detail  = document.getElementById('detailInput').value;
            const val     = document.getElementById('durationValue').value;
            const unit    = document.getElementById('durationUnitSelect').value;
            const total   = document.getElementById('totalPriceInput').value;
            const rawWa   = document.getElementById('waNumberInput').value || "6289525194553";
            const whatsappNumber = rawWa.replace(/[\s\+\-]/g, '');

            const submitBtn = event.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';
            submitBtn.disabled = true;

            // Simpan ke database dulu
            try {
                await fetch('/order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        service_title:   service,
                        client_name:     name,
                        whatsapp_number: whatsappNumber,
                        project_title:   title,
                        project_details: detail,
                        duration_days:   val + ' ' + unit,
                        price:           parseInt(total),
                    })
                });
            } catch (e) {
                console.warn('Gagal simpan order ke server, lanjut buka WA:', e);
            }

            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;

            // Buka WhatsApp
            const message = `Halo Gaskeun.IDR, saya mau order paket ini:
-----------------------------------
 🛠️ Layanan: *${service}*
 👤 Nama: *${name}*
 📝 Judul: *${title}*
 💬 Kebutuhan: ${detail}
 ⏳ Durasi Target: *${val} ${unit}*
 💰 Total Biaya: *Rp ${parseInt(total).toLocaleString('id-ID')}*
-----------------------------------
Tolong diproses ya min, saya langsung kirim bukti bayar DP di chat selanjutnya!`;

            const encodedMessage = encodeURIComponent(message);
            const waUrl = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;

            const link = document.createElement('a');
            link.href = waUrl;
            link.target = '_blank';
            link.rel = 'noopener noreferrer';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            closeOrderModal();
        }

        // --- Inquiry Logic ---
        function openInquiryModal() {
            document.getElementById('inquiryModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeInquiryModal() {
            document.getElementById('inquiryModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        async function handleInquirySubmit(event) {
            event.preventDefault();
            const btn = document.getElementById('inquiryBtn');
            const originalText = btn.innerText;
            btn.innerText = "Mengirim...";
            btn.disabled = true;

            const name = document.getElementById('inquiryName').value;
            const message = document.getElementById('inquiryMessage').value;
            const whatsapp_number = document.getElementById('inquiryWA').value;

            try {
                const response = await fetch('/inquiry', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name, message, whatsapp_number })
                });

                const res = await response.json();
                if(response.ok && res.success) {
                    alert("✅ Pesan Terkirim! Segera cek menu Chat Masuk di Admin.");
                    closeInquiryModal();
                    document.getElementById('inquiryForm').reset();
                } else {
                    alert("❌ Gagal Terkirim: " + (res.message || "Ada masalah di server"));
                }
            } catch (error) {
                console.error(error);
                alert("🚨 Error fatal: Tidak bisa menyambung ke server. Pastikan internet lancar!");
            } finally {
                btn.innerText = originalText;
                btn.disabled = false;
            }
        }
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }
    </style>
</body>
</html>
