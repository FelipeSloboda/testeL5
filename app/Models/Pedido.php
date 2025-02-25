<?php

namespace App\Models;

use CodeIgniter\Model;

class Pedido extends Model
{
    protected $table            = 'pedidos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['cliente_id','produto_id','quantidade','preco_total','status'];

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


    // RELACIONAMENTO COM CLIENTE (N:1)
    public function cliente()
    {
        return $this->belongsTo('App\Models\ClienteModel', 'cliente_id');
    }

    // RWELACIONAMENTO COIM PRODUTOS (N:M através de PEDIDOXPRODUTOS)
    public function produtos()
    {
        return $this->belongsToMany('App\Models\ProdutoModel', 'pedidoxprodutos', 'pedido_id', 'produto_id')
                    ->withPivot('quantidade', 'preco');
    }

    public function verificaPedidoExiste($pedido_id){
        if($this->find($pedido_id)){
            return true;
        }
        return false;  
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
