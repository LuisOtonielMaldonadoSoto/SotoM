CREATE DATABASE tarifario_test;
USE tarifario_test;

CREATE Table user(
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255),
    correo VARCHAR(255),
    contraseña VARCHAR(255),
    tipo ENUM('administrador', 'ejecutivo', 'user') NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    administrador_id INT,
    fecha_desactivacion TIMESTAMP,
    FOREIGN KEY (administrador_id) REFERENCES user(user_id)
)

CREATE TABLE clientes(
    cliente_id INT PRIMARY KEY AUTO_INCREMENT,
    numero_identificacion_fiscal VARCHAR(255) NOT NULL,
    telefono VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    fecha_alta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    administrador_id INT NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES user(user_id),
    FOREIGN KEY (administrador_id) REFERENCES user(user_id)
)

CREATE TABLE clientes_ejecutivos(
    cliente_id INT NOT NULL,
    ejecutivo_id INT NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES user(user_id),
    FOREIGN KEY (ejecutivo_id) REFERENCES user(user_id)
)

CREATE TABLE tarifarios(
    tarifario_id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    documento LONGBLOB NOT NULL,
    estado ENUM('En Validacion','Expirado','Activo','Inactivo', 'Sin Contactos', 'Historico') NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_expiracion TIMESTAMP NULL,
    usuario_id INT NOT NULL,
    cliente_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES user(user_id),
    FOREIGN KEY (cliente_id) REFERENCES clientes(cliente_id)
)

CREATE TABLE revisiones(
    revision_id INT PRIMARY KEY AUTO_INCREMENT,
    tarifario_id INT NOT NULL,
    fecha_revision TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (tarifario_id) REFERENCES tarifarios(tarifario_id)
)

CREATE Table historialCambios(
    cambio_id INT PRIMARY KEY AUTO_INCREMENT,
    revision_id INT NOT NULL,
    cambio VARCHAR(255) NOT NULL,
    fecha_cambio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    detalles_cambio TEXT NOT NULL,
    area_impacto VARCHAR(255) NOT NULL,
    FOREIGN KEY (cambio_id) REFERENCES revisiones(revision_id)
)

SELECT 
    u.nombre AS cliente_nombre,
    c.numero_identificacion_fiscal,
    u.correo,
    c.telefono,
    c.direccion,
    t.estado,
    t.documento,
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
    JOIN user u ON c.cliente_id = u.user_id
    JOIN user u2 ON t.usuario_id = u2.user_id;

<!-- Vamos a insertar datos en las tablas -->

INSERT INTO user(nombre, correo, contraseña, tipo, administrador_id) VALUES('Juan Perez', 'juanp@gmial.com', '123456', 'administrador', NULL);
INSERT INTO user(nombre, correo, contraseña, tipo, administrador_id) VALUES('Maria Lopez', 'marial@gmail.com', '123456', 'ejecutivo', 1);
INSERT INTO user(nombre, correo, contraseña, tipo, administrador_id) VALUES('Pedro Ramirez', 'pedror@gmail.com', '123456', 'ejecutivo', 1);

INSERT INTO clientes(numero_identificacion_fiscal, telefono, direccion, administrador_id) VALUES('123456789', '123456789', 'Calle 123', 1);
INSERT INTO clientes(numero_identificacion_fiscal, telefono, direccion, administrador_id) VALUES('987654321', '987654321', 'Calle 321', 1);
INSERT INTO clientes_ejecutivos(cliente_id, ejecutivo_id) VALUES(1, 2);
INSERT INTO clientes_ejecutivos(cliente_id, ejecutivo_id) VALUES(2, 3);

INSERT INTO tarifarios(nombre, documento, estado, usuario_id, cliente_id) VALUES('Tarifario 1', 'documento1.pdf', 'Activo', 2, 1);

INSERT INTO revisiones(tarifario_id) VALUES(1);

INSERT INTO historialCambios(revision_id, cambio, detalles_cambio, area_impacto) VALUES(1, 'Cambio 1', 'Detalles del cambio 1', 'Area 1');

<!-- Vamos a realizar las consultas -->

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
    JOIN user u ON c.cliente_id = u.user_id
    JOIN user u2 ON t.usuario_id = u2.user_id;