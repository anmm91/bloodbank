@extends('layouts.app')


@section('content')
@section('page_title')

@endsection
@section('small_title')
@endsection



<section class="content">



    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        @include('flash::message')
        <form class="box-body" action="{{url('/reset-password')}}" method="post">

            @csrf

            <div class="form-group">
                <label for="name">old_password</label>
                {!! Form::password('old_password',[
                'class'=>'form-control'
                ]) !!}

            </div>
            <div class="form-group">

                        <label for="name">new_password</label>
                        {!! Form::password('new_password',[
                        'class'=>'form-control'

                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="name">confirm</label>

                        <input type="password" name="new_password_confirmation" class="form-control">
                    </div>


                    <div class="form-group">
                        <button class="btn btn-primary">Submit</button>
                    </div>
        </form>




        </div>
        <!-- /.box-body -->

        <!-- /.box-footer-->
    </div>
    <!-- /.box -->

</section>

@endsection
