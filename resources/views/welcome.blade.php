@extends('layouts.client')

@section('content')
    <div class="container client-content">
        <div class="register-form text-center mx-auto mt-5">
            <form
                action="{{ route('player_game_code') }}"
                method="post"
                class="form d-flex flex-column gap-5 mx-auto"
            >
                @csrf
                <h1 class="fw-bold form-title">Регистрация</h1>
                <div class="field position-relative">
                    <label for="game_code" class="field-label">Код игры</label>
                    <input
                        type="text"
                        name="game_code"
                        id="game_code"
                        class="field-input"
                        value="{{ old('game_code') }}"
                        autofocus
                        required
                    />
                    @error('game_code')
                    <div class="text-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>
                <div class="field position-relative">
                    <label for="name" class="field-label">Ваше имя</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="field-input"
                        value="{{ old('name') }}"
                        autofocus
                        required
                    />
                    @error('name')
                    <div class="text-danger mt-3">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="mx-auto col-3 btn-submit">Войти</button>
            </form>
        </div>
    </div>
    <div class="mobile-content">
        <div class="container text-center">
            <img src="{{ asset('images/game-over.png') }}" alt="Game over" width="250">
            <h1 class="mt-4">Извините, страница пока недоступна в этом разрешении экрана</h1>
            <div class="mt-5 card card-body fs-5">
                <div>Возможно у Вас в настройках дисплея установлен <strong>размер текста 150%.</strong></div>
                Если у вас Windows 10 и выше,
                для изменения этого параметра нажмите в любом пустом месте на рабочем столе правой кнопкой мыши

                <div class="mx-auto text-start">
                    <div>> выберите <strong>Параметры экрана</strong></div>
                    <div>> в разделе <strong>Масштаб и Разметка</strong></div>
                    <div>> укажите<strong> размер текста 100%.</strong></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/css/client/game.css'])
@endpush
