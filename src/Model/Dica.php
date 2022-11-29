<?php

namespace Petshop\Model;

use Petshop\Core\Attribute\Campo;
use Petshop\Core\Attribute\Entidade;
use Petshop\Core\DAO;
use Petshop\Core\Exception;

#[Entidade(name: 'dicas')]
class Dica extends DAO
{
  #[Campo(label: 'Cód. Dica', nn: true, pk: true, auto: true)]
  protected $idDica;

  #[Campo(label: 'Título', nn: true, order: true)]
  protected $titulo;

  #[Campo(label: 'Descrição', nn: true)]
  protected $descricao;

  #[Campo(label: 'Dt. Criação', nn: true, auto: true)]
  protected $created_at;

  #[Campo(label: 'Dt. Alteração', nn: true, auto: true)]
  protected $updated_at;

  public function getIdDica()
  {
    return $this->idDica;
  }

  public function getTitulo()
  {
    return $this->titulo;
  }

  public function setTitulo(string $titulo): self
  {
    $titulo = trim($titulo);
    if (!$titulo) {
      throw new Exception('Título inválido');
    }

    $this->titulo = $titulo;
    return $this;
  }

  public function getDescricao()
  {
    return $this->descricao;
  }

  public function setDescricao(string $descricao): self
  {
    $descricao = trim($descricao);
    if (strlen($descricao) < 10) {
      throw new Exception('Descrição inválida para a dica');
    }

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
