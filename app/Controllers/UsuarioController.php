<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class UsuarioController extends ResourceController
{
    public function perfil()
    {
        helper('jwt');

        $header = $this->request->getHeaderLine('Authorization');
        $token = explode(' ', $header)[1] ?? '';

        $usuario = validar_jwt($token);

        if (!$usuario) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => 'error',
                'message' => 'Token inválido'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'dados' => $usuario->dados
        ]);
    }
}
