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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('avatar')->default('avatars/Drr5XHa1VMnj6U5WYSyqqrfSvj4ZForUOYeAJrbq.jpg');
            $table->boolean('gender');
            $table->string('signature')->default('This user has not set a signature yet.');
            $table->string('location')->default('south');
            $table->string('tel')->nullable();
            $table->timestamp('birthday')->default(now());
            $table->boolean("notiEmail")->default(true);
            $table->boolean("notiFollow")->default(true);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
