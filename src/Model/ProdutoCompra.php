<?php
namespace Petshop\Model;

use Petshop\Core\Attribute\Campo;
use Petshop\Core\Attribute\Entidade;
use Petshop\Core\DAO;

#[Entidade(name: 'produtos_compras')]
class ProdutoCompra extends DAO
{
  #[Campo(label: 'Cód. Produto', pk: true, nn: true, order:true)]
  protected $idProduto;

  #[Campo(label: 'Cód. Fornecedor', pk: true, nn: true)]
  protected $idFornecedor;

  #[Campo(label: 'Preço do produto', nn: true)]
  protected $preco;

  #[Campo(label: 'Quantidade do produto', nn: true)]
  protected $quantidade;


  public function getIdProduto()
  {
    return $this->idProduto;
  }

  public function setIdProduto($idProduto): self
  {
    $this->idProduto = $idProduto;

    return $this;
  }

  public function getIdFornecedor()
  {
    return $this->idFornecedor;
  }

  public function setIdFornecedor($idFornecedor): self
  {
    $this->idFornecedor = $idFornecedor;

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
}
