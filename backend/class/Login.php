<?php
class Login{   
    
    private $itemsTable = "usuarios";      
    public $usuario;
    public $contrasena;
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function auth(){	
        $stmt = $this->conn->prepare("SELECT * FROM ".$this->itemsTable." WHERE usuario = ?");
        $stmt->bind_param("s", $this->usuario);			
		$stmt->execute();			
		$result = $stmt->get_result();

        $item = $result->fetch_assoc();
        extract($item); 

        // return $result;
        if($contrasena == md5($this->contrasena)){
            $itemDetails=array(
                "usuario_id" => $usuario_id,
                "nombre" => $nombre,	
                "usuario" => $usuario
            ); 	
		    return $itemDetails;	
        }
        else{
            $itemDetails=array(
                "usuario_id" => 0,
            ); 
            return $itemDetails;
        }
	}
}
?>