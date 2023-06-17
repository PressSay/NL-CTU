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
        Schema::create('image_tmps', function (Blueprint $table) {
            $table->id();
            $table->text('path');
            $table->integer('user_id');
            $table->integer('thread_comment_id')->nullable();
            $table->integer('san_pham_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_tmps');
    }
};
