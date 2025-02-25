<?php

namespace App\Database\Factories;

use Faker\Factory as Faker;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\ConnectionInterface;

class PedidoXProdutosFactory
{
    protected $db;
    protected $faker;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = $db;
        $this->faker = Faker::create();
    }

    public function create(int $qtd = 100)
    {
        //DADOS A INSERIR
        $pedidoXProdutos = [];

        for ($i = 0; $i < $qtd; $i++) {
            $pedido_id = $this->getRandomPedidoId();  //PEGA ID DE CLIENTE RANDOM
            $produto_id = $this->getRandomProdutoId();  //PEGA ID DE PRODUTO RANDOM

            $pedidoXProdutos[] = [
                'pedido_id' => $pedido_id,
                'produto_id' => $produto_id,
                'quantidade' => $this->faker->numberBetween(1,100),
                'preco'  => $this->faker->randomFloat(2,1,1000)
            ];
        }

        //INSERE OS DADOS VIA MODEL
        $this->db->table('pedidoxprodutos')->insertBatch($pedidoXProdutos);
    }

    //FUNÇÃO QUE BUSCA UM ID DE PEDIDO RANDOM
    private function getRandomPedidoId()
    {
        $select = $this->db->table('pedidos');
        $select->select('id');
        $select->orderBy('rand()'); // RANDOM
        $query = $select->get();
        return $query->getRow()->id;
    }
    
    //FUNÇÃO QUE BUSCA UM ID DE PRODUTO RANDOM
    private function getRandomProdutoId()
    {
        $select = $this->db->table('produtos');
        $select->select('id');
        $select->orderBy('rand()'); // RANDOM
        $query = $select->get();
        return $query->getRow()->id;
    }
}
