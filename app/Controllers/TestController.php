<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TestController extends BaseController
{
    public function takeTest($uuid)
    {
        helper('OpenAiHelper'); // Make sure this helper exists and is loaded

        // Example topic: could also extract from DB using $uuid
        $topic = 'frontend development';

        // Generate AI-based questions
        $questions = generateAIQuestions($topic);

        // If OpenAI fails, fallback to static
        if (empty($questions)) {
            $questions = [
                [
                    'question' => 'What is the time complexity of binary search?',
                    'options'  => ['O(n)', 'O(log n)', 'O(n log n)', 'O(1)'],
                    'answer'   => 'O(log n)',
                ],
                [
                    'question' => 'Which language is used for web styling?',
                    'options'  => ['HTML', 'Python', 'CSS', 'Java'],
                    'answer'   => 'CSS',
                ],
            ];
        }

        // Save to session
        session()->set('current_test', [
            'uuid' => $uuid,
            'questions' => $questions,
        ]);

        return view('pages/student/take_test', [
            'questions' => $questions,
            'uuid' => $uuid,
        ]);
    }

    public function submitTest()
    {
        $submitted = $this->request->getPost();
        $stored = session()->get('current_test');

        if (!$stored || !isset($stored['questions'])) {
            return redirect()->to('/student/tests')->with('error', 'Test session expired.');
        }

        $questions = $stored['questions'];
        $score = 0;

        foreach ($questions as $index => $question) {
            $key = 'q' . $index;
            if (
                isset($submitted[$key]) &&
                $submitted[$key] === $question['answer']
            ) {
                $score++;
            }
        }

        $total = count($questions);
        $percent = round(($score / $total) * 100);

        return view('pages/student/test_result', [
            'score'  => $percent,
            'status' => $percent >= 50 ? 'Pass' : 'Fail',
        ]);
    }
}
