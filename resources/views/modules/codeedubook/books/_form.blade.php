{!! Form::hidden('redirect_to', URL::previous()) !!}

{!! Html::openFormGroup('author') !!}
{!! Form::label('author', 'Author:') !!}
{!! Form::text('author', $book->author->name , ['class' => 'form-control',  'placeholder'=> 'Input new Title here', 'disabled']) !!}
{!! Html::closeFormGroup() !!}


{!! Html::openFormGroup('title', $errors) !!}
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null , ['class' => 'form-control',  'placeholder'=> 'Input new Title here']) !!}
{!! Form::error('title', $errors ) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('subtitle', $errors) !!}
    {!! Form::label('subtitle', 'SubTitle:') !!}
    {!! Form::text('subtitle', null , ['class' => 'form-control',  'placeholder'=> 'Input new SubTitle here']) !!}
{!! Form::error('subtitle', $errors ) !!}
{!! Html::closeFormGroup() !!}


{!! Html::openFormGroup('price', $errors) !!}
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text('price', null , ['class' => 'form-control',  'placeholder'=> 'Input new price here']) !!}
{!! Form::error('price', $errors ) !!}
{!! Html::closeFormGroup() !!}


{!! Html::openFormGroup(['categories', 'categories.*'], $errors) !!}
{!! Form::label('categories[]', 'Categories:') !!}
{!! Form::select('categories[]', $categories , null, ['class' => 'form-control', 'multiple'=> true]) !!}
{!! Form::error('categories', $errors ) !!}
{!! Form::error('categories.*', $errors ) !!}
{!! Html::closeFormGroup() !!}


{!! Html::openFormGroup('description', $errors) !!}
{!! Form::label('description', 'Description:') !!}
{!! Form::textarea('description', null , ['class' => 'form-control',  'placeholder'=> 'Input new Dedication here']) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('dedication',  $errors) !!}
{!! Form::label('dedication', 'Dedication:') !!}
{!! Form::textarea('dedication', null , ['class' => 'form-control',  'placeholder'=> 'Input new Description here']) !!}
{!! Html::closeFormGroup() !!}


{!! Html::openFormGroup('website', $errors) !!}
{!! Form::label('website', 'Website:') !!}
{!! Form::text('website', null , ['class' => 'form-control',  'placeholder'=> 'Input new Website here']) !!}
{!! Form::error('website', $errors ) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('percent_complete', $errors) !!}
{!! Form::label('percent_complete', 'Progress (%):') !!}
{!! Form::number('percent_complete', null , ['class' => 'form-control',  'placeholder'=> 'Input new Progress here']) !!}
{!! Form::error('percent_complete', $errors ) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup() !!}
<label>
    {!! Form::checkbox('published') !!} Publicado?
</label>
{!! Html::closeFormGroup() !!}






