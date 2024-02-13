<?php

use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('no_induk_pegawai')->nullable();
            $table->string('role');
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt(123),
            'role'=>'admin'
        ]);
        User::create([
            'name'=>'Sales Luar',
            'email'=>'sales@gmail.com',
            'password'=>bcrypt(123),
            'role'=>'sales',
            'no_induk_pegawai'=>'1234'
        ]);
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
