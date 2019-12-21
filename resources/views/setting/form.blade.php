

<div class="form-group">
    <label for="name">created-at</label>
    {!! Form::date('created_at',$model->created_at,[
    'class'=>'form-control'

    ]) !!}

</div>
<div class="form-group">
    <label for="name">updated-at</label>
    {!! Form::date('updated_at',$model->updated_at,[
    'class'=>'form-control'

    ]) !!}
</div>
<div class="form-group">
    <label for="name">play-store</label>
    {!! Form::text('play_store_url',$model->play_store_url,[
    'class'=>'form-control'

    ]) !!}
</div>
<div class="form-group">
    <label for="name">app-store</label>
    {!! Form::text('app_store_url',$model->app_store_url,[
    'class'=>'form-control'

    ]) !!}
</div>
<div class="form-group">
    <label for="name">notifications-settings</label>
    {!! Form::text('notification_settings_text',$model->notification_settings_text,[
    'class'=>'form-control'

    ]) !!}
</div>
<div class="form-group">
    <label for="name">about_app</label>
    {!! Form::text('about_app',$model->about_app,[
    'class'=>'form-control'

    ]) !!}
</div>
<div class="form-group">
    <label for="name">phone</label>
    {!! Form::text('phone',$model->phone,[
    'class'=>'form-control'

    ]) !!}
</div>
<div class="form-group">
    <label for="name">email</label>
    {!! Form::text('email',$model->email,[
    'class'=>'form-control'

    ]) !!}
</div>
<div class="form-group">
    <label for="name">facebook</label>
    {!! Form::text('fb_link',$model->fb_link,[
    'class'=>'form-control'

    ]) !!}
</div>
<div class="form-group">
    <label for="name">twitter</label>
    {!! Form::text('tw_link',$model->tw_link,[
    'class'=>'form-control'

    ]) !!}
</div>
<div class="form-group">
    <label for="name">insta</label>
    {!! Form::text('insta_link',$model->insta_link,[
    'class'=>'form-control'

    ]) !!}
</div>
<div class="form-group">
    <label for="name">youtube</label>
    {!! Form::text('youtube_link',$model->youtube_link,[
    'class'=>'form-control'

    ]) !!}
</div>
<div class="form-group">
    <button class="btn btn-primary">Submit</button>
</div>

