<?php
/**
 * DEFINIÇÕES GLOBAIS DO PROJETO
 */
define('FRONTEND_TITLE', 'Bicho Novo: Seu Petshop Animal');
define('BACKTEND_TITLE', 'Bicho Novo');
define('TIMEZONE', 'America/Sao_Paulo');
define('DISPLAY_ERRORS', 1);
define('PATH_PROJETO', __DIR__ . '/../');
define('SALT_SENHA', '123ABC');

/**
 * DEFINIÇÕES DE PATH DE ARQUIVOS
 */
define('URL', 'http://localhost');
define('TEMPLATES', PATH_PROJETO . 'templates/');
define('TFRONTEND', TEMPLATES . 'frontend/');
define('TBACKEND', TEMPLATES . 'backend/');

/**
 * DEFIIÇÕES DO BANCO DE DADOS
 */
define('DB_HOST',     'localhost');
define('DB_SCHEMA',   'ps_sr006546');
define('DB_USER',     'root');
define('DB_PASSWORD', '');

/**
 * DEFINIÇÕES DE ENVIO DE EMAIL
 */
define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT', 587);
define('MAIL_NAME', 'Bicho Novo Petshop');
define('MAIL_USER', 'sr006546@cfjl.com.br');
define('MAIL_PASSWORD', '');
define('MAIL_CONTACTNAME', 'Samuel Atendedor');
define('MAIL_CONTACTMAIL', 'sr006546@cfjl.com.br');