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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('apartment_id');
            $table->string('dni')->nullable();;
            $table->enum('gender', ['m', 'f'])->default('m');
            $table->unsignedInteger('age')->nullable();
            $table->string('name');
            $table->boolean('is_owner')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};

