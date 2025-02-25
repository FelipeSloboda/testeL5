<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProdutosTable extends Migration
{
    public function up()
    {
        //CRIA A TABELA PRODUTOS VIA MIGRATION
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'descricao' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'quantidade' => [
                'type'       => 'INT',
                'constraint' => '255',
                'unsigned' => true,
            ],
            'preco' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2', //10 DIGITOS, E 2 CASAS DECIMAL PARA OS CENTAVOS
                'unsigned' => true,
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
        
        //CRIA A TABELA NO BANCO
        $this->forge->createTable('produtos');
    }

    public function down()
    {
        //EXCLUIR A TABELA PRODUTOS NO ROOLBACK
        $this->forge->dropTable('produtos');
    }
}
