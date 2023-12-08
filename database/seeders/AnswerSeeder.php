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
            ['answer_title' => 'Воодушевленность'],
            ['answer_title' => 'Ответственность'],
            ['answer_title' => 'Командная работа'],
            ['answer_title' => 'Честность'],
            ['answer_title' => 'Причастность'],
            ['answer_title' => 'Доверие'],
            ['answer_title' => 'Cотрудничество'],
            ['answer_title' => 'Инклюзивность'],
            ['answer_title' => 'Креативность'],
            ['answer_title' => 'Гибкость'],
            ['answer_title' => 'Празднование'],
            ['answer_title' => 'Фокус на клиента'],
            ['answer_title' => 'Влиять и воздействовать'],
            ['answer_title' => 'Мотивировать и вдохновлять'],
            ['answer_title' => 'Партнерство с клиентами'],
            ['answer_title' => 'Признавать ценность других'],
            ['answer_title' => 'Постоянно повышать планку'],
            ['answer_title' => 'Думать о завтрашнем дне']
        ];

        foreach ($answers as $answer) {
            Answer::factory()->state($answer)->create();
        }
    }
}
