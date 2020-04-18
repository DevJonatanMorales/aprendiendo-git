<?php
    require_once 'conexion.php';

    $showQuery = "SELECT * FROM `mis_tareas`";
    $resultQuery = mysqli_query($conn, $showQuery);

    if (!$resultQuery) {
        Die('Error query' . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_array($resultQuery)) {
        $json[] = array('id' => $row['id'], 'name' => $row['nom_tareas'], 'description' => $row['des_tareas']);
    }

    $jsonString = json_encode($json);
    echo $jsonString;
?>