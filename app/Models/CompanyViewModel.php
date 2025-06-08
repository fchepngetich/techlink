<?php

namespace App\Models;

use CodeIgniter\Model;


class CompanyViewModel extends Model
{
    protected $table = 'company_views';
    protected $allowedFields = ['student_id', 'company_id', 'viewed_at'];
    public $timestamps = false;
}

