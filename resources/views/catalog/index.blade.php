@extends('layouts.app')
@section('content')
    <h1>{{ $title }}</h1>
    <form method="GET" action="{{ route('catalog.index') }}" class="row g-2 mb-3">
        <div class="col-auto">
            <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Название...">
        </div>
        <div class="col-auto">
            <select name="sort" class="form-select">
                <option value="name" @selected($sort === 'name')>По названию</option>
                <option value="dosage_mg" @selected($sort === 'dosage_mg')>По дозировке</option>
                <option value="price" @selected($sort === 'price')>По цене</option>
            </select>
        </div>
        <div class="col-auto"><button class="btn btn-secondary">Найти</button></div>
    </form>
    <table class="table">
        <tr><th>№</th><th>Название</th><th>Производитель</th><th>Форма</th><th>Дозировка, мг</th><th></th></tr>
        @forelse ($medicines as $medicine)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="{{ route('catalog.show', ['id' => $medicine['id']]) }}">{{ $medicine['name'] }}</a></td>
                <td><a href="{{ route('catalog.manufacturer', $medicine['manufacturer']) }}">{{ $medicine['manufacturer'] }}</a></td>
                <td>{{ $medicine['form'] }}</td>
                <td>{{ $medicine['dosage_mg'] }}</td>
                <td>@if ($medicine['by_prescription']) <span class="badge bg-danger">по рецепту</span> @endif</td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-muted">Ничего не найдено.</td></tr>
        @endforelse
    </table>
@endsection
