<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBundleReveuneTo extends Migration
{
    public function up()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            if (!Schema::hasColumn('checkouts', 'Bundle_reveune')) {
                $table->string('bundle_reveune')->nullable();
            }
        });
    }

    public function down()
    {

    }
}
