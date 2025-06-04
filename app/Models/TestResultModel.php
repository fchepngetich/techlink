<?php

namespace App\Models;

use CodeIgniter\Model;

class TestResultModel extends Model
{
    protected $table = 'test_results';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'assigned_test_id', 'score', 'completed_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'completed_at';
}
