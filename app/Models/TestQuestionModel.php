<?php

namespace App\Models;

use CodeIgniter\Model;

class TestQuestionModel extends Model
{
    protected $table = 'test_questions';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'test_id', 'question', 'options', 'correct_option'
    ];
}
