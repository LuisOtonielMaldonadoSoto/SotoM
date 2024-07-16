<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <link href="./public/css/ad_tf_style.css" rel="stylesheet"> <!-- Archivo CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"> <!-- Font Awesome -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
</head>
<body>
<?php
// Lógica específica de la página de destino
$estado2 = 'Activo'; // Ejemplo de estado
$estado = 'Inactivo'; // Ejemplo de estado diferente
$estado3 = 'En Validacion'; // Ejemplo de estado diferente
$claseEstado = estadoTarifario($estado); // Llamada a la función que devuelve la clase CSS basada en el estado del tarifario
$claseEstado2 = estadoTarifario($estado2); // Llamada a la función que devuelve la clase CSS basada en el estado del tarifario
$claseEstado3 = estadoTarifario($estado3); // Llamada a la función que devuelve la clase CSS basada en el estado del tarifario
// Función que devuelve la clase CSS basada en el estado del tarifario
function estadoTarifario($estado) {
    switch ($estado) {
        case 'Activo':
            return 'estado-activo';
        case 'Inactivo':
            return 'estado-inactivo';
        case 'En Validacion':
            return 'estado-validacion';
        default:
            return 'estado-desconocido';
    }
}
$infocliente = "Información actualizada del cliente"; // Ejemplo de información actualizada
$estado1 = "Estado actualizado"; // Ejemplo de estado actualizado
?>

<!-- Tabla Principal-->
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Tramitaciones</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <button class="btn btn-light my-2 my-sm-0" type="submit"><i class="fas fa-user"></i></button>
                            <button id="redirectButton" class="btn btn-light my-2 my-sm-0" type="submit"><i class="fas fa-share"></i></button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Barra de búsqueda -->
    <form class="form-inline my-2 my-lg-0 mr-auto">
        <div>
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar" style="width: 300px;">
            <button class="btn btn-light my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Número de Identificación Fiscal</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Estado</th>
                    <th>Tarifario</th>
                    <th>Fecha de Actualización</th>
                    <th>Fecha de Caducidad</th>
                    <th>Usuario de Actualización</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Cliente 2</td>
                    <td>12345678B</td>
                    <td>Dato 1.1</td>
                    <td>Dato 2.1</td>
                    <td>Dirección 1.1</td>
                    <td><button type="button" class="<?= $claseEstado2 ?>"><?= $estado2 ?></button></td>
                    <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#previewModal"><i class="fas fa-eye"></i></button></td>
                    <td>2023-06-02</td>
                    <td>2024-11-06</td>
                    <td>Usuario de Actualización</td>
                    <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#histModal"><i class="fas fa-landmark"></i></button></td>
                    <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#checkModal"><i class="fas fa-check"></i></button></td>
                    <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#destructionModal"><i class="fas fa-trash"></i></button></td>
                </tr>
                <tr>
                    <td>Cliente 3</td>
                    <td>12345678C</td>
                    <td>Dato 1.2</td>
                    <td>Dato 2.2</td>
                    <td>Dirección 1.2</td>
                    <td><button type="button" class="<?= $claseEstado3 ?>"><?= $estado3 ?></button></td>
                    <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#previewModal"><i class="fas fa-eye"></i></button></td>
                    <td>2023-06-03</td>
                    <td>2024-11-07</td>
                    <td>Usuario de Actualización</td>
                    <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#histModal"><i class="fas fa-landmark"></i></button></td>
                    <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#checkModal"><i class="fas fa-check"></i></button></td>
                    <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#destructionModal"><i class="fas fa-trash"></i></button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Footer -->
<footer class="bg-body-tertiary text-center text-lg-start">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);"></div>
</footer>

<!-- Modal de confirmacion de revision -->
<div class="modal fade" id="checkModal" tabindex="-1" role="dialog" aria-labelledby="checkModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkModalLabel">Confirmación de revisión</h5>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas confirmar la revisión de la información del cliente?</p>
                <iframe src="https://mozilla.github.io/pdf.js/web/viewer.html?file=/ruta/a/tu/archivo.pdf" width="100%" height="500px"></iframe>
                <div>
                    <input type="checkbox" id="userConfirm" name="userConfirm" value="revisado">
                    <label for="userConfirm">He revisado este documento</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnConfirm" class="btn btn-primary" disabled data-dismiss="modal">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Previsualización -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Previsualizar</h5>
            </div>
            <div class="modal-body">
                <!-- Aquí puedes agregar el contenido que deseas previsualizar -->
                <iframe src="https://mozilla.github.io/pdf.js/web/viewer.html?file=/ruta/a/tu/archivo.pdf" width="100%" height="500px"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Histórico -->
<div class="modal fade" id="histModal" tabindex="-1" role="dialog" aria-labelledby="histModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="histModalLabel">Archivo Histórico</h5>
            </div>
            <div class="modal-body">
                <!-- Aquí puedes agregar el contenido que deseas previsualizar -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Estado</th>
                                <th>Tarifario</th>
                                <th>Periodo Activo</th>
                                <th>Usuario de Actualización</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><button type="button" class="<?= $claseEstado ?>"><?= $estado ?></button></td>
                                <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#previewModal"><i class="fas fa-eye"></i></button></td>
                                <td>2023-06-01 - 2024-11-01</td>
                                <td>Juan Pablo</td>
                                <td><button type="button" class="btn btn-light"><i class="fas fa-download"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmacion de eliminacion -->
<div class="modal fade" id="destructionModal" tabindex="-1" role="dialog" aria-labelledby="destructionModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="destructionModalLabel">Confirmación de Destrucción del Tarifario</h5>
            </div>
            <div class="modal-body">
                <p>Al confirmar la destrucción del tarifario, el usuario se compromete y asume la total responsabilidad por la destrucción de cualquier tarifario en estado físico.</p>
                <div>
                    <input type="checkbox" id="userConfirm2" name="userConfirm2" value="eliminado">
                    <label for="userConfirm2">He destruido este documento</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="btnConfirm2" class="btn btn-primary" disabled data-dismiss="modal">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Script que maneja el cambio de modales -->
<script>
$(document).ready(function() {
    var addModal = $('#addModal');
    var previewModal = $('#previewModal');
    var histModal = $('#histModal');
    var sendModal = $('#sendModal');
    var openedFromHistModal = false;
    var openedFromAddModal = false;

    $('.btn[data-target="#previewModal"], .btn[data-target="#sendModal"]').click(function() {
        var targetModal = $($(this).data('target'));

        if (addModal.hasClass('show')) {
            openedFromAddModal = true;
            addModal.modal('hide');
            setTimeout(function() {
                sendModal.modal('show');
            }, 300); // Retraso para esperar la transición
        } else if (histModal.hasClass('show')) {
            openedFromHistModal = true;
            histModal.modal('hide');
            setTimeout(function() {
                previewModal.modal('show');
            }, 300); // Retraso para esperar la transición
        }
    });

    sendModal.on('hidden.bs.modal', function() {
        if (openedFromAddModal) {
            setTimeout(function() {
                addModal.modal('show');
            }, 300);
            openedFromAddModal = false;
        }
    });

    previewModal.on('hidden.bs.modal', function() {
        if (openedFromHistModal) {
            setTimeout(function() {
                histModal.modal('show');
            }, 300);
            openedFromHistModal = false;
        }
    });
});
</script>

<!-- Script para manejo de checkboxes -->
<script>
$(document).ready(function() {
    // Cuando el estado de cualquier checkbox "Seleccionar Todo" cambia
    $('.selectAll').change(function() {
        // Obtiene el estado actual del checkbox "Seleccionar Todo"
        var isChecked = $(this).prop('checked');
        // Establece el estado de todos los otros checkboxes en el mismo contenedor basado en el estado de "Seleccionar Todo"
        $(this).closest('.modal-content').find('.checkboxes-container .form-check-input').prop('checked', isChecked);
    });
});
</script>
<!-- Script que maneja la redirección al hacer clic en el botón de redirección -->
<script>
document.getElementById("redirectButton").addEventListener('click', function() {
    // Redirige a la página deseada
    window.location.href = './ad_tf_adminPage.php';
});
</script>
<!-- Script que deshabilita el botón de aprobado si el checkbox no está seleccionado -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Vincula el evento change al checkbox
    document.getElementById("userConfirm").addEventListener('change', function() {
        // Habilita o deshabilita los botones basado en el estado del checkbox
        var revisado = this.checked;
        document.getElementById("btnConfirm").disabled = !revisado;
    });
});
</script>
<!-- Script que deshabilita el boton de confirmacion si el checkbox no esta seleccionado -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Vincula el evento change al checkbox
    document.getElementById("userConfirm2").addEventListener('change', function() {
        // Habilita o deshabilita los botones basado en el estado del checkbox
        var revisado = this.checked;
        document.getElementById("btnConfirm2").disabled = !revisado;
    });
});
</script>
</body>
</html>
