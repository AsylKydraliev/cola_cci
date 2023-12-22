<input type="hidden" name="party_id" value="{{ $partyStage->party_id }}">

<div class="text-center w-100 mx-auto">
    <div class="mx-5">
        <div class="position-relative">
            <img src="{{ asset('images/title-img.png') }}" alt="" width="100%" height="130">
            <div class="text-container">
                <h1 class="pending-title">
                    Ожидание начала
                    <img src="{{ asset('images/clock.png') }}" alt="" width="50"/>
                    {{ $partyStage->title }}
                </h1>
            </div>
        </div>
    </div>
</div>

<div class="d-flex flex-row justify-content-between gap-5 mx-5 pending-content align-items-center">
    <div class="w-50">
        <img src="{{ asset('images/pending-img.png') }}" alt="" width="100%">
    </div>
    <div class="w-50 position-relative">
        <div class="pending-content-label col-2">Описание</div>
        <div class="pending-content-task">
            {{ $partyStage->description }}
        </div>
    </div>
</div>

@push('scripts')
    @vite(['resources/js/client/game.js'])
@endpush

