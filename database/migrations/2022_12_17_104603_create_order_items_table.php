<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // order_id
            // menu_item_id 
            // quantity
            // unit_price
            // total_amount (i.e. quantity * unit_price).


            
            $table->integer('menu_id')->unsigned()->nullable();
            $table->integer('order_id')->unsigned()->nullable();
            $table->integer('quantity')->unsigned()->nullable();

            $table->integer('calorie_count')->unsigned();
            $table->string('diet');
            $table->string('cuisine');
            $table->string('description');
            $table->boolean('confirmed')->default(false);
            $table->string('has_offer')->nullable()->default('no');
            

            $table->integer('price');
                        
            $table->string('menu_name');
            $table->string('image');

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
        Schema::dropIfExists('order_items');
    }
};
