<?php
require 'conexion.php';

$search = $_POST['search'];

if(!empty($search)){
	$query = "SELECT * FROM `mis_tareas` WHERE nom_tareas LIKE '%".$search."%'";

	$result = mysqli_query($conn,$query);

	if(!$result){
		die('Query Error ' . mysqli_error($conn));
	}
	
	$json = array();
	
	while($row = mysqli_fetch_array($result)){
		$json[] = array('id' => $row['id'], 'nom_tareas' => $row['nom_tareas'], 'des_tareas' => $row['des_tareas']);
	}
	
	$jsonstring = json_encode($json);
	echo $jsonstring;
}
	


?>