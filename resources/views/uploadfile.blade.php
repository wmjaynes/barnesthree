@extends('layouts.app')

@section('content')

    <div class="box">
        {!!  Form::open(array('url' => '/uploadfile','files'=>'true')) !!}
        'Select the file to upload.
        {!! Form::file('image')  !!}
        {!! Form::submit('Upload File')  !!}
        {!! Form::close()  !!}
    </div>

    <div class="box">
        <ul>
            <li>File Name: {{ $fileName ?? "" }}</li>
            <li>File Extension: {{ $fileExtension ?? "" }}</li>
            <li>File Real Path: {{ $fileRealPath ?? "" }}</li>
            <li>File Size: {{ $fileSize?? "" }}</li>
            <li>File Mime Type: {{ $fileMimeType ?? "" }}</li>
        </ul>
    </div>
@endsection
