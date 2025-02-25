<?php

namespace App\Requests;

use CodeIgniter\Validation\Validation;

class PedidoXProdutosFormRequest
{
    //REGRAS
    protected $validationRules = [
        'pedido_id'  => 'required|numeric',
        'produto_id' => 'required|numeric',
        'quantidade' => 'required|numeric|min_length[1]|max_length[10000]',
    ];

    public function validate($data)
    {
        $validation = \Config\Services::validation();

        //MENSAGENS
        $validation->setRules($this->validationRules, [
            'pedido_id' => [
                'required'   => 'O campo PEDIDO_ID é obrigatório.',
                'numeric'    => 'O campo PEDIDO_ID aceita apenas números.',
            ],
            'produto_id' => [
                'required'   => 'O campo PRODUTO_ID é obrigatório.',
                'numeric'    => 'O campo PRODUTO_ID aceita apenas números.',
            ],
            'quantidade' => [
                'required'   => 'O campo QUANTIDADE é obrigatório.',
                'numeric'    => 'O campo QUANTIDADE aceita apenas números.',
                'min_length' => 'O campo QUANTIDADE deve ser no minimo 1 digito.',
                'max_length' => 'O campo QUANTIDADE deve ser no maximo 100000 dígitos.',
            ],
        ]);

        //VALIDACAO
        if (!$validation->run($data)) {
            return $validation->getErrors();
        }
        return null;
    }
}
