<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_case_study_notes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id');
            $table->longText('main_partnerships');
            $table->longText('main_activities');
            $table->longText('added_value');
            $table->longText('customer_relations');
            $table->longText('customer_category');
            $table->longText('main_sub_activities');
            $table->longText('marketing_channels');
            $table->longText('project_revenue');
            $table->longText('project_costs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_casestudy_level_1');
    }
};
