<body>
<?php
class Utility
{
private $mDays=array();
public function Utility()
{
$this->mDays[1] = 31;
$this->mDays[2] = 28;
$this->mDays[3] = 31;
$this->mDays[4] = 30;
$this->mDays[5] = 31;
$this->mDays[6] = 30;
$this->mDays[7] = 31;
$this->mDays[8] = 31;
$this->mDays[9] = 30;
$this->mDays[10] = 31;
$this->mDays[11] = 30;
$this->mDays[12] = 31;
} //constructor

public function isdate($mdate)
{
$t=true;
$dtarray=explode("/",$mdate);
if (count($dtarray)==3)
{
if (substr($dtarray[1],0,1)=="0")
$dtarray[1]=substr($dtarray[1],-1);
if (($dtarray[2]%4)==0)
$this->mDays[2] = 29;
if(is_numeric($dtarray[2]) && is_numeric($dtarray[1]) && is_numeric($dtarray[0]))
$t=true;
else
$t=false;
if (($dtarray[1]<1) || ($dtarray[1]>12))
$t=false;
if (($dtarray[0]<1)  || ($dtarray[0]>31))
$t=false;
if ($dtarray[1]>0 && $dtarray[1]<13 )
{
if ($dtarray[0]>$this->mDays[$dtarray[1]])
$t=false;
}
}
else
$t=false;
return($t);
}

public function to_mysqldate($mdate)
{
$t="";
$t=substr($mdate,-4)."-".substr($mdate,3,2)."-".substr($mdate,0,2);
$dtarray=explode("/",$mdate);
if (count($dtarray)==3)
$t=$dtarray[2]."-".$dtarray[1]."-".$dtarray[0];
return($t);
}

public function to_date($mydate)
{
$dt=array();
$dt="";
if (strlen($mydate)>=10)
{
$mydate=substr($mydate,0,10);
$dt=explode("-",$mydate);
$dd=$dt[2];
$mm=$dt[1];
$yy=$dt[0];
$dt=$dd."/".$mm."/".$yy;
}
return($dt);
}

public function isUnicode($mystring)
{
$t=false;
if (strlen($mystring) != strlen(utf8_decode($mystring)))
$t=true;
else
$t=false;
return($t);
}

public function validate($str)
{
$found=true;
if (preg_match("/'/",$str))
$found=false;

if (preg_match("/--/",$str))
$found=false;


if (preg_match("/</",$str))
$found=false;


if (preg_match("/>/",$str))
$found=false;

if (preg_match("/;/",$str))
$found=false;


return($found);
}

public function saveSqlLog($line)
{
$dd="./log/".date('dmY');
$fname = $dd.".sql";
$ts = fopen($fname, 'a') or die("can't open file");
$line=$line.";\n";
fwrite($ts, $line);
//fclose($fname);
}
}//end class
