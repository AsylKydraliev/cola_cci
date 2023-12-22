@extends('layouts.gameFinish')

@section('content')
    <h1 class="mb-4 mt-4">Игра окончена</h1>
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
@endsection

@push('scripts')
    @vite('resources/css/client/game.css')
@endpush
