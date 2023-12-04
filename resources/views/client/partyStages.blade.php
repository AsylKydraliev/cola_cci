@extends('layouts.client')

@section('content')
    <div class="container">
        @foreach($partyStages as $partyStage)
            <div class="card mb-2">
                <div class="card-header">
                    {{ \App\Models\PartyStage::getPartyStageType()[$partyStage->type] }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $partyStage->title }}</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
