<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu_item extends Model
{
	
	
    protected $table = 'menu_items';
    protected $fillable = [	'title','price','description','restaurant_id'];
    
	public function restaurant()
	{
		return $this->belongsTo('App\Restaurant','restaurant_id');
	}

	
}
