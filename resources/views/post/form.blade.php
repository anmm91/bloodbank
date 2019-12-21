
@inject('cats' , App\Models\Category)

<div class="form-group">
    <label for="name">Title</label>
    {!! Form::text('title',null,[
    'class'=>'form-control'

    ]) !!}

</div>
{{--<div class="form-group">--}}
{{--    <label for="name">image</label>--}}

{{--    {!! Form::Select('governorate_id', $gov->all()->pluck('name' , 'id') , null ,['class'=>'form-control']) !!}--}}
{{--    {!! Form::file('image',null,['class'=>'form-control-file']) !!}--}}

{{--</div>--}}
<div class="file-field">
    <div class="btn btn-primary btn-sm float-left">
        <span>Choose file</span>
        <input type="file" name="image">
    </div>
    <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="Upload your file">
    </div>
</div>
<div class="form-group">
    <label for="name">content</label>
    <br>

{!! Form::text('content',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="name">category</label>
    {!! Form::Select('category_id', $cats->all()->pluck('name' , 'id') , null ,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="name">created-at</label>
    <br>

    {!! Form::date('created_at',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <label for="name">updated-at</label>
    <br>

    {!! Form::date('updated_at',null,['class'=>'form-control']) !!}
</div>



<br>
<div class="form-group">
    <button class="btn btn-primary">Submit</button>
</div>
