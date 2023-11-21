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
        Schema::create('project_marketing_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id');
            $table->string('name');
            $table->bigInteger('quantity');
            $table->double('price');
            $table->double('profit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_marketing_products');
    }
};
