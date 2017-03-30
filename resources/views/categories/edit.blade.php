@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Update Category</h1></div>

                <div class="panel-body">

                    @include('errors._check')

                    {!! Form::model($category, ['route' => ['categories.update', $category->id], 'class' => 'form', 'method' => 'PUT']) !!}

                    @include('categories._form')

                    <div class="form-group">
                        {!! Form::submit('Update',['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
@endsection