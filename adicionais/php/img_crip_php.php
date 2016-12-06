<?php
/**
 * Created by PhpStorm.
 * Usuario: CHRV
 * Data: 19/10/2016
 * hora: 23:06
 */

function criptografiaNomeImg($file){

    $pathinfo = pathinfo($file);

    $nomearquivo = MD5($pathinfo['filename'].time());

    $basenome = $nomearquivo.'.'.$pathinfo['extension'];

    return $basenome;

}
?>
