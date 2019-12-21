@extends('layouts.app')
@inject('client','App\Models\Client')
@inject('donation','App\Models\DonationRequest')

@section('content')
@section('page_title')
   Create Governorates
@endsection
@section('small_title')
@endsection



<section class="content">



    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">List of governorates</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            @include('partial.validation_error')
            @include('flash::message')
            {!! Form ::model($model,[

            'action'=>['GovernorateController@update',$model->id],
            'method'=>'put'

            ])!!}

            @include('partial.form')


{!! Form ::close()!!}
</div>
<!-- /.box-body -->

<!-- /.box-footer-->
</div>
<!-- /.box -->

</section>

@endsection
