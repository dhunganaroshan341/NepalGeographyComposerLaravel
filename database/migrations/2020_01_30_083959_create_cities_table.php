<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('municipality_id');

            $table->string('name');

            // Denormalized snapshot fields (optional)
            $table->string('province_name')->nullable();
            $table->string('district_name')->nullable();
            $table->string('municipality_name')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('province_id');
            $table->index('district_id');
            $table->index('municipality_id');

            // Foreign keys
            $table->foreign('province_id')
                ->references('id')
                ->on('states')
                ->cascadeOnDelete();

            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->cascadeOnDelete();

            $table->foreign('municipality_id')
                ->references('id')
                ->on('vdc_municipalities')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
