<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../class/Articulos.php'; 
 
$database = new Database();
$db = $database->getConnection();
 
$items = new Articulos($db);
 
$data = json_decode(file_get_contents("php://input"));


if(!empty($data->articulo_id) && 
   !empty($data->nombre)&&
   !empty($data->descripcion)&&
   !empty($data->categoria_id)){ 
	
	$items->articulo_id = $data->articulo_id; 
	$items->nombre = $data->nombre;
    $items->descripcion = $data->descripcion;
    $items->categoria_id = $data->categoria_id;	
    
	
	// Ejecucion del metodo update de la instancia categorias
	if($items->update()){     
		http_response_code(200);   
		echo json_encode(array("message" => "Item was updated."));
	}else{    
		http_response_code(503);     
		echo json_encode(array("message" => "Unable to update items."));
	}
	
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Unable to update items. Data is incomplete."));
}
?>