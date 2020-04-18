<?php
    require_once 'conexion.php';

    if(isset($_POST['taskId'])){
        $id = $_POST['taskId'];
        $query = "DELETE FROM `mis_tareas` WHERE `id` = '".$id."'";
        $resultDelet = mysqli_query($conn, $query);

        if(!$resultDelet){
            Die('Query Failed.');
        }

        echo 'Task Delete SuccessFully';
    }
?>