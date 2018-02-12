<?php

class conexion{

// var $servidor="serteza.com";
// var $usuario="sertezac_omar";
// var $pass="serteza14#";
// var $nombd="sertezac_factor9";

private $servidor="localhost";
private $usuario="root";
private $pass="";
private $nombd="pruebas";

function conectar(){
	@$con = mysqli_connect($this->servidor,$this->usuario,$this->pass,$this->nombd);
	if (!$con) {
	header("Location:../views/login.php?msj=42");
    exit();
    }else{
    return $con;
    }
}
function ejecutarconsulta($consulta){
	$resp=mysqli_query($this->conectar(),$consulta);
     return $resp;
}
	
}
?>