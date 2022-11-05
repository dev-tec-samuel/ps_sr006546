<?php

namespace Petshop\Model;

//estados
class Estado
{
  //Unidade Federativa do estado, pk, nn
  protected $uf;

  //Cód. IBGE do estado, nn
  protected $ibge;

  //Nome do estado, nn
  protected $estado;

  //Região do estado, nn
  protected $regiao;

  /**
   * Get the value of uf
   */
  public function getUf()
  {
    return $this->uf;
  }

  /**
   * Set the value of uf
   */
  public function setUf($uf): self
  {
    $this->uf = $uf;

    return $this;
  }

  /**
   * Get the value of ibge
   */
  public function getIbge()
  {
    return $this->ibge;
  }

  /**
   * Set the value of ibge
   */
  public function setIbge($ibge): self
  {
    $this->ibge = $ibge;

    return $this;
  }

  /**
   * Get the value of estado
   */
  public function getEstado()
  {
    return $this->estado;
  }

  /**
   * Set the value of estado
   */
  public function setEstado($estado): self
  {
    $this->estado = $estado;

    return $this;
  }

  /**
   * Get the value of regiao
   */
  public function getRegiao()
  {
    return $this->regiao;
  }

  /**
   * Set the value of regiao
   */
  public function setRegiao($regiao): self
  {
    $this->regiao = $regiao;

    return $this;
  }
}
