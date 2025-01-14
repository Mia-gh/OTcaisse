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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('color', 30)->nullable();
            $table->longText('description')->nullable();
            $table->enum('status',['actif','inactif'])->default('actif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

// CREATE TABLE categories (
//     id INT PRIMARY KEY AUTO_INCREMENT,
//     name VARCHAR(255) UNIQUE,
//     color VARCHAR(30),
//     description TEXT,
//     status ENUM('actif', 'inactif') DEFAULT 'actif',
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
// );