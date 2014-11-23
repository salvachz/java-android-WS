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
}
