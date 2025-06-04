<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table = 'companies';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name', 'email', 'phone', 'password', 'is_approved', 'created_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}
