<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Categories
         */
        Schema::create('product_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name', 255);

            $table->string('slug', 255);
            $table->unique('slug');

            $table->text('description')->nullable();

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('product_category');
        });

        /**
         * Attributes for product
         */
        Schema::create('attribute', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name', 255);

            $table->string('slug', 255);
            $table->unique('slug');

            $table->text('description')->nullable();
        });

        /**
         * Attribute value
         */
        Schema::create('attribute_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name', 255);

            $table->string('slug', 255);
            $table->unique('slug');

            $table->unsignedBigInteger('attribute_id')->nullable();
            $table->foreign('attribute_id')->references('id')->on('attribute');
        });

        /**
         * Product table
         */
        Schema::create('product_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name', 255);
            $table->text('description')->nullable(true);

            $table->string('slug', 255)->nullable();
            $table->unique('slug');
        });

        /**
         * Product table
         */
        Schema::create('product_type_param', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name');
            $table->string('slug');

            $table->unsignedBigInteger('product_type_id')->nullable();
            $table->foreign('product_type_id')->references('id')->on('product_type');

            $table->unsignedBigInteger('attribute_id')->nullable();
            $table->foreign('attribute_id')->references('id')->on('attribute');

            // 1 for product binding, 2 for sku binding
            $table->integer('type')->default(1);
            $table->boolean('multiple')->default(false);
            $table->integer('max_qty')->default(1);
        });

        /**
         * Product table
         */
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name', 255);
            $table->text('description')->nullable(true);

            $table->string('code')->nullable();
            $table->index('code')->nullable();

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('product_category');

            $table->unsignedBigInteger('product_type_id')->nullable(true);
            $table->foreign('product_type_id')->references('id')->on('product_type');
        });

        /**
         * Product table
         */
        Schema::create('product_attribute', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('product');

            $table->unsignedBigInteger('attribute_item_id');
            $table->foreign('attribute_item_id')->references('id')->on('attribute_item');

            $table->unsignedBigInteger('product_type_param_id')->nullable(true);
            $table->foreign('product_type_param_id')->references('id')->on('product_type_param');
        });

        Schema::create('sku', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('code')->nullable();
            $table->index('code')->nullable();

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('product');

            $table->integer('qty')->default(0);
        });

        Schema::create('sku_attribute', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('sku_id');
            $table->foreign('sku_id')->references('id')->on('sku');

            $table->unsignedBigInteger('product_type_param_id');
            $table->foreign('product_type_param_id')->references('id')->on('product_type_param');

            $table->unsignedBigInteger('attribute_item_id');
            $table->foreign('attribute_item_id')->references('id')->on('attribute_item');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop');
    }
}
