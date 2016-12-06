//função para se fazer o select do produto.
function mostraProdutosEnt(){
  //recebe o valor da campo que esta com o id marca
  var marca = document.getElementById('marca').value;
  //recebe o valor da campo que está com o id categoria
  var categoria = document.getElementById('categoria').value;
  //este 'se' serve para ver se o valor de marca e categoria não estão vazios caso estejam ele não será executado.
  if((marca!="") && (categoria!="")){
    //envia os dados por método post as variáveis para a página de busca dinâmica e retorna o valor.
    $.post('../adicionais/php/buscadinamica/novos/buscadinamica_php.php', {mar:marca, cat:categoria}, function(dadosRetornados){
      $('#produto').html(dadosRetornados);
    });
  }
}
//função para se fazer o select do produto.
function mostraProdutosSai(){
  //recebe o valor da campo que esta com o id marca
  var marca = document.getElementById('marca').value;
  //recebe o valor da campo que está com o id categoria
  var categoria = document.getElementById('categoria').value;
  //este 'se' serve para ver se o valor de marca e categoria não estão vazios caso estejam ele não será executado.
  if((marca!="") && (categoria!="")){
    //envia os dados por método post as variáveis para a página de busca dinâmica e retorna o valor.
    $.post('../adicionais/php/buscadinamica/novos/buscadinamica_saida_novos_php.php', {mar:marca, cat:categoria, tipo:1}, function(dadosRetornados){
      $('#produto').html(dadosRetornados);
    });
  }
}
//função para se fazer o select do produto.
function mostraProdutosSaiLote(){
  //recebe o valor da campo que esta com o id marca
  var produto = document.getElementById('produto').value;

  if(produto!=""){
    //envia os dados por método post as variáveis para a página de busca dinâmica e retorna o valor.
    $.post('../adicionais/php/buscadinamica/novos/buscadinamica_saida_novos_php.php', {pro:produto, tipo:2}, function(dadosRetornados){
      $('#lote').html(dadosRetornados);
    });
  }
}

function mostraProdutosSaiVenda(){

  var produto = document.getElementById('produto').value;

  var lote = document.getElementById('lote').value;

  if((produto!="") && (lote!="")){

    $.post('../adicionais/php/buscadinamica/novos/buscadinamica_said_valor_venda_php.php', {pro:produto, id:lote}, function(dadosRetornados){
      $('#vVenda').val(dadosRetornados);
      $('#vValor').val(dadosRetornados);
    });
  }
}
