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
            $table->string('name');
            $table->string('reference')->unique();
            $table->string('photo')->nullable();
            $table->decimal('quantity', 15, 2)->default(0);
            $table->timestamps();
            
            $table->index('reference');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
