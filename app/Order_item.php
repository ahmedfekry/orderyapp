<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_item extends Model
{
	
	
    protected $table = 'order_items';
    protected $fillable = ['quantity','menu_item_id','order_id'];
	
	public function menu_item()
	{
		return $this->belongsTo('App\Menu_item','menu_item_id');
	}

	
	public function order()
	{
		return $this->belongsTo('App\Order','order_id');
	}

	
}
