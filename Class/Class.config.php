
<?php
class Config
{
private $db;
private $user;
private $pwd;

static $dbhost = "localhost"; //Modify Database Host Here
    static $dbname = "egovbackup"; //Modify Database Name Here
   // static $dbname = "ac_001";
    static $dbuser = "root"; //Modify Database User here
    static $dbpwd  = "";


public function Config()
{
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/kolkata");

$this->db=self::$dbname;
//$this->dbname="TempEgov";
$_SESSION['databasename']=$this->db;
$this->user=self::$dbuser;
$_SESSION['dbuser']=$this->user;
$this->pwd=self::$dbpwd;
$_SESSION['dbpwd']=self::$dbpwd;

if (strlen(trim($this->pwd))>0)
$con=mysql_connect('localhost',trim($this->user),trim($this->dbpwd));
//$con=mysql_connect('localhost','root','pwd');
else
$con=mysql_connect('localhost',trim($this->user));
//$con=mysql_connect('localhost','root');
if (!$con)
{
die('Could not connect to MySQL: ' . mysql_error());
}
//mysql_select_db("election") or die(mysql_error());
mysql_select_db(trim($this->db)) or die(mysql_error());
mysql_query("SET NAMES UTF8");
}//end constructor

     //$dbhost = trim(Config::getDBHost());
        //$dbname = trim(Config::getDB());
        //$dbuser = trim(Config::getUser());
        //$dbpwd = trim(Config::getPWD());

public function getDBHost()
{
return(self::$dbhost);
}


public function getDB()
{
return(self::$dbname);
}

public function getUser()
{
return(self::$dbuser);
}

public function getPWD()
{
return(self::$dbpwd);
}

}//end class
