<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('age');
            $table->string('email');
            $table->string('number');
            $table->text('address');
            $table->unsignedBigInteger('vehicle_id');
            $table->date('pickup_date');
            $table->date('drop_date');
            $table->enum('payment_method', ['cash', 'online']);
            $table->string('payment_status')->default('pending');
            $table->string('message');
            $table->string('order_number')->unique();
            $table->string('reservation_status')->default('pending'); // Default status is 'pending'
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
