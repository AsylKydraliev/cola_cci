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
            [
                'answer_title' => 'Воодушевленность',
                'answer_width' => '200',
            ],
            [
                'answer_title' => 'Ответственность',
                'answer_width' => '170',
            ],
            [
                'answer_title' => 'Командная работа',
                'answer_width' => '130',
            ],
            [
                'answer_title' => 'Честность',
                'answer_width' => '130',
            ],
            [
                'answer_title' => 'Причастность',
                'answer_width' => '170',
            ],
            [
                'answer_title' => 'Доверие',
                'answer_width' => '130',
            ],
            [
                'answer_title' => 'Cотрудничество',
                'answer_width' => '130',
            ],
            [
                'answer_title' => 'Инклюзивность',
                'answer_width' => '200',
            ],
            [
                'answer_title' => 'Креативность',
                'answer_width' => '130',
            ],
            [
                'answer_title' => 'Гибкость',
                'answer_width' => '170',
            ],
            [
                'answer_title' => 'Празднование',
                'answer_width' => '130',
            ],
            [
                'answer_title' => 'Фокус на клиента',
                'answer_width' => '130',
            ],
            [
                'answer_title' => 'Влиять и воздействовать',
                'answer_width' => '170',
            ],
            [
                'answer_title' => 'Мотивировать и вдохновлять',
                'answer_width' => '130',
            ],
            [
                'answer_title' => 'Партнерство с клиентами',
                'answer_width' => '200',
            ],
            [
                'answer_title' => 'Признавать ценность других',
                'answer_width' => '130',
            ],
            [
                'answer_title' => 'Постоянно повышать планку',
                'answer_width' => '170',
            ],
            [
                'answer_title' => 'Думать о завтрашнем дне',
                'answer_width' => '130',
            ],
            [
                'answer_title' => 'Быть лидером',
                'answer_width' => '130',
            ]
        ];

        foreach ($answers as $answer) {
            Answer::factory()->state($answer)->create();
        }
    }
}
