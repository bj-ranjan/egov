<body>
<?php
require_once 'class.config.php';

class Pwd
{
private $Uid;
private $Pwd;
private $Roll;
private $Zpcno;

public $Available;
public $recordCount;
public $returnSql;
private $condString;

//public function _construct($i) //for PHP6
public function Pwd()
{
$objConfig=new Config();//Connects database
$Available=false;
$sql=" select count(*) from office_user";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
$this->recordCount=$row[0];
else
$this->recordCount=0;
$this->condString="1=1";
}//End constructor

public function ExecuteQuery($sql)
{
$result=mysql_query($sql);
if($result)
return(true);
else
return(false);
}



public function getUid()
{
return($this->Uid);
}

public function setUid($str)
{
$this->Uid=$str;
}

public function getPwd()
{
return($this->Pwd);
}

public function setPwd($str)
{
$this->Pwd=$str;
}

public function getRoll()
{
return($this->Roll);
}

public function setRoll($str)
{
$this->Roll=$str;
}

public function setCondString($str)
{
$this->condString=$str;
}


public function EditRecord()
{
$sql="select user_id, user_name, password, roll from office_user where user_id='".$this->Uid."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
$this->Available=true;
$this->Pwd=$row['password'];
$this->Roll=$row['roll'];
}
else
$this->Available=false;
} //end editrecord


public function DeleteRecord()
{
$sql="delete from pwd where Uid='".$this->Uid."'";
$result=mysql_query($sql);
return($result);
} //end deleterecord


public function UpdateRecord()
{
$sql="update pwd set ";
if (strlen($this->Pwd)>0)
{
if ($this->Pwd=="NULL")
$sql=$sql."Pwd=NULL";
else
$sql=$sql."Pwd='".$this->Pwd."'";
$sql=$sql.",";
}

if (strlen($this->Roll)>0)
{
if ($this->Roll=="NULL")
$sql=$sql."Roll=NULL";
else
$sql=$sql."Roll='".$this->Roll."'";
$sql=$sql.",";
}

if (strlen($this->Zpcno)>0)
{
if ($this->Zpcno=="NULL")
$sql=$sql."Zpcno=NULL";
else
$sql=$sql."Zpcno='".$this->Zpcno."'";
}
else
$sql=$sql."Zpcno=Zpcno";

$cond="  where user_id='".$this->Uid."'";
$this->returnSql=$sql.$cond;
if (mysql_query($sql.$cond))
return(true);
else
return(false);
}//End Update Record





public function getAllRecord()
{
$tRows=array();
$sql="select user_id,user_name,password where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Uid']=$row['user_id'];
$tRows[$i]['Pwd']=$row['password'];
$tRows[$i]['Roll']=$row['roll'];

$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
