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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender',["l","p"]);
            $table->string("email");
            $table->string('address');
            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id')
            ->references('id')
            ->on('positions');
            $table->string('profile_img')->nullable();
            $table->boolean('status')->default("1");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
