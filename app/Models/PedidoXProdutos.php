<?php

namespace App\Models;

use CodeIgniter\Model;

use function PHPUnit\Framework\isNull;

class PedidoXProdutos extends Model
{
    protected $table            = 'pedidoxprodutos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','pedido_id','produto_id','quantidade','preco'];

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

    // RELACIONAMENTO COM PEDIDO
    public function pedido()
    {
        return $this->belongsTo('App\Models\PedidoModel', 'pedido_id');
    }

    // RELACIONAMENTO COM PRODUTO
    public function produto()
    {
        return $this->belongsTo('App\Models\ProdutoModel', 'produto_id');
    }

    public function adicionarProduto($dados){
        return $this->insert($dados);
    }

    public function removerProduto($pedido_id, $produto_id){
        return $this->where('pedido_id', $pedido_id)->where('produto_id', $produto_id)->delete();
    }

    public function verificarProdutoxPedido($pedido_id, $produto_id){
        $pedidoproduto = $this->where('pedido_id', $pedido_id)->where('produto_id', $produto_id)->first();
        if($pedidoproduto === null){
            return false;
        }
        return true;  
    }

}
