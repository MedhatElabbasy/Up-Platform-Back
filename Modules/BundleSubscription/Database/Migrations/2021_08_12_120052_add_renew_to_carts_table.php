<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRenewToCartsTable extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            if (!Schema::hasColumn('carts', 'renew')) {
                $table->boolean('renew')->default(0);
            }
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {

        });
    }
}
