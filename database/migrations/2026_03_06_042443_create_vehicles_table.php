ç<?php

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
        Schema::create('vehicles', function (Blueprint $table) {
            // PK
            $table->id();

            // FK
            $table->foreignId('client_id')
                    ->constrained('clients', 'id')
                    ->onDelete('cascade');

            // Fields
            $table->string('plate', 9)->index();
            $table->string('brand', 50);
            $table->string('model', 50);
            $table->char('manufacturing_year', 4);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
