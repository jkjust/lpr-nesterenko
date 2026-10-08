@extends('layouts.app')
@section('content')
    <h1>{{ $title }}</h1>
    <ul>
        <li>Количество препаратов: {{ $count }}</li>
        <li>Средняя цена: {{ number_format($avg, 2, ',', ' ') }} ₽</li>
        <li>Минимальная цена: {{ number_format($min, 2, ',', ' ') }} ₽</li>
        <li>Максимальная цена: {{ number_format($max, 2, ',', ' ') }} ₽</li>
    </ul>
@endsection
