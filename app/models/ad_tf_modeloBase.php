<?php
class ModeloBase{
    public $db;

    public function __construct() {
        $this->db = database::connect();
    }

    public function tablaprincipal(){
        $query = $this->db->query("SELECT 
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
                JOIN user u2 ON t.usuario_id = u2.user_id;");
        return $query;
    }
}