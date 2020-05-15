<?php
try
{
    $host = "localhost";//Servidor
    $db ="simpleCalendario";//Nombre de la Base de Datos
    $userDb = "root"; //Usuario de la Base de Datos en este caso es root para localhost por defecto
    $password = ""; //Por defecto esta en blanco para localhost 
	$dbConn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $userDb, $password);
}
catch(Exception $e)
{
        die("Ups! algo no está Bien: ".$e->getMessage());
}
