<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBubdleToCartsTable extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            if (!Schema::hasColumn('carts', 'bundle_course_id')) {
                $table->integer('bundle_course_id')->unsigned()->default(0);
            }
            if (!Schema::hasColumn('carts', 'bundle_course_validity')) {
                $table->date('bundle_course_validity')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {

        });
    }
}
