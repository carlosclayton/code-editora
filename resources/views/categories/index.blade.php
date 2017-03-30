@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Categories <a href="{{route('books.create')}}"  class="btn btn-primary">New</a> </h1></div>

                    <div class="panel-body">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id  }}</th>
                                <td>{{ $category->name  }}</td>
                                <td>
                                    <a href="{{route('categories.edit', ['id' => $category->id ])}}"  class="btn btn-primary">Edit</a> |

                                    <?php $deleteForm = "delete-form-{$loop->index}"; ?>
                                    <a href="{{route('categories.destroy', ['category' => $category->id ])}}"
                                       onclick="event.preventDefault();document.getElementById('{{ $deleteForm }}').submit();"
                                       class="btn btn-danger">Delete</a>
                                    {!! Form::open(['route' => ['categories.destroy', 'category' => $category->id],  'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display:none']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div align="center"> {{ $categories->links()  }}</div>
            </div>
        </div>
    </div>
@endsection
