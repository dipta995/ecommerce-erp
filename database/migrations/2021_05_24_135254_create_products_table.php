<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');
            $table->integer('subcat_id');
            $table->integer('brand_id');
            $table->integer('product_type_id');
            $table->integer('total_hit')->nullable();
            $table->integer('total_rat')->nullable();
            $table->string('product_code');
            $table->string('name');
            $table->longText('details');
            $table->string('quantity');
            $table->integer('unit_id');
            $table->string('buy_price');
            $table->string('sell_price');
            $table->string('discount');
            $table->string('image_one');
            $table->integer('junk');
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
        Schema::dropIfExists('products');
    }
}
