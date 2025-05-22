<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('families', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('fid'); // Family ID, primary key
            $table->foreignId('house_id')->nullable()->constrained('houses', 'hid')->onDelete('cascade');
            $table->foreignId('primary_user_id')->nullable()->constrained('users', 'sid')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('family_user', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreignId('family_id')->constrained('families', 'fid')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users', 'sid')->onDelete('cascade');
            $table->string('role', 50)->default('member');
            $table->timestamps();
            $table->primary(['family_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_user');
        Schema::dropIfExists('families');
    }
};