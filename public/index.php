<?php

use PetShop\Model\Dica;

require_once __DIR__ . '/../vendor/autoload.php';



$dica = new Dica();
//$dica->find( ['campo2 like'=>'%nov%']);
var_dump($dica->find(['titulo like'=>'Dica0%']));
