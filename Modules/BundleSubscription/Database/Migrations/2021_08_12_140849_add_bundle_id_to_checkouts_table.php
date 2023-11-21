<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBundleIdToCheckoutsTable extends Migration
{
    public function up()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            if (!Schema::hasColumn('checkouts', 'bundle_id')) {
                $table->integer('bundle_id')->unsigned()->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('checkouts', function (Blueprint $table) {

        });
    }
}
