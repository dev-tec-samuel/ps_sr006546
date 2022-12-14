// $('.carrousel').slick({
//   dots: true,
//   slidesToShow: 3,
//   slidesToScroll: 1,
//   autoplay: true,
//   autoplaySpeed: 2000,
// });

// ADD COMPORTAMENTO PARA O BOTÃO CURTIR
document.querySelectorAll('.curtir-produto').forEach(linkCurtir => {
  linkCurtir.addEventListener('click', e => {
    e.preventDefault();
    let dadosPost = new FormData();
    dadosPost.append('acao', 'curtir');
    dadosPost.append('idproduto', linkCurtir.dataset.idproduto);
    ajax('/ajax', dadosPost, function (resposta) {
      if (resposta.status != 'success') {
        Swal.fire({
          icon: resposta.status,
          title: 'Ops...',
          text: resposta.mensagem
        });
        return;
      }
      //se deu tudo certo, executa o código abaixo
      if (resposta.dados.curtiu) {
        linkCurtir.querySelector('.icone-coracao').src = 'https://cdn.lordicon.com/xryjrepg.json';
      } else {
        linkCurtir.querySelector('.icone-coracao').src = 'https://cdn.lordicon.com/pnhskdva.json';
      }
    });
  });
});

// ADD COMPORTAMENTO PARA O BOTÃO COMPRAR
document.querySelectorAll('.comprar-produto').forEach(linkComprar => {
  linkComprar.addEventListener('click', e => {
    e.preventDefault();
    let dadosPost = new FormData();
    dadosPost.append('acao', 'carrinho');
    dadosPost.append('idproduto', linkComprar.dataset.idproduto);
    dadosPost.append('quantidade', linkComprar.dataset.quantidade);
    ajax('/ajax', dadosPost, function (resposta) {
      if (resposta.status != 'success') {
        Swal.fire({
          icon: resposta.status,
          title: 'Ops...',
          text: resposta.mensagem
        });
        return;
      }
      window.location.href = '/carrinho';
    });
  });
});

// ADD COMPORTAMENTO PARA ALTERAR QUANTIDADE PRODUTOS
document.querySelectorAll('.altera-qtd-produto').forEach(link => {
  link.addEventListener('click', e => {
    e.preventDefault();

    let input = document.querySelector('#produto-' + link.dataset.idproduto);
    let totalFinal = parseInt(input.value) + parseInt(link.dataset.incremento);

    let dadosPost = new FormData();
    dadosPost.append('acao', 'carrinho');
    dadosPost.append('idproduto', link.dataset.idproduto);
    dadosPost.append('quantidade', totalFinal);
    ajax('/ajax', dadosPost, function (resposta) {
      if (resposta.status != 'success') {
        Swal.fire({
          icon: resposta.status,
          title: 'Opssss...',
          text: resposta.mensagem,
        });
        return;
      }
      input.value = totalFinal;

      let objTotal = document.querySelector('.valor-total');
      let total = resposta.dados.valortotal;
      objTotal.textContent = 'R$ ' + (new Intl.NumberFormat().format(total));

      if (totalFinal == 0) {
        window.location.href = '/carrinho';
      }

    });
  });
})

function ajax(url, dados, callback) {
  if (!url || !dados || !callback) {
    throw 'Todos os parâmetros devem ser preenchidos ';
  }

  let dadosCallback = {};
  let xhr = new XMLHttpRequest();
  xhr.open('POST', url);
  xhr.onload = function () {
    if (xhr.readyState == 4) {
      if (xhr.status != 200) {
        Swal.fire({
          position: 'top-end',
          icon: 'warning',
          title: 'Falha na comunicação',
          text: 'Ocorreu erro de conexão, por favor tente novamente. Se o erro persisitir contate o suporte.',
          showConfirmButton: false,
          timer: 3000
        });
        return;
      }

      try {
        dadosCallback = JSON.parse(xhr.responseText);
      } catch (e) {
        Swal.fire({
          position: 'top-end',
          icon: 'warning',
          title: 'Falha de processamento',
          text: 'A resposta não pôde ser processada, tente novamente ou entre em contato com o suporte.',
          showConfirmButton: false,
          timer: 3000
        });
        return;
      }

      callback(dadosCallback);
    }
  };

  xhr.onerror = function () {
    Swal.fire({
      position: 'top-end',
      icon: 'error',
      title: 'Falha na comunicação',
      text: 'Ocorreu erro de conexão, por favor tente novamente',
      showConfirmButton: false,
      timer: 3000
    });
  };
  xhr.send(dados);
}