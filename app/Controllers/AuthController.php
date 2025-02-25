<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    public function login()
    {
        helper('jwt'); // Carregar o helper JWT

        // Simulação de usuário (substituir por banco de dados)
        $usuarios = [
            ['id' => 1, 'email' => 'teste@email.com', 'senha' => '123456']
        ];

        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');

        foreach ($usuarios as $user) {
            if ($user['email'] === $email && $user['senha'] === $senha) {
                // Gerar token JWT
                $token = gerar_jwt(['id' => $user['id'], 'email' => $user['email']]);

                return $this->response->setStatusCode(200)->setJSON([
                    'status' => 'success',
                    'token' => $token
                ]);
            }
        }

        return $this->response->setStatusCode(401)->setJSON([
            'status' => 'error',
            'message' => 'Usuário ou senha inválidos'
        ]);
    }
}
