<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->string('slug', 256)->unique();
            $table->string('description', 1024)->nullable();
            $table->string('image', 2048)->nullable();
            $table->double('price')->default(0);
            $table->integer('quantity')->default(0);
            $table->integer('view')->default(0);
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
