@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Books <a href="{{route('books.create')}}"  class="btn btn-primary">New</a>  </h1></div>

                    <div class="panel-body">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($books as $book)
                            <tr>
                                <th scope="row">{{ $book->id  }}</th>
                                <td>{{ $book->title  }}</td>
                                <td>
                                    <a href="{{route('books.edit', ['id' => $book->id ])}}"  class="btn btn-primary">Edit</a> |

                                    <?php $deleteForm = "delete-form-{$loop->index}"; ?>
                                    <a href="{{route('books.destroy', ['category' => $book->id ])}}"
                                       onclick="event.preventDefault();document.getElementById('{{ $deleteForm }}').submit();"
                                       class="btn btn-danger">Delete</a>
                                    {!! Form::open(['route' => ['books.destroy', 'category' => $book->id],  'method' => 'DELETE', 'id' => $deleteForm, 'style' => 'display:none']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div align="center"> {{ $books->links()  }}</div>
            </div>
        </div>
    </div>
@endsection
