@extends('layouts.app')

@section('title', 'События')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h1><i class="bi bi-calendar-event me-2"></i>События</h1>
        <p class="text-muted mb-0">Исторические и политические события стран</p>
    </div>
    <div class="d-flex gap-2 align-items-center">
        @auth
            <a href="{{ url('/events/create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i>Добавить событие
            </a>
        @endauth
    </div>
</div>

<div class="card">
    <div class="card-body">
        <!-- Фильтр количества записей -->
        <div class="row mb-4">
            <div class="col-md-4">
                <form action="{{ url('/events') }}" method="GET" class="d-flex align-items-center gap-2">
                    <label for="per_page" class="form-label mb-0 text-nowrap">
                        <i class="bi bi-list-ol me-1"></i>Записей на странице:
                    </label>
                    <select name="per_page" id="per_page" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    </select>
                </form>
            </div>
            <div class="col-md-8 text-end">
                <span class="text-muted">
                    Показано {{ $events->firstItem() ?? 0 }} - {{ $events->lastItem() ?? 0 }} из {{ $events->total() }}
                </span>
            </div>
        </div>

        <!-- Таблица событий -->
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th><i class="bi bi-calendar me-1"></i>Дата</th>
                        <th><i class="bi bi-flag me-1"></i>Страна</th>
                        <th><i class="bi bi-card-text me-1"></i>Описание</th>
                        <th class="text-center"><i class="bi bi-gear me-1"></i>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                        <tr>
                            <td>
                                <span class="badge bg-primary">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $event->date ? \Carbon\Carbon::parse($event->date)->format('d.m.Y') : 'Не указана' }}
                                </span>
                            </td>
                            <td>
                                @if($event->country)
                                    <a href="{{ url('/countries/' . $event->country->id) }}" class="text-decoration-none">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $event->country->name }}
                                    </a>
                                @else
                                    <span class="text-muted">Н/Д</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($event->description, 100) }}</td>
                            <td class="text-center action-buttons">
                                <div class="btn-group" role="group">
                                    <a href="{{ url('/events/' . $event->id) }}" class="btn btn-info btn-sm" title="Просмотр">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @auth
                                        <a href="{{ url('/events/' . $event->id . '/edit') }}" class="btn btn-warning btn-sm" title="Редактировать">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ url('/events/' . $event->id) }}" method="POST" class="d-inline" 
                                              onsubmit="return confirm('Вы уверены, что хотите удалить это событие?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Удалить">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endauth
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-calendar-x display-4 text-muted"></i>
                                <p class="text-muted mt-2 mb-0">Нет событий</p>
                                @auth
                                    <a href="{{ url('/events/create') }}" class="btn btn-primary mt-3">
                                        <i class="bi bi-plus-circle me-1"></i>Добавить первое событие
                                    </a>
                                @endauth
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Пагинация -->
        @if($events->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $events->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection
