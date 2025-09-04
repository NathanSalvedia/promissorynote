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
        Schema::create('student_account_subledger', function (Blueprint $table) {
        $table->bigIncrements('subledger_id');
       $table->unsignedBigInteger('user_id');
        $table->foreign('user_id')->references('id')->on('users');
        $table->string('school_year');
        $table->string('semester');
        $table->date('date');
        $table->string('reference');
        $table->decimal('debit', 10, 2)->default(0);
        $table->decimal('credit', 10, 2)->default(0);
        $table->decimal('balance', 10, 2)->default(0);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_account_subledger');
    }
};
