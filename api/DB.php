<?php
class DB{
    public $db;
    private static $instance = null;

    public function __construct(){
        try{
            $this->db = new PDO(
                'mysql:host='.HOST.';dbname='.DATABASE.';charset=utf8;',
                USER, PASSWORD
            );
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new DB();
        }
        return self::$instance;
    }

}