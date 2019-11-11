<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('user_id');
            $table->string('avatar');
            $table->string('product');
            $table->integer('price');
            $table->integer('quantily');
            $table->text('description');
            $table->integer('size_id');
            $table->integer('libraryimg_id');
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
        Schema::dropIfExists('product');
    }
}
