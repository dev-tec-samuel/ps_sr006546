<?php
namespace PetShop\Core;

class DAO
{
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
}