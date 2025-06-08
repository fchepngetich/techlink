<?php

namespace App\Models;

use CodeIgniter\Model;

class OpportunityModel extends Model
{
    protected $table = 'opportunities';
    protected $primaryKey = 'id';

    protected $allowedFields = ['company_id', 'title', 'type', 'description', 'location', 'deadline'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    public function findByUUID(string $uuid)
{
    return $this->where('uuid', $uuid)->first();
}

public function getOpportunityTitle($id)
{
    return $this->where('id', $id)->select('title')->first()['title'] ?? 'Unknown';
}

}
