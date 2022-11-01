<?php
class Articulos{   
    
    private $itemsTable = "articulos";      
    public $articulo_id;
    public $nombre;
    public $descripcion;
    //public categoria_id;
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function read(){	
		if($this->articulo_id) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->itemsTable." WHERE articulo_id = ?");
			$stmt->bind_param("i", $this->articulo_id);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->itemsTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	function create(){
		
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->itemsTable."(`nombre`, `descripcion`, `categoria_id`)
			VALUES(?,?,?)");
		
		$this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->categoria_id = htmlspecialchars(strip_tags($this->categoria_id));
		
		$stmt->bind_param("ssi", $this->nombre, $this->descripcion, $this->categoria_id);
		
		
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	function update(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->itemsTable." 
			SET nombre= ?,
            descripcion= ?,
            categoria_id =? 
			WHERE articulo_id = ?");
	 
			$this->nombre = htmlspecialchars(strip_tags($this->nombre));
			$this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
			$this->categoria_id = htmlspecialchars(strip_tags($this->categoria_id));
			$this->articulo_id = htmlspecialchars(strip_tags($this->articulo_id));
	 
		$stmt->bind_param("ssii", $this->nombre, $this->descripcion, $this->categoria_id, $this->articulo_id);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	function delete(){
		
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->itemsTable." 
			WHERE articulo_id = ?");
			
		$this->articulo_id = htmlspecialchars(strip_tags($this->articulo_id));
	 
		$stmt->bind_param("i", $this->articulo_id);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
}
?>