<?php

use PetShop\Model\Arquivo;
use PetShop\Model\Avaliacao;
use PetShop\Model\Carrinho;
use PetShop\Model\CarrinhoProduto;
use PetShop\Model\Categoria;
use PetShop\Model\Cidade;
use PetShop\Model\Cliente;
use PetShop\Model\Comentario;
use PetShop\Model\Compra;
use PetShop\Model\Desconto;
use PetShop\Model\Dica;
use PetShop\Model\Empresa;
use PetShop\Model\Estado;
use PetShop\Model\Favorito;
use PetShop\Model\Fornecedor;
use PetShop\Model\Marca;
use PetShop\Model\Produto;
use PetShop\Model\ProdutoCategoria;
use PetShop\Model\ProdutoCompra;
use PetShop\Model\Usuario;
use PetShop\Model\Venda;

require_once __DIR__ . '/../vendor/autoload.php';

$teste = new Venda();
var_dump($teste->find());