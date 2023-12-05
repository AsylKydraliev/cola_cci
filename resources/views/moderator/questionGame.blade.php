@extends('layouts.client')

@section('content')
    <div class="container-fluid">
        @include('components.gameQuestion', ['partyStage' => $partyStage])
    </div>

    <div class="text-end">
        <a class="btn btn-danger px-5 py-2 me-5" href="{{ route('next_party_stage', ['party_id' => $partyStage->party_id]) }}">
            Далее
            <i class="bi bi-chevron-double-right"></i>
        </a>
    </div>
@endsection

@push('scripts')
    @vite(['resources/css/client/game.css'])
@endpush
