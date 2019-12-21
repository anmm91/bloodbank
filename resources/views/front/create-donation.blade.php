@inject('blood','App\Models\BloodType')
@extends('front.layouts.app')
@section('page-title')
    <title> create donation </title>
@endsection
@section('content')
{!! Form::open(['url'=>'front/create-donation']) !!}
<div class="form-group">
    <label for="name">name</label>
    {!! Form::text('name',null,[
    'class'=>'form-control',
    'id'=>'name',
    'placeholder'=>'plz enter the name'

    ]) !!}

</div>
<div class="form-group">
    <label for="age">age</label>
    {!! Form::text('age',null,[

    'class'=>'form-control',
    'id'=>'age',
    'placeholder'=>'plz enter th age'
    ]) !!}

</div>
<div class="form-group">
    <label for="bags_num">bags_num</label>
    {!! Form::text('bags_num',null,[
    'class'=>'form-control',
    'id'=>'bags_num',
    'placeholder'=>'plz enter the number of bags'
    ]) !!}

</div>
<div class="form-group">
    <label id="hospital_name">hospital_name</label>
    {!! Form::text('hospital_name',null,[
    'class'=>'form-control',
    'id'=>'hospital_name',
    'placeholder'=>'plz enter the hospital name'
    ]) !!}

</div>
<div class="form-group">
    <label id="hospital_address">hospital_address</label>
    {!! Form::text('hospital_address',null,[
    'class'=>'form-control',
    'id'=>'hospital_address',
    'placeholder'=>'plz enter the hospital address'
    ]) !!}

</div>
<div class="form-group">
    <label id="notes">notes</label>
    {!! Form::text('notes',null,[
    'class'=>'form-control',
    'id'=>'notes',
    'placeholder'=>'plz enter the your notes'
    ]) !!}

</div>
<div class="form-group">
    <label id="blood_type_id">blood_type</label>

        {!! Form::Select('blood_type_id', $blood->all()->pluck('name' , 'id') , null ,['class'=>'form-control']) !!}

</div>
{!! Form::close() !!}

@endsection

