<?php
namespace Petshop\Model;

use Petshop\Core\Attribute\Campo;
use Petshop\Core\Attribute\Entidade;
use Petshop\Core\DAO;

#[Entidade(name: 'vendas')]
class Venda extends DAO
{
  #[Campo(label: 'Cód. Venda', pk: true, nn: true, auto: true)]
  protected $idVenda;

  #[Campo(label: 'Cód. Carrinho', pk: true, nn: true)]
  protected $idCarrinho;

  #[Campo(label: 'Forma GPTO da venda', nn: true)]
  protected $formaGpto;

  #[Campo(label: 'Status da venda', nn: true)]
  protected $status;

  #[Campo(label: 'Dt. Criação', nn: true, auto: true)]
  protected $created_at;

  #[Campo(label: 'Dt. Alteração', nn: true, auto: true)]
  protected $updated_at;


  public function getIdVenda()
  {
    return $this->idVenda;
  }

  public function getIdCarrinho()
  {
    return $this->idCarrinho;
  }

  public function setIdCarrinho($idCarrinho): self
  {
    $this->idCarrinho = $idCarrinho;

    return $this;
  }

  public function getFormaGpto()
  {
    return $this->formaGpto;
  }

  public function setFormaGpto($formaGpto): self
  {
    $this->formaGpto = $formaGpto;

    return $this;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function setStatus($status): self
  {
    $this->status = $status;

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
