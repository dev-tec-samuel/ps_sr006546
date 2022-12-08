<?php
namespace Petshop\Controller;

use Petshop\Core\FrontController;
use Petshop\Model\Categoria;
use Petshop\Model\Produto;
use Petshop\View\Render;

class CategoriaController extends FrontController
{
  public function listaProdutos($idcategoria)
  {
    $dados = [];
    $dados['topo'] = $this->carregaHTMLTopo();
    $dados['rodape'] = $this->carregaHTMLRodape();

    $categoria= new Categoria();
    if(!$categoria->loadById($idcategoria)){
      redireciona('/', 'warning', 'Categoria não pode ser localizada');
    }
    
    $dados['categoria'] = [];
    $dados['categoria']['idcategoria'] = $categoria->getIdCategoria();
    $dados['categoria']['nome']        = $categoria->getNome();
    $dados['categoria']['descricao']   = $categoria->getDescricao();

    $dados['categoria']['imagens']     = $categoria->getFiles();

    $produtos = (new Produto)->find(['idcategoria=' => $categoria->getIdCategoria()]);

    foreach($produtos as &$p) {
      $prodAtual = new Produto();
      $prodAtual->loadById($p['idproduto']);
      $p['imagens'] = $prodAtual->getFiles();
    }

    $dados['produtos'] = $produtos;

    Render::front('categorias', $dados);
  }
}