<?php

require_once './ad_tf_modeloBase.php';

class Revision extends ModeloBase {
    public $revision_id;
    public $tarifario_id;
    public $fecha_revision;

    public function __construct() {
        parent::__construct();
    }

    public function getRevisiones() {
        $query = 'SELECT * FROM revisiones';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getRevisionById($revision_id) {
        $query = 'SELECT * FROM revisiones WHERE revision_id = ? LIMIT 0,1';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $revision_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Define métodos para crear, actualizar y eliminar revisiones
}