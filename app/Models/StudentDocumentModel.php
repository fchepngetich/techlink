<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentDocumentModel extends Model
{
    protected $table = 'student_documents';
    protected $primaryKey = 'id';
    protected $allowedFields = ['student_id', 'type', 'path', 'uploaded_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'uploaded_at';
}
