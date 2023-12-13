@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between gap-3">
            <div class="w-75">
                @foreach($partyStages as $partyStage)
                    <div
                        class="py-2 alert {{ $partyStage->type == \App\Models\PartyStage::TYPE_ROUND ? 'alert-primary mt-3' : 'alert-light'}} mb-1"
                    >
                        <div>
                            <span class="text-secondary">
                                {{ \App\Models\PartyStage::getPartyStageType()[$partyStage->type] }}:
                            </span>
                            {{ $partyStage->title }}
                        </div>
                        @if($partyStage->type == \App\Models\PartyStage::TYPE_QUESTION)
                            <div><span class="text-secondary">Баллы:</span> {{ $partyStage->points }}</div>
                            <div><span class="text-secondary">Ответ:</span> {{ $partyStage->answer->answer_title }}</div>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="w-25 mt-3">
                <div class="game-leaders">
                    <div class="game-leaders-list pb-2">
                        <div class="game-leaders-label mb-4">Рейтинг</div>
                        <div class="px-2 d-flex flex-column gap-1">
                            @include('components.gameLeadersList', ['points' => $points])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/css/client/game.css'])
@endpush
