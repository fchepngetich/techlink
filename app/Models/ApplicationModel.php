<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationModel extends Model
{
    protected $table = 'applications';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'student_id', 'opportunity_id', 'status', 'applied_at','updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'applied_at';
}
