<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cartproducts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id'); 
            $table->string('product_name'); 
            $table->integer('quantity'); 
            $table->integer('price'); 
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
        Schema::dropIfExists('cartproducts');
    }
}
