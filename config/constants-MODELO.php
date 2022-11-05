<?php
/**
 * DEFINIÇÕES GLOBAIS DO PROJETO
 */
define('FRONTEND_TITLE', 'Bicho Novo: Seu Petshop Animal');
define('BACKTEND_TITLE', 'Bicho Novo');
define('TIMEZONE', 'America/Sao_Paulo');
define('DISPLAY_ERRORS', 1);
define('PATH_PROJETO', __DIR__ . '/../');

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
define('MAIL_HOST', 'smtp.gamil.com');
define('MAIL_PORT', 587);
define('MAIL_NAME', 'Bicho Novo Petshop');
define('MAIL_USER', '');
define('MAIL_PASSWORD', '');