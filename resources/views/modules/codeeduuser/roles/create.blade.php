@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>New Role</h1></div>

                <div class="panel-body">
                    {!! Form::open(['route' => 'codeeduuser.roles.store', 'class' => 'form']) !!}

                    @include('codeeduuser::roles._form')

                    {!! Html::openFormGroup() !!}
                    {!! Button::info('New')->submit() !!}
                    {!! Html::closeFormGroup() !!}

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
@endsection