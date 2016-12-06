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

	$tipo=$_POST['tipo'];
	if($tipo=='1'){
		$cat=$_POST['cat'];
		$mar=$_POST['mar'];

		$sql_sel_entradas="SELECT entradas.id, entradas.produtos_id, produtos.nome FROM entradas INNER JOIN produtos ON entradas.produtos_id=produtos.id WHERE categorias_id='".$cat."' AND marcas_id='".$mar."' AND entradas.tipo='PN' AND entradas.esgotada='0' GROUP BY entradas.produtos_id ASC";
		$sql_sel_entradas_preparado = $conexaobd->prepare($sql_sel_entradas);
		$sql_sel_entradas_preparado->execute();
		echo "<option value=''>Escolha...</option>";
		while($sql_sel_entradas_dados=$sql_sel_entradas_preparado->fetch()){
			echo "<option value=".$sql_sel_entradas_dados['produtos_id'].">".$sql_sel_entradas_dados['nome']."</option>";
		}
		}else if($tipo=='2'){
			$pro=$_POST['pro'];

			$sql_sel_entradas="SELECT id, produtos_id, tipo, valor_venda, data FROM entradas WHERE produtos_id='".$pro."' AND tipo='PN' AND esgotada='0'";
			$sql_sel_entradas_preparado = $conexaobd->prepare($sql_sel_entradas);
			$sql_sel_entradas_preparado->execute();
			echo "<option value=''>Escolha...</option>";
			while($sql_sel_entradas_dados=$sql_sel_entradas_preparado->fetch()){

				echo "<option value=".$sql_sel_entradas_dados['id'].">".$sql_sel_entradas_dados['id']."</option>";
			}
		}
?>
