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
            $table->string('name');
            $table->text('description')->nullable();
            $table->longText('short_description')->nullable();
            $table->bigInteger('price');
            $table->string('thumb_url');
            $table->string('slug');
            $table->boolean('active')->default(true);

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')
                                            ->onDelete('NO ACTION')
                                            ->onUpdate('NO ACTION');;

            // $table->unsignedBigInteger('order_id')->;
            // $table->foreign('order_id')->references('id')->on('product_orders');

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
