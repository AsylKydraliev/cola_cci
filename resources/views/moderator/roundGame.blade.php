@extends('layouts.client')

@section('content')
    <div class="container-fluid">

        @if(session('finish') || $partyStage->party->status === \App\Models\Party::STATUS_FINISHED)
            <div class="container alert alert-danger my-3">
                {{ session('finish') ?? 'Игра окончена' }}
            </div>
        @else
            @include('components.gameRound', ['partyStage' => $partyStage])

            <div class="text-end">
                <a class="btn btn-danger px-5 py-2 me-5"
                   href="{{ route('next_party_stage', ['party_id' => $partyStage->party_id]) }}">
                    {{ $partyStage->party->status === \App\Models\Party::STATUS_PENDING ? 'Старт' : 'Далее' }}
                    <i class="bi bi-chevron-double-right"></i>
                </a>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    @vite(['resources/css/client/game.css'])
@endpush
