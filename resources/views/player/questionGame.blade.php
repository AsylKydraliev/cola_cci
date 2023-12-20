@extends('layouts.client')

@section('content')
    <div class="client-content">
        <div class="container-fluid">
            <div class="client-content">
                @include('components.gameQuestion', ['partyStage' => $partyStage, 'player' => true])
            </div>
        </div>
    </div>
    <div class="mobile-content d-none">
        <div class="container text-center">
            <img src="{{ asset('images/game-over.png') }}" alt="Game over" width="400">
            <h1 class="mt-4">Извините, страница пока недоступна в мобильной версии</h1>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/css/client/game.css'])
@endpush
