@extends('layouts.client')

@section('content')
    <div class="container-fluid">
        @include('components.gameQuestion', ['partyStage' => $partyStage])
    </div>
@endsection

@push('scripts')
    @vite(['resources/css/client/game.css'])
@endpush
