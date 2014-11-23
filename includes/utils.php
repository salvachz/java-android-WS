<?php
function do_output($status, $params){
    header('Content-Type: application/json');
    $output = Array();
    $output['status'] = $status;
    if(!$status){
        http_response_code(404);
        $output['reason'] = $params;
   }
    else
        $output = array_merge($params, $output);
    echo json_encode($output);
    exit;
}

function get_pedido_id($user){
    $qry_pedido = "SELECT pedId FROM Pedido WHERE pedStatus = 'aberto' AND pedCliId = '$user'";
    $ped_id = mysql_result(mysql_query($qry_pedido), 0, 0);
    if(!$ped_id){
        $insert_pedido = "INSERT INTO Pedido (pedCliId) VALUES ($user)";
        mysql_query($insert_pedido);
        $ped_id = mysql_insert_id();
    }
    return $ped_id;
}

function get_produtos_by_pedido($pedido_id){
    $list = Array();
    $qry = "SELECT ppeProId product ,ppeCount count FROM ProdutoPedido WHERE ppePedId = $pedido_id";
    $qry = mysql_query($qry);
    while($row = mysql_fetch_assoc($qry))
        $list[] = $row;
    return $list;
}

function add_product_to_pedido($pedido_id,$product, $count){
    $qry = "INSERT INTO ProdutoPedido (ppePedId, ppeProId, ppeCount) VALUES ($pedido_id, $product, $count) ON DUPLICATE KEY UPDATE ppeCount = ppeCount + $count";
    mysql_query($qry);
    if(mysql_error())
        return false;
    return true;
}
