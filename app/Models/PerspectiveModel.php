<?php

namespace App\Models;

use CodeIgniter\Model;

class PerspectiveModel extends Model
{
    protected $table         = 'perspective';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['image','width', 'height', 'address', 'details', 'title'];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}