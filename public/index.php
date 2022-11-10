<?php

use PetShop\Model\Dica;

require_once __DIR__ . '/../vendor/autoload.php';

$dica = new Dica();
$dica->loadById(2);
//$dica->titulo = 'Dica Atualizada';
$dica->descricao = 'NOVA DESCRIÇÃO';
$dica->save();
