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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('u_code', 20)->unique()->index();
            $table->string('u_name', 100);
            $table->string('u_email', 100)->unique()->index();
            $table->timestamp('u_email_verified_at')->nullable();
            $table->string('u_password');
            $table->enum('u_role', ['admin', 'supplier'])->default('supplier')->index();
            $table->tinyInteger('u_status')->default(1)->index();
            $table->foreignId('u_created_by')->nullable()->index();
            $table->foreignId('u_updated_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
