<?php

namespace App\Requests;

use CodeIgniter\Validation\Validation;

class PedidoXProdutosFormRequest2
{
    //REGRAS
    protected $validationRules = [
        'pedido_id'  => 'required|numeric',
        'produto_id' => 'required|numeric',
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
        ]);

        //VALIDACAO
        if (!$validation->run($data)) {
            return $validation->getErrors();
        }
        return null;
    }
}
