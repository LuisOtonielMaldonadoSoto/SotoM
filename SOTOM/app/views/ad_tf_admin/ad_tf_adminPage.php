<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tarifario_test";
// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Ejecutar la consulta
$query = "
    SELECT 
        u.nombre AS cliente_nombre,
        c.numero_identificacion_fiscal,
        u.correo,
        c.telefono,
        c.direccion,
        t.estado,
        t.tarifario_id,
        t.fecha_creacion AS fecha_actualizacion,
        t.fecha_expiracion,
        u2.nombre AS usuario_actualizo
    FROM
        clientes c
        JOIN (
            SELECT 
                t1.cliente_id,
                MAX(t1.fecha_creacion) AS ultima_fecha
            FROM 
                tarifarios t1
            GROUP BY 
                t1.cliente_id
        ) ultimos_tarifarios ON c.cliente_id = ultimos_tarifarios.cliente_id
        JOIN tarifarios t ON c.cliente_id = t.cliente_id 
                          AND t.fecha_creacion = ultimos_tarifarios.ultima_fecha
        JOIN user u ON c.administrador_id = u.user_id
        JOIN user u2 ON t.usuario_id = u2.user_id;
";
$result = $conn->query($query);
if (!$result) {
    die("Query failed: " . $conn->error);
}
function estadoTarifario($estado) {
    switch ($estado) {
        case 'Activo':
            return 'estado-activo';
        case 'Inactivo':
            return 'estado-inactivo';
        case 'En Validacion':
            return 'estado-validacion';
        case 'Sin Contactos';
            return 'estado-sin-contactos';
        case 'Expirado';
            return 'estado-expirado';
        default:
            return 'estado-desconocido';
    }
}
$infocliente = "Aquí va la información del cliente"; // Reemplaza esto con la información real del cliente
$estado1 = "Aquí va el estado"; // Reemplaza esto con el estado real del tarifario
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap CSS -->
    <link href="public/css/ad_tf_style.css" rel="stylesheet"> <!-- Archivo CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"> <!-- Font Awesome -->
</head>
<body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> <!-- jQuery -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
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
                            <button class="btn btn-light my-2 my-sm-0" type="submit" data-toggle="modal" data-target="#downModal"><i class="fas fa-bars"></i></button>
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
                <?php while ($row = $result->fetch_assoc()): 
                    $estado = $row['estado'];
                    $id_tarifario = $row['tarifario_id'];
                    $claseEstado = estadoTarifario($estado);
                ?>
                <tr>
                <td><?= htmlspecialchars($row['cliente_nombre']); ?></td>
                    <td><?= htmlspecialchars($row['numero_identificacion_fiscal']); ?></td>
                    <td><?= htmlspecialchars($row['correo']); ?></td>
                    <td><?= htmlspecialchars($row['telefono']); ?></td>
                    <td><?= htmlspecialchars($row['direccion']); ?></td>
                    <td><button type="button" class="<?= $claseEstado ?>"><?= $estado?></button></td>
                    <td><button type="button" class="btn btn-light valor-btn" data-id=<?="$id_tarifario"?> data-toggle="modal" data-target="#previewModal"><i class="fas fa-eye"></i></button></td>
                    <td><?= htmlspecialchars($row['fecha_actualizacion']); ?></td>
                    <td><?= htmlspecialchars($row['fecha_expiracion']?? ''); ?></td>
                    <td><?= htmlspecialchars($row['usuario_actualizo']); ?></td>
                    <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#histModal"><i class="fas fa-landmark"></i></button></td>
                    <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#addModal"><i class="fas fa-file"></i></button></td>
                    <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#contModal"><i class="fas fa-address-card"></i></button></td>
                </tr>
                
                <?php 
            endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Footer -->
<footer class="bg-body-tertiary text-center text-lg-start">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);"></div>
</footer>
<!-- Modal de Envío -->
<div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="sendModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendModal">Notificaciones</h5>
            </div>
            <div class="modal-body">
                <!-- Aquí puedes agregar el contenido que deseas previsualizar -->
                <div>
                    <div class="checkboxes-container" style="margin-left: 20px;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" class="checkbox1">
                            <label class="form-check-label" for="checkbox1">Usuario 1 - Correo@tramitaciones.com - Departamento</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" class="checkbox2">
                            <label class="form-check-label" for="checkbox2">Usuario 2 - Correo@tramitaciones.com - Departamento</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" class="checkbox3">
                            <label class="form-check-label" for="checkbox3">Usuario 3 - Correo@tramitaciones.com - Departamento</label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="form-check" style="margin-top:20px;">
                        <input class="form-check-input selectAll" type="checkbox" value="">
                        <label class="form-check-label" for="selectAll">Select All/Deselect All</label>
                    </div>
                </div>
            </div>
            <div>
                <input style="margin-left: 20px; border-radius: 100px;">
                <label>@tramitaciones.com</label>
            </div>
            <div style="background-color: #E0F9AF; padding: 20px; margin: 10px; width: 90%;">
                <span>Datos</span>
            </div>
            <div>
                <button type="button" class="btn btn-light" style="margin: 10px; width: 90%;">Agregar Nuevo Contacto</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-paper-plane"></i></button>
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
<!-- Modal Contactos -->
<div class="modal fade" id="contModal" tabindex="-1" role="dialog" aria-labelledby="contModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contModalLabel">Contactos X Usuario</h5>
            </div>
            <div class="modal-body">
                <!-- ListBox agregado aquí -->
                <select class="form-control" style="margin-bottom: 10px; border-radius: 10px;">
                    <option>Departamento 1</option>
                    <option>Departamento 2</option>
                    <option>Departamento 3</option>
                    <!-- Agrega más opciones según sea necesario -->
                </select>
                <div>
                    <div class="checkboxes-container" style="margin-left: 20px;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" class="checkbox1">
                            <label class="form-check-label" for="checkbox1">Usuario 1 - Correo@tramitaciones.com - Departamento</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" class="checkbox2">
                            <label class="form-check-label" for="checkbox2">Usuario 2 - Correo@tramitaciones.com - Departamento</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" class="checkbox3">
                            <label class="form-check-label" for="checkbox3">Usuario 3 - Correo@tramitaciones.com - Departamento</label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="form-check" style="margin-top:20px;">
                        <input class="form-check-input selectAll" type="checkbox" value="">
                        <label class="form-check-label" for="selectAll">Select All/Deselect All</label>
                    </div>
                </div>
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
<!-- Modal Agregar -->
<div class="modal fade bd-example-modal-xl" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Actualización de Tarifario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="infocliente">
                <!-- Contenido del modal agregar -->

                <p>
                    <a class="btn btn-light" data-toggle="collapse" href="#collapseRevision" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Actualización
                    </a>
                    <a class="btn btn-light" data-toggle="collapse" href="#collapseRenovacion" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Renovación
                    </a>
                </p>
                <div class="collapse show" id="collapseRevision">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="h4 text-muted">Actualizar Tarifario</div>
                            <div class="card">
                                <div class="card-body">
                                    <div id="datTarifario">
                                        <h5>Tarifario de servicios</h5>
                                        <p>ID: 123456</p>
                                    </div>
                                    <div>
                                        <div class="alert alert-success" role="alert">
                                            <?= $estado ?>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="pdfUpload">Archivo PDF</label>
                                        <input type="file" id="pdfUpload" class="small-input" accept=".pdf, .docx" />
                                    </div>
                                    <div>
                                        <label for="periodsAssig">Asignacion de Periodo</label>
                                        <select class="form-control">
                                            <option value="">3 Meses</option>
                                            <option value="">6 Meses</option>
                                            <option value="">1 Año</option>
                                            <option value="">Indefinido</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="h4 text-muted">Tarifario</div>
                            <div class="card">
                                <div class="card-body">
                                    <iframe src="Tarifario.pdf" class="w-100 " style="height: 600px;"></iframe>
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="collapseRenovacion">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="h4 text-muted">Actualizar Tarifario</div>
                            <div class="card h-100">
                                <div class="card-body">
                                    <div id="datTarifario">
                                        <h5>Tarifario de servicios</h5>
                                        <p>ID: 123456</p>
                                    </div>
                                    <div>
                                        <label for="pdfUpload">Archivo PDF</label>
                                        <input type="file" id="pdfUpload" class="small-input" accept=".pdf" />
                                    </div>
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="h4 text-muted">Renovar Tarifario</div>
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Nombre del Tarifario</h5>
                                    <iframe src="Tarifario.pdf" class="w-100" style="height: 500px;"></iframe>
                                </div>
                                <div class="card-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#sendModal"><i class="fas fa-file-import"></i></button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Revisión -->
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Revisión</h5>
            </div>
            <div class="modal-body">
                <!-- Aquí puedes agregar el contenido que deseas previsualizar -->
                <iframe src="https://mozilla.github.io/pdf.js/web/viewer.html?file=/ruta/a/tu/archivo.pdf" width="100%" height="500px"></iframe>
                <div>
                    <input type="checkbox" id="usuarioHaRevisado" name="usuarioHaRevisado" value="revisado">
                    <label for="usuarioHaRevisado">He revisado este documento</label>
                </div>
                <div>
                    <button type="button" id="btnAprobado" class="btn btn-light" disabled data-dismiss="modal">Aprobado</button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Cambio</th>
                                <th>Fecha de Cambio</th>
                                <th>Detalles de Cambio</th>
                                <th>Área de Impacto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Cambio 1</td>
                                <td>25-06-2024</td>
                                <td>----------------------------------</td>
                                <td>Importaciones</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <button type="button" id="btnCerrar" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal de descarga -->
<div class="modal fade" id="downModal" tabindex="-1" role="dialog" aria-labelledby="downModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downModalLabel">Descarga de Archivo</h5>
            </div>
            <div class="modal-body">
                <p>Descarga el archivo generico.</p>
                <div>
                    <button type="button" class="btn btn-ligth" data-dismiss="modal"><i class="fas fa-print"></i></button>
                    <label for="button"> Tarifario </label>
                </div>
                <div>
                    <button type="button" class="btn btn-ligth" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cerrar la conexión -->
<?php $conn->close(); ?>
</body>
</html>

