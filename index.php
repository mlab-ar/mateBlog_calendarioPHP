<?php
require_once('core/connection.php');
/**Consulta para Traer Todos los Eventos */
$sqlAllEvents = "SELECT id, title, start, end, color FROM eventos ";
/**Preparamos la Consulta */
$result = $dbConn->prepare($sqlAllEvents);
/**Ejecutamos la Consulta */
$result->execute();
/**Guardamos Todos los Eventos */
$events = $result->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calendario</title>
    <!-- Incluimos Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Incluimos FullCalendar CSS -->
    <link href='css/fullcalendar.css' rel='stylesheet' />
    <!-- CSS Mod -->
    <style>
        body {
            padding-top: 5px;

        }

        #calendar {
            max-width: 800px;
        }

        .col-centered {
            float: none;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <!-- Contenido de la Pagina -->
    <!--container -->
    <div class="container">
        <!-- Calendario -->
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Un Simple Calendario</h1>
                <p class="lead">MateLab</p>
                <div id="calendar" class="col-centered">
                </div>
            </div>
        </div>
        <!-- /Calendario -->
        <!-- Modal Nuevo Evento -->
        <div class="modal fade" id="newEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="core/newEvent.php">

                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Nuevo Evento</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Titulo</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Color</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color">
                                        <option value="">Seleccionar Color</option>
                                        <option style="color:#159E4A;" value="#159E4A">&#9724;Verde Matelab</option>
                                        <option style="color:#FFD700;" value="#FFD700">&#9724;Amarillo</option>
                                        <option style="color:#FF8C00;" value="#FF8C00">&#9724;Naranja</option>
                                        <option style="color:#FF0000;" value="#FF0000">&#9724;Rojo</option>
                                        <option style="color:#000;" value="#000">&#9724;Negro</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="start" class="col-sm-10 control-label">Fecha y Hora de Inicio</label>
                                <div class="col-sm-10">
                                    <input type="text" name="start" class="form-control" id="start">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="end" class="col-sm-10 control-label">Fecha y Hora de Finalización</label>
                                <div class="col-sm-10">
                                    <input type="text" name="end" class="form-control" id="end">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Modal Nuevo Evento -->
        <!-- Modal Editar Titulo o Eliminar Evento -->
        <div class="modal fade" id="editDeleteEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="core/editTitleDeleteEvent.php">

                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Editar Titulo o Eliminar Evento</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Titulo</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Color</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color">
                                        <option value="">Seleccionar Color</option>
                                        <option style="color:#159E4A;" value="#159E4A">&#9724;Verde Matelab</option>
                                        <option style="color:#FFD700;" value="#FFD700">&#9724;Amarillo</option>
                                        <option style="color:#FF8C00;" value="#FF8C00">&#9724;Naranja</option>
                                        <option style="color:#FF0000;" value="#FF0000">&#9724;Rojo</option>
                                        <option style="color:#000;" value="#000">&#9724;Negro</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label class="text-danger"><input type="checkbox" name="delete"> Eliminar Evento</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Mandamos el id del Evento para poder editarlo -->
                            <input type="hidden" name="id" class="form-control" id="id">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Modal Editar Titulo o Eliminar Evento -->
    </div>
    <!-- /container -->
    <!-- Incluimos Bootstrap JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- Incluimos FullCalendar JS -->
    <script src='js/moment.min.js'></script>
    <script src='js/fullcalendar/fullcalendar.min.js'></script>
    <script src='js/fullcalendar/fullcalendar.js'></script>
    <script src='js/fullcalendar/locale/es.js'></script>

    <!-- FullCalendar Funciones-->
    <script>
        $(document).ready(function() {
            /**Alguna Variables con la Fecha que vamos a Usar mas Adelante */
            var date = new Date(); //Fecha Completa
            var yyyy = date.getFullYear().toString(); //Solo el Año
            var mm = (date.getMonth() + 1).toString().length == 1 ? "0" + (date.getMonth() + 1).toString() : (date.getMonth() + 1).toString(); //Solo el Mes
            var dd = (date.getDate()).toString().length == 1 ? "0" + (date.getDate()).toString() : (date.getDate()).toString(); //Solo el Dia

            $('#calendar').fullCalendar({
                columnFormat: 'dddd', //Nombre Completo de los Dias.
                firstDay: 0, //Para que comience en Domingo la semana
                header: {
                    language: 'es', //Lenguaje en Español
                    left: 'prev,next today', //Opciones de Menus para avanzar o ir al Dia Actual
                    center: 'title',
                    right: 'month,basicWeek,basicDay' //Mas Opciones de Menus para cambiar de Vistas
                },
                /**Colores distintos para el fin de Semana */
                businessHours: {
                    dow: [1, 2, 3, 4, 5] // dias de semana, 0=Domingo
                },
                displayEventTime: false, //NO Mostrar la Hora
                defaultDate: yyyy + "-" + mm + "-" + dd,
                editable: true,
                eventLimit: false, //esta en false para que muestre todos los eventos y no el link mas
                selectable: true,
                selectHelper: true,
                /**Nuevo Evento */
                select: function(start, end) {
                    $('#newEvent #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#newEvent #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#newEvent').modal('show');
                },
                /**Editar Titulo o Eliminar Evento */
                eventRender: function(event, element) {
                    element.bind('dblclick', function() {
                        $('#editDeleteEvent #id').val(event.id);
                        $('#editDeleteEvent #title').val(event.title);
                        $('#editDeleteEvent #color').val(event.color);
                        $('#editDeleteEvent').modal('show');
                    });
                },
                /**Si Cambiamos de lugar el Evento */
                eventDrop: function(event, delta, revertFunc) {
                    /**Llamamos a la Función que se va a Encargar de Editar  */
                    update(event);
                },
                /**Si Cambiamos el Tamaño del Evento */
                eventResize: function(event, dayDelta, minuteDelta, revertFunc) {
                    /**Llamamos a la Función que se va a Encargar de Editar  */
                    update(event);
                },
                /**Mostramos todos los Eventos */
                events: [
                    /**Recorremos todos los resultados */
                    <?php foreach ($events as $event) {
                    ?> {
                            id: '<?php echo $event["id"]; ?>',
                            title: '<?php echo $event["title"]; ?>',
                            start: '<?php echo $event["start"]; ?>',
                            end: '<?php echo $event["end"]; ?>',
                            color: '<?php echo $event["color"]; ?>',
                        },
                    <?php } ?>
                ]
            });//Fin Full Calendar
            /**Función Encargada de Editar el Evento con los Eventos Anteriores */
            function update(event) {
                /**Capturamos la Fecha y Hora de Incio */
                start = event.start.format('YYYY-MM-DD HH:mm:ss');
                /**Comprobamos La Fecha de Fin */
                if (event.end) {
                    end = event.end.format('YYYY-MM-DD HH:mm:ss');
                } else {
                    end = start;
                }
                /**Capturamos los Datos del Evento */
                id = event.id;
                eventId = id;
                eventStart = start;
                eventEnd = end;
                /**Lo Editamos por Una Petición AJAX */
                $.ajax({
                    url: 'core/editDateEvent.php',
                    type: "POST",
                    data: {
                        eventId: eventId,
                        eventStart: eventStart,
                        eventEnd: eventEnd,
                    },
                    success: function(rep) {
                        if (rep == 'ohSi') {
                            alert('Se Edito Correctamente el Evento');
                        } else {
                            alert('No se pudo Editar. Intentemos de Nuevo.');
                        }
                    }
                });
            }//Fin Update
        });
    </script>
</body>

</html>