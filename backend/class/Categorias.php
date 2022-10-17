<?php
class Categorias{   
    
    private $itemsTable = "categorias";      
    public $categoria_id;
    public $nombre;
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function read(){	
		if($this->categoria_id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->itemsTable." WHERE categoria_id = ?");
			$stmt->bind_param("i", $this->categoria_id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->itemsTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	function create(){
		
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->itemsTable."(`nombre`)
			VALUES(?)");
		
		$this->nombre = htmlspecialchars(strip_tags($this->nombre));
		
		$stmt->bind_param("s", $this->nombre);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	function update(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->itemsTable." 
			SET nombre= ? 
			WHERE categoria_id = ?");
	 
		$this->categoria_id = htmlspecialchars(strip_tags($this->categoria_id));
		$this->nombre = htmlspecialchars(strip_tags($this->nombre));
	 
		$stmt->bind_param("si", $this->nombre, $this->categoria_id);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	function delete(){
		
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->itemsTable." 
			WHERE categoria_id = ?");
			
		$this->categoria_id = htmlspecialchars(strip_tags($this->categoria_id));
	 
		$stmt->bind_param("i", $this->categoria_id);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
}
?>