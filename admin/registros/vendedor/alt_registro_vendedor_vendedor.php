<div>
  <h1 class="titulo_corpo" Align="center">Aviso</h1>
    <div class="mensagem_aviso">
    <?php
      $p_id         = $_POST['hidid'];
      $p_nome       = $_POST['txtnome'];
      $p_logradouro = $_POST['txtlogradouro'];
      $p_numero     = $_POST['txtnum'];
      $p_bairro     = $_POST['txtbairro'];
      $p_cep        = $_POST['txtcep'];
      $p_telefone   = $_POST['txttel'];
      $p_email      = $_POST['txtemail'];

      $msg_aviso = "Erro";
      $cor       = "erro";
      $destino   = "?folder=registros/vendedor/&file=falt_registro_vendedor_vendedor&ext=php&id=".$p_id;

      if($p_nome=="") {
        $msg = msgGeral('4','','nome');
      }elseif ($p_logradouro=="") {
        $msg = msgGeral('4','','logradouro');
        }elseif ($p_numero=="") {
          $msg = msgGeral('4','','número');
          }elseif ($p_bairro=="") {
            $msg = msgGeral('4','','bairro');
            }elseif ($p_cep=="") {
              $msg = msgGeral('4','','cep');
              }elseif ($p_telefone=="") {
                $msg = msgGeral('4','','telefone');
                }elseif ($p_email=="") {
                  $msg = msgGeral('4','','email');
                }else {

                  $sql_sel_vendedor = "SELECT * FROM vendedores WHERE nome='".$p_nome."' AND id<>'".$p_id."'"; //Esse SELECT serve para não deixar registrar um vendedor novo quando o nome for igual ao de outro registrado.

                  $sql_sel_vendedor_preparado = selecionar($sql_sel_vendedor);

                  if ($sql_sel_vendedor_preparado->rowCount()==0) {

                    $tabela = "vendedores";

                    $dados = array(
                      'nome'       => $p_nome,
                      'email'      => $p_email,
                      'telefone'   => $p_telefone,
                      'cep'        => $p_cep,
                      'logradouro' => $p_logradouro,
                      'numero'     => $p_numero,
                      'bairro'     => $p_bairro
                    );

                    $condicao = "id = '".$p_id."'";

                    $sql_alt_vendedor_resultado = alterar($tabela, $dados, $condicao);

                    if ($sql_alt_vendedor_resultado) {
                      $msg_aviso = "Confirmação";
                      $msg       = msgGeral('5', 'Alteração', 'vendedor');
                      $cor       = "confirmacao";
                      $destino   = "?folder=registros/vendedor/&file=registro_vendedor_vendedor&ext=php";
                    }else {
                      $msg = msgGeral('2', 'alteração', 'vendedor');
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

     ?>
