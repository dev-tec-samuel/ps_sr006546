<?php

namespace Petshop\Model;

use Petshop\Core\Attribute\Campo;
use Petshop\Core\Attribute\Entidade;
use Petshop\Core\DAO;

#[Entidade(name: 'cidades')]
class Cidade extends DAO
{
  #[Campo(label: 'Cód. Cidade', pk: true, nn: true, auto: true)]
  protected $idCidade;

  #[Campo(label: 'Unidade Federativa', nn: true)]
  protected $uf;

  #[Campo(label: 'Cód. IBGE da cidade', nn: true)]
  protected $ibge;

  #[Campo(label: 'Cód. IBGE7 da cidade', nn: true)]
  protected $ibge7;

  #[Campo(label: 'Município da cidade', nn: true)]
  protected $municipio;

  #[Campo(label: 'Região da cidade', nn: true)]
  protected $regiao;

  #[Campo(label: 'População da cidade', nn: true)]
  protected $populacao;

  #[Campo(label: 'Porte da cidade', nn: true)]
  protected $porte;

  #[Campo(label: 'Capital da cidade', nn: true)]
  protected $capital;


  public function getIdCidade()
  {
    return $this->idCidade;
  }

  public function getUf()
  {
    return $this->uf;
  }

  public function getIbge()
  {
    return $this->ibge;
  }

  public function getIbge7()
  {
    return $this->ibge7;
  }

  public function getMunicipio()
  {
    return $this->municipio;
  }

  public function getRegiao()
  {
    return $this->regiao;
  }

  public function getPopulacao()
  {
    return $this->populacao;
  }

  public function getPorte()
  {
    return $this->porte;
  }

  public function getCapital()
  {
    return $this->capital;
  }
}
