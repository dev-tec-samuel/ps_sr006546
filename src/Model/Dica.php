<?php

namespace PetShop\Model;

use PetShop\Core\Attribute\Campo;
use PetShop\Core\Attribute\Entidade;
use PetShop\Core\DAO;

#[Entidade(name: 'dicas')]
class Dica extends DAO
{
  #[Campo(label: 'Cód. Dica', nn:true, pk:true, auto:true)]
  protected $idDica;

  #[Campo(label: 'Título da dica', nn:true)]
  protected $titulo;

  #[Campo(label: 'Descrição da dica', nn:true)]
  protected $descricao;

  #[Campo(label: 'Dt. Criação', nn:true, auto:true)]
  protected $created_at;

  #[Campo(label: 'Dt. Alteração', nn:true, auto:true)]
  protected $updated_at;

  public function getIdDica()
  {
    return $this->idDica;
  }

  public function getTitulo()
  {
    return $this->titulo;
  }

  public function setTitulo($titulo): self
  {
    $this->titulo = $titulo;

    return $this;
  }

  public function getDescricao()
  {
    return $this->descricao;
  }

  public function setDescricao($descricao): self
  {
    $this->descricao = $descricao;

    return $this;
  }

  public function getCreated_At()
  {
    return $this->created_at;
  }

  public function getUpdated_At()
  {
    return $this->updated_at;
  }
}
