<?php

namespace Petshop\Controller;

use Petshop\Core\Exception;
use Petshop\Model\Cidade;
use Petshop\Model\Empresa;
use Petshop\Model\Estado;
use Petshop\View\Render;

class AdminEmpresaController
{
  public function listar()
  {
    //alimentando dados para a tabela de listagem
    $dadosListagem = [];
    $dadosListagem['objeto']  = new Empresa();
    $dadosListagem['imagens']  = true;
    $dadosListagem['remover'] = true;
    $dadosListagem['colunas'] = [
      ['campo' => 'idempresa',     'class' => 'text-center'],
      ['campo' => 'nomefantasia'],
      ['campo' => 'razaosocial'],
      ['campo' => 'tipo',           'class' => 'text-center'],
      ['campo' => 'estado',         'class' => 'text-center'],
      ['campo' => 'telefone1',      'class' => 'text-center'],
      ['campo' => 'created_at', 'class' => 'text-center'],
    ];
    $htmlTabela = Render::block('tabela-admin', $dadosListagem);

    //alimentando dados para a página de clientes
    $dados = [];
    $dados['titulo'] = 'Empresas - Listagem';
    $dados['usuario'] = $_SESSION['usuario'];
    $dados['tabela'] = $htmlTabela;

    Render::back('empresas', $dados);
  }

  public function form($valor)
  {
    //verificar se o parâmetro tem um número e, se for número, é um ID válido
    if (is_numeric($valor)) {
      $objeto = new Empresa();
      $resultado = $objeto->find(['idempresa=' => $valor]);
      if (empty($resultado)) {
        redireciona('/admin/empresas', 'danger', 'Link inválido, registro não localizado');
      }
      $_POST = $resultado[0];
      // $_POST['senha'] = '';
    }

    //cria e exibe o formulário
    $dados = [];
    $dados['titulo'] = 'Empresas - Manutenção';
    $dados['formulario'] = $this->renderizaFormulario(empty($_POST));

    Render::back('empresas', $dados);
  }

  public function postForm($valor)
  {
    $objeto = new Empresa();

    //se $valor tem um número, carrega dados relativos a ele
    if (is_numeric($valor)) {
      if (!$objeto->loadById($valor)) {
        redireciona('/admin/empresas', 'danger', 'Link inválido, registro não localizado');
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
    redireciona('/admin/empresas', 'success', 'Alterações realizadas com SUCESSO');
  }

  public function renderizaFormulario($novo)
  {
    $cidades = (new Cidade)->find();
    $optionsCidade = [];
    foreach($cidades as $c) {
      $optionsCidade[] = ['value'=>$c['municipio'], 'label'=>$c['municipio']];
    }

    $estados = (new Estado)->find();
    $optionsEstado = [];
    foreach($estados as $c) {
      $optionsEstado[] = ['value'=>$c['estado'], 'label'=>$c['estado']];
    }

    $dados = [
      'btn_class' => 'btn btn-warning px-5 mt-5',
      'btn_label' => ($novo ? 'Adicionar' : 'Atualizar'),
      'fields' => [
        ['type' => 'readonly', 'name' => 'idempresa', 'class' => 'col-2', 'label' => 'Id. Empresa'],
        ['type' => 'text', 'name' => 'nomefantasia', 'class' => 'col-5', 'label' => 'Nome da Empresa', 'required'=>true],
        ['type' => 'text', 'name' => 'razaosocial', 'class' => 'col-5', 'label' => 'Razão Social', 'required'=>true],
        [
          'type' => 'radio-inline', 'name' => 'tipo', 'class' => 'col-3', 'label' => 'A empresa é...',
          'options' => [
            ['value' => 'Matriz', 'label' => 'Matriz'],
            ['value' => 'Filial', 'label' => 'Filial'],
          ],
          'required'=>true
        ],
        ['type' => 'text', 'name' => 'cep', 'class' => 'col-3', 'label' => 'CEP', 'required'=>true],
        ['type' => 'select', 'name' => 'cidade', 'class' => 'col-3', 'label' => 'Cidade', 'required'=>true, 'options'=>$optionsCidade],
        ['type' => 'select', 'name' => 'estado', 'class' => 'col-3', 'label' => 'Estado', 'required'=>true, 'options'=>$optionsEstado],
        ['type' => 'text', 'name' => 'rua', 'class' => 'col-5', 'label' => 'Rua'],
        ['type' => 'text', 'name' => 'bairro', 'class' => 'col-5', 'label' => 'Bairro'],
        ['type' => 'text', 'name' => 'numero', 'class' => 'col-2', 'label' => 'Número'],
        ['type' => 'text', 'name' => 'telefone1', 'class' => 'col-3', 'label' => 'Telefone 1', 'required'=>true],
        ['type' => 'text', 'name' => 'telefone2', 'class' => 'col-3', 'label' => 'Telefone 2'],
        ['type' => 'text', 'name' => 'site', 'class' => 'col-6', 'label' => 'Site'],
        ['type' => 'email', 'name' => 'email', 'class' => 'col-6', 'label' => 'Email', 'required'=>true],
        ['type' => 'text', 'name' => 'cnpj', 'class' => 'col-4', 'label' => 'CNPJ', 'required'=>true],
        ['type' => 'readonly', 'name' => 'created_at', 'class' => 'col-3', 'label' => 'Criado em:'],
        ['type' => 'readonly', 'name' => 'updated_at', 'class' => 'col-3', 'label' => 'Atualizado em:'],
      ]
    ];

    return Render::block('form', $dados);
  }
}
