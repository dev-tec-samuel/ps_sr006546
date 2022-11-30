<?php $link = URL . $_SERVER['REQUEST_URI'] ?>

<div class="container text-center" style="margin: 8em auto">
  <h1 class="display-4"> <div class="icon icon-generic"></div> Página não encontrada</h1>
  <p class="h5 mt-5"> Erro 404: A página "<?= $link ?>" solicitado não existe</p>
  <p class="lead mt-5 mb-3">Faça uma busca no site ou pesquise pelo menu</p>
  <a href="/" class="btn btn-primary btn-lg rounded-pill ">Voltar para casa</a>
</div>