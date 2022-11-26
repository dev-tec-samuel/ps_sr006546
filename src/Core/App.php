<?php

namespace Petshop\Core;

use Bramus\Router\Router;
use Petshop\Controller\ErrorController;

class App
{
  /**
   * Váriavel estática que contera o objeto Router
   * reponsável pelo tratamento da rotas
   *
   * @var Router
   */
  private static $router;

  /**
   * Método que será carregado quando alguma página do 
   * site for invocada, decide qual a rota deve ser 
   * executada a partir da URL informada pelo usuario
   *
   * @return void
   */
  public static function start()
  {
    //carrega uma sessão ou inicia uma nova sessão em caso de novo acesso
    self::carregasessao();

    //associa um objeto Bramus\Router à váriavel $router
    self::$router = new Router();

    // registra as rotas possíveis
    self::registraRotasDoFrontEnd();
    self::registraRotasDoBackEnd();
    self::registra404generico();

    // analisa a requisição e escolhe a rota compatível
    self::$router->run();
  }

  /**
   * registra as rotas possíveis que estarão associadas
   * aos controllers para o FrotnEnd
   *
   * @return void
   */
  private static function registraRotasDoFrontEnd()
  {
    // ROTAS dos GETTERS
    self::$router->get('/', '\Petshop\Controller\HomeController@index');
    self::$router->get('/login', '\Petshop\Controller\LoginController@login');
    self::$router->get('/logout', '\Petshop\Controller\LoginController@logout');
    self::$router->get('/cadastro', '\Petshop\Controller\CadastroController@cadastro');
    self::$router->get('/meus-dados', '\Petshop\Controller\MeusDadosController@meusDados');
    self::$router->get('/fale-conosco', '\Petshop\Controller\FaleConoscoController@faleConosco');

    //ROTAS dos SETTERS
    self::$router->post('/login', '\Petshop\Controller\LoginController@postlogin');
    self::$router->post('/cadastro', '\Petshop\Controller\CadastroController@postCadastro');
    self::$router->post('/fale-conosco', '\Petshop\Controller\FaleConoscoController@postFaleConosco');
  }

  /**
   * Registra rota generica para erro de URL digitada
   *
   * @return void
   */
  private static function registraRotasDoBackEnd()
  {
    self::$router->mount('/admin', function() {
      self::$router->get('/', '\Petshop\Controller\AdminDashboardController@index');
      self::$router->get('/clientes', '\Petshop\Controller\AdminClienteController@listar');
      self::$router->get('/clientes/{valor}', '\Petshop\Controller\AdminClienteController@form');

      self::$router->post('/clientes/{valor}', '\Petshop\Controller\AdminClienteController@postForm');

    });
  }

  /**
   * Registra as rotas possíveis que estarão associadas
   * aos controllers para o FrotnEnd
   *
   * @return void
   */
  private static function registra404generico()
  {
    self::$router->set404(function () {
      header('HTTP/1.1 404 Not Found');
      $objErro = new ErrorController();
      $objErro->erro404();
    });
  }

  /**
   * Função que inicia uma nova sessão 
   * e posteriormente carrega o id da sessão
   * gravada no dispositivo do usuário
   *
   * @return void
   */
  private static function carregasessao()
  {
    session_start();
  }
}
