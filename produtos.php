<?php

require('includes/connect.php');
require('includes/utils.php');

$list = Array();

$qry = "SELECT proId, proName, proValue FROM Produto";
$qry = mysql_query($qry);
while($row = mysql_fetch_assoc($qry)){
    $row['imgResource'] = 'http://salvachz.com.br/restaurante/img/'.$row['proId'].'.jpg';
    $list[] = $row;
}


if(!$list)
    do_output(false,'Nenhum produto encontrado "/');
else
    do_output(true,$list);
