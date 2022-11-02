<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Login.php';

$database = new Database();
$db = $database->getConnection();
 
$items = new Login($db);

$items->usuario = (isset($_POST['usuario']) && $_POST['usuario']) ? $_POST['usuario'] : 'x';
$items->contrasena = (isset($_POST['contrasena']) && $_POST['contrasena']) ? $_POST['contrasena'] : 'x';

$result = $items->auth();

if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["items"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "usuario_id" => $usuario_id,
            "nombre" => $nombre,	
            "usuario" => $usuario
        ); 
       array_push($itemRecords["items"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "Incomplete user data: " . $items->usuario)
    );
} 