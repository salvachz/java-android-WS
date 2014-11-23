<?php

require('includes/connect.php');
require('includes/utils.php');

if(!$_REQUEST['user'])
    do_output(false, 'Voce precisa passar o ID do usuario');
$user = $_REQUEST['user'];

if($_GET){
    $pedido_id = get_pedido_id($user);
    $list_products = get_produtos_by_pedido($pedido_id);
    do_output(true,Array('products' => $list_products));
}

else if($_POST){
    $count = $_POST['count'];
    $product = $_POST['product'];
    if(!$count)
        do_output(false, 'A quantidade precisa ser passada');
    if(!$product)
        do_output(false, 'O ID do produto precisa ser passado');

    $pedido_id = get_pedido_id($user);
    if(add_product_to_pedido($pedido_id,$product, $count))
        do_output(true,Array('message' => 'Adicionado com sucesso'));
    else
        do_output(false,'Um erro ocoreu ao adicionar o produto');
}
