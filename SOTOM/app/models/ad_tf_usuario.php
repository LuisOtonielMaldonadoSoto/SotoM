<?php
// models/Usuario.php
require_once './ad_tf_modeloBase.php';

class Usuario extends ModeloBase {
    public $user_id;
    public $nombre;
    public $correo;
    public $contraseña;
    public $tipo;
    public $fecha_creacion;
    public $administrador_id;
    public $fecha_desactivacion;

    public function __construct() {
        parent::__construct();
    }

    public function getUsuarios() {
        $query = 'SELECT * FROM user';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getUsuarioById($user_id) {
        $query = 'SELECT * FROM user WHERE user_id = ? LIMIT 0,1';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getUsuarioByCorreo($correo) {
        $query = 'SELECT * FROM user WHERE correo = ? LIMIT 0,1';
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $correo);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Define métodos para crear, actualizar y eliminar usuarios
}