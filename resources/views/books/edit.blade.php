@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Update Book</h1></div>

                <div class="panel-body">

                    @include('errors._check')

                    {!! Form::model($book, ['route' => ['books.update', $book->id], 'class' => 'form', 'method' => 'PUT']) !!}

                    @include('books._form')

                    <div class="form-group">
                        {!! Form::submit('Update',['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
@endsection