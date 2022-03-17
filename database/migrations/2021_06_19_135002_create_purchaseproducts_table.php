<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseproducts', function (Blueprint $table) {
            $table->id();
            $table->integer('agent_id');
            $table->string('pr_code');
            $table->string('pr_name');
            $table->string('pr_price');
            $table->string('pr_extracost')->nullable();
            $table->string('pr_unit');
            $table->string('pr_quantity');
            $table->integer('sift_status')->default('0');
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
        Schema::dropIfExists('purchaseproducts');
    }
}
