<?php
namespace Petshop\Core;

use Bramus\Router\Router;

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
  }

  /**
   * registra as rotas possíveis que estarão associadas
   * aos controllers para o FrotnEnd
   *
   * @return void
   */
  private static function registraRotasDoBackEnd()
  {
    
  }
}