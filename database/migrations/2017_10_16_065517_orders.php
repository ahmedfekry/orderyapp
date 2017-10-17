<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Orders.
 *
 * @author  The scaffold-interface created at 2017-10-16 06:55:17pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('orders',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('address');
        
        $table->String('phone_number');
        
        $table->String('total_price');
        
        $table->String('comments');
        
        /**
         * Foreignkeys section
         */
        
        
        $table->timestamps();
        
        
        // type your addition here

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
