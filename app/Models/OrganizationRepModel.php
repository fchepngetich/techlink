<?php

namespace App\Models;

use CodeIgniter\Model;

class OrganizationRepModel extends Model
{
    protected $table = 'organization_reps';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'company_id', 'name', 'email', 'role'
    ];
}
