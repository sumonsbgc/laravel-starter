<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 70);
            $table->string('slug', 70);
            $table->unsignedBigInteger('parent_id')->default(0);
            // $table->foreignId('parent_id')->constrained('categories', 'id');
            $table->text('description')->nullable();
            $table->boolean('featured')->nullable();
            $table->boolean('menu')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
