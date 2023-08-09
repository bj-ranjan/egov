<?php
class Config {

static $dbhost = "localhost";
static $dbname = "egovbackup";

static $dbuser = "root";    //MySQL
static $dbpwd = "";           //MySQL

//static $dbuser = "postgres";  //Postgres
//static $dbpwd = "nic001";    // //Postgres

//static $dbuser = "sa";        //SQL server
//static $dbpwd = "sa123";   //SQL server


static $dbport = "5432";

static $binpath="E:/PostgreSQL/9.4/bin";


public static function getBinPath(){
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

    public static function getUser() {
           return(self::$dbuser);
            }

    public static function getPWD() {
           return(self::$dbpwd);
            }
}//End Class