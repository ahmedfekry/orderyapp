<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">Title *</label>
    <div class="col-sm-9 col-lg-10 controls">
        {!! Form::text('title',old('title'), ['class'=>'form-control input-lg','required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">Price *</label>
    <div class="col-sm-9 col-lg-10 controls">
        {!! Form::number('price',old('price'), ['class'=>'form-control input-lg','required' => 'required']) !!}
    </div>
</div>


<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">Description *</label>
    <div class="col-sm-9 col-lg-10 controls">
        {!! Form::textarea('description',old('description'), ['class'=>'form-control input-lg','required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">Restaurant *</label>
    <div class="col-sm-9 col-lg-10 controls">
        {!! Form::select('restaurant_id',$restaurants,null, ['class'=>'form-control input-lg chosen','required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label">Profile Image *</label>
    <div class="col-sm-9 col-lg-10 controls">
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                <img src="{{url(old('image_path'))}}" alt="" />
            </div>
            <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
            <div>
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
                    <span class="fileupload-exists">Change</span>
                    <input type="file" name="image_path"></span>
                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
            </div>
        </div>
        <span class="label label-important">NOTE!</span>
        <span>Only extension supported jpg, png, and jpeg</span>
    </div>
</div>
                    
<div class="form-group">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
        {!! Form::button('<i class="fa fa-check"></i> Save',['type'=>'submit','class'=>'btn btn-primary']) !!}
    </div>
</div>
