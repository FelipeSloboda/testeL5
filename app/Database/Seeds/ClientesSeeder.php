<?php

namespace App\Database\Seeds;

use App\Database\Factories\ClientesFactory;
use CodeIgniter\Database\Seeder;

class ClientesSeeder extends Seeder
{
    public function run()
    {
        //DADOS PARA POPULAR A TABELA CLIENTES
        $data = [
            [
                'cpf-cnpj' => '09908550900',
                'nome-razao'  => 'Felipe Sloboda',
            ]
        ];

        //INSERE OS DADOS NO DB VIA MODEL
        $this->db->table('clientes')->insertBatch($data);

        //EXECUTA A FACTORY (POPULA AS TABELAS EM MASSA COM DADOS FAKE)
        $pedidosFactory = new ClientesFactory($this->db);
        $pedidosFactory->create(100);
    }
}
