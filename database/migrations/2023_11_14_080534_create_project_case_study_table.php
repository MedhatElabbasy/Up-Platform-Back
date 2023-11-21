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
        Schema::create('project_case_study', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->integer('capital_cost');
            $table->double('loan_interest_percentage')->default(0);
            $table->integer('salary_per_year');
            $table->integer('rent_per_year');
            $table->integer('purchases_cost_per_year');
            $table->integer('decor_cost_per_month');
            $table->integer('marketing_cost');
            $table->json('government_fees');
            $table->integer('additional_costs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_case_study');
    }
};
