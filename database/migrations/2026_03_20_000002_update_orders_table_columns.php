<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Hapus kolom lama yang tidak sesuai jika ada
            if (Schema::hasColumn('orders', 'client_email')) {
                $table->dropColumn('client_email');
            }
            if (Schema::hasColumn('orders', 'notes')) {
                $table->dropColumn('notes');
            }

            // Tambah kolom baru jika belum ada
            if (!Schema::hasColumn('orders', 'whatsapp_number')) {
                $table->string('whatsapp_number')->nullable()->after('client_name');
            }
            if (!Schema::hasColumn('orders', 'project_title')) {
                $table->string('project_title')->nullable()->after('whatsapp_number');
            }
            if (!Schema::hasColumn('orders', 'project_details')) {
                $table->text('project_details')->nullable()->after('project_title');
            }
            if (!Schema::hasColumn('orders', 'duration_days')) {
                $table->string('duration_days')->nullable()->after('project_details');
            }

            // Update default status
            $table->string('status')->default('proses')->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['whatsapp_number', 'project_title', 'project_details', 'duration_days']);
        });
    }
};
