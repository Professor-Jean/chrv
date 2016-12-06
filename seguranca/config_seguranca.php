<?php
  $server_name = $_SERVER['SERVER_NAME'];
  $project_name = "chrv1";

  define("BASE_URL", "http://".$server_name."/".$project_name."/");

  include "autenticacao/sessao_autenticacao.php";
?>
