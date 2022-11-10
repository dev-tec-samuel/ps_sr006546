<?php

use Petshop\Model\Cidade;

require_once __DIR__ . '/../vendor/autoload.php';

$cidade = new Cidade();
var_dump($cidade->find(['municipio like'=>'%horizon%']);