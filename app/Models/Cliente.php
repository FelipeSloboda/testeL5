<?php

namespace App\Models;

use CodeIgniter\Model;


class Cliente extends Model
{
    protected $table            = 'clientes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['cpf-cnpj','nome-razao'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // RELACIONAMENTO COM PEDIDOS (1:N)
    public function pedidos()
    {
        return $this->hasMany('App\Models\PedidoModel', 'cliente_id');
    }

    public function listar()
    {
        return $this->findAll();
    }

    public function buscar($id)
    {
        return $this->find($id);
    }

    public function criar($dados)
    {
        return $this->insert($dados);
    }

    public function atualizar($id, $dados)
    {
        return $this->update($id, $dados);
    }

    public function excluir($id)
    {
        return $this->delete($id);
    }
}
