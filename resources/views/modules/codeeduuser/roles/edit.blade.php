@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Update Role</h1></div>

                <div class="panel-body">

                    {!! Form::model($role, ['route' => ['codeeduuser.roles.update', $role->id], 'class' => 'form', 'method' => 'PUT']) !!}

                    @include('codeeduuser::roles._form')

                    {!! Html::openFormGroup() !!}
                    {!! Form::submit('Update',['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
@endsection