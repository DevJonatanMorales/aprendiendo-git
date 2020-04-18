<?php
    require_once 'conexion.php';

    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $queryUpdate = "UPDATE `mis_tareas` SET `nom_tareas`='$name',`des_tareas`='$description' WHERE `id`='$id'";

    $resultUpdate = mysqli_query($conn, $queryUpdate);

    if(!$resultUpdate){
        die('Query Failed');
    }

    echo 'Update Task SuccessFully';
?>