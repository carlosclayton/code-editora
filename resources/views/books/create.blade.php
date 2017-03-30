@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>New Book</h1></div>

                <div class="panel-body">

                    @include('errors._check')

                    {!! Form::open(['route' => 'books.store', 'class' => 'form']) !!}

                    @include('books._form')

                    <div class="form-group">
                        {!! Form::submit('New',['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
@endsection