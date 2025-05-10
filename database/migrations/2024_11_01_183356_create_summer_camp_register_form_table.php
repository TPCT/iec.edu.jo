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
        Schema::create('summer_camp_register_form', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gender_id')->references('id')->on('dropdowns')->cascadeOnDelete();
            $table->foreignId('age_id')->references('id')->on('dropdowns')->cascadeOnDelete();
            $table->string('name')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('phone')->nullable(false);
            $table->text('message')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summer_camp_register_form');
    }
};
