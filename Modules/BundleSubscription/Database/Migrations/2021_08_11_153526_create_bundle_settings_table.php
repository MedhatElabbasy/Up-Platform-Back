<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBundleSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('bundle_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('commission_rate');
            $table->timestamps();
        });
        DB::table('bundle_settings')->insert([
            'commission_rate' => 50
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('bundle_settings');
    }
}
