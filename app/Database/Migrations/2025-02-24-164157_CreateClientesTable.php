<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClientesTable extends Migration
{
    public function up()
    {
        //CRIA A TABELA CLIENTES VIA MIGRATION
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'cpf-cnpj' => [
                'type'       => 'VARCHAR', //TRATADO COMO STRING PARA NAO TER PROBLEMAS COM "0" A ESQUEDA
                'constraint' => '14', //14 DIGITOS NO MAX PARA CNPJ OU 11 PARA CPF
                'unique' => true, // PERMITE UNICO CADASTRO POR CPF/CNPJ
            ],
            'nome-razao' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
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
        $this->forge->createTable('clientes');
    }

    public function down()
    {
        //EXCLUIR A TABELA CLIENTES NO ROOLBACK
        $this->forge->dropTable('clientes');
    }
}
