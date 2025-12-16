@extends('layouts.app')

@section('title', 'Событие #' . $event->id)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="page-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/events') }}">События</a></li>
                    <li class="breadcrumb-item active">Событие #{{ $event->id }}</li>
                </ol>
            </nav>
            <h1><i class="bi bi-calendar-event me-2"></i>Детали события</h1>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-calendar3 text-primary fs-4"></i>
                            </div>
                            <div>
                                <small class="text-muted">Дата события</small>
                                <h5 class="mb-0">
                                    {{ $event->date ? \Carbon\Carbon::parse($event->date)->format('d.m.Y') : 'Не указана' }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="bi bi-flag text-success fs-4"></i>
                            </div>
                            <div>
                                <small class="text-muted">Страна</small>
                                <h5 class="mb-0">
                                    @if($event->country)
                                        <a href="{{ url('/countries/' . $event->country->id) }}" class="text-decoration-none">
                                            {{ $event->country->name }}
                                        </a>
                                    @else
                                        <span class="text-muted">Не указана</span>
                                    @endif
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="mb-4">
                    <h5 class="text-muted mb-3">
                        <i class="bi bi-card-text me-2"></i>Описание события
                    </h5>
                    <div class="bg-light rounded p-4">
                        {{ $event->description }}
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <a href="{{ url('/events') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>К списку событий
                    </a>
                    @auth
                        <div class="d-flex gap-2">
                            <a href="{{ url('/events/' . $event->id . '/edit') }}" class="btn btn-warning">
                                <i class="bi bi-pencil me-1"></i>Редактировать
                            </a>
                            <form action="{{ url('/events/' . $event->id) }}" method="POST" 
                                  onsubmit="return confirm('Вы уверены, что хотите удалить это событие?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash me-1"></i>Удалить
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
