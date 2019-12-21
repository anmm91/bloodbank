@extends('layouts.app')


@section('content')
@section('page_title')
    Contact
@endsection
@section('small_title')
@endsection



<section class="content">



    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">List of contacts</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            @include('flash::message')
            @if(count($records))
                <table class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>Name</td>
                            <td>Created_at</td>
                            <td>Updated_at</td>
                            <td>phone</td>
                            <td>email</td>
                            <td>subject</td>
                            <td>message</td>

                            <td class="text-center">Delete</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($records as $record)

                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$record->name}}</td>
                            <td>{{$record->created_at}}</td>
                            <td>{{$record->updated_at}}</td>
                            <td>{{$record->phone}}</td>
                            <td>{{$record->email}}</td>
                            <td>{{$record->subject}}</td>
                            <td>{{$record->message}}</td>
                            <td class="text-center">
                                {!!Form::open([
                                'action'=>['ContactController@destroy',$record->id],
                                'method'=>'delete',


                                ])!!}
                                <button class="btn btn-danger xs" type="submit" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o"></i></button>


                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>


                    </table>

                </table>
                @else
                <div class="alert alert-danger" role="alert">
                    No data
                </div>

            @endif

        </div>
        <!-- /.box-body -->

        <!-- /.box-footer-->
    </div>
    <!-- /.box -->

</section>

@endsection
