@extends('layouts.app')

@section('title', 'Добавить событие')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="page-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/events') }}">События</a></li>
                    <li class="breadcrumb-item active">Добавление</li>
                </ol>
            </nav>
            <h1><i class="bi bi-plus-circle me-2"></i>Добавить событие</h1>
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

                <form action="{{ url('/events') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="country_id" class="form-label">
                            <i class="bi bi-flag me-1"></i>Страна <span class="text-danger">*</span>
                        </label>
                        <select name="country_id" id="country_id" class="form-select @error('country_id') is-invalid @enderror" required>
                            <option value="">Выберите страну...</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
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
                                  placeholder="Введите подробное описание события..." required>{{ old('description') }}</textarea>
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
                               value="{{ old('date') }}">
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <a href="{{ url('/events') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Отмена
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle me-1"></i>Создать событие
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
