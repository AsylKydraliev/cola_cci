@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="nav nav-pills nav-justified mb-4 mt-4">
            <li class="nav-item">
                <a class="nav-link active game-link" href="#game"><h5>Редактирование игры</h5></a>
            </li>

            <li class="nav-item">
                <a class="nav-link disabled question-link" href="#question"><h5>Раунды и Вопросы</h5></a>
            </li>
        </ul>

        @if(session('errors'))
            <div class="alert alert-danger my-3">
                Заполните все обязательные поля
            </div>
        @endif

        <form action="{{ route('admin.games.update', ['game' => $game]) }}" method="post">
            @csrf
            @method('put')
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
                        placeholder="Введите название игры"
                        value="{{ old('game_title') ?? $game->game_title }}"
                        required
                    />
                </div>
                <div class="mb-3">
                    <label for="rounds_quantity">Количество раундов</label>
                    <input
                        type="number"
                        id="rounds_quantity"
                        class="form-control"
                        name="rounds_quantity"
                        placeholder="Выберите количество раундов"
                        value="{{ old('rounds_quantity') ?? $game->rounds_quantity  }}"
                        required
                    />
                </div>

                <div class="text-end">
                    <button type="button" id="next-step" class="btn btn-primary next-step" disabled>Продолжить</button>
                </div>
            </div>

            <div id="question" class="tab-content" style="display: none">
                <h3>Шаг 2</h3>

                <hr>

                <div id="rounds-container">
                    <div id="answers" data-answers="{{ $answers }}"></div>
                    <!-- Здесь будут созданы поля для раундов -->

                    @foreach($game->rounds as $keyRound => $round)
                        <div class="mb-3 round">
                            <div class="mb-2">
                                <label for="rounds">Раунд №{{ $keyRound +1 }}</label>
                                <input
                                    type="text"
                                    id="rounds"
                                    class="form-control"
                                    name="rounds[{{ $round->id }}]"
                                    placeholder="Введите название раунда"
                                    value="{{ old('rounds[]') ?? $round->round_title }}"
                                    required
                                />
                                @error('rounds')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="button" class="btn btn-primary btn-sm mb-2 addQuestion">
                                <i class="bi bi-plus-lg"></i>
                                Добавить вопрос
                            </button>

                            @foreach($questions[$keyRound] as $keyQuestion => $question)
                                <div class="mb-1 d-flex gap-1 question">
                                    <input
                                        type="text"
                                        id="questions"
                                        class="form-control form-control-sm"
                                        name="questions[{{ $round->id }}][{{ $question['id'] }}]"
                                        placeholder="Введите вопрос"
                                        value="{{ old("questions.{$round->id}.{$question['id']}.question_title") ?? $question['question_title'] }}"
                                        required
                                    />
                                    @error('questions')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <select
                                        id="answer_id"
                                        name="answer_ids[{{ $round->id }}][{{ $question['id'] }}]"
                                        class="form-select form-select-sm"
                                        required
                                    >
                                        <option value="">Выберите ответ</option>
                                        @foreach($answers as $answer)
                                            <option
                                                value="{{ $answer->id }}"
                                                @selected($answer->id == (old("answer_id.{$round->id}.{$question['id']}") ?? $question['answer_id']))
                                            >{{ $answer->answer_title }}</option>
                                        @endforeach
                                    </select>
                                    @error('answer_ids')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    <input
                                        type="number"
                                        id="points"
                                        class="form-control form-control-sm"
                                        name="points[{{ $round->id }}][{{ $question['id'] }}]"
                                        placeholder="Введите баллы"
                                        value="{{ old("points.{$round->id}.{$question['id']}") ?? $question['points'] }}"
                                        required
                                    />
                                    @error('points')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    <button type="button" class="btn btn-danger btn-sm deleteBtn">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <div class="text-end mt-4">
                    <button type="button" class="btn btn-outline-secondary prev-step">Вернуться</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/admin/tabs.js', 'resources/js/admin/gamesEdit.js'])
@endpush
