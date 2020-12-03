<?php namespace App\Controllers\API;

use App\Models\UsuariosModel;
use CodeIgniter\RESTful\ResourceController;

class Usuarios extends ResourceController
{
    public function __construct()
    {
        $this->model = $this->setModel(new UsuariosModel());
    }
	public function index()
	{
        $usuarios = $this->model->findAll();
		return $this->respond($usuarios);
    }
    public function create()
    {
        try {
            $usuario = $this->request->getJSON();
            if($this->model->insert($usuario)) {
                $usuario->id = $this->model->insertID();
               return $this->respondCreated($usuario);
            }else{
                return $this->failValidationError($this->model->validation->listErrors());
            }
        } catch (\Exception $e) {
            return $this->failServerError('Error en el servidor');
        }
    }
    public function edit($id = null)
	{
        try {
            if ($id == null)
                return $this->failValidationError('ID Invalido');
            
            $usuario = $this->model->find($id);
            if ($usuario == null)
                return $this->failValidationError('Usuario no encontrado '.$id);

            return $this->respond($usuario);

        } catch (\Exception $e) {
            return $this->failServerError('Error en el servidor');
        }
    }  
    public function update($id = null)
	{
        try {
            if ($id == null)
                return $this->failValidationError('ID invalido');
            
            $usuarioVerificado = $this->model->find($id);
            if ($usuarioVerificado == null)
                return $this->failValidationError('Usuario no encontrado'.$id);


            $usuario = $this->request->getJSON();
            if($this->model->update($id, $usuario)) {
                $usuario->id = $id;
                return $this->respondUpdated($usuario);
            }else{
                return $this->failValidationError($this->model->validation->listErrors());
            }
        } catch (\Exception $e) {
            return $this->failServerError('Error en el servidor');
        }
    }
    public function delete($id = null)
	{
		try {
            if ($id == null)
                return $this->failValidationError('ID invalido');
            
            $usuarioVerificado = $this->model->find($id);
            if ($usuarioVerificado == null)
                return $this->failValidationError('Usuario no encontrado'.$id);

            if($this->model->delete($id)) {
                return $this->respondDeleted($usuarioerificado);
            }else{
                return $this->failServerError('No se pudo eliminar el usuario');
            }
        } catch (\Exception $e) {
            return $this->failServerError('Error en el servidor');
        }
	}

}
