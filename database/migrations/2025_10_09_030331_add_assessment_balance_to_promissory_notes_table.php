<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAssessmentBalanceToPromissoryNotesTable extends Migration
{
    public function up()
    {
        Schema::table('promissory_notes', function (Blueprint $table) {
            $table->decimal('assessment_balance', 12, 2)->nullable()->after('amount');
        });
    }

    public function down()
    {
        Schema::table('promissory_notes', function (Blueprint $table) {
            $table->dropColumn('assessment_balance');
        });
    }
}
