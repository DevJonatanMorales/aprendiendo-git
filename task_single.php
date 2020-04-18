<?php
    require_once 'conexion.php';
    
    if(isset($_POST['taskId'])){
        $id = $_POST['taskId'];
        $query = "SELECT * FROM `mis_tareas` WHERE `id` = '".$id."'";
        $resultTask = mysqli_query($conn, $query);

        if(!$resultTask){
            Die('Query Failed.');
        }

        while ($row = mysqli_fetch_array($resultTask)) {
            $json[] = array('id' => $row['id'], 'name' => $row['nom_tareas'], 'description' => $row['des_tareas']);
        }

        $jsonString = json_encode($json[0]);
        echo $jsonString;
    }
?>