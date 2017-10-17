@extends('template')
@section('page_title')
    Users
@stop
@section('content')
    @include('errors')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>Create New User</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form class="form-horizontal" action="{{url('users')}}" method="post">
                    	{{ csrf_field() }}
                    	<div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Name *</label>
                            <div class="col-sm-9 col-lg-10 controls">
                                <input type="text" name="name" placeholder="Name" class="form-control input-lg" required>
                                <span class="help-inline">create new user</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Email *</label>
                            <div class="col-sm-9 col-lg-10 controls">
                                <input type="email" name="email" placeholder="Email" class="form-control input-lg" required>
                                <span class="help-inline">Enter a new Email</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Password *</label>
                            <div class="col-sm-9 col-lg-10 controls">
                                <input type="password" name="password" placeholder="Password" class="form-control input-lg" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                                <input type="submit" class="btn btn-primary" value="Save">
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
        $('#user').addClass('active');
        $('#user-create').addClass('active');
    </script>
@stop