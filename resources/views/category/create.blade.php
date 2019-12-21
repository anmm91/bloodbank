@extends('layouts.app')


@inject('model','App\Models\Governorate')
@section('content')
@section('page_title')
   Create categories
@endsection
@section('small_title')
@endsection



<section class="content">



    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">List of categories</h3>

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
            {!! Form ::model($model,[

            'action'=>'CategoryController@store',
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
