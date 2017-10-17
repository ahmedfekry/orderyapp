<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
use Validator;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - restaurant';
        $restaurants = Restaurant::paginate(6);
        return view('restaurant.index',compact('restaurants','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - restaurant';
        
        return view('restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:restaurants,title',
            'address' => 'required',
            'image_path' => 'required',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }


        $restaurant = Restaurant::create($request->all());
        $request->session()->flash('success', 'Created successfuly');
        return redirect('restaurant');
    }

    /**
     * Display the specified resource.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        $title = 'Show - restaurant';
        $restaurant = Restaurant::findOrfail($id);
        return view('restaurant.show',compact('title','restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - restaurant';
        $restaurant = Restaurant::findOrfail($id);
        return view('restaurant.edit',compact('title','restaurant'  ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:restaurants,title,'.$id,
            'address' => 'required',
            'image_path' => 'required',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $restaurant = Restaurant::findOrfail($id);
    	
        $restaurant->update($request->all());
        $request->session()->flash('success', 'Updated successfuly');
        return redirect('restaurant');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
     	$restaurant = Restaurant::findOrfail($id);
     	$restaurant->delete();
        $request->session()->flash('success', 'Deleted successfuly');
        return redirect('restaurant');
    }
}
