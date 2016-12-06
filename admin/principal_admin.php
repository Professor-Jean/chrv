<!DOCTYPE html>
<?php
  include "../seguranca/config_seguranca.php";
  include "../seguranca/banco_de_dados/conexao_banco_de_dados.php";
  include "../adicionais/php/operacoesbd_php.php";
  //include "../adicionais/php/validations_php.php";
  include "../adicionais/php/exclusao_segura_php.php";
  include "../adicionais/php/repositorio_de_mensagens_php.php";
  include "../adicionais/php/img_crip_php.php";
  include "../adicionais/php/calculo_porcentagem_php.php";
  include "../adicionais/php/cal_valor_venda_php.php";
?>
<html>
  <head>
    <title>BobSom Musical Center</title>
    <meta name="author" content="CHRV">
    <meta name="description" content="Web Software para controle de estoque da empresa BobSom Musical Center">
    <meta name="keywords" content="Controle, Estoque, BobSom, Musical, Center">
    <meta charset="utf-8">
    <link href="../leiaute/css/reset_css.css" rel="stylesheet" type="text/css">
    <link href="../leiaute/css/verso_css.css" rel="stylesheet" type="text/css">
    <link href="../leiaute/css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <script src="../adicionais/extensoes/chart.js"></script>
    <script  src="../adicionais/js/jquery_js.js"></script>
    <script  src="../adicionais/js/selectdinamico_js.js"></script>
    <script  src="../adicionais/js/selectdinamico_usados_js.js"></script>
    <script src="../adicionais/js/jquery_js.js"></script>
    <script src="../adicionais/js/auxiliar_js.js"></script>
    <script src="../adicionais/js/confirmar_exclusao_js.js"></script>
  </head>
  <body class="adm_backgound">
    <header>
          <img src="../leiaute/imagens/logo.png" class="logo" />
          <div class="div_titulo">
            <h1>Controle de Estoque</h1>
          </div>
          <div class="div_icones">
            <a href="https://www.facebook.com/Bob-Som-Musical-Center-695593683855299/" class="icone"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
            <a href="https://www.instagram.com/bobsommusicalcenter/" class="icone"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="https://www.youtube.com/" class="icone"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
            <a href="https://plus.google.com/collections/featured" class="icone"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
          </div>
          <nav class="menu"><!-- início menu -->
            <ul>
              <li class="menu_especial"> <span> Registros <i class="fa fa-sort-desc" aria-hidden="true"></i></span>
                <ul>
                  <li class="menu_li"><a href="?folder=registros/usuario/&file=registro_usuario_usuario&ext=php">Registro de Usuário</a></li>
                  <li class="menu_li"><a href="?folder=registros/categoria/&file=registro_categoria_categoria&ext=php">Registro de Categoria</a></li>
                  <li class="menu_li"><a href="?folder=registros/marca/&file=registro_marca_marca&ext=php">Registro de Marca</a></li>
                  <li class="menu_li"><a href="?folder=registros/fornecedor/&file=registro_fornecedor_fornecedor&ext=php">Registro de Fornecedor</a></li>
                  <li class="menu_li"><a href="?folder=registros/produto/&file=registro_produto_produto&ext=php">Registro de Produto</a></li>
                  <li class="menu_li"><a href="?folder=registros/vendedor/&file=registro_vendedor_vendedor&ext=php">Registro de Vendedor</a></li>
                </ul>
              </li>
              <li class="menu_especial"> <span> Movimentações <i class="fa fa-sort-desc" aria-hidden="true"></i></span>
                <ul>
                  <li class="menu_li"><a href="?folder=movimentacoes/entradas/novos/&file=mov_ent_novos_novos&ext=php">Movimentação de Entrada no Estoque de Produtos</a></li>
                  <li class="menu_li"><a href="?folder=movimentacoes/saidas/novos/&file=mov_sai_novos_novos&ext=php">Movimentação de Saída no Estoque de Produtos</a></li>
                </ul>
              </li>
              <li class="menu_especial"> <span> Relatórios <i class="fa fa-sort-desc" aria-hidden="true"></i></span>
                <ul>
                  <li class="menu_li"><a href="?file=inicial_admin&ext=php">Relatório de Estoque</a></li>
                  <li class="menu_li"><a href="?folder=relatorios/movimentacoes/entradas/novos/&file=relatorio_movimentacao_entrada_novos&ext=php">Relatório de Movimentação de Entrada no Estoque de Produtos</a></li>
                  <li class="menu_li"><a href="?folder=relatorios/movimentacoes/saidas/novos/&file=relatorio_movimentacao_saida_novos&ext=php">Relatório de Movimentação de Saída no Estoque de Produtos</a></li>
                  <li class="menu_li"><a href="?folder=relatorios/produtos/&file=relatorio_produtos_produtos&ext=php">Relatório de Produtos</a></li>
                </ul>
              </li>
            </ul>
          </nav><!-- fim menu -->
          <div class="area_usuario"> <!-- início usuário -->
            <a href="?folder=registros/usuario/&file=falt_registro_usuario_usuario&ext=php&id=<?php echo $_SESSION['idUsuario']; ?>" style="text-decoration: none; color: #fff;"><span><?php echo $_SESSION['usuario'] ?></span></a>
            <a href='../seguranca/autenticacao/desconexao_autenticacao.php' class="adm_sair"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
          </div><!-- fim usuário -->
        </header>
          <hr/ class="limpa_float">
          <div class="div_global"><!-- início conteúdo -->
          <?php
            if (isset($_GET['folder']) && isset($_GET['file']) && isset($_GET['ext'])) {
                if (!include $_GET['folder'].$_GET['file'].".".$_GET['ext']) {
                    echo "<h1>Página não encontrada!</h1>";
                }
            }else{
                include "inicial_admin.php";
            }
          ?>
          </div><!-- fim conteúdo -->
  </body>
  <hr/ class="limpa_float">
    <footer class="rodape">
      BobSom, CNPJ
    </footer>
  </html>
