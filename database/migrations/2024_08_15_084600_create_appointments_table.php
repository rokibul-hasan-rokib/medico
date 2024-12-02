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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->date('date');
            $table->string('department');
            $table->string('doctor');
            $table->integer('age');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'pending'])->default('pending');
            $table->timestamp('canceled_at')->nullable();

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
        $table->dropColumn('canceled_at');
    }
};