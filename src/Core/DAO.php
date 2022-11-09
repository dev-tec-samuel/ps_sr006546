<?php
namespace PetShop\Core;

use PetShop\Core\Attribute\Campo;
use PetShop\Core\Attribute\Entidade;
use ReflectionClass;

class DAO
{
  /**@var array Informações da tabela/campos carregados */
  private $tableInfo = [];
  
  public function __construct()
  {
    $this->tableInfo = $this->getTableInfo();
  }

  /**
   * Método GET para acesso direto via nome de propriedades
   *
   * @param string $name
   * @return mixed
   */
  public function __get(string $name)
  {
    $metodoProcurado = 'get' . $name;
    if (method_exists($this, $metodoProcurado)) {
      return $this->$metodoProcurado();
    } else {
      throw new Exception("O atributo {$name} não tem método 'get' assciado");
    }
  }

  /**
   * Método SET para gravação direta via nome de propriedades
   *
   * @param string $name Nome da propriedade
   * @param mixed $value Valor a ser inserido
   * @param midex
   */
  public function __set(string $name, $value)
  {
    $metodoProcurado = 'set' . $name;
    if (method_exists($this, $metodoProcurado)) {
      $this->$metodoProcurado($value);
    } else {
      throw new Exception("O atributo {$name} não tem método 'set' assciado");
    }
  }
  /**
   * Função que objetiva retornar as metainformações
   * da classa, baseando-se para isso na leitura do Attributes
   *
   * @return array Prorpiedades da entidade(tabela e campos)
   */
  public function getTableInfo() : array
  {
    //vetor que armazenará as informações das classes referentes 
    //as tabelas e campos do banco de dados
    $info = [];

    //pegando as metainformações da classe referente ao
    //objeto atual instanciado
    $ref = new ReflectionClass($this::class);
    foreach($ref->getAttributes(Entidade::class) as $attrTable) {
      $info['tabela'] = $attrTable->getArguments();

      //procurando as metasinformações das prorpiedades da classe
      foreach($ref->getProperties() as $propriedade) {
        //pra cada campo/prop localizada, procura seus atributos
        foreach($propriedade->getAttributes(Campo::class) as $attrCampo) {
          $info['campos'][$propriedade->getName()] = $attrCampo->getArguments();
        }
      }
    }

    if(!isset($info['tabela']) || !isset($info['campos']) ) {
      throw new Exception('Os atributos da classe/propriedades não foram preenchidos');
    }
    return $info;
  }

  /**
   * Retorna o nome da tabela instanciada
   *
   * @return string
   */
  public function getTableName() : string 
  {
    return $this->tableInfo['tabela']['name'];
  }

  /**
   * Retorna informações dos campos/propriedades da classe associada
   *
   * @return array
   */
  public function getFields() : array
  {
    return $this->tableInfo['campos'];
  }

  /**
   * Retorna o nome do campo chave da tabela associada a classe atual
   *
   * @return string
   */
  public function getPkName() : string
  {
    foreach($this->tableInfo['campos'] as $cname => $cprops) {
      if(array_key_exists('pk', $cprops)) {
        return strtolower($cname);
      }
    }
    return '';
  }

  /**
   * Retorna o nome do campo de ordenação padrão
   *
   * @return string
   */
  public function getOrderByField() : string
  {
    foreach($this->tableInfo['campos'] as $cname => $cprops) {
      if(array_key_exists('order', $cprops)) {
        return strtolower($cname);
      }
    }
    return '';
  }
}