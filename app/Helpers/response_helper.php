<?php

if (!function_exists('response_json')) {

    function response_json($status = 200, $mensagem = '', $dados = null)
    {
        $response = service('response');

        //PADRAO DE CORPO DE RESPOSTA
        $resultado = [
            'CABEÇALHO' => [
                'status' => $status,
                'mensagem' => $mensagem,
            ],
            'RETORNO' => $dados
            
        ];

        //CFG código HTTP e tipo de conteúdo JSON
        return $response->setStatusCode($status)
                        ->setContentType('application/json')
                        ->setJSON($resultado);
    }
}