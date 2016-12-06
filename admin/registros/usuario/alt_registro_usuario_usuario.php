<div>
  <h1 class="titulo_corpo" align="center"> Aviso </h1>
    <div class="mensagem_aviso">
      <?php

        $p_id = $_POST['hidid'];
        $p_usuario = $_POST['txtusuario'];
  			$p_senha = $_POST['pwdsenha'];
  			$hash_senha = md5($salt.$p_senha);
        $msg_aviso = "Erro";
        $cor = "erro";
        $destino = "?folder=registros/usuario/&file=falt_registro_usuario_usuario&ext=php&id=".$p_id;


        if($p_usuario==""){
  			    $cor = "erro";
  			    $aviso = "Erro";
  			    $msg = msgGeral('4','','usuário');
  			  }else if($p_senha==""){
  			      $cor = "erro";
  			      $aviso = "Erro";
  			      $msg = msgGeral('4','','senha');
  			        }else{

                  $sql_sel_usuario = "SELECT * FROM usuarios WHERE usuario='".$p_usuario."' and id<>'".$p_id."'";

                  $sql_sel_usuario_preparado = selecionar($sql_sel_usuario);

  			          if($sql_sel_usuario_preparado->rowCount()==0){

  									$tabela = "usuarios";

  		 						 $dados = array(
  		 							 	'usuario' => $p_usuario,
  		 								'senha' => $hash_senha,
  		 						 );

  								 $condicao = "id='".$p_id."'";

  		 						 $sql_alt_usuario_resultado = alterar($tabela, $dados, $condicao);

                  if ($sql_alt_usuario_resultado) {
                    $msg_aviso = "Confirmação";
                    $msg       = msgGeral('5', 'Alteração', 'usuário');
                    $cor       = "confirmacao";
                    $destino   = "?folder=registros/usuario/&file=registro_usuario_usuario&ext=php";
                  }else {
                    $msg = msgGeral('2', 'alteração', 'usuário');
                  }
                }else {
                  $msg = msgGeral('8','','');
                }
              }
      ?>
      <!--class erro e sucesso -->
          <h3 class="<?php echo $cor ?>" ><?php echo $msg_aviso ?></h3>
          <p><?php echo $msg ?></p>
          <hr/ class="limpa_float">
          <a class="icone" href="<?php echo $destino ?>"><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a>
        </div>
    </div>
