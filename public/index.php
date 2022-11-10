<?php

use Petshop\Model\Cidade;
use Petshop\Model\Estado;

require_once __DIR__ . '/../vendor/autoload.php';

$cidade = new Estado();
var_dump($cidade->find());