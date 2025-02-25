<?php

namespace App\Database\Seeds;

use App\Database\Factories\PedidosFactory;
use CodeIgniter\Database\Seeder;

class PedidosSeeder extends Seeder
{
    public function run()
    {
        //DADOS PARA POPULAR A TABELA PEDIDOS
        $data = [
            [
                'cliente_id' => '1',
                'status'  => 'ABERTO',
            ]
        ];

        //INSERE OS DADOS NO DB VIA MODEL
        $this->db->table('pedidos')->insertBatch($data);

        //EXECUTA A FACTORY (POPULA AS TABELAS EM MASSA COM DADOS FAKE)
        $pedidosFactory = new PedidosFactory($this->db);
        $pedidosFactory->create(100);
    }   
}
