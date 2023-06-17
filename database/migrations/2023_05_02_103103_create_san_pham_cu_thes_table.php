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
        Schema::create('san_pham_cu_thes', function (Blueprint $table) {
            $table->id();
            $table->integer('san_pham_id');
            $table->integer('don_hang_id');
            $table->boolean('rated')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_pham_cu_thes');
    }
};
