@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Permissions of {{$role->name}}</h1></div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['codeeduuser.roles.permissions.update', $role->id], 'class' => 'form', 'method' => 'PUT']) !!}

                    <ul class="list-group">
                        @foreach($permissionsGroup as $pg)
                            <li class="list-group-item">
                                <h4 class="list-group-item-heading">{{ $pg->description }}</h4>

                                <p class="list-group-item-text">
                                <ul class="list-inline">
                                    <?php
                                    $permissionsSubGroup = $permissions->filter(function ($value) use ($pg) {
                                        return $value->name == $pg->name;
                                    });
                                    ?>
                                    @foreach($permissionsSubGroup as $permission){
                                    <li>
                                        <div class="checkbox">
                                            <label for="">
                                                <input type="checkbox" name="permissions[]"
                                                       {{ $role->permission->contains('id', $permission->id) ? 'checked="checked"': '' }}
                                                       value="{{ $permission->id  }}"/> {{ $permission->resource_description }}
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                </p>
                            </li>
                        @endforeach
                    </ul>

                    {!! Html::openFormGroup() !!}
                    {!! Button::info('Save')->submit() !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
@endsection