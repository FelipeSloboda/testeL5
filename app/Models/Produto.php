<?php

namespace App\Models;

use CodeIgniter\Model;

class Produto extends Model
{
    protected $table            = 'produtos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['descricao','quantidade','preco'];

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

    // RELACIONAMENTO COM PEDIDOS (N:M através de PEDIDOXPRODUTOS)
    public function pedidos()
    {
        return $this->belongsToMany('App\Models\PedidoModel', 'pedidoxprodutos', 'produto_id', 'pedido_id')
                    ->withPivot('quantidade', 'preco');
    }

    public function verificaProdutoExiste($produto_id){
        if($this->find($produto_id)){
            return true;
        }
        return false;  
    }

    public function verificaQtdProduto($produto_id, $qtd){
        $saldo = $this->select('quantidade')->where('id', $produto_id)->first();
        if($qtd <= $saldo['quantidade']){
            return true;
        }
        return false;  
    }

    public function buscaValorProduto($produto_id){
        $valor = $this->select('preco')->where('id', $produto_id)->first();
        return $valor['preco'];
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
