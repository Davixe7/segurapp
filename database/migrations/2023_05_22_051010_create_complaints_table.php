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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('residence_id');
            $table->foreignId('apartment_id')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('title');
            $table->text('description');
            $table->text('response')->nullable();
            $table->datetime('read_at')->nullable();
            $table->datetime('closed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
