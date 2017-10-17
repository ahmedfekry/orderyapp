@extends('template')
@section('page_title')
    Order #{{$order->id}}
@stop

@section('content')
    <div class="box">
        <div class="box-title">
            <h3><i class="fa fa-file"></i>Oder Info</h3>
            <div class="box-tool">
                <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                <a data-action="close" href="#"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="box-content">
            <div class="row">                
                <div class="col-md-9 user-profile-info">
                    <p><span>Order ID:</span> {{$order->id}}</p>
                    <p><span>Address:</span> <a href="#">{{$order->address}}</a></p>
                    <p><span>Phone Number:</span> <a href="#">{{$order->phone_number}}</a></p>
                    <p><span>Total Price:</span> <a href="#">{{$order->total_price}}</a></p>
                    <p><span>Comments:</span> <a href="#">{{$order->comments}}</a></p>
                    <p><span>Restaurant:</span> <a href="#">{{$order->restaurant->title}}</a></p>
                    <p><span>Items:</span></p>
                    @foreach($order->order_items as $item)
                        <hr>
                        <p><span>Quantity:</span> <a href="#">{{$item->quantity}}</a></p>
                        <p><span>Item Title:</span> <a href="#">{{$item->menu_item->title}}</a></p>
                        <p><span>Item Price:</span> <a href="#">{{$item->quantity.' x '.$item->menu_item->price. ' = '.$item->menu_item->price * $item->quantity}}</a></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $('#order').addClass('active');
        $('#order-index').addClass('active');
    </script>
@stop