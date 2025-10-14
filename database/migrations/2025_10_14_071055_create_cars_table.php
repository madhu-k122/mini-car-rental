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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('c_code', 20)->unique()->index();
            $table->foreignId('c_user_id')->constrained('users')->onDelete('cascade')->index();
            $table->string('c_name', 100)->index();
            $table->string('c_type', 50);
            $table->string('c_location', 100)->index();
            $table->decimal('c_price_per_day', 8, 2);
            $table->string('c_image', 255)->nullable();
            $table->boolean('c_is_approved')->default(false)->index();
            $table->tinyInteger('c_status')->default(1)->index();
            $table->foreignId('c_created_by')->nullable()->index();
            $table->foreignId('c_updated_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
