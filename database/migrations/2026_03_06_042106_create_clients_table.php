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
        Schema::create('clients', function (Blueprint $table) {
            // PK
            $table->id();

            // Fields
            $table->string('name', 50);
            $table->string('lastname', 50);
            $table->char('dni', 8);
            $table->string('email');
            $table->string('phone_code');
            $table->string('phone');

            $table->timestamps();

            // Restrictions
            $table->unique('email');
            $table->unique('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
