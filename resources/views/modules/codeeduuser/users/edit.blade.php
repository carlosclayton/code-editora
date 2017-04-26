@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Update User</h1></div>

                <div class="panel-body">

                    {!! Form::model($user, ['route' => ['codeeduuser.users.update', $user->id], 'class' => 'form', 'method' => 'PUT']) !!}

                    @include('codeeduuser::users._form')

                    {!! Html::openFormGroup() !!}
                    {!! Form::submit('Update',['class' => 'btn btn-primary']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
@endsection