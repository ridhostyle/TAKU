<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom id (auto-increment)
            $table->string('name'); // Kolom untuk nama
            $table->string('username')->unique(); // Kolom untuk username, dengan index unik
            $table->string('password'); // Kolom untuk password
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
