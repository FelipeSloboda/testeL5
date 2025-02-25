<?php

namespace App\Requests;

use CodeIgniter\Validation\Validation;

class ClienteFormRequest
{
    //REGRAS
    protected $validationRules = [
        'cpf-cnpj'  => 'required|numeric|is_unique[clientes.cpf-cnpj]|min_length[11]|max_length[14]',
        'nome-razao' => 'required|is_unique[clientes.nome-razao]|min_length[1]|max_length[255]',
    ];

    public function validate($data)
    {
        $validation = \Config\Services::validation();

        //MENSAGENS
        $validation->setRules($this->validationRules, [
            'cpf-cnpj' => [
                'required'   => 'O campo CPF/CNPJ é obrigatório.',
                'is_unique'  => 'O campo CPF/CNPJ já foi utilizado.',
                'numeric'    => 'O campo CPF/CNPJ aceita apenas números.',
                'min_length' => 'O campo CPF deve ter 11 dígitos e o CNPJ 14 dígitos.',
                'max_length' => 'O campo CPF deve ter 11 dígitos e o CNPJ 14 dígitos.',
            ],
            'nome-razao' => [
                'required'   => 'O campo NOME/RAZÃO é obrigatório.',
                'is_unique'  => 'O campo NOME/RAZÃO já foi utilizado.',
                'min_length' => 'O campo NOME/RAZÃO deve ter entre 1 e 255 dígitos.',
                'max_length' => 'O campo NOME/RAZÃO deve ter entre 1 e 255 dígitos.',
            ],
        ]);

        //VALIDACAO
        if (!$validation->run($data)) {
            return $validation->getErrors();
        }
        return null;
    }
}
