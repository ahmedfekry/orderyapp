<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Menu_items.
 *
 * @author  The scaffold-interface created at 2017-10-16 06:49:47pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class MenuItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('menu_items',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('title');
        
        $table->float('price');
        
        $table->String('image_path');
        
        $table->longText('description');
        
        /**
         * Foreignkeys section
         */
        
        $table->integer('restaurant_id')->unsigned()->nullable();
        $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        
        
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
        Schema::drop('menu_items');
    }
}
