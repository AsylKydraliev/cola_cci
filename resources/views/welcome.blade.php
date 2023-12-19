@extends('layouts.client')

@section('content')
    <div class="container">
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
@endsection

@push('scripts')
    @vite(['resources/css/client/game.css'])
@endpush
