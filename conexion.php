<?php
    //Datos de conexión a la BD
    $host = "fdb1028.awardspace.net"; //localhost en XAMPP
    $user = "4593737_db";
    $password = "tabascof50";
    $db = "4593737_db";

    $conn = new mysqli($host, $user, $password, $db);

    if($conn->connect_error)
    {
        die("Error de conexión: ".$conn->connect_error);
    }
?>