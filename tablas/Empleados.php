<?php
class Empleados
{

	private $tabla = "Empleados";
	public $id;
	public $nombre;
	public $puesto;
	public $correo;
	public $telefono;
	private $conn;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	function leer()
	{
		if ($this->id>=0) {
			$stmt = $this->conn->prepare("
			SELECT * FROM " . $this->tabla . " WHERE id = ?");
			$stmt->bind_param("i", $this->id);
		} else { //Si no se le pasa id correcto hace un SELECT masivo
			$stmt = $this->conn->prepare("SELECT * FROM " . $this->tabla);
		}
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}

	function insertar()
	{

		$stmt = $this->conn->prepare("
		    INSERT INTO " . $this->tabla . "(`nombre`, `puesto`, `correo`, `telefono`)
			VALUES(?,?,?,?)");

		$this->nombre = strip_tags($this->nombre);
		$this->puesto = strip_tags($this->puesto);
		$this->correo = strip_tags($this->correo);
		$this->telefono = strip_tags($this->telefono);

		$stmt->bind_param("sssi", $this->nombre, $this->puesto, $this->correo, $this->telefono);
		if ($stmt->execute()) {
			return true;
		}

		return false;
	}


	function actualizar()
	{

		$stmt = $this->conn->prepare("
		    UPDATE " . $this->tabla . " 
			SET nombre = ?, puesto = ?, correo = ?, telefono = ? WHERE id = ?");

		$this->nombre = strip_tags($this->nombre);
		$this->puesto = strip_tags($this->puesto);
		$this->correo = strip_tags($this->correo);
		$this->telefono = strip_tags($this->telefono);
		$this->id = strip_tags($this->id);
		$stmt->bind_param("sssii", $this->nombre, $this->puesto, $this->correo, $this->telefono, $this->id);

		if ($stmt->execute()) {
			return true;
		}
		return false;
	}
	function borrar()
	{

		$stmt = $this->conn->prepare("
			DELETE FROM " . $this->tabla . " 
			WHERE id = ?");

		$this->id = strip_tags($this->id);
		$stmt->bind_param("i", $this->id);
		if ($stmt->execute()) {
			return true;
		}

		return false;
	}

}
?>