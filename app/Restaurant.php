<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
	
	
    protected $table = 'restaurants';
    protected $fillable = ['title','address'];

    public function menu()
    {
    	return $this->hasMany('App\Menu_item','restaurant_id');
    }
	
	public function orders()
	{
    	return $this->hasMany('App\Order','restaurant_id');
	}
}
