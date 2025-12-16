@extends('layouts.app')

@section('title', $country->name)

@section('content')
<div class="page-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="{{ url('/countries') }}">Страны</a></li>
            <li class="breadcrumb-item active">{{ $country->name }}</li>
        </ol>
    </nav>
    <h1><i class="bi bi-flag me-2"></i>{{ $country->name }}</h1>
</div>

<!-- Основная информация -->
<div class="row mb-4">
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card">
            <i class="bi bi-building"></i>
            <h3>{{ $country->capital }}</h3>
            <p class="text-muted mb-0">Столица</p>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card">
            <i class="bi bi-people"></i>
            <h3>{{ number_format($country->population, 0, ',', ' ') }}</h3>
            <p class="text-muted mb-0">Население</p>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card">
            <i class="bi bi-map"></i>
            <h3>{{ number_format($country->area, 0, ',', ' ') }}</h3>
            <p class="text-muted mb-0">Площадь (км²)</p>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card">
            <i class="bi bi-graph-up"></i>
            <h3>{{ $country->economies->count() }}</h3>
            <p class="text-muted mb-0">Записей ВВП</p>
        </div>
    </div>
</div>

<div class="row">
    <!-- События (1:N) -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-calendar-event me-2"></i>События (1:N)
                <span class="badge bg-white text-dark float-end">{{ $country->events->count() }}</span>
            </div>
            <div class="card-body">
                @if($country->events->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Дата</th>
                                    <th>Описание</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($country->events as $event)
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary">
                                                {{ $event->date ? \Carbon\Carbon::parse($event->date)->format('d.m.Y') : 'Н/Д' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ url('/events/' . $event->id) }}" class="text-decoration-none">
                                                {{ Str::limit($event->description, 50) }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-calendar-x display-4 text-muted"></i>
                        <p class="text-muted mt-2 mb-0">Нет записанных событий</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Экономика (1:N) -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-graph-up-arrow me-2"></i>Экономические показатели (1:N)
                <span class="badge bg-white text-dark float-end">{{ $country->economies->count() }}</span>
            </div>
            <div class="card-body">
                @if($country->economies->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Год</th>
                                    <th>ВВП (млрд)</th>
                                    <th>ВВП на душу</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($country->economies->sortByDesc('year') as $eco)
                                    <tr>
                                        <td><span class="badge bg-secondary">{{ $eco->year }}</span></td>
                                        <td>${{ number_format($eco->gdp, 2, ',', ' ') }}</td>
                                        <td>${{ number_format($eco->gdp_per_capita, 0, ',', ' ') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-bar-chart display-4 text-muted"></i>
                        <p class="text-muted mt-2 mb-0">Нет экономических данных</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Торговые партнеры (M:N) -->
<div class="card mb-4">
    <div class="card-header">
        <i class="bi bi-arrow-left-right me-2"></i>Торговые партнеры (M:N)
        <span class="badge bg-white text-dark float-end">{{ $country->partners->count() }}</span>
    </div>
    <div class="card-body">
        @if($country->partners->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Страна-партнер</th>
                            <th>Год</th>
                            <th>Экспорт → Партнер</th>
                            <th>Импорт ← Партнер</th>
                            <th>Торговый баланс</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($country->partners as $partner)
                            @php
                                $export = $partner->pivot->export_c1_to_c2;
                                $import = $partner->pivot->export_c2_to_c1;
                                $balance = $export - $import;
                            @endphp
                            <tr>
                                <td>
                                    <a href="{{ url('/countries/' . $partner->id) }}" class="text-decoration-none">
                                        <i class="bi bi-flag me-1"></i>{{ $partner->name }}
                                    </a>
                                </td>
                                <td><span class="badge bg-secondary">{{ $partner->pivot->year }}</span></td>
                                <td class="text-success">${{ number_format($export, 2, ',', ' ') }} млрд</td>
                                <td class="text-danger">${{ number_format($import, 2, ',', ' ') }} млрд</td>
                                <td>
                                    <span class="badge {{ $balance >= 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $balance >= 0 ? '+' : '' }}${{ number_format($balance, 2, ',', ' ') }} млрд
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="bi bi-people display-4 text-muted"></i>
                <p class="text-muted mt-2 mb-0">Нет данных о торговых партнерах</p>
            </div>
        @endif
    </div>
</div>

<div class="text-center">
    <a href="{{ url('/countries') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Вернуться к списку стран
    </a>
</div>
@endsection
