{!! Form::hidden('redirect_to', URL::previous()) !!}
{!! Html::openFormGroup('name', $errors) !!}
    {!! Form::label('name', 'Name:', ['class' =>'control-label']) !!}
    {!! Form::text('name', null , ['class' => 'form-control',  'placeholder'=> 'Input category here']) !!}
    {!! Form::error('name', $errors ) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('description', $errors) !!}
{!! Form::label('description', 'Description:', ['class' =>'control-label']) !!}
{!! Form::textarea('description', null , ['class' => 'form-control',  'placeholder'=> 'Input description here']) !!}
{!! Form::error('description', $errors ) !!}
{!! Html::closeFormGroup() !!}
