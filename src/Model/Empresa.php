<?php
namespace PetShop\Model;

use PetShop\Core\Attribute\Campo;
use PetShop\Core\Attribute\Entidade;
use PetShop\Core\DAO;

#[Entidade(name: 'empresas')]
class Empresa extends DAO
{
  #[Campo(label: 'Cód. Empresa', pk: true, nn: true, auto: true)]
  protected $idEmpresa;

  #[Campo(label: 'Nome fantasia', nn: true)]
  protected $nomeFantasia;

  #[Campo(label: 'Razão social da empresa', nn: true)]
  protected $razaoSocial;

  #[Campo(label: 'Tipo da empresa', nn: true)]
  protected $tipo;

  #[Campo(label: 'CEP da empresa', nn: true)]
  protected $cep;

  #[Campo(label: 'Cidade da empresa', nn: true)]
  protected $cidade;

  #[Campo(label: 'Estado da empresa', nn: true)]
  protected $estado;

  #[Campo(label: 'Rua da empresa')]
  protected $rua;

  #[Campo(label: 'Bairro da empresa')]
  protected $bairro;

  #[Campo(label: 'Número da empresa')]
  protected $numero;

  #[Campo(label: 'Telefone 1 da empresa', nn: true)]
  protected $telefone1;

  #[Campo(label: 'Telefone 2 da empresa')]
  protected $telefone2;

  #[Campo(label: 'Site da empresa')]
  protected $site;

  #[Campo(label: 'E-mail da empresa', nn: true)]
  protected $email;

  #[Campo(label: 'CPNJ da empresa', nn: true)]
  protected $cnpj;

  #[Campo(label: 'Dt. Criação', nn: true, auto: true)]
  protected $created_at;

  #[Campo(label: 'Dt. Alteração', nn: true, auto: true)]
  protected $updated_at;


  public function getIdEmpresa()
  {
    return $this->idEmpresa;
  }

  public function getNomeFantasia()
  {
    return $this->nomeFantasia;
  }

  public function setNomeFantasia($nomeFantasia): self
  {
    $this->nomeFantasia = $nomeFantasia;

    return $this;
  }

  public function getRazaoSocial()
  {
    return $this->razaoSocial;
  }

  public function setRazaoSocial($razaoSocial): self
  {
    $this->razaoSocial = $razaoSocial;

    return $this;
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

  public function getCep()
  {
    return $this->cep;
  }

  public function setCep($cep): self
  {
    $this->cep = $cep;

    return $this;
  }

  public function getCidade()
  {
    return $this->cidade;
  }

  public function setCidade($cidade): self
  {
    $this->cidade = $cidade;

    return $this;
  }

  public function getEstado()
  {
    return $this->estado;
  }

  public function setEstado($estado): self
  {
    $this->estado = $estado;

    return $this;
  }

  public function getRua()
  {
    return $this->rua;
  }

  public function setRua($rua): self
  {
    $this->rua = $rua;

    return $this;
  }

  public function getNumero()
  {
    return $this->numero;
  }

  public function setNumero($numero): self
  {
    $this->numero = $numero;

    return $this;
  }

  public function getTelefone1()
  {
    return $this->telefone1;
  }

  public function setTelefone1($telefone1): self
  {
    $this->telefone1 = $telefone1;

    return $this;
  }

  public function getTelefone2()
  {
    return $this->telefone2;
  }

  public function setTelefone2($telefone2): self
  {
    $this->telefone2 = $telefone2;

    return $this;
  }

  public function getSite()
  {
    return $this->site;
  }

  public function setSite($site): self
  {
    $this->site = $site;

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

  public function getCnpj()
  {
    return $this->cnpj;
  }

  public function setCnpj($cnpj): self
  {
    $this->cnpj = $cnpj;

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
