<?php
require_once __DIR__ . '/../vendor/autoload.php';

class Teste
{
  protected $protegido;
  private $privado;

  public function __set($nome, $valor)
  {
    $metodoProcurado = 'set' . $nome;
    if(method_exists($this::class, $metodoProcurado)) {
      $this->$metodoProcurado($valor);
    } else {
      throw new Exception('O método "' . $metodoProcurado . '"não existe');
    }
  }

  public function __get($nome)
  {
    $metodoProcurado = 'get' . $nome;
    if(method_exists($this::class, $metodoProcurado)) {
      return $this->$metodoProcurado();
    } else {
      throw new Exception('O método "' . $metodoProcurado . '"não existe');
    }
  }

  public function getProtegido()
  {
    return $this->protegido;
  }

  public function setProtegido($protegido): self
  {
    if($protegido<1) {
      throw new Exception('Valor inválido deve ser protegido');
    }
    $this->protegido = $protegido;

    return $this;
  }

  public function getPrivado()
  {
    return $this->privado;
  }

  public function setPrivado($privado): self
  {
    $this->privado = $privado;

    return $this;
  }
}

$t = new Teste();
$t->protegido = 33;
echo $t->protegido;
