<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Restaurants.
 *
 * @author  The scaffold-interface created at 2017-10-16 06:31:24pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Restaurants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('restaurants',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('title');
        
        $table->String('address');
        
        $table->String('image_path');
        
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
        Schema::drop('restaurants');
    }
}
