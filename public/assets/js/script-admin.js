document.querySelectorAll('.table .link-excluir').forEach(link => {
  //para cada link com a classe .link-excluir, add confirmação
  link.addEventListener('click', e => {
    //impedir que o href do link seja acionado
    e.preventDefault();

    Swal.fire({
      title: 'ATENÇÃO! CUIDADO...',
      html: "Tem certeza que deseja remover este registro?<br><br>Você <b>NÃO</b> poderá reverter esta decisão!",
      icon: 'warning', //danger = error
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sim, remova',
      cancelButtonText: 'Cancelar',
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link.href;
      }
    })
  });
});