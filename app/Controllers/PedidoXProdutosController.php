<?php

namespace App\Controllers;

use App\Requests\PedidoXProdutosFormRequest;
use App\Requests\PedidoXProdutosFormRequest2;
use CodeIgniter\RESTful\ResourceController;
use App\Models\PedidoXProdutos as ModelsPedidoXProdutos;
use App\Models\Produto as ModelsProduto;
use App\Models\Pedido as ModelsPedido;

class PedidoXProdutosController extends ResourceController
{   
    private $pedidoxprodutosModel;
    private $pedidoModel;
    private $produtoModel;

    public function __construct()
    {
        $this->pedidoxprodutosModel = new ModelsPedidoXProdutos();  
        $this->produtoModel = new ModelsProduto();
        $this->pedidoModel = new ModelsPedido();       
    }

    public function adicionarProduto()
    {
        try{
            //RECEBE OS DADOS DA REQUISICAO
            $dados = $this->request->getPost();
            
            
            //FAZ A VALIDACAO E RETORNA OS ERROS SE HOUVER
            $formRequest = new PedidoXProdutosFormRequest();
            $erros = $formRequest->validate($dados);
            if ($erros) {  
                return response_json(400, 'Dados invalidos', $erros);
            }

            //VERIFICA SE O PEDIDO EXISTE
            $pedido = $this->pedidoModel->verificaPedidoExiste($dados['pedido_id']);

            if($pedido == false)
            {
                return response_json(404, 'Pedido não encontrado', "0");
            }
            
            //VERIFICA SE O PRODUTO EXISTE
            $produto = $this->produtoModel->verificaProdutoExiste($dados['produto_id']);
            if($produto == false)
            {
                return response_json(404, 'Produto não encontrado', "0");
            }

            //VERIFICA SE A QUANTIDADE É <= PRODUTOS.QUANTIDADE
            $quantidade = $this->produtoModel->verificaQtdProduto($dados['produto_id'], $dados['quantidade']);
            if($quantidade == false)
            {
               return response_json(404, 'Quantidade do produto maior que a quantidade disponivel', "0");
            }
            //BUSCA O VALOR DO PRODUTO 
            $valor = $this->produtoModel->buscaValorProduto($dados['produto_id']);
            $dados['preco'] = $valor;

            //FAZ A INSERÇÃO DOS DADOS
            $this->pedidoxprodutosModel->adicionarProduto($dados);
            return response_json(200, 'Produto inserido no pedido com sucesso.', $dados);
            
        }
        catch (\Exception $erro) {
            return response_json(500, 'Erro interno', $erro->getMessage());
        }
    }

    public function removerProduto()
    {
        try{
            //RECEBE OS DADOS DA REQUISICAO
            $dados = $this->request->getPost();

            //FAZ A VALIDACAO E RETORNA OS ERROS SE HOUVER
            $formRequest = new PedidoXProdutosFormRequest2();
            $erros = $formRequest->validate($dados);
            if ($erros) {  
                return response_json(400, 'Dados invalidos', $erros);
            }

            //VERIFICA SE O PEDIDO EXISTE E SE POSSUI O PRODUTO
            $pedido = $this->pedidoxprodutosModel->verificarProdutoxPedido($dados['pedido_id'],$dados['produto_id']);
            if($pedido == false)
            {
                return response_json(404, 'Pedido ou produto não encontrado', "0");
            }

            //FAZ A EXCLUSAO DOS DADOS
            $this->pedidoxprodutosModel->removerProduto($dados['pedido_id'], $dados['produto_id']);
            return response_json(200, 'Produto excluido do pedido com sucesso.', $dados);
        }
        catch (\Exception $erro) {
            return response_json(500, 'Erro interno', $erro->getMessage());
        }        
    }
}
