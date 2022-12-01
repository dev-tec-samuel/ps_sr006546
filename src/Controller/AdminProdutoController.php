<?php

namespace Petshop\Controller;

use Petshop\Core\Exception;
use Petshop\Model\Marca;
use Petshop\Model\Produto;
use Petshop\View\Render;

class AdminProdutoController
{
  public function listar()
  {
    //alimentando dados para a tabela de listagem
    $dadosListagem = [];
    $dadosListagem['objeto']  = new Produto();
    $dadosListagem['imagens']  = true;
    $dadosListagem['colunas'] = [
      ['campo' => 'idproduto',  'class' => 'text-center'],
      ['campo' => 'tipo',       'class' => 'text-center'],
      ['campo' => 'preco',      'class' => 'text-center'],
      ['campo' => 'quantidade', 'class' => 'text-center'],
      ['campo' => 'descricao'],
      ['campo' => 'created_at', 'class' => 'text-center'],
    ];
    $htmlTabela = Render::block('tabela-admin', $dadosListagem);

    //alimentando dados para a página de clientes
    $dados = [];
    $dados['titulo'] = 'Produtos - Listagem';
    $dados['usuario'] = $_SESSION['usuario'];
    $dados['tabela'] = $htmlTabela;

    Render::back('produtos', $dados);
  }

  public function form($valor)
  {
    //verificar se o parâmetro tem um número e, se for número, é um ID válido
    if (is_numeric($valor)) {
      $objeto = new Produto();
      $resultado = $objeto->find(['idproduto=' => $valor]);
      if (empty($resultado)) {
        redireciona('/admin/produtos', 'danger', 'Link inválido, registro não localizado');
      }
      $_POST = $resultado[0];
      $_POST['preco']         = number_format($_POST['preco'], 2, ',', '.');
      $_POST['largura']       = number_format($_POST['largura']??0, 2, ',', '.');
      $_POST['altura']        = number_format($_POST['altura']??0, 2, ',', '.');
      $_POST['profundidade']  = number_format($_POST['profundidade']??0, 2, ',', '.');
      $_POST['peso']          = number_format($_POST['peso']??0, 2, ',', '.');
    }

    //cria e exibe o formulário
    $dados = [];
    $dados['titulo'] = 'Produtos - Manutenção';
    $dados['formulario'] = $this->renderizaFormulario(empty($_POST));

    Render::back('produtos', $dados);
  }

  public function postForm($valor)
  {
    $objeto = new Produto();

    //se $valor tem um número, carrega dados relativos a ele
    if (is_numeric($valor)) {
      if (!$objeto->loadById($valor)) {
        redireciona('/admin/produtos', 'danger', 'Link inválido, registro não localizado');
      }
    }

    try {
      
      $campos = array_change_key_case($objeto->getFields());
      foreach($campos as $campo => $propriedades) {
        if(isset($_POST[$campo])) {
          $objeto->$campo = $_POST[$campo];
        }
      }

      $objeto->save();
      
    } catch(Exception $e) {
      $_SESSION['mensagem'] = [
        'tipo'=>'warning',
        'texto'=>$e->getMessage()
      ];

      $this->form($valor);
      exit;
    }
    redireciona('/admin/produtos', 'success', 'Alterações realizadas com SUCESSO');
  }

  public function renderizaFormulario($novo)
  {
    $marcas = (new Marca)->find();
    $optionsMarca = [];
    foreach($marcas as $m) {
      $optionsMarca[] = ['value'=>$m['idmarca'], 'label'=>$m['marca']];
    }
    $dados = [
      'btn_class' => 'btn btn-warning px-5 mt-5',
      'btn_label' => ($novo ? 'Adicionar' : 'Atualizar'),
      'fields' => [
        ['type' => 'readonly', 'name' => 'idproduto', 'class' => 'col-2', 'label' => 'Id. Produto'],
        ['type' => 'select', 'name' => 'idmarca', 'class' => 'col-2', 'label' => 'Id. Marca', 'required'=>true, 
            'options'=>$optionsMarca
        ],
        ['type' => 'text', 'name' => 'nome', 'class' => 'col-3', 'label' => 'Nome', 'required'=>true],
        ['type' => 'select', 'name' => 'tipo', 'class' => 'col-4', 'label' => 'Tipo', 'required'=>true, 
          'options'=>[
            ['value'=>'Ração', 'label'=>'Ração'],
            ['value'=>'Brinquedo', 'label'=>'Brinquedo'],
            ['value'=>'Medicamento', 'label'=>'Medicamento'],
            ['value'=>'Higiene', 'label'=>'Higiene'],
            ['value'=>'Beleza', 'label'=>'Beleza'],
          ]
        ],
        ['type' => 'text', 'name' => 'preco', 'class' => 'col-4', 'label' => 'Preço', 'required'=>true],
        ['type' => 'text', 'name' => 'quantidade', 'class' => 'col-4', 'label' => 'Quantidade', 'required'=>true],
        ['type' => 'text', 'name' => 'largura', 'class' => 'col-4', 'label' => 'Largura'],
        ['type' => 'text', 'name' => 'altura', 'class' => 'col-4', 'label' => 'Altura'],
        ['type' => 'text', 'name' => 'profundidade', 'class' => 'col-4', 'label' => 'Profundidade'],
        ['type' => 'text', 'name' => 'peso', 'class' => 'col-4', 'label' => 'Peso'],
        ['type' => 'text', 'name' => 'descricao', 'class' => 'col-4', 'label' => 'Descrição'],
        ['type' => 'text', 'name' => 'especificadores', 'class' => 'col-3', 'label' => 'Especificadores'],
        ['type' => 'readonly', 'name' => 'created_at', 'class' => 'col-3', 'label' => 'Criado em:'],
        ['type' => 'readonly', 'name' => 'updated_at', 'class' => 'col-3', 'label' => 'Atualizado em:'],
      ]
    ];

    return Render::block('form', $dados);
  }
}
