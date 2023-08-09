<body>
<?php
require_once 'class.xconfig.php';
class Status
{
private $Id;
private $Name;

//extra Old Variable to store Pre update Data
private $Old_Id;
private $Old_Name;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Status()
{
$objConfig=new xConfig();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from status";
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
$sql=" select count(*) from status where ".$condition;
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
$sql="select Id,Name from status where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Id']=$row['Id'];//Primary Key-1
$tRow[$i]['Name']=$row['Name'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getId()
{
return($this->Id);
}

public function setId($str)
{
$this->Id=$str;
}

public function getName()
{
return($this->Name);
}

public function setName($str)
{
$this->Name=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Id,Name from status where Id='".$this->Id."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Name'])>0)
$this->Old_Name=$row['Name'];
else
$this->Old_Name="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Id,Name from status where Id='".$this->Id."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Name=$row['Name'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Id from status where Id='".$this->Id."'";
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
$sql="delete from status where Id='".$this->Id."'";
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
$sql="update status set ";
if ($this->Old_Name!=$this->Name &&  strlen($this->Name)>0)
{
if ($this->Name=="NULL")
$sql=$sql."Name=NULL";
else
$sql=$sql."Name='".$this->Name."'";
$i++;
$this->updateList=$this->updateList."Name=".$this->Name.", ";
}
else
$sql=$sql."Name=Name";


$cond="  where Id='".$this->Id."'";
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
$sql1="insert into status(";
$sql=" values (";
$mcol=0;
if (strlen($this->Id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Id";
if ($this->Id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Id."'";
$this->updateList=$this->updateList."Id=".$this->Id.", ";
}

if (strlen($this->Name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Name";
if ($this->Name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Name."'";
$this->updateList=$this->updateList."Name=".$this->Name.", ";
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


public function maxId()
{
$sql="select max(Id) from status";
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
$sql="select Id,Name from status where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Name']=$row['Name'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Id,Name from status where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Name']=$row['Name'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
