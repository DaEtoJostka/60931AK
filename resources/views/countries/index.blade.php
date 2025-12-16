@extends('layouts.app')

@section('title', 'Страны')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1><i class="bi bi-flag me-2"></i>Страны мира</h1>
        <p class="text-muted mb-0">Макроэкономические данные по странам</p>
    </div>
    <div>
        <span class="badge bg-primary fs-6">
            <i class="bi bi-globe me-1"></i>Всего: {{ count($countries) }}
        </span>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th><i class="bi bi-hash me-1"></i>ID</th>
                        <th><i class="bi bi-flag me-1"></i>Название</th>
                        <th><i class="bi bi-building me-1"></i>Столица</th>
                        <th><i class="bi bi-people me-1"></i>Население</th>
                        <th><i class="bi bi-map me-1"></i>Площадь (км²)</th>
                        <th class="text-center"><i class="bi bi-gear me-1"></i>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($countries as $country)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $country->id }}</span></td>
                            <td><strong>{{ $country->name }}</strong></td>
                            <td>{{ $country->capital }}</td>
                            <td>{{ number_format($country->population, 0, ',', ' ') }}</td>
                            <td>{{ number_format($country->area, 0, ',', ' ') }}</td>
                            <td class="text-center">
                                <a href="{{ url('/countries/' . $country->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye me-1"></i>Подробнее
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="bi bi-inbox display-4 text-muted"></i>
                                <p class="text-muted mt-2">Нет данных о странах</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
