@extends('layouts.app')

@section('title', 'Редактировать событие')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="page-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/events') }}">События</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/events/' . $event->id) }}">Событие #{{ $event->id }}</a></li>
                    <li class="breadcrumb-item active">Редактирование</li>
                </ol>
            </nav>
            <h1><i class="bi bi-pencil-square me-2"></i>Редактировать событие</h1>
        </div>

        <div class="card">
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Ошибки валидации:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('/events/' . $event->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="country_id" class="form-label">
                            <i class="bi bi-flag me-1"></i>Страна <span class="text-danger">*</span>
                        </label>
                        <select name="country_id" id="country_id" class="form-select @error('country_id') is-invalid @enderror" required>
                            <option value="">Выберите страну...</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ (old('country_id', $event->country_id) == $country->id) ? 'selected' : '' }}>
                                    {{ $country->name }} ({{ $country->capital }})
                                </option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">
                            <i class="bi bi-card-text me-1"></i>Описание события <span class="text-danger">*</span>
                        </label>
                        <textarea name="description" id="description" rows="5" 
                                  class="form-control @error('description') is-invalid @enderror" 
                                  placeholder="Введите подробное описание события..." required>{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="date" class="form-label">
                            <i class="bi bi-calendar3 me-1"></i>Дата события
                        </label>
                        <input type="date" name="date" id="date" 
                               class="form-control @error('date') is-invalid @enderror" 
                               value="{{ old('date', $event->date) }}">
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <a href="{{ url('/events') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Отмена
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i>Сохранить изменения
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Опасная зона -->
        <div class="card mt-4 border-danger">
            <div class="card-header bg-danger text-white">
                <i class="bi bi-exclamation-triangle me-2"></i>Опасная зона
            </div>
            <div class="card-body">
                <p class="text-muted mb-3">Удаление события невозможно отменить. Будьте осторожны.</p>
                <form action="{{ url('/events/' . $event->id) }}" method="POST" 
                      onsubmit="return confirm('Вы уверены, что хотите удалить это событие? Это действие нельзя отменить.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Удалить событие
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
