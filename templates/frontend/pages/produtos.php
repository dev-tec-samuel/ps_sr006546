<?php
$produto['desconto'] ??= 0.15;
$produto['precodesconto'] = $produto['preco'] * (1 - $produto['desconto']);
?>
<div class="container mt-3">
  <div class="row">

    <div class="col-12 row p-3">
      <div class="col-6">
        <img src="<?= $imagens[0]['url'] ?>" alt="<?= $produto['nome'] ?>" class="w-100 h-100">
      </div>
      <div class="col-6">
        <div class="ms-auto bg-light rounded p-3">
          <div class="titulo-produto fs-3 text-justify">
            <?= $produto['nome'] ?>
          </div>

          <div class="info-porduto d-flex inline-block align-items-center">
            <div class="estrelas">
              <img alt="1" src="https://www.petz.com.br/novaLoja/images/star-fill.svg" title="Péssimo">
              <img alt="2" src="https://www.petz.com.br/novaLoja/images/star-fill.svg" title="Ruim">
              <img alt="3" src="https://www.petz.com.br/novaLoja/images/star-fill.svg" title="Médio">
              <img alt="4" src="https://www.petz.com.br/novaLoja/images/star-fill.svg" title="Bom">
              <img alt="5" src="https://www.petz.com.br/novaLoja/images/star-half.svg" title="Ótimo">
            </div>

            <div class="fs-5 m-2">
              <span> (203 avaliações) </span>
              <span> | </span>
              <span style="color:#3ba73d; font-weight:bold;"> Em estoque</span>
            </div>
          </div>

          <hr>

          <div class="valor-produto d-flex">
            <span class="fs-1 fw-bold" style="color: #ff4500;">
              R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
            </span>
            <a href="#" 
              class="curtir-produto icon-circle fs-4 text-danger p-2 ms-auto" 
              data-idproduto="<?=$produto['idproduto']?>" 
              title="Favoritar este produto">
              <script src="https://cdn.lordicon.com/fudrjiwc.js"></script>
              <lord-icon class="icone-coracao" src="https://cdn.lordicon.com/<?= ($produto['ativo']=='S') ? 'xryjrepg' : 'pnhskdva'?>.json" trigger="hover" colors="primary:#c71f16" style="width:40px;height:40px">
              </lord-icon>
            </a>
          </div>

          <?php
          if ($produto['precodesconto'] > 80) :
          ?>
            <div class="info-pagamento text-muted">
              <i class="bi bi-credit-card"></i>
              no cartão em até 8x de R$
              <?= number_format($produto['precodesconto'] / 8, 2, ',', '.') ?> <br>
              (sem juros)
            </div>
          <?php
          endif;
          ?>

          <div class="info-desconto my-3 p-2 border border-1 rounded" style="background-color: #e9e9e9;">
            <div class="d-flex align-items-center">
              <div>
                <span class="fs-5 fw-bold" style="color: #ff4500;">
                  R$ <?= number_format($produto['precodesconto'], 2, ',', '.') ?>
                  <span class="ms-2 badge rounded-pill text-bg-success">
                    <?= $produto['desconto'] * 100 ?>% off
                  </span>
                </span>
              </div>
              <span class="ms-2 fw-semibold">
                para assinantes...
              </span>
            </div>
            <div class="vantagens-assinatura mt-2">
              <ul>
                <li>
                  <span>É gratuito: assine e cancele sem custo</span>
                </li>
                <li>
                  <span>10% OFF em todo site, app e nos produtos assinados</span>
                </li>
                <li>
                  <span>Selecione criar assinatura na tela de pagamento</span>
                </li>
              </ul>
            </div>
          </div>

          <div class="rodape-info mt-4 row d-flex align-items-center">

            <div class="ngcQtde col-3">
              <button class="btnQtde">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14.5">
                  <path fill="#007dc5" d="M400 288h-352c-17.69 0-32-14.32-32-32.01s14.31-31.99 32-31.99h352c17.69 0 32 14.3 32 31.99S417.7 288 400 288z"></path>
                </svg>
              </button>
              <input value="1" id="qtde" class="qtde" type="text">
              <button class="btnQtde">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14.5">
                  <path fill="#007dc5" d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z"></path>
                </svg>
              </button>
            </div>
            <div class="btn-add_carrinho col-8">
              <a href="/carrinho/<?= $produto['idproduto'] ?>/add" class="btn btn-success w-100" style="font-size:18px;">
                <i class="bi bi-cart2 me-2"></i>Adicionar ao carrinho
              </a>
            </div>
          </div>

        </div>

      </div>

    </div>

  </div>

  <div class="row-mt-5">
    <hr>
    <h4 class="fw-bold mb-4">Descrição</h4>
    <p><?= str_replace("\n", '<br>', $produto['descricao']) ?></p>
  </div>

  <!--Tebla(striped) com as informações relativas ao produto  -->
  <div class="row mt-3">
    <hr>
    <h4 class="fw-bold mb-4">Especificações</h4>
    <table class="table table-striped">
      <tbody>
        <?php
        $items = explode("\n", $produto['especificacoes']);

        $titulosGolden = [
          'Idade',
          'Linha',
          'Pet',
          'Porte de Raça',
          'Tipo',
          'Sabor',
          'Indicação',
          'Apresentação',
          'Composição'
        ];

        for ($i = 0; $i < count($items); $i++) {
          echo '<tr><th>' . $titulosGolden[$i] . '</th><td>' . $items[$i] . '</td></tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</div>