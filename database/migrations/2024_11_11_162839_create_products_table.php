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
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->integer('childcategory_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('pickup_point_id')->nullable();
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('product_code');
            $table->string('product_unit')->nullable();
            $table->string('product_tags')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('product_video')->nullable();
            $table->string('product_image')->nullable();
            $table->string('product_thumbnail')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('stock_quantity')->nullable();
            $table->integer('warehouse')->nullable();
            $table->text('description')->nullable();
            $table->integer('featured')->nullable()->default(0);
            $table->integer('today_deal')->nullable()->default(0);
            $table->integer('status')->nullable()->default(0);
            $table->integer('product_slider')->nullable()->default(0);
            $table->integer('product_view')->nullable()->default(0);
            $table->integer('product_trendy')->nullable()->default(0);
            $table->integer('flash_deal_id')->nullable()->default(0);
            $table->integer('cash_on_delivery')->nullable()->default(0);
            $table->integer('user_id')->nullable();
            $table->integer('date')->nullable();
            $table->integer('month')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
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
