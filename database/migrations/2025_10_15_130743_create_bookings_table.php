<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('b_id');
            $table->unsignedBigInteger('b_car_id');
            $table->unsignedBigInteger('b_user_id');
            $table->date('b_start_date');
            $table->date('b_end_date');
            $table->enum('b_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps(); // b_created_at and b_updated_at handled by default
            $table->softDeletes(); // b_deleted_at

            $table->index('b_car_id');
            $table->index('b_user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
