<?php namespace App\Models;

use CodeIgniter\Model;

class usuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields    = ['nombre', 'username', 'password' 'rol_id'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $hidden = ['usuario_id'];

    protected $skipValidation   = false;
}