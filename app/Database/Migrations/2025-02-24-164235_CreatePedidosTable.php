<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePedidosTable extends Migration
{
    public function up()
    {
        //CRIA A TABELA PEDIDOS VIA MIGRATION
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'cliente_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => false,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        //DEFINE O ID COMO PK
        $this->forge->addPrimaryKey('id');

        //DEFINE AS FK (CLIENTE_ID)
        $this->forge->addForeignKey('cliente_id', 'clientes', 'id', 'CASCADE', 'CASCADE');

        //CRIA A TABELA NO BANCO
        $this->forge->createTable('pedidos');
    }

    public function down()
    {
        //EXCLUIR A TABELA PRODUTOS NO ROOLBACK
        $this->forge->dropTable('pedidos');
    }
}
