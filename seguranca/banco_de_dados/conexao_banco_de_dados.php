<?php /*Arquivo para conexão para o banco de dados */
  include "configuracoes_banco_de_dados.php";
    try{
      $conexaobd = new PDO("mysql:host=".$servidor.";dbname=".$banco.";charset=".$charset, $usuario, $senha); //Mostra os respectivos dados do configuration db
    } catch (PDOexception $e){ /* Serve para pegar os arquivos do banco de dados */
          die ("Erro ao conectar com o banco de dados: ".$e->getMessage()); /*Serve para diminuir a quantidade de informações para o usuário, ajudando o prorgamador a identificar o erro contido.*/
    }
     ?>
