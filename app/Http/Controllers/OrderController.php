<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use Validator;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index - order';
        $orders = Order::paginate(6);
        return view('order.index',compact('orders','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create - order';
        
        return view('order.create');
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
                        "address" => "required",
                        "phone_number" => "required",
                        "total_price" => "required",
                        "comments" => "required"
                    ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), 500);
        }

        $order = Order::create($request->all());
        $request->session()->flash('success', 'Created Successfully');
        return redirect('order');
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
        $title = 'Show - order';
        $order = Order::findOrfail($id);
        return view('order.show',compact('title','order'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param    \Illuminate\Http\Request  $request
     * @param    int  $id
     * @return  \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $title = 'Edit - order';
        $order = Order::findOrfail($id);
        return view('order.edit',compact('title','order'  ));
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
                        "address" => "required",
                        "phone_number" => "required",
                        "total_price" => "required",
                        "comments" => "required"
                    ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), 500);
        }


        $order = Order::findOrfail($id);
        $request->session()->flash('success', 'Updated Successfully');
        return redirect('order');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
     	$order = Order::findOrfail($id);
        $order->delete();
        $request->session()->flash('success', 'Deleted Successfully');
        return redirect('order');
    }
}
