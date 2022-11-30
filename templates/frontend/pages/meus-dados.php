<div class="container my-5 ps-5">
  <div class="row d-flex">
    <div class="icon-perfil d-flex align-items-center mb-3">
      <i class="fa-solid fa-id-card col-2 text-end ps-4" style="transform: scale(3.5);"></i>
      <h1 class="col-7 text-align-left ps-0">Meus dados</h1>
    </div>
    <div class="coluna-nome d-flex align-items-center mb-3">
      <div class="col-2 text-end pe-3"><strong>NOME</strong></div>
      <div class="col-7">
        <span class=" form-control"><?= $cliente['nome']?></span>
      </div>
    </div>
    <div class="coluna-email d-flex align-items-center mb-3">
      <div class="col-2 text-end pe-3"><strong>E-MAIL</strong></div>
      <div class="col-7">
        <span class=" form-control"><?= $cliente['email']?></span>
      </div>
    </div>
    <div class="coluna-documento d-flex align-items-center">
      <div class="col-2 text-end pe-3"><strong>DOCUMENTO</strong></div>
      <div class="col-7">
        <span class=" form-control"><?= $cliente['cpfcnpj']?></span>
      </div>
    </div>
  </div>
</div>