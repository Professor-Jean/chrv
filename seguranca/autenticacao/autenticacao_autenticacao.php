<!DOCTYPE html>
<html>
  <head>
    <title>BobSom Musical Center(index)</title>
    <meta name="author" content="CHRV"/>
		<meta name="description" content=" Web Software para controle de estoque da empresa BobSom Musical Center"/>
		<meta name="keywords" content="Controle, Estoque, BobSom, Musical, Center"/>
		<meta charset="utf-8"/>
    <link href="../../leiaute/css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="../../leiaute/css/reset_css.css" rel="stylesheet" type="text/css" />
    <link href="../../leiaute/css/frente_css.css" rel="stylesheet" type="text/css" />
  </head>
<?php
   include '../banco_de_dados/conexao_banco_de_dados.php';
   include '../../adicionais/php/repositorio_de_mensagens_php.php';
   //Cadastrando dados no formulário de login
   $p_usuario = $_POST['txtusuario'];
   $p_senha = $_POST['pwdsenha'];
   $hash_senha = md5($salt.$p_senha);

   //Validação dos dados do formulário do login
   if ($p_usuario=="") {
     $msg  = msgGeral('4', '', 'usuario');
   }else if ($hash_senha=="") {
     $msg  = msgGeral('4', '', 'senha');
        }else{
         $sql_sel_usuarios = "SELECT * FROM usuarios WHERE usuario='".$p_usuario."' AND senha='".$hash_senha."'";

         $sql_sel_usuarios_preparado = $conexaobd->prepare($sql_sel_usuarios);

         $sql_sel_usuarios_preparado->execute();

       if($sql_sel_usuarios_preparado->rowCount()==1){
         $sql_sel_usuarios_dados = $sql_sel_usuarios_preparado->fetch();
         session_start();

         $_SESSION['idUsuario'] = $sql_sel_usuarios_dados['id'];
         $_SESSION['usuario'] = $sql_sel_usuarios_dados['usuario'];
         $_SESSION['idSessao'] = session_id();

         if ($sql_sel_usuarios_dados){
           header('Location: ../../admin/principal_admin.php');
         }else {
           $msg = msgGeral('6', '', 'Dados de Autenticação');
         }

       }else{
         $msg = msgGeral('6', '', 'Dados de Autenticação');
       }
      }
      ?>
    <body class="login_backgound">
      <div class="login_div"><!-- div geral-->
        <fieldset class="login_box">
          <p style=" margin-bottom: 10%;" class="login_texto"> <?php echo $msg ?></p>
          <h1 align="center" style="font-size: 35px;"><a href="../../index.html" style=" text-decoration: none; color: #000;"><i class="fa fa-reply" aria-hidden="true"></i>Voltar</a></h1>
        </fieldset>
      </div><!-- fim da div geral-->
    </body>
    <footer class="rodape">
      <div>
        <h3>BobSom, CNPJ</h3>
      </div>
    </footer>
</html>
