<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Order_items.
 *
 * @author  The scaffold-interface created at 2017-10-16 06:59:04pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class OrderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('order_items',function (Blueprint $table){

        $table->increments('id');
        
        $table->integer('quantity');
        
        /**
         * Foreignkeys section
         */
        
        $table->integer('menu_item_id')->unsigned()->nullable();
        $table->foreign('menu_item_id')->references('id')->on('menu_items')->onDelete('cascade');
        
        $table->integer('order_id')->unsigned()->nullable();
        $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        
        
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
        Schema::drop('order_items');
    }
}
