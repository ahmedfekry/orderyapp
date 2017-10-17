<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order_item;
use App\Menu_item;
use App\Order;
use Validator;

class Order_itemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - order_item';
        $order_items = Order_item::paginate(6);
        return view('order_item.index',compact('order_items','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - order_item';
        
        $menu_items = Menu_item::all()->pluck('title','id');
        
        $orders = Order::all()->pluck('phone_number','id');
        
        return view('order_item.create',compact('title','menu_items' , 'orders'  ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
                        "quantity" => "required|numeric",
                        "menu_item_id" => "required|exists:menu_items,id",
                        "order_id" => "required|exists:orders,id",
                    ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), 500);
        }

        $order_item = Order_item::create($request->all());
        $request->session()->flash('success', 'Created Successfully');
        return redirect('order_item');
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
        $title = 'Show - order_item';
        $order_item = Order_item::findOrfail($id);
        return view('order_item.show',compact('title','order_item'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - order_item';
        $menu_items = Menu_item::all()->pluck('title','id');
        $orders = Order::all()->pluck('phone_number','id');
        $order_item = Order_item::findOrfail($id);
        return view('order_item.edit',compact('title','order_item' ,'menu_items', 'orders' ) );
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
        $validator = Validator::make($request->all(),[
                        "quantity" => "required|numeric",
                        "menu_item_id" => "required|exists:menu_items,id",
                        "order_id" => "required|exists:orders,id",
                    ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), 500);
        }

        $order_item = Order_item::findOrfail($id);
    	$order_item->update($request->all());
        $request->session()->flash('success', 'Updated Successfully');
        return redirect('order_item');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
     	$order_item = Order_item::findOrfail($id);
     	$order_item->delete();
        $request->session()->flash('success', 'Deleted Successfully');
        return redirect('order_item');
    }
}
