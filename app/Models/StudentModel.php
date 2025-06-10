<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';

   protected $allowedFields = [
    'name', 'university', 'phone', 'email', 'admission_no',
    'course', 'skills', 'cv_path', 'transcript_path',
    'github', 'portfolio',
    'password', 'is_verified','verification_code', 'created_at','role'
];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    public function getUniversityById($studentId)
{
    $student = $this->select('university')
                    ->where('id', $studentId)
                    ->first();

    return $student ? $student['university'] : null;
}

}
