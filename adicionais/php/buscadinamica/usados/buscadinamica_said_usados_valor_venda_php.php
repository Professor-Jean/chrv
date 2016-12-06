<?php
/*
	Nome:Haran. Dia: 01/11/2016.
	Esta página foi criada no intuito de se fazer uma busca dinâmica sobre produtos.
	Esta página está vinculada a um arquivo ajax que está vinculada as páginas de movimentação de entrade de produtos novos
	e movimentação de entrada de produtos usados.
	A página do ajax envia os dados do id da marca e o id da categoria para esta página fazer a pesquisa do produto.
	Com base nestes dados esta página faz o select dos dados e o envia para a página com o formulário com um escolha.
*/
	include "../../../../seguranca/banco_de_dados/conexao_banco_de_dados.php";

	$pro=$_POST['pro'];
	$id=$_POST['id'];

	$sql_sel_entradas="SELECT valor_venda FROM entradas WHERE produtos_id='".$pro."' AND id='".$id."' AND tipo='PU' AND esgotada='0'";
	$sql_sel_entradas_preparado = $conexaobd->prepare($sql_sel_entradas);
	$sql_sel_entradas_preparado->execute();
	$sql_sel_entradas_dados=$sql_sel_entradas_preparado->fetch();
	echo $sql_sel_entradas_dados['valor_venda'];
?>
