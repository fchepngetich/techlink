<?php

namespace App\Models;

use CodeIgniter\Model;

class AssignedTestModel extends Model
{
    protected $table = 'assigned_tests';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'student_id', 'test_id', 'opportunity_id', 'assigned_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'assigned_at';
}
