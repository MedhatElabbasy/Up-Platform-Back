<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRenewToCheckoutsTable extends Migration
{
    public function up()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            if (!Schema::hasColumn('checkouts', 'renew')) {
                $table->boolean('renew')->default(0);
            }
        });
    }

    public function down()
    {
        Schema::table('checkouts', function (Blueprint $table) {

        });
    }
}
