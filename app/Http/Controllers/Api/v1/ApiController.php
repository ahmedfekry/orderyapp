<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cart;
use Validator;
use App\Restaurant;
use App\Order;
use App\Menu_item;
use App\Order_item;
class ApiController extends Controller
{
     
    
    /**
     * Get all the restaurants.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRestaurants()
    {
        $restaurants = Restaurant::select(["*",\DB::raw("CONCAT('".\URL::to('/')."','/',image_path)  AS image_path")])->get();
        return response()->json($restaurants,200);
    }

    /**
     * Get restaurant with the menu.
     * @param Int $id
     * @return \Illuminate\Http\Response
     */
    public function getRestaurant($id)
    {
        $restaurant = Restaurant::where('id',$id)->select(["*",\DB::raw("CONCAT('".\URL::to('/')."','/',image_path)  AS image_path")])->with('menu')->first();
        foreach ($restaurant->menu as $item) {
            $item->image_path = \URL::to('/').'/'.$item->image_path;
        }
        return response()->json($restaurant,200);
    }

    /**
     * Add item to the shopping cart.
     * @param Int $id
     * @param Int $qty
     * @return \Illuminate\Http\Response
     */
    public function addItemToTheCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_item_id' => 'required|numeric|exists:menu_items,id',
            'qty' => 'required|numeric',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        $menu_item = Menu_item::find($request->menu_item_id);
        $first_item = Cart::content()->first();
        // return $first_item;
        if ($first_item) {
               $last_menu_item = Menu_item::find($first_item->id);
               if ($last_menu_item->restaurant->id != $menu_item->restaurant->id) {
                    return response()->json(['items must be from the same restaurant'],500);
               }
           }   
        $item['id'] = $menu_item->id;
        $item['name'] = $menu_item->title;
        $item['qty'] = $request->qty;
        $item['price'] = $menu_item->price;
        $cart = Cart::add($item);
        return response()->json($cart,200);
    }

    public function updateQuantity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rowId' => 'required',
            'qty' => 'required|numeric',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $cart = Cart::update($request->rowId, $request->qty); // Will update the quantity
        return response()->json($cart,200);
    }

    public function removeItem($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['removed'],200);
    }

    public function addArea(Request $request)
    {
        $item = Cart::content()->first();
        if (!$item) {
            return response()->json(['cart is empity'],500);
        }
        Cart::update($item->rowId,['options' => ['address' => $request->address]]);
        return Cart::content();

        return response()->json(['Success'],200);
    }

    public function viewCart()
    {
        $items = Cart::content();
        return response()->json(['item'=>$items,'total_price' => Cart::total()-Cart::tax()], 200);
    }

    public function destryCart()
    {
        Cart::destroy();
        return response()->json(['destroyed'],200);
    }

    public function placeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
        ]);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        if (count(Cart::content()) == 0) {
            return response()->json(['Cart is empity'],500);
        }
        $order = new Order();
        $order->phone_number = $request->phone_number;
        $order->comments = ($request->comments)? $request->comments : "";
        $order->total_price = Cart::total()-Cart::tax();
        $order->restaurant_id = Menu_item::find(Cart::content()->first()->id)->restaurant->id;
        $order->save();
        foreach (Cart::content() as $item) {
            $order_item = new Order_item();
            // 'quantity','menu_item_id','order_id'
            $order_item->order_id = $order->id;
            $order_item->menu_item_id = $item->id;
            $order_item->quantity = $item->qty;
            $order_item->save();
        }
        Cart::destroy();
        return response()->json([$order],200);
    }
}
