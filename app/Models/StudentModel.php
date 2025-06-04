<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name', 'university', 'phone', 'email', 'admission_no',
        'skills', 'cv_path', 'transcript_path',
        'password', 'is_verified', 'created_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}
