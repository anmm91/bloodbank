@extends('layouts.app')


@section('content')
@section('page_title')
    Settings
@endsection
@section('small_title')
@endsection



<section class="content">



    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">settings</h3>

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
            @foreach($records as $record)
                <div class="form-group">
                    <label for="name">id</label>
                    {!!Form::text('id',$record->id,['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                    <label for="name">created-at</label>
                {!!Form::text('created_at',$record->created_at,['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                    <label for="name">updated-at</label>
                {!!Form::text('updated_at',$record->updated_at,['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                        <label for="name">play-store</label>
                {!!Form::text('play_store_url',$record->play_store_url,['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                        <label for="name">app-store</label>
                {!!Form::text('app_store_url',$record->app_store_url,['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                        <label for="name">notifications</label>
                {!!Form::text('notification_settings_text',$record->notification_settings_text,['class'=>'form-control'])!!}
                </div>
                <div class="form-group">
                        <label for="name">about-app</label>
                {!!Form::text('about_app',$record->about_app,['class'=>'form-control'])!!}
                </div>

                <div class="form-group">
                        <label for="name">phone</label>
                {!!Form::text('phone',$record->phone,['class'=>'form-control'])!!}
                </div>
                 <div class="form-group">
                        <label for="name">email</label>
                {!!Form::text('email',$record->email,['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                         <label for="name">facebook</label>
                {!!Form::text('fb_link',$record->fb_link,['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                         <label for="name">twitter</label>
                {!!Form::text('tw_link',$record->tw_link,['class'=>'form-control'])!!}
                 </div>
                 <div class="form-group">
                         <label for="name">instagram</label>
                {!!Form::text('insta_link',$record->insta_link,['class'=>'form-control'])!!}
                 </div>
                <div class="form-group">
                         <label for="name">youtube</label>
                {!!Form::text('youtube_link',$record->youtube_link,['class'=>'form-control'])!!}
                </div>
                <td class="text-center"><a href="{{url(route('setting.edit',$record->id))}}" class="btn btn-primary xs"><i class="fa fa-edit"></i></a></td>

            @endforeach




        </div>
        <!-- /.box-body -->

        <!-- /.box-footer-->
    </div>
    <!-- /.box -->

</section>

@endsection
