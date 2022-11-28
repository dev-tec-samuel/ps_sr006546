<?php

namespace Petshop\Controller;

use Petshop\Core\Exception;
use Petshop\Model\Cliente;
use Petshop\View\Render;

class AdminClienteController
{
  public function listar()
  {
    //alimentando dados para a tabela de listagem
    $dadosListagem = [];
    $dadosListagem['objeto']  = new Cliente();
    $dadosListagem['colunas'] = [
      ['campo' => 'idcliente',  'class' => 'text-center'],
      ['campo' => 'tipo',       'class' => 'text-center'],
      ['campo' => 'nome'],
      ['campo' => 'email'],
      ['campo' => 'created_at', 'class' => 'text-center'],
    ];
    $htmlTabela = Render::block('tabela-admin', $dadosListagem);

    //alimentando dados para a página de clientes
    $dados = [];
    $dados['titulo'] = 'Clientes - Listagem';
    $dados['tabela'] = $htmlTabela;

    Render::back('clientes', $dados);
  }

  public function form($valor)
  {
    //verificar se o parâmetro tem um número e, se for número, é um ID válido
    if (is_numeric($valor)) {
      $objeto = new Cliente();
      $resultado = $objeto->find(['idcliente=' => $valor]);
      if (empty($resultado)) {
        redireciona('/admin/clientes', 'danger', 'Link inválido, registro não localizado');
      }
      $_POST = $resultado[0];
      $_POST['senha'] = '';
    }

    //cria e exibe o formulário
    $dados = [];
    $dados['titulo'] = 'Clientes - Manutenção';
    $dados['formulario'] = $this->renderizaFormulario(empty($_POST));

    Render::back('clientes', $dados);
  }

  public function postForm($valor)
  {
    $objeto = new Cliente();

    //se $valor tem um número, carrega dados relativos a ele
    if (is_numeric($valor)) {
      if (!$objeto->loadById($valor)) {
        redireciona('/admin/clientes', 'danger', 'Link inválido, registro não localizado');
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
    redireciona('/admin/clientes', 'success', 'Alterações realizadas com SUCESSO');
  }

  public function renderizaFormulario($novo)
  {
    $dados = [
      'btn_class' => 'btn btn-warning px-5 mt-5',
      'btn_label' => ($novo ? 'Adicionar' : 'Atualizar'),
      'fields' => [
        ['type' => 'readonly', 'name' => 'idcliente', 'class' => 'col-2', 'label' => 'Id. Cliente'],
        [
          'type' => 'radio-inline', 'name' => 'tipo', 'class' => 'col-3', 'label' => 'Pessoa...',
          'options' => [
            ['value' => 'F', 'label' => 'Física'],
            ['value' => 'J', 'label' => 'Jurídica'],
          ],
          'required'=>true
        ],
        ['type' => 'text', 'name' => 'cpfcnpj', 'class' => 'col-3', 'label' => 'Documento', 'required'=>true],
        ['type' => 'text', 'name' => 'nome', 'class' => 'col-4', 'label' => 'Nome completo', 'required'=>true],
        ['type' => 'email', 'name' => 'email', 'class' => 'col-3', 'label' => 'E-mail', 'required'=>true],
        ['type' => 'password', 'name' => 'senha', 'class' => 'col-3', 'label' => 'Senha'],
        ['type' => 'readonly', 'name' => 'created_at', 'class' => 'col-3', 'label' => 'Criado em:'],
        ['type' => 'readonly', 'name' => 'updated_at', 'class' => 'col-2', 'label' => 'Atualizado em:'],
      ]
    ];

    return Render::block('form', $dados);
  }
}
