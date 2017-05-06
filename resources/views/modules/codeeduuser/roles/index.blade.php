@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>
                            Roles {!! Button::primary('New')->asLinkTo(route('codeeduuser.roles.create')) !!} </h1>

                    </div>

                    <div class="panel-body">
                        <div class="row" style="padding: 12px">
                            {!! Form::model([], ['class' => 'form', 'method' => 'GET']) !!}
                            {!! Form::label('search', 'Search:') !!}
                            {!! Form::text('search', null , ['class' => 'form-control',  'placeholder'=> 'Input new Title here']) !!}
                            {!! Form::close() !!}
                        </div>

                        {!!
                        Table::withContents($roles->items())->striped()
                        ->callback('Action', function($field, $role){
                            $edit = route('codeeduuser.roles.edit', ['category' => $role->id]);
                            $dest = route('codeeduuser.roles.destroy', ['category' => $role->id]);
                            $editPermission = route('codeeduuser.roles.permissions.edit', ['role' => $role->id]);
                            $index = "delete-form-{$role->id}";
                            $form = Form::open(['route' => ['codeeduuser.roles.destroy', 'category' => $role->id],  'method' => 'DELETE', 'id' => $index, 'style' => 'display:none']).
                            Form::close();

                            $anch = Button::link('Delete')
                            ->asLinkTo($dest)->addAttributes([
                            'onclick' => "event.preventDefault();document.getElementById(\"{$index}\").submit();"
                            ]);
                            $anchFlag = '<a href="" title="Disable"> Delete</a>';
                            $anch = $role->id == \Auth::user()->id ? $anchFlag: $anch;

                            return Button::link('Edit')->asLinkTo($edit) . "|" . Button::link('Permission')->asLinkTo($editPermission) . "|" .  $anch . $form;

                        })

                        !!}
                    </div>
                </div>
                <div align="center"> {{ $roles->links()  }}</div>
            </div>
        </div>
    </div>
@endsection
