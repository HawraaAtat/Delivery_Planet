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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            $table->integer('user_id')->unsigned()->nullable();
            

            $table->integer('total_amount');
                        
            $table->string('shipping_type');
            $table->string('address');
            // status (e.g. "pending", "in progress", "delivered")
            $table->string('status')->default("pending");
            $table->string('order_date');

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
};
