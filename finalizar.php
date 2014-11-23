<?php

require('includes/connect.php');
require('includes/utils.php');

if(!$_REQUEST['user'])
    do_output(false, 'Voce precisa passar o ID do usuario');
$user = $_REQUEST['user'];

if($_POST){
    $payment = $_POST['payment'];
    if(!in_array($payment, Array('dinheiro','debito','credito')))
        do_output(false, 'Methodo de pagamento invalido');
    if(finalizar_pedido(get_pedido_id($user), $payment))
        do_output(true, Array('message' => 'Pedido finalizado com sucesso!'));
    else
        do_output(false,'Occoreu um erro ao finalizar seu pedido');
}
else
    do_output(false,'Voce precisa utilizar o method POST');
