<?php

namespace App\Models;

use CodeIgniter\Model;

class TestModel extends Model
{
    protected $table = 'tests';
    protected $primaryKey = 'id';

    protected $allowedFields = [
    'company_id', 'student_id', 'title', 'description', 'slug', 'status', 'test_date'
];



}
