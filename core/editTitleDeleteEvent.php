<?php
require_once('connection.php');
/**Comprobamos si Activo eliminar el Evento */
if (isset($_POST['delete']) && isset($_POST['id'])) {
    /**Recibimos el ID */
    $id = $_POST['id'];
    $sqlDelete = "DELETE FROM eventos WHERE id = $id";
    /**Preparamos la Query y lo Guardamos para Comprobar los Errores */
    $queryPrepare = $dbConn->prepare($sqlDelete);
    if ($queryPrepare == false) {
        print_r($bdd->errorInfo());
        /**Mostramos el Error */
        die('Ups! algo no está Bien cuando Preparamos la Query');
    }
    $queryExecute = $queryPrepare->execute();
    if ($queryExecute == false) {
        print_r($queryPrepare->errorInfo());
        /**Mostramos el Error */
        die('Ups! algo no está Bien cuando Ejecutamos la Query');
    }
    /**SI no quiere eliminar Entonces Comprobamos que Vengo Todo Completo */
} elseif (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id'])) {
    /**Recibimos los Datos */
    $id = $_POST['id'];
    $title = $_POST['title'];
    $color = $_POST['color'];

    $sqlUpdate = "UPDATE eventos SET  title = '$title', color = '$color' WHERE id = $id ";
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
    }
}
/**Volvemos a la Pagina de Inicio */
header('Location: ../index.php');
