
@inject('gov' , App\Models\Governorate)
<div class="form-group">
    <label for="name">Name</label>
    {!! Form::text('name',null,[
    'class'=>'form-control'

    ]) !!}

</div>
<div class="form-group">
    <label for="name">governorate</label>

    {!! Form::Select('governorate_id', $gov->all()->pluck('name' , 'id') , null ,['class'=>'form-control']) !!}

</div>
<div class="form-group">
    <button class="btn btn-primary">Submit</button>
</div>
