<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if (!function_exists('gerar_jwt')) {
    function gerar_jwt($dados)
    {
        $chave_secreta = getenv('JWT_SECRET'); // Chave segura no .env
        $tempo_expiracao = time() + 3600; // 1 hora

        $payload = [
            'iat' => time(),         // Tempo de criação do token
            'exp' => $tempo_expiracao, // Expiração
            'dados' => $dados        // Dados do usuário
        ];

        return JWT::encode($payload, $chave_secreta, 'HS256');
    }
}

if (!function_exists('validar_jwt')) {
    function validar_jwt($token)
    {
        $chave_secreta = getenv('JWT_SECRET');

        try {
            return JWT::decode($token, new Key($chave_secreta, 'HS256'));
        } catch (\Exception $e) {
            return null; // Token inválido
        }
    }
}
