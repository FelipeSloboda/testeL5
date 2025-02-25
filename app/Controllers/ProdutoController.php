<?php

namespace App\Controllers;

use App\Requests\ProdutoFormRequest;
use App\Models\Produto as ModelsProduto;
use CodeIgniter\RESTful\ResourceController;

class ProdutoController extends ResourceController
{
    private $produtoModel;

    public function __construct()
    {
        $this->produtoModel = new ModelsProduto();
    }

    public function index()
    {
        $pager = \Config\Services::pager();
        $pagina = $this->request->getGet('pagina') ?? 1;
        $por_pagina = $this->request->getGet('por_pagina') ?? 10;
        $filtro = $this->request->getGet('filtro');

        try{                 
            $produtos = $this->produtoModel->like('descricao',$filtro)->paginate($por_pagina,'default_simple', $pagina);

            $total_itens = $this->produtoModel->like('descricao',$filtro)->countAllResults();
            $total_paginas = ceil($total_itens / $por_pagina);
            
            $paginacao = [
                'pagina atual' => $pagina,
                'total de paginas' => $total_paginas,
                'itens por pagina' => $por_pagina,
                'total de itens' => $total_itens,
                'proxima pagina' => ($pagina < $total_paginas) ? site_url('/produto?filtro='. $filtro . '&pagina=' . ($pagina + 1) . '&por_pagina=' . $por_pagina) : null,
                'pagina anterior' => ($pagina > 1) ? site_url('/produto?filtro='. $filtro . '&pagina=' . ($pagina - 1) . '&por_pagina=' . $por_pagina) : null,
            ];

            if(!empty($produtos))
                return response_json(200, 'Dados retornados com sucesso',['DADOS' => $produtos, 'PAGINAÇÃO' => $paginacao]);
            else{
                return response_json(404, 'Nenhum registro encontrado', "0");
            }
        }
        catch (\Exception $erro) {
            return response_json(500, 'Erro interno', $erro->getMessage());
        }
    }

    public function show($id = null)
    {   
        try{
            //VALIDACAO SE O ID FOI INFORMADO
            if (!$id || $id==null || empty($id) || !is_numeric($id)) {
                return response_json(400, 'ID invalido', "0");
            }

            //FAZ A BUSCA DO CLIENTE
            $produto = $this->produtoModel->buscar($id);
            if(!empty($produto))
                return response_json(200, 'Dados retornados com sucesso', $produto);
            else{
                return response_json(404, 'Nenhum registro encontrado', "0");
            }
        }
        catch (\Exception $erro) {
            return response_json(500, 'Erro interno', $erro);
        }
    }

    public function create()
    {
        try{
            //RECEBE OS DADOS DA REQUISICAO
            $dados = $this->request->getPost();

            //FAZ A VALIDACAO E RETORNA OS ERROS SE HOUVER
            $formRequest = new produtoFormRequest();
            $erros = $formRequest->validate($dados);
            if ($erros) {
                return response_json(400, 'Dados invalidos', $erros);
            }

            //FAZ A INSERÇÃO DOS DADOS
            $this->produtoModel->criar($dados);
            return response_json(200, 'Produto cadastrado com sucesso', $dados);
        }
        catch (\Exception $erro) {
            return response_json(500, 'Erro interno', $erro);
        }
    }
    
    public function update($id = null)
    {
        try{
            //VALIDACAO SE O ID FOI INFORMADO
            if (!$id || $id==null || empty($id) || !is_numeric($id)) {
                return response_json(400, 'ID invalido', "0");
            }

            //RECEBE OS DADOS DA REQUISICAO
            $dados = $this->request->getPost();

            //FAZ A VALIDACAO E RETORNA OS ERROS SE HOUVER
            $formRequest = new produtoFormRequest();
            $erros = $formRequest->validate($dados);
            if ($erros) {
                return response_json(400, 'Dados invalidos', $erros);
            }

            //FAZ A ATUALIZAÇÃO DOS DADOS
            if ($this->produtoModel->atualizar($id, $dados)) {
                return response_json(200, 'Produto atualizado com sucesso', $dados);
            } else {
                return response_json(404, 'Nenhum registro encontrado', "0");
            }
        }
        catch (\Exception $erro) {
            return response_json(500, 'Erro interno', $erro);
        }
    }

    public function delete($id = null)
    {
        try{
            //VALIDACAO SE O ID FOI INFORMADO
            if (!$id || $id==null || empty($id) || !is_numeric($id)) {
                return response_json(400, 'ID invalido', "0");
            }

            //FAZ A EXCLUSÃO DOS DADOS
            if ($this->produtoModel->excluir($id)) {
                return response_json(200, 'Produto excluido com sucesso', $id);
            } else {
                return response_json(404, 'Nenhum registro encontrado', "0");
            }
        }
        catch (\Exception $erro) {
            return response_json(500, 'Erro interno', $erro);
        }
    }
}
