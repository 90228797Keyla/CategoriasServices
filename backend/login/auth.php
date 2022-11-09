<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Login.php';

$database = new Database();
$db = $database->getConnection();
 
$items = new Login($db);

$items->usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : 'x';
$items->contrasena = (isset($_POST['contrasena'])) ? $_POST['contrasena'] : 'x';

$result = $items->auth();

if($result['usuario_id'] > 0){
    $itemRecords=array();
    $itemRecords["items"]=array(); 
    array_push($itemRecords["items"], $result); 
    http_response_code(200); 
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "Invalid user data." )
    );
} 