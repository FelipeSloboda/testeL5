<?php

namespace App\Database\Seeds;

use App\Database\Factories\ProdutosFactory;
use CodeIgniter\Database\Seeder;

class ProdutosSeeder extends Seeder
{
    public function run()
    {
        //DADOS PARA POPULAR A TABELA PRODUTOS
        $data = [
            [
                'descricao' => 'Arroz branco 5Kg Buriti',
                'quantidade'  => '100',
                'preco'  => '20.00',
            ]
        ];

        //INSERE OS DADOS NO DB VIA MODEL
        $this->db->table('produtos')->insertBatch($data);

        //EXECUTA A FACTORY (POPULA AS TABELAS EM MASSA COM DADOS FAKE)
        $produtosFactory = new ProdutosFactory($this->db);
        $produtosFactory->create(100);
    }
}
