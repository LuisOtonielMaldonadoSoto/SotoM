<?php
// models/Tarifario.php
require_once './ad_tf_modeloBase.php';

class Tarifario extends ModeloBase {
    public $tarifario_id;
    public $nombre;
    public $documento;
    public $estado;
    public $fecha_creacion;
    public $fecha_expiracion;
    public $usuario_id;
    public $cliente_id;

    public function __construct() {
        parent::__construct();
    }

    public function getTarifarios() {
        $query = 'SELECT * FROM tarifarios';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getTarifarioById($tarifario_id) {
        $query = 'SELECT * FROM tarifarios WHERE tarifario_id = ? LIMIT 0,1';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $tarifario_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Define métodos para crear, actualizar y eliminar tarifarios
}
