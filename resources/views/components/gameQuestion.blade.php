<div class="text-center mt-4 w-100 mx-auto">
    <div class="mx-5">
        <div class="position-relative">
            <img src="{{ asset('images/title-img.png') }}" alt="" width="100%" height="130">
            <div class="text-container">
                <h1 class="pending-title">{{ $partyStage->title }}</h1>
            </div>
        </div>
    </div>
</div>

<form method="POST" id="player_id">
    @csrf
</form>

@if($player)
    <input value="{{ $existingPlayer->id }}" name="current_player_id" type="hidden">
    <input value="{{ $partyStage->id }}" name="party_stage_id" type="hidden">
@endif

@if($partyStage->player_winner && $partyStage->type == \App\Models\PartyStage::TYPE_QUESTION)
    <input value="1" name="modal" type="hidden">
    <input value="{{ $partyStage->player_winner->id }}" name="player_winner_id" type="hidden">
    <input value="{{ $partyStage->player_winner->name }}" name="player_winner_name" type="hidden">
    <input value="{{ $partyStage->answer->answer_title }}" name="answer" type="hidden">
@endif

<input type="hidden" name="party_id" value="{{ $partyStage->party_id }}">
<input type="hidden" name="is_player" value="{{ $player }}">

<div class="d-flex flex-wrap gap-2 mx-5 game-content mt-4">
    <div class="position-relative" style="width: 1250px">
        <img src="{{ asset('images/bubbles-bg.png') }}" alt="" width="1250px" class="bubbles-bg">

        <img src="{{ asset('images/bonaqua.png') }}" alt="" class="bonaqua-bg">
        <img src="{{ asset('images/cola.png') }}" alt="" class="cola-bg">
        <img src="{{ asset('images/fanta.png') }}" alt="" class="fanta-bg">
        <img src="{{ asset('images/fuse.png') }}" alt="" class="fuse-bg">
        <img src="{{ asset('images/piko.png') }}" alt="" class="piko-bg">
        <img src="{{ asset('images/sprite.png') }}" alt="" class="sprite-bg">
        <img src="{{ asset('images/schweppes.png') }}" alt="" class="schweppes-bg">
        <img src="{{ asset('images/monster.png') }}" alt="" class="monster-bg">
        <img src="{{ asset('images/zero.png') }}" alt="" class="zero-bg">

        <span id="answer" data-answer="{{ $partyStage->answer->answer_title }}"></span>

        <div class="bubbles d-flex gap-4 flex-wrap align-items-start justify-content-center">
            @foreach (\App\Models\Answer::shuffleAnswers() as $answer)
                <button class="bubble @if($player) bubble-player @endif">
                    <img
                        src="{{ asset('images/bubbles-big.png') }}"
                        width="{{ $answer['answer_width'] }}"
                        alt="{{ $answer['answer_title'] }}"
                        class="{{ $answer['id'] }}"
                    />
                    <span class="answer">{{ $answer['answer_title'] }}</span>
                </button>
            @endforeach
        </div>
    </div>
    <div class="game-leaders">
        <div class="game-leaders-list">
            <div class="game-leaders-label mb-4">Лидеры турнира</div>
            @if(isset($points))
                <div class="px-3 d-flex flex-column gap-3">
                    @include('components.gameLeadersList', ['points' => $points])
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
    @vite(['resources/css/client/game.css', 'resources/js/client/game.js'])
@endpush
