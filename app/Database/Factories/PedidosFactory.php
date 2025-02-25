<?php

namespace App\Database\Factories;

use Faker\Factory as Faker;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\ConnectionInterface;

class PedidosFactory
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
        $pedidos = [];

        for ($i = 0; $i < $qtd; $i++) {

            $cliente_id = $this->getRandomClienteId();  //PEGA ID DE CLIENTE RANDOM

            $pedidos[] = [
                'cliente_id' => $cliente_id,
                'status'  => $this->faker->randomElement(['ABERTO','PAGO','CANCELADO'])
            ];
        }

        //INSERE OS DADOS VIA MODEL
        $this->db->table('pedidos')->insertBatch($pedidos);
    }

    //FUNÇÃO QUE BUSCA UM ID DE CLIENTE RANDOM
    private function getRandomClienteId()
    {
        $select = $this->db->table('clientes');
        $select->select('id');
        $select->orderBy('rand()'); // RANDOM
        $query = $select->get();
        return $query->getRow()->id;
    }
}
