<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderAddressCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->boolean('copy')->default(false);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('user_hash')->nullable();

            $table->string("postal_code")->nullable();
            $table->string("country")->nullable();
            $table->text("country_iso_code")->nullable();
            $table->string("federal_district")->nullable();
            $table->string("region_fias_id")->nullable();
            $table->string("region_kladr_id")->nullable();
            $table->string("region_iso_code")->nullable();
            $table->string("region_with_type")->nullable();
            $table->string("region_type")->nullable();
            $table->text("region_type_full")->nullable();
            $table->string("region")->nullable();
            $table->string("area_fias_id")->nullable();
            $table->string("area_kladr_id")->nullable();


            $table->string("area_type")->nullable();
            $table->string("area_type_full")->nullable();
            $table->string("area")->nullable();
            $table->string("city_fias_id")->nullable();
            $table->string("city_kladr_id")->nullable();

            $table->string("city_type")->nullable();
            $table->text("city_type_full")->nullable();
            $table->string("city")->nullable();
            $table->string("city_area")->nullable();
            $table->string("city_district_fias_id")->nullable();
            $table->string("city_district_kladr_id")->nullable();

            $table->string("city_district_type")->nullable();
            $table->text("city_district_type_full")->nullable();
            $table->string("city_district")->nullable();
            $table->string("settlement_fias_id")->nullable();
            $table->string("settlement_kladr_id")->nullable();

            $table->string("settlement_type")->nullable();
            $table->text("settlement_type_full")->nullable();
            $table->string("settlement")->nullable();
            $table->string("street_fias_id")->nullable();
            $table->string("street_kladr_id")->nullable();

            $table->string("street_type")->nullable();
            $table->text("street_type_full")->nullable();
            $table->string("street")->nullable();
            $table->string("house_fias_id")->nullable();
            $table->string("house_kladr_id")->nullable();
            $table->string("house_type")->nullable();
            $table->text("house_type_full")->nullable();
            $table->string("house")->nullable();
            $table->string("block_type")->nullable();
            $table->string("block_type_full")->nullable();
            $table->string("block")->nullable();
            $table->string("flat_type")->nullable();
            $table->string("flat_type_full")->nullable();
            $table->string("flat")->nullable();
            $table->string("flat_area")->nullable();
            $table->string("square_meter_price")->nullable();


            $table->string("fias_id")->nullable();
            $table->string("fias_code")->nullable();
            $table->string("fias_level")->nullable();
            $table->string("fias_actuality_state")->nullable();
            $table->string("kladr_id")->nullable();
            $table->string("geoname_id")->nullable();
            $table->text("okato")->nullable();
            $table->text("oktmo")->nullable();
            $table->text("timezone")->nullable();
            $table->string("geo_lat")->nullable();
            $table->string("geo_lon")->nullable();
            $table->text("beltway_hit")->nullable();
            $table->text("beltway_distance")->nullable();
            $table->text("metro")->nullable();
            $table->text("qc_geo")->nullable();
            $table->text("qc_complete")->nullable();
            $table->text("qc_house")->nullable();

            $table->text("full_name")->nullable();
        });

        Schema::create('cart', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('user_hash')->nullable();

            $table->integer('status')->default(10);
        });

        Schema::create('order_shipment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name')->nullable();
            $table->text('comment')->nullable();

            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('address');
        });

        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->boolean('main')->default(true);

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('cart_id')->nullable();
            $table->foreign('cart_id')->references('id')->on('cart');

            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('address');

            $table->integer('delivery_type')->nullable();
            $table->integer('payment_type')->nullable();

            $table->float('sum')->default(0)->comment('Order cost with delivery and discounts');
            $table->float('sum_original')->default(0)->comment('Cost of items without discount');
            $table->float('sum_products')->default(0)->comment('Cost of items with discount');
            $table->float('sum_delivery')->default(0)->comment('Cost of delivery');
            $table->float('comment')->nullable();

            $table->string('promo')->nullable();
        });

        Schema::create('order_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('order');

            $table->unsignedBigInteger('sku_id')->nullable();
            $table->foreign('sku_id')->references('id')->on('sku');

            $table->unsignedBigInteger('shipment_id')->nullable();
            $table->foreign('shipment_id')->references('id')->on('order_shipment');

            $table->integer('qty')->default(1);
            $table->float('price')->default(1);
            $table->float('price_sum')->default(1);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
