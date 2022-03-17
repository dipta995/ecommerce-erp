<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('sleep_no');
            $table->string('product_code');
            $table->string('order_quantity');
            $table->string('buy_price');
            $table->string('selling_price');
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            //$table->string('order_at')->useCurrent()->nullable();
            $table->timestamp('order_at')->useCurrent();



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
        Schema::dropIfExists('orders');
    }
}
