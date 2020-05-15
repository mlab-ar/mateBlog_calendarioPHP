<?php
require_once('connection.php');
/**Comprobamos que todos los Campos vengan Completos */
if (isset($_POST['eventId']) && isset($_POST['eventStart']) && isset($_POST['eventStart'])) {

    /**Recibimos los Datos */
    $id = $_POST['eventId'];
    $start = $_POST['eventStart'];
    $end = $_POST['eventStart'];

    $sqlUpdate = "UPDATE eventos SET  start = '$start', end = '$end' WHERE id = $id ";
    /**Preparamos la Query y lo Guardamos para Comprobar los Errores */
    $queryPrepare = $dbConn->prepare($sqlUpdate);
    if ($queryPrepare == false) {
        print_r($dbConn->errorInfo());
        /**Mostramos el Error */
        die('Ups! algo no está Bien cuando Ejecutamos la Query');
    }
    $queryExecute = $queryPrepare->execute();
    if ($queryExecute == false) {
        print_r($queryPrepare->errorInfo());
        /**Mostramos el Error */
        die('Ups! algo no está Bien cuando Ejecutamos la Query');
    } else {
        die('ohSi');
    }
}
