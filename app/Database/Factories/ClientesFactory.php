<?php

namespace App\Database\Factories;

use Faker\Factory as Faker;
use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\ConnectionInterface;

class ClientesFactory
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
        $clientes = [];

        for ($i = 0; $i < $qtd; $i++) {
            $clientes[] = [
                'cpf-cnpj' => $this->faker->numerify('###########'),
                'nome-razao'  => $this->faker->name
            ];
        }

        //INSERE OS DADOS VIA MODEL
        $this->db->table('clientes')->insertBatch($clientes);
    }
}
