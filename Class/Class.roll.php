<body>
<?php
require_once 'class.config.php';
class Roll
{
private $Roll;
private $Description;

//extra Old Variable to store Pre update Data
private $Old_Roll;
private $Old_Description;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Roll()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from roll";
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
$this->rowCommitted= mysql_affected_rows();
return($result);
}

public function rowCount($condition)
{
$sql=" select count(*) from roll where ".$condition;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
} //rowCount

public function getRow()
{
$i=0;
$tRow=array();
$sql="select Roll,Description from roll where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Roll']=$row['Roll'];//Primary Key-1
$tRow[$i]['Description']=$row['Description'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getRoll()
{
return($this->Roll);
}

public function setRoll($str)
{
$this->Roll=$str;
}

public function getDescription()
{
return($this->Description);
}

public function setDescription($str)
{
$this->Description=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Roll,Description from roll where Roll='".$this->Roll."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Description'])>0)
$this->Old_Description=$row['Description'];
else
$this->Old_Description="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Roll,Description from roll where Roll='".$this->Roll."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Description=$row['Description'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Roll from roll where Roll='".$this->Roll."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
return(true);
else
return(false);
} //end Available


public function DeleteRecord()
{
$sql="delete from roll where Roll='".$this->Roll."'";
$result=mysql_query($sql);
$this->rowCommitted= mysql_affected_rows();
$this->returnSql=$sql;
return($result);
} //end deleterecord


public function UpdateRecord()
{
$i=$this->copyVariable();
$i=0;
$this->updateList="";
$sql="update roll set ";
if ($this->Old_Description!=$this->Description &&  strlen($this->Description)>0)
{
if ($this->Description=="NULL")
$sql=$sql."Description=NULL";
else
$sql=$sql."Description='".$this->Description."'";
$i++;
$this->updateList=$this->updateList."Description=".$this->Description.", ";
}
else
$sql=$sql."Description=Description";


$cond="  where Roll='".$this->Roll."'";
$this->returnSql=$sql.$cond;
$this->rowCommitted= mysql_affected_rows();
$this->colUpdated=$i;

if (mysql_query($sql.$cond))
return(true);
else
return(false);
}//End Update Record



public function SaveRecord()
{
$this->updateList="";
$sql1="insert into roll(";
$sql=" values (";
$mcol=0;
if (strlen($this->Roll)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Roll";
if ($this->Roll=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Roll."'";
$this->updateList=$this->updateList."Roll=".$this->Roll.", ";
}

if (strlen($this->Description)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Description";
if ($this->Description=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Description."'";
$this->updateList=$this->updateList."Description=".$this->Description.", ";
}

$sql1=$sql1.")";
$sql=$sql.")";
$sqlstring=$sql1.$sql;
$this->returnSql=$sqlstring;
$this->rowCommitted= mysql_affected_rows();

if (mysql_query($sqlstring))
{
$this->colUpdated=1;
return(true);
}
else
{
$this->colUpdated=0;
return(false);
}
}//End Save Record


public function maxRoll()
{
$sql="select max(Roll) from roll";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}
public function getAllRecord()
{
$tRows=array();
$sql="select Roll,Description from roll where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Roll']=$row['Roll'];
$tRows[$i]['Description']=$row['Description'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Roll,Description from roll where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Roll']=$row['Roll'];
$tRows[$i]['Description']=$row['Description'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
