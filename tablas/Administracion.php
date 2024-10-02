<?php
class Administracion
{

	private $tabla = "administracion";
	public $idEmpresa;
	public $idEmpleado;
	public $horasxContrato;
	public $horasTrabajadas;
	public $sueldoxHora;
	private $conn;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	function leer()
	{
		if ($this->idEmpleado>=0) {
			$stmt = $this->conn->prepare("
			SELECT * FROM " . $this->tabla . " WHERE idEmpleado = ?");
			$stmt->bind_param("i", $this->idEmpleado);
		}else { //Si no se le pasa id correcto hace un SELECT masivo
			$stmt = $this->conn->prepare("SELECT * FROM " . $this->tabla);
		}
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}

	function insertar()
	{

		$stmt = $this->conn->prepare("
		    INSERT INTO " . $this->tabla . "(`idEmpresa`, `idEmpleado`, `horasxContrato`, `horasTrabajadas`, `sueldoxHora`)
			VALUES(?,?,?,?,?)");

		$this->idEmpresa = strip_tags($this->idEmpresa);
		$this->idEmpleado = strip_tags($this->idEmpleado);
		$this->horasxContrato = strip_tags($this->horasxContrato);
		$this->horasTrabajadas = strip_tags($this->horasTrabajadas);
		$this->sueldoxHora = strip_tags($this->sueldoxHora);

		$stmt->bind_param("iiiii", $this->idEmpresa, $this->idEmpleado, $this->horasxContrato, $this->horasTrabajadas, $this->sueldoxHora);
		if ($stmt->execute()) {
			return true;
		}

		return false;
	}


	function actualizar()
	{

		$stmt = $this->conn->prepare("
		    UPDATE " . $this->tabla . " 
			SET horasxContrato = ?, horasTrabajadas = ?, sueldoxHora = ? WHERE idEmpleado = ? && idEmpresa=?");

		$this->horasxContrato = strip_tags($this->horasxContrato);
		$this->horasTrabajadas = strip_tags($this->horasTrabajadas);
		$this->sueldoxHora = strip_tags($this->sueldoxHora);
		$this->idEmpleado = strip_tags($this->idEmpleado);
		$this->idEmpresa = strip_tags($this->idEmpresa);
		$stmt->bind_param("iiiii",$this->horasxContrato,$this->horasTrabajadas,$this->sueldoxHora, $this->idEmpleado, $this->idEmpresa);

		if ($stmt->execute()) {
			return true;
		}
		return false;
	}
	function borrar()
	{

		$stmt = $this->conn->prepare("
			DELETE FROM " . $this->tabla . " 
			WHERE idEmpleado = ? && idEmpresa= ?");
		
		$this->idEmpleado = strip_tags($this->idEmpleado);
		$this->idEmpresa = strip_tags($this->idEmpresa);
		$stmt->bind_param("ii", $this->idEmpleado, $this->idEmpresa);
		if ($stmt->execute()) {
			return true;
		}

		return false;
	}

}
?>