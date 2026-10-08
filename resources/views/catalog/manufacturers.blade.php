@extends('layouts.app')
@section('content')
    <h1>{{ $title }}</h1>
    <ul>
        @foreach ($manufacturers as $m)
            <li><a href="{{ route('catalog.manufacturer', $m) }}">{{ $m }}</a></li>
        @endforeach
    </ul>
@endsection
