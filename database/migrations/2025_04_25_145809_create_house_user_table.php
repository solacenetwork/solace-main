<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('house_user', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreignId('house_id')->constrained('houses', 'hid')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users', 'sid')->onDelete('cascade');
            $table->boolean('is_primary')->default(true);
            $table->timestamps();
            $table->primary(['house_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('house_user');
    }
};