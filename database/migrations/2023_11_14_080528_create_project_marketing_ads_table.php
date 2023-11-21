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
        Schema::create('project_marketing_ads', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->integer('marketing_product_id');
            $table->string('name');
            $table->string('name');
            $table->text('image');
            $table->text('video');
            $table->text('link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_marketing_ads');
    }
};
