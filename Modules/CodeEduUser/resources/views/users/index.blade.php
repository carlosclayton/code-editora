@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>
                            Users {!! Button::primary('New')->asLinkTo(route('codeeduuser.users.create')) !!} </h1>

                    </div>

                    <div class="panel-body">
                        <div class="row" style="padding: 12px">
                            {!! Form::model([], ['class' => 'form', 'method' => 'GET']) !!}
                            {!! Form::label('search', 'Search:') !!}
                            {!! Form::text('search', null , ['class' => 'form-control',  'placeholder'=> 'Input new Title here']) !!}
                            {!! Form::close() !!}
                        </div>

                        {!!
                        Table::withContents($users->items())->striped()
                        ->callback('Action', function($field, $user){
                            $edit = route('codeeduuser.users.edit', ['category' => $user->id]);
                            $dest = route('codeeduuser.users.destroy', ['category' => $user->id]);
                            $index = "delete-form-{$user->id}";
                            $form = Form::open(['route' => ['codeeduuser.users.destroy', 'category' => $user->id],  'method' => 'DELETE', 'id' => $index, 'style' => 'display:none']).
                            Form::close();

                            $anch = Button::link('Delete')
                            ->asLinkTo($dest)->addAttributes([
                            'onclick' => "event.preventDefault();document.getElementById(\"{$index}\").submit();"
                            ]);
                            $anchFlag = '<a href="" title="Disable">Excluir</a>';
                            $anch = $user->id == \Auth::user()->id ? $anchFlag: $anch;

                            return Button::link('Edit')->asLinkTo($edit) . "|" . $anch . $form;

                        })

                        !!}
                    </div>
                </div>
                <div align="center"> {{ $users->links()  }}</div>
            </div>
        </div>
    </div>
@endsection
