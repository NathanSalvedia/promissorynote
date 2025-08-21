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
        Schema::create('promissorynotes', function (Blueprint $table) {
            $table->bigIncrements('pn_id');
            $table->unsignedBigInteger('id');
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->text('reason');
            $table->boolean('partial_payment');
            $table->string('partial_payment_status');
            $table->decimal('total_balance', 8, 2);
            $table->string('status');
            $table->string('denied_by');
            $table->timestamp('denial_timestamp');
            $table->text('rejection_reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promissorynotes');
    }
};
