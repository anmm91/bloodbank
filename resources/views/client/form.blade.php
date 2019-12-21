
@inject('bloodtype' , App\Models\BloodType)
@inject('city' , App\Models\City)
<div class="form-group">
    <label for="name">phone</label>
    {!! Form::text('phone',null,[
    'class'=>'form-control'

    ]) !!}

</div>
<div class="form-group">
    <label for="name">password</label>

    {!! Form::text('password',null,[
        'class'=>'form-control'

        ]) !!}
</div>
<div class="form-group">
<label for="name">name</label>

{!! Form::text('name',null,[
    'class'=>'form-control'

    ]) !!}
</div>
<div class="form-group">
    <label for="name">email</label>

    {!! Form::text('email',null,[
        'class'=>'form-control'

        ]) !!}
</div>
<div class="form-group">
    <label for="name">dob</label>

    {!! Form::date('email',null,[
        'class'=>'form-control'

        ]) !!}
</div>
<div class="form-group">
    <label for="name">last-donation</label>

    {!! Form::date('last_donation_date',null,[
        'class'=>'form-control'

        ]) !!}
</div>
<div class="form-group">
    <label for="name">blood-type</label>

    {!! Form::Select('blood_type_id', $bloodtype->all()->pluck('name' , 'id') , null ,['class'=>'form-control']) !!}

</div>
<div class="form-group">
    <label for="name">city</label>

    {!! Form::Select('city_id', $city->all()->pluck('name' , 'id') , null ,['class'=>'form-control']) !!}

</div>

<div class="form-group">
    <button class="btn btn-primary">Submit</button>
</div>
