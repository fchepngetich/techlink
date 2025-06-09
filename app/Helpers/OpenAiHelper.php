<?php

use GuzzleHttp\Client;

if (!function_exists('generateAIQuestions')) {
    function generateAIQuestions(string $topic): array
    {
        log_message('info', 'Generating AI questions for topic: ' . $topic);

        $apiKey = getenv('OPENAI_API_KEY');
        if (!$apiKey) {
            log_message('error', 'OpenAI API key not found in environment.');
            return [];
        }

        try {
            $client = new Client([
                'base_uri' => 'https://api.openai.com/v1/',
                'headers'  => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type'  => 'application/json',
                ],
            ]);

            $prompt = "Generate 3 multiple choice questions (with 4 options each and the correct answer) on the topic: $topic. Format them as JSON with 'question', 'options', and 'answer'.";

            $response = $client->post('chat/completions', [
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'temperature' => 0.7,
                ],
            ]);

            $body = json_decode($response->getBody(), true);
            $text = $body['choices'][0]['message']['content'] ?? '';

            log_message('debug', 'OpenAI raw response: ' . $text);

            // Decode formatted JSON string from OpenAI response
            $jsonStart = strpos($text, '[');
            $json = substr($text, $jsonStart);
            $questions = json_decode($json, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                log_message('error', 'Failed to decode OpenAI response: ' . json_last_error_msg());
                return [];
            }

            return $questions;
        } catch (\Throwable $e) {
            log_message('critical', 'OpenAI request failed: ' . $e->getMessage());
            return [];
        }
    }
}
