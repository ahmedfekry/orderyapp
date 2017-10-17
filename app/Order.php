<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	
	
    protected $table = 'orders';
    protected $fillable = ['address','phone_number','total_price','comments'];

    public function order_items()
    {
    	return $this->hasMany('App\Order_item');
    }
	
}
