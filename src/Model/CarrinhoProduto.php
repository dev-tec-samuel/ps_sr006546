<?php
namespace Petshop\Model;

use Petshop\Core\Attribute\Campo;
use Petshop\Core\Attribute\Entidade;
use Petshop\Core\DAO;

#[Entidade(name: 'carrinhosprodutos')]
class CarrinhoProduto extends DAO
{
  #[Campo(label: 'Cód. Produto', pk: true, nn: true)]
  protected $idProduto;

  #[Campo(label: 'Cód. Carrinho', pk: true, nn: true)]
  protected $idCarrinho;

  #[Campo(label: 'Preço do produto', nn: true, order:true)]
  protected $preco;

  #[Campo(label: 'Quantidade do produto', nn: true)]
  protected $quantidade;

  #[Campo(label: 'Dt. Criação', nn: true, auto: true)]
  protected $created_at;


  public function getIdProduto()
  {
    return $this->idProduto;
  }

  public function setIdProduto($idProduto): self
  {
    $this->idProduto = $idProduto;

    return $this;
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

  public function getPreco()
  {
    return $this->preco;
  }

  public function setPreco($preco): self
  {
    $this->preco = $preco;

    return $this;
  }

  public function getQuantidade()
  {
    return $this->quantidade;
  }

  public function setQuantidade($quantidade): self
  {
    $this->quantidade = $quantidade;

    return $this;
  }

  public function getCreated_At()
  {
    return $this->created_at;
  }
}
