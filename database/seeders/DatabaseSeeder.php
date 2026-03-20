<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        User::create([
            'name' => 'Admin Gaskeun',
            'email' => 'admin@gaskeun.id',
            'password' => Hash::make('password'),
        ]);

        // 2. Create Services (12 + 1 Custom)
        $services = [
            [
                'title' => 'Joki Koding App & Web',
                'description' => 'Website, Mobile App, atau Sistem Informasi dari awal sampai deploy.',
                'icon' => 'fa-code',
                'base_price' => 1000000,
                'estimated_days' => 7
            ],
            [
                'title' => 'Tugas Kuliah IT',
                'description' => 'Bantuin tugas koding, algoritma, skripsi, atau TA informatika.',
                'icon' => 'fa-graduation-cap',
                'base_price' => 300000,
                'estimated_days' => 3
            ],
            [
                'title' => 'UI/UX & Desain Grafis',
                'description' => 'Desain interface aplikasi atau website yang modern & estetik.',
                'icon' => 'fa-pen-nib',
                'base_price' => 200000,
                'estimated_days' => 2
            ],
            [
                'title' => 'Video Editing',
                'description' => 'Edit video tugas, YouTube, reels, atau TikTok profesional.',
                'icon' => 'fa-video',
                'base_price' => 100000,
                'estimated_days' => 1
            ],
            [
                'title' => 'Laporan & Dokumentasi IT',
                'description' => 'Bikin laporan praktikum atau dokumen teknis lainnya.',
                'icon' => 'fa-file-lines',
                'base_price' => 75000,
                'estimated_days' => 1
            ],
            [
                'title' => 'Desain PPT & Poster',
                'description' => 'Slide presentasi sidang atau poster ilmiah yang visualnya premium.',
                'icon' => 'fa-chalkboard',
                'base_price' => 100000,
                'estimated_days' => 1
            ],
            [
                'title' => 'Slicing UI (Desain ke Kode)',
                'description' => 'Ubah desain Figma jadi HTML/Tailwind/Flutter yang presisi.',
                'icon' => 'fa-layer-group',
                'base_price' => 250000,
                'estimated_days' => 2
            ],
            [
                'title' => 'AI & Machine Learning',
                'description' => 'Buat model AI, olah data, atau algoritma ML/DL.',
                'icon' => 'fa-brain',
                'base_price' => 500000,
                'estimated_days' => 5
            ],
            [
                'title' => 'Undangan Digital',
                'description' => 'Website undangan nikahan premium, fitur RSVP & Maps.',
                'icon' => 'fa-envelope-open-text',
                'base_price' => 150000,
                'estimated_days' => 2
            ],
            [
                'title' => 'Tugas Sekolah (SMA/SMP)',
                'description' => 'Tugas harian MTK, IPA, IPS, atau Bahasa Inggris.',
                'icon' => 'fa-book',
                'base_price' => 50000,
                'estimated_days' => 1
            ],
            [
                'title' => 'Hosting & Deploy Web',
                'description' => 'Bantu online-kan web ke Server/VPS/Hosting.',
                'icon' => 'fa-server',
                'base_price' => 150000,
                'estimated_days' => 1
            ],
            [
                'title' => 'Jasa Perbaikan Bug',
                'description' => 'Beresin error kodingan yang bikin pusing.',
                'icon' => 'fa-bug',
                'base_price' => 75000,
                'estimated_days' => 1
            ],
            [
                'title' => 'Tugas Lainnya (Custom)',
                'description' => 'Punya tugas unik atau project yang nggak ada di daftar? Tanya admin aja dulu, kita Gaskeun!',
                'icon' => 'fa-ellipsis',
                'base_price' => 50000,
                'estimated_days' => 3
            ],
        ];

        foreach ($services as $svc) {
            Service::create($svc);
        }

        // 3. Create Orders (Dummy Data)
        Order::create([
            'order_number' => 'GSK-0921',
            'service_id' => 1,
            'client_name' => 'Andi Dermawan',
            'client_email' => 'andi@email.com',
            'status' => 'proses',
            'price' => 1000000,
            'notes' => 'Tolong buatkan e-commerce',
        ]);
    }
}
