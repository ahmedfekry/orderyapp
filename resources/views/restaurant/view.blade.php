@extends('template')
@section('page_title')
    Restaurant View
@stop

@section('content')
    <div class="box">
        <div class="box-title">
            <h3><i class="fa fa-file"></i> Restaurant Info</h3>
            <div class="box-tool">
                <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                <a data-action="close" href="#"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="box-content">
            <div class="row">
                <div class="col-md-3">
                    <img class="img-responsive img-thumbnail" src="{{url($restaurant->image)}}" alt="profile picture" />
                    <br/><br/>
                </div>
                <div class="col-md-9 user-profile-info">
                    <p><span>Title:</span> {{$restaurant->title}}</p>
                    <p><span>Address:</span> <a href="#">{{$restaurant->address}}</a></p>
                </div>
            </div>
        </div>
    </div>
    {{-- Menu --}}
   <div class="row">
        <div class="col-md-12">
            <div class="box box-black">
                <div class="box-title">
                    <h3><i class="fa fa-table"></i>Menu Items</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">

                    <div class="table-responsive">
                        <table id="example" class="table table-striped dt-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th style="width:18px"><input type="checkbox"></th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th class="visible-md visible-lg" style="width:130px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($restaurant->menu as $menu_item)
                                <tr class="table-flag-blue">
                                    <td><input type="checkbox"></td>
                                    <td>{{$menu_item->title}}</td>
                                    <td>{{$menu_item->price}}</td>
                                    <td><img src="{{url($menu_item->image_path)}}"  class="img img-circle" width="200" height="200"></td>
                                    <td>{{$menu_item->description}}</td>
                                    <td class="visible-md visible-lg">
                                        <div class="btn-group">
                                            <a class="btn btn-sm show-tooltip" title="" href="{{url('menu_item/'.$menu_item->id.'/edit')}}" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger show-tooltip" title="" onclick="return confirm('Are you sure you want to delete this ?');" href="{{url('menu_item/'.$menu_item->id.'/delete')}}" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Orders --}}
    <div class="row">
        <div class="col-md-12">
            <div class="box box-black">
                <div class="box-title">
                    <h3><i class="fa fa-table"></i> Orders</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">

                    <div class="table-responsive">
                        <table id="example" class="table table-striped dt-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th style="width:18px"><input type="checkbox"></th>
                                <th>Id</th>
                                <th>Phone number</th>
                                <th>Price</th>
                                <th class="visible-md visible-lg" style="width:130px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($restaurant->orders as $order)
                                <tr class="table-flag-blue">
                                    <td><input type="checkbox"></td>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->phone_number}}</td>
                                    <td>{{$order->total_price}}</td>
                                    <td class="visible-md visible-lg">
                                        <div class="btn-group">
                                            <a class="btn btn-sm show-tooltip" title="" href="{{url('order/'.$order->id)}}" data-original-title="View"><i class="fa fa-search-plus"></i></a>
                                            <a class="btn btn-sm btn-danger show-tooltip" title="" onclick="return confirm('Are you sure you want to delete this ?');" href="{{url('order/'.$order->id.'/delete')}}" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop