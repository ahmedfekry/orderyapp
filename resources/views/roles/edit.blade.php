@extends('template')
@section('page_title')
    @lang('messages.role') 
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>@lang('messages.role') </h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form class="form-horizontal" action="{{url('roles/'.$role->id.'/update')}}" method="post">
                    	{{ csrf_field() }}
                    	<div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">@lang('messages.roles.role-name') </label>
                            <div class="col-sm-9 col-lg-10 controls">
                                {{-- {!! Form::text('category_name',null,['placeholder'=>'Category Name','class'=>'form-control input-lg']) !!} --}}
                                <input type="text" name="name" placeholder="@lang('messages.roles.role-name') " value="{{$role->name}}" class="form-control input-lg" required>
                                <input type="hidden"  name="role_id" value="{{$role->id}}">
                                {{-- <span class="help-inline">Enter a new Role name</span> --}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                <input type="submit" class="btn btn-primary" value="@lang('messages.save')">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop

@section('script')
    <script>
        $('#role').addClass('active');
        $('#role-index').addClass('active');
    </script>
@stop