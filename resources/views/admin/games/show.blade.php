@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>{{ $game->game_title  }}</h3>

        <div class="mb-4">
            <label for="rounds_quantity" class="fw-bold">Количество раундов</label>
            <input
                type="number"
                id="rounds_quantity"
                class="form-control"
                name="rounds_quantity"
                value="{{ $game->rounds_quantity }}"
                disabled
                readonly
            />
        </div>

        <h3>Раунды</h3>
        <hr>

        <div id="rounds-container">
            @foreach($game->rounds as $keyRound => $round)
                <h5>Раунд №{{ $round->id }}</h5>
                <div class="mb-3 round card card-body">
                    <div class="mb-2 d-flex flex-column gap-1">
                        <div class="col">
                            <label for="rounds" class="fw-bold">Название</label>
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
                            <label class="fw-bold">Описание</label>
                            <div class="card">
                                <div class="card-body">
                                    {{ $round->description }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach($questions[$keyRound] as $keyQuestion => $question)
                        <div class="mb-1 d-flex gap-1 question">
                            <div class="col">
                                <label for="questions" class="fw-bold">Вопрос</label>
                                <input
                                    type="text"
                                    id="questions"
                                    class="form-control form-control-sm"
                                    name="questions[{{ $round->id }}][{{ $question['id'] }}]"
                                    value="{{ $question['question_title'] }}"
                                    disabled
                                    readonly
                                />
                            </div>

                            <div class="col">
                                <label for="answer_id" class="fw-bold">Ответ</label>
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
                            </div>

                            <div class="col">
                                <label for="points" class="fw-bold">Баллы</label>
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
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
