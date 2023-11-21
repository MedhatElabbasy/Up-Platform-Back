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
        Schema::create('partnerships', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');

            $table->string('part_title');
            $table->text('part_desc')->nullable();
            $table->string('part_duration');
            $table->decimal('part_percentage', 5, 2);
            $table->string('part_location');
            $table->text('part_rules')->nullable();
            $table->decimal('part_cost', 10, 2);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('partner_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partnership');
    }
};
