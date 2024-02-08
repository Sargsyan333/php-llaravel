<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('delivery_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile')->nullable();
            $table->text('package_delivery_information')->nullable();
            $table->timestamp('package_delivery_date')->nullable();
            $table->text('package_comment')->nullable();
            $table->unsignedInteger('economics_id')->nullable();
            $table->timestamp('order_accepted_date')->nullable();
            $table->unsignedInteger('shipmondo_id')->nullable();
            $table->unsignedInteger('shipmondo_package_id')->nullable();
            $table->unsignedInteger('layout')->nullable();
            $table->unsignedInteger('paymentTerms')->nullable();
            $table->string('currency')->nullable();
            $table->boolean('economic_status')->default(0);
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
