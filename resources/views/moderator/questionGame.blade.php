@extends('layouts.gameFinish')

@section('content')
    <div class="container-fluid">
        <input type="hidden" id="party_id" value="{{ $partyStage->party_id }}">

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
@endsection

@push('scripts')
    @vite(['resources/css/client/game.css'])
@endpush
