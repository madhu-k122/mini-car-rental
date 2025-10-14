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
        Schema::create('car_availabilities', function (Blueprint $table) {
            $table->id();
            $table->string('a_code', 20)->unique()->index();
            $table->foreignId('a_car_id')->constrained('cars')->onDelete('cascade')->index();
            $table->date('a_date')->index();
            $table->boolean('a_is_available')->default(true)->index();
            $table->tinyInteger('a_status')->default(1)->index();
            $table->foreignId('a_created_by')->nullable()->index();
            $table->foreignId('a_updated_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_availabilities');
    }
};
