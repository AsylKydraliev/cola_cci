<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $answers = [
            ['answer_title' => 'Ответ №1'],
            ['answer_title' => 'Ответ №2'],
            ['answer_title' => 'Ответ №3'],
            ['answer_title' => 'Ответ №4'],
            ['answer_title' => 'Ответ №5'],
            ['answer_title' => 'Ответ №6'],
            ['answer_title' => 'Ответ №7'],
            ['answer_title' => 'Ответ №8'],
            ['answer_title' => 'Ответ №9'],
            ['answer_title' => 'Ответ №10'],
            ['answer_title' => 'Ответ №11'],
            ['answer_title' => 'Ответ №12'],
            ['answer_title' => 'Ответ №13'],
            ['answer_title' => 'Ответ №14'],
            ['answer_title' => 'Ответ №15'],
            ['answer_title' => 'Ответ №16'],
            ['answer_title' => 'Ответ №17'],
            ['answer_title' => 'Ответ №18'],
            ['answer_title' => 'Ответ №19'],
            ['answer_title' => 'Ответ №20'],
        ];

        foreach ($answers as $answer) {
            Answer::factory()->state($answer)->create();
        }
    }
}
