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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            $table->integer('restaurant_id')->unsigned()->nullable();

            $table->string('menu_name');
            $table->integer('price')->unsigned();
            $table->integer('calorie_count')->unsigned();
            $table->string('diet');
            $table->string('cuisine');
            $table->string('description');
            $table->integer('order_time')->unsigned()->nullable();
            $table->string('image');
            $table->boolean('confirmed')->default(false);
            $table->string('has_offer')->nullable()->default('no');
            $table->string('new_price')->nullable();
            $table->integer('quantity')->unsigned()->nullable();

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
        Schema::dropIfExists('menus');
    }


};
