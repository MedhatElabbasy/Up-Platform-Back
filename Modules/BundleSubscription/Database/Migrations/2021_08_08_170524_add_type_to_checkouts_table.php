<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AddTypeToCheckoutsTable extends Migration
{
    public function up()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            if (!Schema::hasColumn('checkouts', 'payment_type')) {
                $table->string('payment_type')->nullable();
            }

            if (!Schema::hasColumn('checkouts', 'course_type')) {
                $table->string('course_type')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('checkouts', function (Blueprint $table) {

        });
    }
}
