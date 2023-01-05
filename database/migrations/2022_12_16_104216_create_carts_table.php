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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('menu_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('menu_name');
            $table->integer('price')->unsigned();
            $table->integer('calorie_count')->unsigned();
            $table->string('diet');
            $table->string('cuisine');
            $table->longText('description');
            $table->string('image');
            $table->boolean('confirmed')->default(false);
            $table->string('has_offer')->nullable()->default('no');
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
        Schema::dropIfExists('carts');
    }
};
