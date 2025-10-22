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
            if (!Schema::hasColumn('promissory_notes', 'status')) {
                $table->string('status')->default('pending')->after('due_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('promissory_notes', function (Blueprint $table) {
            if (Schema::hasColumn('promissory_notes', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
