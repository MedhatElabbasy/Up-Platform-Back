<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->tinyInteger('quize_type')->after('type')->default(1)->nullable()->comment = '1=webSiteExam, 2=traningExam';
        });


        if (Schema::hasColumn('courses', 'type')) {
            DB::table('courses')->where('type', '1')->update(['quize_type' => null]);
        }
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            //
        });
    }
};