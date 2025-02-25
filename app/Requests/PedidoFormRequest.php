<?php

namespace App\Requests;

use CodeIgniter\Validation\Validation;

class PedidoFormRequest
{
    //REGRAS
    protected $validationRules = [
        'cliente_id'  => 'required|numeric',
        'status' => 'required',
    ];

    public function validate($data)
    {
        $validation = \Config\Services::validation();

        //MENSAGENS
        $validation->setRules($this->validationRules, [
            'cliente_id' => [
                'required'   => 'O campo CLIENTE_ID é obrigatório.',
                'numeric'    => 'O campo CLIENTE_ID aceita apenas números.'
            ],
            'status' => [
                'required'   => 'O campo STATUS é obrigatório.',
            ],
        ]);

        //VALIDACAO
        if (!$validation->run($data)) {
            return $validation->getErrors();
        }
        return null;
    }
}
