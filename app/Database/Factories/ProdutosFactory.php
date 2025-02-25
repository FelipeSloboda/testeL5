<?php

namespace App\Database\Factories;

use Faker\Factory as Faker;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\ConnectionInterface;

class ProdutosFactory
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
        $produtos = [];

        for ($i = 0; $i < $qtd; $i++) {
            $produtos[] = [
                'descricao' => $this->faker->word(),
                'quantidade'  => $this->faker->numberBetween(1,100),
                'preco'  => $this->faker->randomFloat(2,1,1000)
            ];
        }

        //INSERE OS DADOS VIA MODEL
        $this->db->table('produtos')->insertBatch($produtos);
    }
}
