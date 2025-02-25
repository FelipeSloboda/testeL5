<?php

namespace App\Requests;

use CodeIgniter\Validation\Validation;

class ProdutoFormRequest
{
    //REGRAS
    protected $validationRules = [
        'descricao'  => 'required|is_unique[produtos.descricao]|min_length[5]|max_length[255]',
        'quantidade' => 'required|numeric|min_length[1]|max_length[100000]',
        'preco' => 'required|min_length[1]|max_length[100000]',
    ];

    public function validate($data)
    {
        $validation = \Config\Services::validation();

        //MENSAGENS
        $validation->setRules($this->validationRules, [
            'descricao' => [
                'required'   => 'O campo DESCRIÇÃO é obrigatório.',
                'is_unique'  => 'O campo DESCRIÇÃO já foi utilizado.',
                'min_length' => 'O campo DESCRIÇÃO deve ter no minimo 5 digitos.',
                'max_length' => 'O campo DESCRIÇÃO deve ter no maximo 255 digitos.',
            ],
            'quantidade' => [
                'required'   => 'O campo QUANTIDADE é obrigatório.',
                'numeric'    => 'O campo QUANTIDADE aceita apenas números.',
                'min_length' => 'O campo QUANTIDADE deve ter no minimo 1 digito.',
                'max_length' => 'O campo QUANTIDADE deve ter no maximo 100000 digito.',
            ],
            'preco' => [
                'required'   => 'O campo PREÇO é obrigatório.',
                'min_length' => 'O campo PREÇO deve ter no minimo 1 digito.',
                'max_length' => 'O campo PREÇO deve ter no maximo 100000 dígitos.',
            ],
        ]);

        //VALIDACAO
        if (!$validation->run($data)) {
            return $validation->getErrors();
        }
        return null;
    }
}
