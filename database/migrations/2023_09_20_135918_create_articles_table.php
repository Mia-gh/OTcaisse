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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->decimal('price');
            $table->integer('quantity')->default(0);
            $table->integer('quantity_alert')->default(10);
            $table->foreignId('category_id')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('reference')->nullable();
            $table->enum('status',['actif','inactif'])->default('actif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

// CREATE TABLE articles (
//     id INT PRIMARY KEY AUTO_INCREMENT,
//     title VARCHAR(255) UNIQUE,
//     price DECIMAL(10, 2),
//     quantity INT DEFAULT 0,
//     quantity_alert INT DEFAULT 10,
//     category_id INT,
//     image VARCHAR(255),
//     description TEXT,
//     reference VARCHAR(255),
//     status ENUM('actif', 'inactif') DEFAULT 'actif',
//     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
//     FOREIGN KEY (category_id) REFERENCES categories(id)
// );