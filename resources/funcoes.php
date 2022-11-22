<?php

/**
 * Função que retorna um ALERT da mensagem presa na sessão
 * e elimina o seu conteúdo
 *
 * @return void
 */
function retornaHTMLAlertMenssagemSessao()
{
  if (!isset($_SESSION['mensagem']) || !is_array($_SESSION['mensagem'])) {
    return '';
  }

  $tipo = $_SESSION['mensagem']['tipo'];
  $texto = $_SESSION['mensagem']['texto'];

  $bootstrapAlert = <<<HTML
      <div class="alert alert-{$tipo}" role="alert">
        {$texto}
      </div>
  HTML;

  unset($_SESSION['mensagem']);
  
  return $bootstrapAlert;
}

/**
 * Função que redireciona (via header location) para uma
 * url específica
 *
 * @param string $detino   URL destino
 * @param string $tipoMsg (primary, secondary, success, danger, warning, info, light, dark)
 * @param string $mensagem
 * @return void
 */
function redireciona(string $detino, string $tipoMsg='', string $mensagem='')
{
  if($tipoMsg && $mensagem) {
    $_SESSION['mensagem'] = [
      'tipo'  => $tipoMsg,
      'texto' => $mensagem
    ];
  }
  
  header('location:' . $detino);
  exit;
}
