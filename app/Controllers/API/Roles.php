<?php namespace App\Controllers\API;

use App\Models\ProfesorModel;
use CodeIgniter\RESTful\ResourceController;

class Profesores extends ResourceController
{
    public function __construct()
    {
        $this->model = $this->setModel(new RolModel());
    }
	public function index()
	{
        $roles = $this->model->findAll();
		return $this->respond($roles)
    }
    public function create()
    {
        try {
            $rol = $this->request->getJSON();
            if($this->model->insert($rol)) {
                $profesor->id = $this->model->insertID();
               return $this->respondCreated($rol);
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
                return $this->failValidationError('ID invalido');
            
            $rol = $this->model->find($id);
            if ($rol == null)
                return $this->failValidationError('No se ha encontrado un rol con el '.$id);

            return $this->respond($rol);

        } catch (\Exception $e) {
            return $this->failServerError('Error en el servidor');
        }
    }
    public function update($id = null)
	{
        try {
            if ($id == null)
                return $this->failValidationError('ID invalido');
            
            $rolVerificado = $this->model->find($id);
            if ($rolVerificado == null)
                return $this->failValidationError('No se ha encontrado un rol con el '.$id);


            $rol = $this->request->getJSON();
            if($this->model->update($id, $profesor)) {
                $rol->id = $id;
                return $this->respondUpdated($rol);
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
            
            $rolVerificado = $this->model->find($id);
            if ($rolVerificado == null)
                return $this->failValidationError('No se ha encontrado un rol con el '.$id);

            if($this->model->delete($id)) {
                return $this->respondDeleted($rolVerificado);
            }else{
                return $this->failServerError('No se pudo eliminar el rol');
            }

            

        } catch (\Exception $e) {
            return $this->failServerError('Error en el servidor');
        }
	}

}
