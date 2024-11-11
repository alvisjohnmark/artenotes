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
        Schema::create('recipient_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->unique()->onDelete('cascade'); 
            $table->string('font')->nullable();
            $table->boolean('has_rose')->default(false);
            $table->string('envelope_color')->nullable();
            $table->string('recipient_name')->nullable();
            $table->string('province')->nullable();
            $table->string('city_municipality')->nullable();
            $table->string('barangay')->nullable();
            $table->string('street')->nullable();
            $table->longText('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipient_details');
    }
};
