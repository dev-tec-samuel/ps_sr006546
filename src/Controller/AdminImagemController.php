<?php

namespace Petshop\Controller;

use Petshop\Core\Exception;
use Petshop\Model\Arquivo;
use Petshop\View\Render;

class AdminImagemController
{
  public function listar($model, $idmodel)
  {
    $modelPath = "Petshop\\Model\\{$model}";
    if(!class_exists($modelPath)) {
      redireciona('admin/dashboard', 'danger', 'Página não localizada. Classe de dados destino não definida');
    }

    $objetoComFiguras = new $modelPath;
    $objetoComFiguras->loadById($idmodel);

    //alimentando dados para a tabela de listagem
    $dadosListagem = [];
    $dadosListagem['objeto']  = new Arquivo();
    $dadosListagem['rows']  = $objetoComFiguras->getFiles();
    $dadosListagem['colunas'] = [
      ['campo' => 'idarquivo',   'class' => 'text-center'],
      ['campo' => 'tipo',        'class' => 'text-center'],
      ['campo' => 'nome'],
      ['campo' => 'tabela',      'class' => 'text-center'],
      ['campo' => 'tabelaid',    'class' => 'text-center'],
      ['campo' => 'created_at',  'class' => 'text-center'],
    ];
    $htmlTabela = Render::block('tabela-admin', $dadosListagem);

    //alimentando dados para a página de categorias
    $dados = [];
    $dados['titulo'] = 'Imagens - Listagem';
    $campoOrdenacao = $objetoComFiguras->getOrderByField();
    $dados['registroAlvo'] = $model . ': <u class="d-inline-block mb-1">>' . $objetoComFiguras->$campoOrdenacao . '</u>';
    $dados['usuario'] = $_SESSION['usuario'];
    $dados['tabela'] = $htmlTabela;

    Render::back('imagens', $dados);
  }

  public function form($model, $idmodel, $valor)
  {
    $modelPath = "Petshop\\Model\\{$model}";
    if(!class_exists($modelPath)) {
      redireciona('admin/dashboard', 'danger', 'Página não localizada. Classe de dados destino não definida');
    }

    $objetoComFiguras = new $modelPath;
    $objetoComFiguras->loadById($idmodel);

    //verificar se o parâmetro tem um número e, se for número, é um ID válido
    if (is_numeric($valor)) {
      $objeto = new Arquivo();
      $resultado = $objeto->find(['idarquivo=' => $valor]);
      if (empty($resultado)) {
        redireciona("/admin/imagens{$model}/{$idmodel}", 'danger', 'Link inválido, registro não localizado');
      }
      $_POST = $resultado[0];
    }

    //cria e exibe o formulário
    $dados = [];
    $dados['titulo'] = 'Imagens - Manutenção';
    $dados['formulario'] = $this->renderizaFormulario(empty($_POST));
    $campoOrdenacao = $objetoComFiguras->getOrderByField();
    $dados['registroAlvo'] = $model . ': <u class="d-inline-block mb-1">' . $objetoComFiguras->$campoOrdenacao . '</u>';

    Render::back('imagens', $dados);
  }

  public function postForm($model, $idmodel, $valor)
  {
    $objeto = new Categoria();

    //se $valor tem um número, carrega dados relativos a ele
    if (is_numeric($valor)) {
      if (!$objeto->loadById($valor)) {
        redireciona('/admin/categorias', 'danger', 'Link inválido, registro não localizado');
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
    redireciona('/admin/categorias', 'success', 'Alterações realizadas com SUCESSO');
  }

  public function renderizaFormulario($novo)
  {
    $dados = [
      'btn_class' => 'btn btn-warning px-5 my-5',
      'btn_label' => ($novo ? 'Adicionar' : 'Atualizar'),
      'enctype'   => 'multipart/form-data',
      'fields' => [
        ['type' => 'readonly', 'name' => 'idarquivo', 'class' => 'col-3', 'label' => 'Id. Arquivo'],
        ['type' => 'readonly', 'name' => 'nome', 'class' => 'col-4', 'label' => 'Nome do arquivo (automático)'],
        ['type' => 'file', 'name' => 'arquivo', 'class' => 'col-5', 'label' => 'Arquivo', 'accept'=>'image/*'],
        ['type' => 'readonly', 'name' => 'tipo', 'class' => 'col-2'],
        ['type' => 'textarea', 'name' => 'descricao', 'class' => 'col-12', 'label' => 'Descrição', 'rows'=>'5'],
        ['type' => 'readonly', 'name' => 'created_at', 'class' => 'col-3', 'label' => 'Criado em:'],
        ['type' => 'readonly', 'name' => 'updated_at', 'class' => 'col-3', 'label' => 'Atualizado em:'],
      ]
    ];

    return Render::block('form', $dados);
  }
}
