<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu_item;
use App\Restaurant;
use Illuminate\Support\Facades\Storage;
use Validator;

class Menu_itemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - menu_item';
        $menu_items = Menu_item::paginate(6);
        return view('menu_item.index',compact('menu_items','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - menu_item';
        
        $restaurants = Restaurant::all()->pluck('title','id');
        
        return view('menu_item.create',compact('title','restaurants'  ));
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
            'title' => 'required|unique:menu_items,title',
            'price' => 'required',
            'image_path' => 'required',
            'description' => 'required',
            'restaurant_id' => 'required|exists:restaurants,id'
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $menu_item = Menu_item::create($request->all());
        $request->session()->flash('success', 'Create successfuly');
        return redirect('menu_item');
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
        $title = 'Show - menu_item';
        $menu_item = Menu_item::findOrfail($id);
        return view('menu_item.show',compact('title','menu_item'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - menu_item';
        $restaurants = Restaurant::all()->pluck('title','id');
        $menu_item = Menu_item::findOrfail($id);
        return view('menu_item.edit',compact('title','menu_item' ,'restaurants' ) );
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
            'title' => 'required|unique:menu_items,title,'.$id,
            'price' => 'required',
            'image_path' => 'required',
            'description' => 'required',
            'restaurant_id' => 'required|exists:restaurants,id'
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $menu_item = Menu_item::findOrfail($id);
    	$menu_item->update($request->all());
        $request->session()->flash('success', 'Updated successfuly');
        return redirect('menu_item');
    }

    /**
     * Delete confirmation message by Ajaxis.
     *
     * @link      https://github.com/amranidev/ajaxis
     * @param    \Illuminate\Http\Request  $request
     * @return  String
     */
    public function DeleteMsg($id,Request $request)
    {
        $msg = Ajaxis::BtDeleting('Warning!!','Would you like to remove This?','/menu_item/'. $id . '/delete');

        if($request->ajax())
        {
            return $msg;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     	$menu_item = Menu_item::findOrfail($id);
     	$menu_item->delete();
        return URL::to('menu_item');
    }
}
