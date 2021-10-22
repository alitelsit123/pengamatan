<?php

class DB {
    public static $connector = null;
    protected $connection = null;
    // protected $server = "banana10";
    // protected $username = "simoawos_log1";
    // protected $password = "elyas12345zz";
    // protected $db_name = 'simoawos_log';

    protected $server = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $db_name = 'simoawos_log';

    protected $query = '';

    public function __construct() {
        try {
            $this->connection = new PDO("mysql:host=$this->server;dbname=$this->db_name", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function insert() {
        $s = self::c()->connection->prepare(self::c()->query);
        $s->execute();
    }

    public function result() {
        $s = self::c()->connection->prepare(self::c()->query);
        $s->execute();
        $s->setFetchMode(PDO::FETCH_ASSOC);
        return $s->fetchAll();
    }

    public static function query($query) {
        self::c()->query = $query;
        return self::$connector;
    }

    public static function c() {
        if(!self::$connector) {
            self::$connector = new DB();
        }
        return self::$connector;
    }

}