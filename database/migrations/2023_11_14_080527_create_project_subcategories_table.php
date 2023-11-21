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
        Schema::create('project_subcategories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_category_id');
            $table->string('name');
            $table->text('description');
            $table->integer('cost_from');
            $table->integer('cost_to');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('project_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_subcategories');
    }
};
