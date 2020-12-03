<?php namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model
{
    protected $table = 'rol';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields    = ['nombre'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $hidden = ['rol_id'];

    protected $skipValidation   = false;
}