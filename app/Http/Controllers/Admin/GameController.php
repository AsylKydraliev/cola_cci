<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Answer;
use App\Models\Game;
use App\Models\Question;
use App\Models\Round;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class GameController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $games = Game::query()
            ->with(['rounds'])
            ->latest('id')
            ->paginate(10);

        return view('admin.games.index', compact('games'));
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $answers = Answer::all();

        return view('admin.games.create', compact('answers'));
    }

    /**
     * @param StoreGameRequest $request
     * @return RedirectResponse
     */
    public function store(StoreGameRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $rounds = $validatedData['rounds'];
        $round_descriptions = $validatedData['round_descriptions'];
        $questions = $validatedData['questions'];
        $points = $validatedData['points'];
        $answerIds = $validatedData['answer_ids'];

        $game = new Game();
        $game->game_title = $validatedData['game_title'];
        $game->rounds_quantity = $validatedData['rounds_quantity'];
        $game->save();

        // Создание вопросов и ответов для каждого раунда
        foreach ($rounds as $roundIndex => $roundTitle) {
            $round = new Round();
            $round->round_title = $roundTitle;
            $round->description = $round_descriptions[$roundIndex];
            $game->rounds()->save($round);

            // Создание вопроса
            foreach ($questions[$roundIndex] as $questionIndex => $questionText) {

                // Получение баллов для вопроса
                $point = $points[$roundIndex][$questionIndex];
                $answerId = $answerIds[$roundIndex][$questionIndex];

                // Создание вопроса с баллами
                $question = new Question();
                $question->question_title = $questionText;
                $question->points = $point;
                $question->answer_id = $answerId;

                $round->questions()->save($question);
            }
        }

        return redirect()
            ->route('admin.games.index')
            ->with('success', "Игра $game->game_title успешно создана");
    }

    /**
     * @param Game $game
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(Game $game): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $answers = Answer::all();
        $questions = [];

        foreach ($game->rounds as $round) {
            $questions[] = Question::query()
                ->select(
                    'questions.id',
                    'questions.question_title',
                    'questions.round_id',
                    'questions.answer_id',
                    'questions.points'
                )
                ->where('questions.round_id', '=', $round->id)
                ->get()
                ->toArray();
        }

        return view('admin.games.show', compact('game', 'answers', 'questions'));
    }

    /**
     * @param Game $game
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Game $game): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $answers = Answer::all();
        $questions = [];

        foreach ($game->rounds as $round) {
            $questions[] = Question::query()
                ->select(
                    'questions.id',
                    'questions.question_title',
                    'questions.round_id',
                    'questions.answer_id',
                    'questions.points'
                )
                ->where('questions.round_id', '=', $round->id)
                ->get()
                ->toArray();
        }

        return view('admin.games.edit', compact('game', 'answers', 'questions'));
    }

    /**
     * @param UpdateGameRequest $request
     * @param Game $game
     * @return RedirectResponse
     */
    public function update(UpdateGameRequest $request, Game $game): RedirectResponse
    {
        $validatedData = $request->validated();
        $rounds = $validatedData['rounds'];
        $round_descriptions = $request['round_descriptions'];
        $new_rounds = $request->get('new_rounds');
        $new_round_descriptions = $request->get('new_round_descriptions');
        $questions = $validatedData['questions'];
        $points = $validatedData['points'];
        $answerIds = $validatedData['answer_ids'];

        $game->game_title = $validatedData['game_title'];
        $game->rounds_quantity = $validatedData['rounds_quantity'];
        $game->save();

        // создание новых раундов
        if (isset($new_rounds) && isset($round_descriptions)) {
            foreach ($new_rounds as $roundIndex => $roundTitle) {
                $round = new Round();
                $round->round_title = $roundTitle;
                $round->description = $new_round_descriptions[$roundIndex];
                $game->rounds()->save($round);

                foreach ($questions[$roundIndex] as $questionId => $questionTitle) {
                    // Получение баллов для вопроса
                    $point = $points[$roundIndex][$questionId];
                    $answerId = $answerIds[$roundIndex][$questionId];

                    $question = new Question();
                    $question->question_title = $questionTitle;
                    $question->points = $point;
                    $question->answer_id = $answerId;

                    $round->questions()->save($question);
                }
            }
        }

        // Обновление раундов
        foreach ($rounds as $roundId => $roundTitle) {
            $existingRound = Round::find($roundId);

            if ($existingRound) {
                // Если запись существует, обновляем ее
                $existingRound->update([
                    'round_title' => $roundTitle,
                    'description' => $round_descriptions[$roundId]
                ]);
                $round = $existingRound;
            }

            // Обновление или создание вопроса для каждого раунда
            foreach ($questions[$roundId] as $questionId => $questionTitle) {
                // Получение баллов для вопроса
                $point = $points[$roundId][$questionId];
                $answerId = $answerIds[$roundId][$questionId];

                $question = Question::find($questionId);

                if ($question) {
                    $question->update([
                        'question_title' => $questionTitle,
                        'points' => $point,
                        'answer_id' => $answerId,
                        'round_id' => $roundId,
                    ]);
                }
            }
        }

        return redirect()
            ->route('admin.games.index')
            ->with('success', "Игра $game->game_title успешно обновлена");
    }

    /**
     * @param Game $game
     * @return RedirectResponse
     */
    public function destroy(Game $game): RedirectResponse
    {
        $game->delete();

        return redirect()
            ->route('admin.games.index')
            ->with('success', "Игра $game->game_title успешно удалена");
    }
}
