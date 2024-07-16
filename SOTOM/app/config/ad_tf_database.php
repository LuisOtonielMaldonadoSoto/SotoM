<?php

class database{
    public static function connect(){
        $db = new mysqli('localhost', 'root', '', 'trifario_test');
        $db->set_charset('utf8');
        return $db;
    }
}

