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
	$cat=$_POST['cat'];
	$mar=$_POST['mar'];
		if ($cat==""){
			echo "<option value=''>Escolha a Categoria</option>";
		}else if($mar==""){
				echo "<option value=''>Escolha a Marca</option>";
			}else{
				$sql_sel_produtos="SELECT * FROM produtos WHERE categorias_id='".$cat."' AND marcas_id='".$mar."'";
				$sql_sel_preparado = $conexaobd->prepare($sql_sel_produtos);
				$sql_sel_preparado->execute();
				echo "<option value=''>Escolha...</option>";
				while($sql_sel_produtos_dados=$sql_sel_preparado->fetch()){
					echo "<option value=".$sql_sel_produtos_dados['id'].">".$sql_sel_produtos_dados['nome']."</option>";
				}
			}
?>
