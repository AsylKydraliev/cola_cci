@extends('layouts.client')

@section('content')
    <div class="container">
        <form
            action="{{ route('player_game_uuid', ['player_uuid' => Request::segment(count(Request::segments()))]) }}"
            method="post"
            class="form d-flex flex-column gap-5 mx-auto mt-5"
        >
            <h1 class="text-center">Вход</h1>
            @csrf
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
            </div>

            <button type="submit" class="mx-auto col-3 btn-submit">Войти</button>
        </form>
    </div>
@endsection

@push('scripts')
    @vite(['resources/css/client/game.css'])
@endpush
