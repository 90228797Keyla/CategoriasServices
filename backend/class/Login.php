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
		return $result;	
	}
		
	
}
?>