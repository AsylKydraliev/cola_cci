@extends('layouts.gameFinish')

@section('content')
    <img src="{{ asset('images/game-over.png') }}" alt="Game over" width="400">
    <h1 class="mt-4">Извините, игра уже началась</h1>
@endsection
