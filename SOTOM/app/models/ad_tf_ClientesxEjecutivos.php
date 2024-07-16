<?php
require_once './ad_tf_modeloBase.php';

class ClientesEjecutivos extends ModeloBase {
    public $cliente_id;
    public $ejecutivo_id;

    public function __construct() {
        parent::__construct();
    }

    public function getClientesEjecutivos() {
        $query = 'SELECT * FROM clientes_ejecutivos';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Define métodos para crear, actualizar y eliminar clientes_ejecutivos
}