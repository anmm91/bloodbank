@inject('per','App\Models\Permission')
@inject('roles','App\Models\Role')

<div class="form-group">
    <label for="name">Name</label>
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
    <label for="name">password</label>

    <input type="password" name="password" class="form-control">
</div>
<div class="form-group">
    <label for="name">confirm</label>

    {!! Form::text('password_confirmation',null,[
    'class'=>'form-control'

    ]) !!}
</div>
<div class="form-group">
<label for="name">الصلاحيات</label>
<input id="selectAll" type="checkbox"><label for='selectAll'>Select All</label><br>

@foreach($roles->all() as $role)
    <div class="col-sm-3">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="roles_lists[]" value="{{$role->id}}"
                       @if($model->hasRole($role->name))
                       checked

                    @endif

                > {{$role->name}}
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
