@inject('per','App\Models\Permission')

<div class="form-group">
    <label for="name">Name</label>
    {!! Form::text('name',null,[
    'class'=>'form-control'

    ]) !!}

</div>
<div class="form-group">
    <label for="name">display-name</label>

    {!! Form::text('display_name',null,[
        'class'=>'form-control'

        ]) !!}
</div>

<div class="form-group">
    <label for="name">description</label>

    {!! Form::textarea('description',null,[
        'class'=>'form-control'

        ]) !!}
</div>
<div class="form-group">
    <label for="name">الصلاحيات</label>
    <input id="selectAll" type="checkbox"><label for='selectAll'>Select All</label><br>

    @foreach($per->all() as $permission)
        <div class="col-sm-3">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="permissions_lists[]" value="{{$permission->id}}"
                    @if($model->hasPermission($permission->name))
                        checked

                    @endif
                    > {{$permission->display_name}}
                </label>
            </div>

        </div>

    @endforeach
</div>
<div class="form-group">
    <button class="btn btn-primary">Submit</button>
</div>
@push('scripts')
<script>
    $("#selectAll").click(function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

    });
</script>
@endpush()
