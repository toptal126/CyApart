<?php

namespace App\Models;

use CodeIgniter\Model;

class ApartmentModel extends Model
{
    protected $table         = 'apartments';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['title', 'apart_id', 'path' ,'price', 'cost', 'bedroom', 'good_sqm', 'room_sqm', 'terrace_sqm', 'balcony_sqm', 'floor', 'story', 'address', 'image','room_images', 'status'];
    protected $useTimestamps = false;
}