<?php

use Petshop\Model\Arquivo;
use Petshop\Model\Avaliacao;
use Petshop\Model\Carrinho;
use Petshop\Model\CarrinhoProduto;
use Petshop\Model\Categoria;
use Petshop\Model\Cidade;
use Petshop\Model\Cliente;
use Petshop\Model\Comentario;
use Petshop\Model\Compra;
use Petshop\Model\Desconto;
use Petshop\Model\Dica;
use Petshop\Model\Empresa;
use Petshop\Model\Estado;
use Petshop\Model\Favorito;
use Petshop\Model\Fornecedor;
use Petshop\Model\Marca;
use Petshop\Model\Produto;
use Petshop\Model\ProdutoCategoria;
use Petshop\Model\ProdutoCompra;
use Petshop\Model\Usuario;
use Petshop\Model\Venda;

require_once __DIR__ . '/../vendor/autoload.php';

$teste = new Venda();
var_dump($teste->find());