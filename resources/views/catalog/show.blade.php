@extends('layouts.app')
@section('content')
    <h1>{{ $medicine['name'] }}</h1>
    <dl class="row">
        <dt class="col-sm-3">Код</dt>          <dd class="col-sm-9">{{ $medicine['code'] }}</dd>
        <dt class="col-sm-3">Производитель</dt><dd class="col-sm-9">{{ $medicine['manufacturer'] }}</dd>
        <dt class="col-sm-3">Форма выпуска</dt><dd class="col-sm-9">{{ $medicine['form'] }}</dd>
        <dt class="col-sm-3">Дозировка</dt>    <dd class="col-sm-9">{{ $medicine['dosage_mg'] }} мг</dd>
        <dt class="col-sm-3">Цена</dt>
        <dd class="col-sm-9">{{ number_format($medicine['price'], 2, ',', ' ') }} ₽</dd>
        <dt class="col-sm-3">Отпуск по рецепту</dt>
        <dd class="col-sm-9">{{ $medicine['by_prescription'] ? 'Да' : 'Нет' }}</dd>
    </dl>
    <a href="{{ route('catalog.index') }}">&larr; К каталогу</a>
@endsection
