@extends('template')

@section('page_title')
    Create Menu Item
@stop

@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>Add Menu Item</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    @if(isset($menu_item))
                        {!! Form::model($menu_item, ['route' => ['menu_item.update', $menu_item->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'files'=>'true' ]) !!}

                    @else
                        {!! Form::open(['method' => 'POST', 'route' => 'menu_item.store', 'class' => 'form-horizontal', 'files'=>'true' ]) !!}
                        
                           
                    @endif
                        @include('menu_item._form')
                        {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>

@stop

@section('script')
    <script>
        $('#menu_item').addClass('active');
        $('#menu_item-create').addClass('active');
    </script>
@stop