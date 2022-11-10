<?php
namespace PetShop\Model;

use PetShop\Core\Attribute\Campo;
use PetShop\Core\Attribute\Entidade;
use PetShop\Core\DAO;

#[Entidade(name: 'clientes')]
class Cliente extends DAO
{
  #[Campo(label: 'Cód. Cliente', pk: true, nn: true, auto: true)]
  protected $idCliente;

  #[Campo(label: 'Tipo de cliente', nn: true)]
  protected $tipo;

  #[Campo(label: 'CPF/CNPJ do cliente', nn: true)]
  protected $cpfCnpj;

  #[Campo(label: 'Nome do cliente', nn: true)]
  protected $nome;

  #[Campo(label: 'E-mail do cliente', nn: true)]
  protected $email;

  #[Campo(label: 'Senha do cliente', nn: true)]
  protected $senha;

  #[Campo(label: 'Dt. Criação', nn: true, auto: true)]
  protected $created_at;

  #[Campo(label: 'Dt. Alteração', nn: true, auto: true)]
  protected $updated_at;


  public function getIdCliente()
  {
    return $this->idCliente;
  }

  public function getTipo()
  {
    return $this->tipo;
  }

  public function setTipo($tipo): self
  {
    $this->tipo = $tipo;

    return $this;
  }

  public function getCpfCnpj()
  {
    return $this->cpfCnpj;
  }

  public function setCpfCnpj($cpfCnpj): self
  {
    $this->cpfCnpj = $cpfCnpj;

    return $this;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function setNome($nome): self
  {
    $this->nome = $nome;

    return $this;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email): self
  {
    $this->email = $email;

    return $this;
  }

  public function getSenha()
  {
    return $this->senha;
  }

  public function setSenha($senha): self
  {
    $this->senha = $senha;

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
