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
        Schema::create('periods', function (Blueprint $table) {
            $table->bigIncrements('period_id');
            $table->unsignedBigInteger('pn_id');

            $table->string('semester');
            $table->string('academic_year');
            $table->timestamps();

             $table->foreign('pn_id')->references('pn_id')->on('promissory_notes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periods');
    }
};
