<?php
namespace Petshop\Core;

use Petshop\Model\Categoria;
use Petshop\Model\Empresa;
use Petshop\View\Render;

abstract class FrontController 
{
  /**
   * Alimenta com dados e renderiza o topo do site
   * para o cliente (front-end)
   *
   * @return void
   */
  public function carregaHTMLTopo()
  {
    $empresa = new Empresa();
    $dados = $empresa->find(['tipo='=>'Matriz']);

    if(!empty($_SESSION['cliente']) ) {
      $dados[0]['cliente'] = $_SESSION['cliente'];
    }
    $categorias = new Categoria();
    $dados[0]['categorias'] = $categorias->find();
    
    return Render::block('topo', $dados[0]);
  }

  /**
   * Alimenta com dados e renderiza o topo do site
   * para o cliente (front-end)
   *
   * @return void
   */
  public function carregaHTMLRodape()
  {
    $empresa = new Empresa();
    $dados = $empresa->find(['tipo='=>'Matriz']);
    return Render::block('rodape', $dados[0]);
  }

}