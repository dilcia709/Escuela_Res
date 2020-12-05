<?php

use App\Models\RolModel;
use Config\Services;
use Firebase\JWT\JWT;

function validateAccess($roles, $authHeader)
{
    if( !is_array($roles) )
        return false;

    $key = Services::SecretKey();
    $arr = explode(' ',$authHeader);
    $jwt = $arr[1];
    $jwt = JWT::decode($jwt, $key,['HS256']);

    $rolModel = new RolModel();
    $rol = $rolModel->find($jwt->data->rol);

    if($rol == null)
        return false;

    if(in_array($rol['nombre'], $roles))
        return false;

    return true;
}