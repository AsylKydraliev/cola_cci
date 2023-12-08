@extends('layouts.client')

@section('content')
    <div class="container">
        <form action="{{ route('player_game_code') }}" method="post">
            @csrf
            <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                <label for="game_code">Код игры</label>
                <input
                    type="number"
                    name="game_code"
                    id="game_code"
                    class="form-control @error('game_code') is-invalid @enderror"
                    value="{{ old('game_code') }}"
                />
                @error('game_code')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                <label for="name">Ваше имя</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                />
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-danger">Войти</button>
        </form>
    </div>
@endsection

@push('scripts')
    @vite(['resources/css/client/game.css'])
@endpush
