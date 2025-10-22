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
    Schema::create('promissory_notes', function (Blueprint $table) {
            $table->bigIncrements('pn_id');
            $table->unsignedBigInteger('user_id');
            $table->string('gender');
            $table->string('course')->nullable();
            $table->string('department');
            $table->string('phone');
            $table->string('year_level');
            $table->decimal('amount', 10, 2);
            $table->string('reason');
            $table->string('other_reason')->nullable();
            $table->string('term');
            $table->string('semester');
            $table->string('academic_year');
            $table->decimal('down_payment', 10, 2)->nullable();
            $table->date('due_date')->nullable();
            $table->boolean('is_settled')->default(false);
            $table->timestamps();


              $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::dropIfExists('promissory_notes');
    }
};
