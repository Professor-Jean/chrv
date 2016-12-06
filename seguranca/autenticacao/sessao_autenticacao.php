<?php
  session_start();
  if (!isset($_SESSION['idSessao'])) {
    header("Location:".BASE_URL."seguranca/autenticacao/desconexao_autenticacao.php");
    exit;
  }else if ($_SESSION['idSessao']!=session_id()) {
      header("Location:".BASE_URL."seguranca/autenticacao/desconexao_autenticacao.php");
      exit;
}
?>
