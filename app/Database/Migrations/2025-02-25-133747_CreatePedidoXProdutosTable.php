<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePedidoXProdutosTable extends Migration
{
    public function up()
    {
        //CRIA A TABELA PEDIDOXPRODUTOS VIA MIGRATION
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pedido_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => false,
            ],
            'produto_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => false,
            ],
            'quantidade' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => false,
            ],
            'preco' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2', //10 DIGITOS, E 2 CASAS DECIMAL PARA OS CENTAVOS
                'unsigned'   => true,
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

        //DEFINE AS FK (PEDIDO_ID)
        $this->forge->addForeignKey('pedido_id', 'pedidos', 'id', 'CASCADE', 'CASCADE');
        //DEFINE AS FK (PRODUTO_ID)
        $this->forge->addForeignKey('produto_id', 'produtos', 'id', 'CASCADE', 'CASCADE');

        //CRIA A TABELA NO BANCO
        $this->forge->createTable('pedidoxprodutos');
    }

    public function down()
    {
        //EXCLUIR A TABELA PEDIDOXPRODUTOS NO ROOLBACK
        $this->forge->dropTable('pedidoxprodutos');
    }
}
