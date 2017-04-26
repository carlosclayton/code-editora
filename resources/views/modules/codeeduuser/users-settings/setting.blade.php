@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Update password</h1></div>

                <div class="panel-body">
                {!! Form::open(['route' => ['codeeduuser.user_settings.update'], 'class' => 'form', 'method' => 'PUT']) !!}

                    {!! Form::hidden('user', $user) !!}
                    {!! Html::openFormGroup('password', $errors) !!}
                    {!! Form::label('password', 'Password:', ['class' =>'control-label']) !!}
                    {!! Form::password('password', null , ['class' => 'form-control',  'placeholder'=> 'Input password here']) !!}
                    {!! Form::error('password', $errors ) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Html::openFormGroup() !!}
                    {!! Form::label('password_confirmation', 'Retype password:', ['class' =>'control-label']) !!}
                    {!! Form::password('password_confirmation', null , ['class' => 'form-control',  'placeholder'=> 'Retype password here']) !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Html::openFormGroup() !!}
                    {!! Button::info('Save')->submit() !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
@endsection

