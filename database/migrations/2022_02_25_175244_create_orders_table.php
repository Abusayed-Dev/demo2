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
            $table->integer('user_id');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('city')->nullable();
            $table->string('extra_phone')->nullable();
            $table->string('payment_type')->nullable()->default(0);
            $table->string('subtotal')->nullable();
            $table->string('total')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->string('after_discount')->nullable();
            $table->string('tax')->nullable();
            $table->string('shipping_charge')->nullable();
            $table->string('order_id', 25)->nullable();
            $table->integer('status')->nullable();
            $table->string('date')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
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
