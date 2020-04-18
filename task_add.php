<?php
require_once 'conexion.php';

if(isset($_POST['name'])){
    $name = $_POST['name'];
    $description = $_POST['description'];

    $query = "INSERT INTO `mis_tareas`(`nom_tareas`, `des_tareas`) VALUES ('$name','$description')";

    $resultSql = mysqli_query($conn, $query);

    if(!$resultSql){
        Die('Query failed :( ' . mysqli_error($conn));
    }
    echo 'Task addred successfully';
}
?>