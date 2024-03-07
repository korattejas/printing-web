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
        Schema::create('employee_master', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name', 50);
            $table->string('employee_code', 50);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('username', 50);
            $table->string('email', 50)->unique();
            $table->unsignedBigInteger('phone')->unique();
            $table->string('password');
            $table->text('address');
            $table->integer('country');
            $table->integer('state');
            $table->integer('city');
            $table->integer('zip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_master');
    }
};
