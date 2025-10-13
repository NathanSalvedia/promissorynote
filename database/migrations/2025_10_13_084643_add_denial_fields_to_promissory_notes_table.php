<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDenialFieldsToPromissoryNotesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('promissory_notes', function (Blueprint $table) {
            $table->text('denial_reason')->nullable()->after('status');
            $table->unsignedBigInteger('denied_by')->nullable()->after('denial_reason');
            $table->timestamp('denied_at')->nullable()->after('denied_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promissory_notes', function (Blueprint $table) {
            $table->dropColumn(['status', 'denial_reason', 'denied_by', 'denied_at']);
        });
    }
};
