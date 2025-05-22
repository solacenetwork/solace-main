<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('neighborhoods', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('nid');
            $table->string('label', 100);
            $table->json('geometry');
            $table->foreignId('captain_id')->nullable()->constrained('users', 'sid')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('neighborhoods');
    }
};