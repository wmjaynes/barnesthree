@extends('layouts.app')

@section('content')
    <script crossorigin="anonymous" src="https://polyfill.io/v3/polyfill.min.js?features=Object.values%2CPromise%2CPromise.prototype.finally%2CArray.prototype.includes"></script>

    <div  id="app">
        <data-table endpoint="{{ route('dances.index') }}"></data-table>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
@endsection
