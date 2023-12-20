@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>{{ $game->game_title  }}</h3>

        <div class="mb-4">
            <label for="rounds_quantity">Количество раундов</label>
            <input
                type="number"
                id="rounds_quantity"
                class="form-control"
                name="rounds_quantity"
                value="{{ $game->rounds_quantity  }}"
                disabled
                readonly
            />
        </div>

        <h4>Раунды</h4>
        <hr>

        <div id="rounds-container">
            @foreach($game->rounds as $keyRound => $round)
                <h4>Раунд №{{ $keyRound +1 }}</h4>
                <div class="mb-3 round">
                    <div class="mb-2 d-flex gap-1">
                        <div class="col">
                            <label for="rounds">Название</label>
                            <input
                                type="text"
                                id="rounds"
                                class="form-control"
                                name="rounds[{{ $round->id }}]"
                                value="{{ $round->round_title }}"
                                disabled
                                readonly
                            />
                        </div>
                        <div class="col">
                            <label for="round_descriptions">Описание</label>
                            <input
                                type="text"
                                id="round_descriptions"
                                class="form-control"
                                name="round_descriptions[{{ $round->id }}]"
                                value="{{ $round->description }}"
                                disabled
                                readonly
                            />
                        </div>
                    </div>

                    @foreach($questions[$keyRound] as $keyQuestion => $question)
                        <div class="mb-1 d-flex gap-1 question">
                            <input
                                type="text"
                                id="questions"
                                class="form-control form-control-sm"
                                name="questions[{{ $round->id }}][{{ $question['id'] }}]"
                                value="{{ $question['question_title'] }}"
                                disabled
                                readonly
                            />
                            <select
                                id="answer_id"
                                name="answer_ids[{{ $round->id }}][{{ $question['id'] }}]"
                                class="form-control form-select-sm readonly"
                                disabled
                                readonly
                            >
                                <option value="">Выберите ответ</option>
                                @foreach($answers as $answer)
                                    <option
                                        value="{{ $answer->id }}"
                                        @selected($answer->id == $question['answer_id'])
                                    >{{ $answer->answer_title }}</option>
                                @endforeach
                            </select>

                            <input
                                type="number"
                                id="points"
                                class="form-control form-control-sm"
                                name="points[{{ $round->id }}][{{ $question['id'] }}]"
                                value="{{ $question['points'] }}"
                                disabled
                                readonly
                            />
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
