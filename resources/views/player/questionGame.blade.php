@extends('layouts.client')

@section('content')
    <div class="container-fluid">
        <div class="client-content">
            @include('components.gameQuestion', ['partyStage' => $partyStage, 'player' => true])
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/css/client/game.css'])
@endpush
