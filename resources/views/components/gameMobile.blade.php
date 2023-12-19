@extends('layouts.gameFinish')

@section('content')
    <div class="container text-center mobile-content">
        <img src="{{ asset('images/game-over.png') }}" alt="Game over" width="400">
        <h1 class="mt-4">Извините, страница пока недоступна в мобильной версии</h1>
    </div>
@endsection

@push('scripts')
    @vite(['resources/css/client/game.css'])
@endpush
