<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        helper('jwt');

        $header = $request->getHeaderLine('Authorization');
        
        if (!$header || !preg_match('/Bearer\s(\S+)/', $header, $matches)) {
            return service('response')->setStatusCode(401)->setJSON([
                'status' => 'error',
                'message' => 'Token não fornecido'
            ]);
        }

        $token = $matches[1];

        $usuario = validar_jwt($token);

        if (!$usuario) {
            return service('response')->setStatusCode(401)->setJSON([
                'status' => 'error',
                'message' => 'Token inválido ou expirado'
            ]);
        }

        return $request; // Permite o acesso se o token for válido
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nenhuma ação necessária após a requisição
    }
}
