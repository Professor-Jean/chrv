<?php

  include_once("../extensoes/mpdf/mpdf.php");

  $pdfheader = '
  <table style="border: 1px solid #000; width: 100%">
    <tr>
      <td width="30%"><img width="150px" height="100px" src="../../leiaute/imagens/logo.png"></td>
      <td width="70%" align="center"  style="padding-left: 38%;"><b>BOBSOM MUSICAL CENTER</b><br>Brasil, Joinville, Iririú <br> Rua: Papa João XXIII, nº 1260, Sala 1</td>
    </tr>
  </table>
  ';

  $pdffooter = '
  <table style="width: 100%">
    <tr>
      <td width="33%">{DATE j/m/Y}</td>
      <td width="33%" align="center">{PAGENO}/{nbpg}</td>
      <td width="33%" align="right">BOBSOM MUSICAL CENTER</td>
    </tr>
  </table>
  ';

  $pdfbody = "<div id='conteudo' class='conteudo'>";

  $pdfbody .= $_POST['dadospdf'];

  $pdfbody .= '</div>';

  $mpdf = new  mPDF('c', 'A4-L', '', '', 20, 15, 48, 25, 10, 10);

  $mpdf->showImageErrors=true;

  $mpdf->SetHTMLHeader($pdfheader);

  $mpdf->SetHTMLFooter($pdffooter);

  $stylesheet = file_get_contents('../../leiaute/css/mpdf_css.css');

  $mpdf->WriteHTML($stylesheet,1);

  $mpdf->WriteHTML($pdfbody,2);

  $mpdf->output();

?>
