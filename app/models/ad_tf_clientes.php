<?php
require_once './ad_tf_modeloBase.php';

class Cliente extends ModeloBase {
    public $cliente_id;
    public $numero_identificacion_fiscal;
    public $telefono;
    public $direccion;
    public $fecha_alta;
    public $administrador_id;

    public function __construct() {
        parent::__construct();
    }

    public function getClientes() {
        $query = 'SELECT * FROM clientes';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getClienteById($cliente_id) {
        $query = 'SELECT * FROM clientes WHERE cliente_id = ? LIMIT 0,1';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $cliente_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Define métodos para crear, actualizar y eliminar clientes
}