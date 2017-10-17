@extends('template')

@section('page_title')
    Create Restaurant
@stop

@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>Add Restaurant</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    @if(isset($restaurant))
                        {!! Form::model($restaurant, ['route' => ['restaurant.update', $restaurant->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'files'=>'true' ]) !!}

                    @else
                        {!! Form::open(['method' => 'POST', 'route' => 'restaurant.store', 'class' => 'form-horizontal', 'files'=>'true' ]) !!}
                        
                           
                    @endif
                        @include('restaurant._form')
                        {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>

@stop

@section('script')
    <script>
        $('#restaurant').addClass('active');
        $('#restaurant-create').addClass('active');
    </script>
@stop