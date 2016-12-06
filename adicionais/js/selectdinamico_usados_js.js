//função para se fazer o select do produto.
function mostraProdutosSaiUsados(){
  //recebe o valor da campo que esta com o id marca
  var marca = document.getElementById('marca').value;
  //recebe o valor da campo que está com o id categoria
  var categoria = document.getElementById('categoria').value;
  //este 'se' serve para ver se o valor de marca e categoria não estão vazios caso estejam ele não será executado.
  if((marca!="") && (categoria!="")){
    //envia os dados por método post as variáveis para a página de busca dinâmica e retorna o valor.
    $.post('../adicionais/php/buscadinamica/usados/buscadinamica_saida_usados_php.php', {mar:marca, cat:categoria, tipo:1}, function(dadosRetornados){
      $('#produto').html(dadosRetornados);
    });
  }
}
//função para se fazer o select do produto.
function mostraProdutosSaiLoteUsados(){
  //recebe o valor da campo que esta com o id marca
  var produto = document.getElementById('produto').value;

  if(produto!=""){
    //envia os dados por método post as variáveis para a página de busca dinâmica e retorna o valor.
    $.post('../adicionais/php/buscadinamica/usados/buscadinamica_saida_usados_php.php', {pro:produto, tipo:2}, function(dadosRetornados){
      $('#lote').html(dadosRetornados);
    });
  }
}

function mostraProdutosSaiVendaUsados(){

  var produto = document.getElementById('produto').value;

  var lote = document.getElementById('lote').value;

  if((produto!="") && (lote!="")){

    $.post('../adicionais/php/buscadinamica/usados/buscadinamica_said_usados_valor_venda_php.php', {pro:produto, id:lote}, function(dadosRetornados){
      $('#vVenda').val(dadosRetornados);
      $('#vValor').val(dadosRetornados);
    });
  }
}
