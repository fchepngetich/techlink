<?php

namespace App\Models;

use CodeIgniter\Model;

class OpportunityModel extends Model
{
    protected $table = 'opportunities';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'company_id', 'title', 'description', 'is_active', 'created_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}
