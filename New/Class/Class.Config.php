<?php

class Config {

    static $encrypt = false;  //Postgres
    static $dbhost = "localhost";
    static $dbname = "egov";
static $dbuser = "root";    //MySQL
static $dbpwd = "";           //MySQL

    //static $dbuser = "postgres";  //Postgres
    //static $dbpwd = "nic001";    // //Postgres
//static $dbuser = "sa";        //SQL server
//static $dbpwd = "sa123";   //SQL server
    static $dbport = "5432";
    static $binpath = "E:/PostgreSQL/9.0/bin";
    //static $binpath = "c:/Progra~1/PostgreSQL/9.4/bin"; //Under Program Files
    static $base_url = "http://10.177.92.2/demoelection/";
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
        if (isset($_SESSION['MyDatabase']))
            return($_SESSION['MyDatabase']);
        else
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