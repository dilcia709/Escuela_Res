<?php namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use Firebase\JWT\JWT;

class Auth extends BaseController
{
	use ResponseTrait;
	
	public function __construct()
	{
		helper('secure');
	}
	
	public function login()
	{
		try {
			$username = $this->request->getPost('username');
			$password = $this->request->getPost('password');

			$model = new UsuarioModel();
			$usuario = $model->where('username', $username)->first();

			if($usuario == null)
				return $this->respond($usuario);
			
			if(verifyPasswordField($password, $usuario['password'])):
				$jwt = $this->generateJWT($usuario);
				return $this->respond(['mensaje' => 'Token Generado','token'=> $jwt]);
			else:
				return $this->failValidationError('Contraseña incorrecta');
			endif;
			

		} catch (\Exception $e) {
			return $this->failServerError('ha ocurrido un error en el servidor');
		}
	}

	protected function generateJWT($usuario)
	{
		$key = Services::SecretKey();
		$time = time();
		$payload = [
			'aud'  => base_url(),
			'iat'  => $time,
			'exp'  => $time + (60),
			'data' => [
				'nombre'   => $usuario['nombre'],
				'username' => $usuario['username'],
				'rol' 	   => $usuario['rol_id']
			]
		];
		$jwt = JWT::encode($payload,$key);
		return $jwt;
	}
}
