@extends('layouts.app')

@section('content')
    <div  id="app">
        <data-table endpoint="{{ route('dances.index') }}"></data-table>
    </div>
@endsection
