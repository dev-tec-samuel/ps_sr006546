<div class="container my-5">

  <div class="row w-75 mx-auto">
    <div class="col-12 text-center mt-1 mb-3">
      <h1><?= $categoria['nome'] ?></h1>
    </div>
    <div class="col-2">
      <img src="<?= $categoria['imagens'][0]['url']?>" alt="<?= $categoria['nome']?>" class="img-fluid">
    </div>
    <div class="col-10">
      <?= $categoria['descricao']?>
    </div>
  </div>

  <hr class="my-5">

  <div class="row row-cols-5">
    <?php
      foreach($produtos as $p) {
        $primeiraImg = $p['imagens'][0]['url'] ?? 'https://picsum.photos/300';
        $preco = number_format($p['preco'], 2, ',','.');
        $nome = strlen($p['nome']) < 50 ? $p['nome'] : substr($p['nome'], 0, 50) . '...';
        $link = '/produtos/' . $p['idproduto'];
        echo <<<HTML
            <div class="col produto position-relative mb-3">
              <img src="{$primeiraImg}" alt="{$p['nome']}" class="img-fluid">
              <p class="mb-0 mt-2">{$nome}</p>
              <a href="{$link}" class="btn btn-success btn-sm w-100 stretched-link">R$ {$preco}</a>
            </div>
        HTML;
      }
    ?>
  </div>
</div>