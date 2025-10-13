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
        Schema::table('promissory_notes', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_pn_id')->nullable()->after('pn_id');
            $table->foreign('parent_pn_id')->references('pn_id')->on('promissory_notes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promissory_notes', function (Blueprint $table) {
            $table->dropForeign(['parent_pn_id']);
            $table->dropColumn('parent_pn_id');
        });
    }
};
