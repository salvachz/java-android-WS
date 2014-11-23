<?php

require('includes/connect.php');
require('includes/utils.php');

$user= $_REQUEST['user'];
$passwd = $_REQUEST['passwd'];

$qry = "SELECT cliId from Cliente WHERE cliName = '$user' AND cliPasswd = '$passwd'";
$result = mysql_result(mysql_query($qry), 0, 0);


if(!$result)
    do_output(false,'Login/Senha incorretos!');
else
    do_output(true,Array('user' => $result));
