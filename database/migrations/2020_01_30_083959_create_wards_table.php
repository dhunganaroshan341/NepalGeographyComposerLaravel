<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->id();

            // Core relation
            $table->unsignedBigInteger('municipality_id')->nullable();

            // Optional denormalized field
            $table->unsignedBigInteger('province_id')->nullable();

            // Ward identity
            $table->unsignedInteger('ward_number');
            $table->string('name')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('municipality_id');
            $table->index('province_id');
            $table->index('ward_number');

            // Foreign key
            $table->foreign('municipality_id')
                ->references('id')
                ->on('municalities')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wards');
    }
};