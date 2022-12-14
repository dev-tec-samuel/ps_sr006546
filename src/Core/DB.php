<?php
namespace Petshop\Core;

use Exception;

class DB
{
  /**
   * Variável estática que armazenará a conexão ao banco de dados
   * em um obejto PDO
   *
   * @var [type]
   */
  private static $db;

  /**
   * Retorna uma instância de conexão ao banco de daods
   * reusa se já houver sido estabelecida
   *
   * @return \PDO
   */
  public static function getInstance() : \PDO
  {
    if (is_null(self::$db)) {
      try {
        $options = [
          \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
          \PDO::ATTR_EMULATE_PREPARES => false,
          \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ];

        $dsn = sprintf('mysql:dbname=%s; host=%s', DB_SCHEMA, DB_HOST);
        self::$db = new \PDO($dsn, DB_USER, DB_PASSWORD,$options);
      } catch(\PDOException $e) {
        error_log($e->getMessage());
        throw new Exception('Falha ao realizr a conexão com o servidor, por favor, tente mais tarde');
      }
    }
    return self::$db;
  }

  /**
   * Metódo estático que retorna o resultado de uma consulta SQl
   * preparada ou não. Retorna um veotr de dados (PDO::FETCH_ASSOC)
   *
   * @param string $sql Consulta preparada com ou sem parâmetros
   * @param array $params Parâmetros opcionais
   * @return array
   */
  public static function select(string $sql, array $params=[]) : array
  {
    $st = self::query($sql, $params);
    return $st->fetchAll();
  }

  /**
   * Metódo estático que retorna um Statement de uma execução SQL
   * no banco de dados
   *
   * @param string $sql Comando SQL (insert/update/delete) preparado
   * @param array $params Parâmetros/valores referentes à consulta
   * @return \PDOStatement
   */
  public static function query(string $sql, array $params=[]) : \PDOStatement
  {
    try {
      $st = self::getInstance()->prepare($sql);
      
      if(!$st) {
        error_log("Erro ao preparar a consulta: {$sql}");
        throw new Exception('Falha ao preparar comando SQL');
      }

      $params = array_values($params);
      
      if(!$st->execute($params)) {
        error_log("Erro ao executar comando SQL: \n{$sql}\nParâmetros: \n" .  var_export($params, true));
        throw new Exception('Falha ao executar comando SQL');
      }
      return $st;
    } catch(\PDOException $e) {
      $msgErroLog =sprintf(
        "ERRO PDO: %s, na LINHA: %s\n%s\nParâmetro: \n%s",
        $e->getMessage(),
        $e->getLine(),
        $sql,
        var_export($params, true)
      );

      error_log($msgErroLog);
      throw new Exception('Falha ao executar comando no banco de dados');
    }
  }
}