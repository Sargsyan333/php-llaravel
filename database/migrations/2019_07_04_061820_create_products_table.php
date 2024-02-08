<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('model_text')->nullable();
            $table->text('colli_size')->nullable();
            $table->text('size')->nullable();
            $table->text('skeeis_item_number')->nullable();
            $table->text('pharmacy_item_number')->nullable();
            $table->string('type')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('weight',15,2)->nullable();
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
