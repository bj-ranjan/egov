<?php

class Config {

    static $encrypt = false;  //Postgres
    static $dbhost = "localhost";
    static $dbname = "training";

    static $dbuser = "postgres";  //Postgres
    static $dbpwd = "nic001";    // //Postgres
    static $dbport = "5432";
    static $binpath = "E:/PostgreSQL/9.0/bin";
    static $base_url = "http://10.177.92.55:90/demoelection/";
    static $schema = "";

    
    public static function getEncrypt() {
        return(self:: $encrypt);
    }
    
    public static function getBase_url() {
        return(self::$base_url);
    }

    public static function getBinPath() {
        return(self::$binpath);
    }

    public static function getPort() {
        return(self::$dbport);
    }

    public static function getDBHost() {
        return(self::$dbhost);
    }

    public static function getDB() {
                  return(self::$dbname);
    }

    public static function getSchema() {
        if (isset($_SESSION['Schema']))
            return($_SESSION['Schema']);
        else
            return(self::$schema);
    }

    public static function getUser() {
        return(self::$dbuser);
    }

    public static function getPWD() {
        return(self::$dbpwd);
    }

}

//End Class