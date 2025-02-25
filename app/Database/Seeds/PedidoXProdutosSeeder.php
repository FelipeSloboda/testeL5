<?php

namespace App\Database\Seeds;

use App\Database\Factories\PedidoXProdutosFactory;
use CodeIgniter\Database\Seeder;

class PedidoXProdutosSeeder extends Seeder
{
    public function run()
    {
        //DADOS PARA POPULAR A TABELA PEDIDOXPRODUTOS
        $data = [
            [
                'pedido_id' => '1',
                'produto_id' => '1',
                'quantidade'  => '10',
                'preco'  => '20.00',
            ]
        ];

        //INSERE OS DADOS NO DB VIA MODEL
        $this->db->table('pedidoxprodutos')->insertBatch($data);

        //EXECUTA A FACTORY (POPULA AS TABELAS EM MASSA COM DADOS FAKE)
        $pedidoXProdutosFactory = new PedidoXProdutosFactory($this->db);
        $pedidoXProdutosFactory->create(100);
    }
}
