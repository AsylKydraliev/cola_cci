@extends('layouts.client')

@section('content')
    <div class="container">
        <form action="{{ route('sign_in_game') }}" method="post">
            @csrf
            <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                <label for="game_code">Код игры</label>
                <input
                    type="number"
                    name="game_code"
                    id="game_code"
                    class="form-control @error('game_code') is-invalid @enderror"
                />
            </div>
            <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                <label for="name">Ваше имя</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control @error('name') is-invalid @enderror"
                />
            </div>

            <button type="submit" class="btn btn-danger">Войти</button>
        </form>
    </div>
@endsection

@push('scripts')
    @vite(['resources/css/client/game.css'])
@endpush
