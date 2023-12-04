@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="nav nav-pills nav-justified mb-4 mt-4">
            <li class="nav-item">
                <a class="nav-link active game-link" href="#game"><h5>Просмотр игры</h5></a>
            </li>

            <li class="nav-item">
                <a class="nav-link question-link disabled" href="#question"><h5>Раунды и Вопросы</h5></a>
            </li>
        </ul>
        <div>
            <div id="game" class="tab-content">
                <h3>Шаг 1</h3>

                <hr>

                <div class="mb-3">
                    <label for="title">Название игры</label>
                    <input
                        type="text"
                        id="game_title"
                        name="game_title"
                        class="form-control"
                        value="{{ $game->game_title }}"
                        disabled
                        readonly
                    />
                </div>
                <div class="mb-3">
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

                <div class="text-end">
                    <button type="button" id="next-step" class="btn btn-primary next-step">Продолжить</button>
                </div>
            </div>

            <div id="question" class="tab-content" style="display: none">
                <h3>Шаг 2</h3>

                <hr>

                <div id="rounds-container">
                    @foreach($game->rounds as $keyRound => $round)
                        <div class="mb-3 round">
                            <div class="mb-2">
                                <label for="rounds">Раунд №{{ $keyRound +1 }}</label>
                                <input
                                    type="text"
                                    id="rounds"
                                    class="form-control"
                                    name="rounds[{{ $round->id }}]"
                                    value="{{ $round->round_title }}"
                                    disabled
                                    readonly
                                />
                                @error('rounds')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
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

                <div class="text-end mt-4">
                    <button type="button" class="btn btn-outline-secondary prev-step">Вернуться</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/admin/tabs.js'])
@endpush
