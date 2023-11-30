@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="nav nav-pills nav-justified mb-4 mt-4">
        <li class="nav-item">
            <a class="nav-link active game-link" href="#game"><h5>Создание игры</h5></a>
        </li>

        <li class="nav-item">
            <a class="nav-link disabled question-link" href="#question"><h5>Раунды и Вопросы</h5></a>
        </li>
    </ul>

    @if(session('errors'))
        <div class="alert alert-danger my-3">
            Заполните все обязательные поля
        </div>
    @endif

    <form action="{{ route('admin.games.store') }}" method="post">
        @csrf
        <div id="game" class="tab-content">
            <h3>Шаг 1</h3>

            <hr>

            <div class="mb-3">
                <label for="title">Название игры</label>
                <input
                    type="text"
                    id="game_title"
                    name="game_title"
                    class="form-control"
                    placeholder="Введите название игры"
                    value="{{ old('game_title') }}"
                />
            </div>
            <div class="mb-3">
                <label for="rounds_quantity">Количество раундов</label>
                <input
                    type="number"
                    id="rounds_quantity"
                    class="form-control"
                    name="rounds_quantity"
                    placeholder="Выберите количество раундов"
                    value="{{ old('rounds_quantity') }}"
                />
            </div>

            <div class="text-end">
                <button type="button" id="next-step" class="btn btn-primary next-step" disabled>Продолжить</button>
            </div>
        </div>

        <div id="question" class="tab-content" style="display: none">
            <h3>Шаг 2</h3>

            <hr>

            <div id="rounds-container">
                <div id="answers" data-answers="{{ $answers }}"></div>
                <!-- Здесь будут созданы поля для раундов -->
            </div>

            <div class="text-end mt-4">
                <button type="button" class="btn btn-outline-secondary prev-step">Вернуться</button>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    @vite(['resources/js/admin/tabs.js', 'resources/js/admin/gamesCreate.js'])
@endpush
