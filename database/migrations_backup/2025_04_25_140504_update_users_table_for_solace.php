<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state', 2)->nullable(); // e.g., 'NY'
            $table->string('zip', 10)->nullable(); // e.g., '12345' or '12345-6789'
            $table->string('phone')->nullable();
            $table->string('nickname')->nullable();
            $table->string('avatar')->nullable(); // Path to avatar image
            $table->boolean('minor')->default(false);
            $table->date('birth_date')->nullable();
        });

        // Migrate existing name data to first_name and last_name
        DB::table('users')->get()->each(function ($user) {
            $names = explode(' ', $user->name, 2);
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'first_name' => $names[0] ?? null,
                    'last_name' => $names[1] ?? null,
                ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable();
        });

        // Restore name from first_name and last_name
        DB::table('users')->get()->each(function ($user) {
            $name = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
            DB::table('users')
                ->where('id', $user->id)
                ->update(['name' => $name ?: null]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name', 'last_name', 'address_line_1', 'address_line_2',
                'city', 'state', 'zip', 'phone', 'nickname', 'avatar',
                'minor', 'birth_date',
            ]);
        });
    }
};