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
    self::$router->get('/', '\Petshop\Controller\HomeController@index');
    self::$router->get('/login', '\Petshop\Controller\LoginController@login');
    self::$router->get('/cadastro', '\Petshop\Controller\CadastroController@cadastro');
  }

  /**
   * Registra rota generica para erro de URL digitada
   *
   * @return void
   */
  private static function registraRotasDoBackEnd()
  {
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
}
