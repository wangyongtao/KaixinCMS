<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace Tests\Services\Services;

use App\Services\Exams\ExamQuestionService;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class QuestionServiceTest extends TestCase
{
    public function testBasic()
    {
        static::assertTrue(true);
    }

    public function testAddQuestion()
    {
        $input = collect([
            'question_type' => 'xxxxxx',
            'paper_id' => 111,
            'section_id' => 222,
            'status' => 1,
        ]);
        $result = (new ExamQuestionService())->addQuestion($input);
        var_dump($result);
    }
}
