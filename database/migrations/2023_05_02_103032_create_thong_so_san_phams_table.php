<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('thong_so_san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('TenThongSo');
            $table->string('ChiTiet');
            $table->integer('san_pham_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thong_so_san_phams');
    }
};
