<div class="container my-5">
  <h1 class="text-center my-2">FAVORITOS</h1>
  <hr>
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