<?php
namespace PetShop\Model;

use PetShop\Core\Attribute\Campo;
use PetShop\Core\Attribute\Entidade;
use PetShop\Core\DAO;

#[Entidade(name: 'estados')]
class Estado extends DAO
{
  #[Campo(label: 'Unidade Federativa do estado ', pk: true, nn: true)]
  protected $uf;

  #[Campo(label: 'Cód. IBGE do estado ', nn: true)]
  protected $ibge;

  #[Campo(label: 'Nome do estado ', nn: true)]
  protected $estado;

  #[Campo(label: 'Região do estado ', nn: true)]
  protected $regiao;


  public function getUf()
  {
    return $this->uf;
  }

  public function getIbge()
  {
    return $this->ibge;
  }

  public function getEstado()
  {
    return $this->estado;
  }

  public function getRegiao()
  {
    return $this->regiao;
  }

}
