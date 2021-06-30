<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('active')->default(0);

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')
                                        ->onDelete('CASCADE')
                                        ->onUpdate('NO ACTION');

            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')
                                        ->onDelete('CASCADE')
                                        ->onUpdate('NO ACTION');

            $table->unsignedBigInteger('order_number')->nullable();
            $table->string('order_token');

            $table->bigInteger('total')->default(0);

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
        Schema::dropIfExists('product_orders');
    }
}
