@inject('blood','App\Models\BloodType')
@inject('city','App\Models\City')
@inject('client','App\Models\Client')
<div class="form-group">
    <label for="name">Name</label>
    {!! Form::text('name',null,[
    'class'=>'form-control'

    ]) !!}

</div>

<div class="form-group">
    <label for="name">age</label>
    {!! Form::text('age',null,[
    'class'=>'form-control'

    ]) !!}

</div>
<div class="form-group">
    <label for="name">bags_num</label>
    {!! Form::text('bags_num',null,[
    'class'=>'form-control'

    ]) !!}

</div>
<div class="form-group">
    <label for="name">hospital_name</label>
    {!! Form::text('hospital_name',null,[
    'class'=>'form-control'

    ]) !!}

</div>
<div class="form-group">
    <label for="name">hospital_address</label>
    {!! Form::text('hospital_address',null,[
    'class'=>'form-control'

    ]) !!}

</div>
<div class="form-group">
    <label for="name">notes</label>
    {!! Form::text('notes',null,[
    'class'=>'form-control'

    ]) !!}

</div>
<div class="form-group">
    <label for="name">blood types</label>
    {!! Form::Select('blood_type_id', $blood->all()->pluck('name' , 'id') , null ,['class'=>'form-control']) !!}


</div>
<div class="form-group">
    <label for="name">cities</label>
    {!! Form::Select('city_id', $city->all()->pluck('name' , 'id') , null ,['class'=>'form-control']) !!}


</div>
<div class="form-group">
    <label for="name">client</label>
    {!! Form::Select('client_id', $client->all()->pluck('name' , 'id') , null ,['class'=>'form-control']) !!}


</div>

<div class="form-group">
    <button class="btn btn-primary">Submit</button>
</div>
