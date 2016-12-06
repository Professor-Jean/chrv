<div>
  <h1 class="titulo_corpo" align="center"> Aviso </h1>
    <div class="mensagem_aviso">
      <?php

        //Recebendo dados do formulário
        $p_usuario = $_POST['txtusuario'];
  			$p_senha   = $_POST['pwdsenha'];
  			$hash_senha = md5($salt.$p_senha);
        $msg_aviso = "Erro";
        $cor       = "erro";

        $msg_aviso = "Erro";
        $cor       = "erro";

        //Verificando se os dados estão preenchidos
  			if($p_usuario==""){
  				$msg  = msgGeral('4', '', 'usuário');
  			}else if($p_senha==""){
  				$msg = msgGeral('4', '', 'senha');
              }else {

                $sql_sel_usuario = "SELECT * FROM usuarios WHERE usuario='".$p_usuario."'";

					      $sql_sel_usuario_preparado = selecionar($sql_sel_usuario);

                if ($sql_sel_usuario_preparado->rowCount()==0) {

                  $tabela = "usuarios";

                  $dados = array(
                    'usuario' => $p_usuario,
    								'senha' => $hash_senha,
                  );

                  $sql_ins_usuario_resultado = adicionar($tabela, $dados);

                  if ($sql_ins_usuario_resultado) {
                    $msg_aviso = "Confirmação";
                    $msg       = msgGeral('1', 'efetuado', 'usuario');
                    $cor       = "confirmacao";
                  }else {
                    $msg = msgGeral('2', 'registro', 'usuario');
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
          <a class="icone" href="?folder=registros/usuario/&file=registro_usuario_usuario&ext=php"><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a>
        </div>
    </div>
