@extends('layouts.gameFinish')

@section('content')
    <div class="client-content">
        <div class="container-fluid">
            @if(session('points') || $partyStage->party->status === \App\Models\Party::STATUS_FINISHED)
                <h1 class="mb-4 text-center">Игра окончена</h1>
                <div class="game-leaders">
                    <div class="game-leaders-list">
                        <div class="game-leaders-label mb-4">Лидеры турнира</div>
                        @if(isset($points))
                            <div class="px-3 d-flex flex-column gap-3 p-4">
                                @include('components.gameLeadersList', ['points' => $points])
                            </div>
                        @endif
                    </div>
                </div>
            @else
                @include('components.gameQuestion', ['partyStage' => $partyStage, 'player' => false])

                <div class="text-end">
                    <a
                        id="next"
                        class="btn btn-danger px-5 py-2 me-5"
                        href="{{ route('next_party_stage', ['party_id' => $partyStage->party_id]) }}">
                        Далее
                        <i class="bi bi-chevron-double-right"></i>
                    </a>
                </div>
            @endif
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
