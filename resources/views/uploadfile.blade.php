@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="box">
            {!!  Form::open(array('url' => '/uploadfile','files'=>'true')) !!}
            'Select the file to upload.
            {!! Form::file('image')  !!}
            {!! Form::submit('Upload File')  !!}
            {!! Form::close()  !!}
        </div>
    </div>
@endsection
