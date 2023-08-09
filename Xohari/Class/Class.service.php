<body>
<?php
require_once 'class.xconfig.php';
class Service
{
private $Id;
private $Name;
private $Department_id;
private $Delivery_time;
private $Fee;

//extra Old Variable to store Pre update Data
private $Old_Id;
private $Old_Name;
private $Old_Department_id;
private $Old_Delivery_time;
private $Old_Fee;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Service()
{
$objConfig=new xConfig();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from service";
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
$sql=" select count(*) from service where ".$condition;
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
$sql="select Id,Name from service where ".$this->condString;
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

public function getDepartment_id()
{
return($this->Department_id);
}

public function setDepartment_id($str)
{
$this->Department_id=$str;
}

public function getDelivery_time()
{
return($this->Delivery_time);
}

public function setDelivery_time($str)
{
$this->Delivery_time=$str;
}

public function getFee()
{
return($this->Fee);
}

public function setFee($str)
{
$this->Fee=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Id,Name,Department_id,Delivery_time,Fee from service where Id='".$this->Id."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Name'])>0)
$this->Old_Name=$row['Name'];
else
$this->Old_Name="NULL";
if (strlen($row['Department_id'])>0)
$this->Old_Department_id=$row['Department_id'];
else
$this->Old_Department_id="NULL";
if (strlen($row['Delivery_time'])>0)
$this->Old_Delivery_time=$row['Delivery_time'];
else
$this->Old_Delivery_time="NULL";
if (strlen($row['Fee'])>0)
$this->Old_Fee=$row['Fee'];
else
$this->Old_Fee="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Id,Name,Department_id,Delivery_time,Fee from service where Id='".$this->Id."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Name=$row['Name'];
$this->Department_id=$row['Department_id'];
$this->Delivery_time=$row['Delivery_time'];
$this->Fee=$row['Fee'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Id from service where Id='".$this->Id."'";
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
$sql="delete from service where Id='".$this->Id."'";
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
$sql="update service set ";
if ($this->Old_Name!=$this->Name &&  strlen($this->Name)>0)
{
if ($this->Name=="NULL")
$sql=$sql."Name=NULL";
else
$sql=$sql."Name='".$this->Name."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Name=".$this->Name.", ";
}

if ($this->Old_Department_id!=$this->Department_id &&  strlen($this->Department_id)>0)
{
if ($this->Department_id=="NULL")
$sql=$sql."Department_id=NULL";
else
$sql=$sql."Department_id='".$this->Department_id."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Department_id=".$this->Department_id.", ";
}

if ($this->Old_Delivery_time!=$this->Delivery_time &&  strlen($this->Delivery_time)>0)
{
if ($this->Delivery_time=="NULL")
$sql=$sql."Delivery_time=NULL";
else
$sql=$sql."Delivery_time='".$this->Delivery_time."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Delivery_time=".$this->Delivery_time.", ";
}

if ($this->Old_Fee!=$this->Fee &&  strlen($this->Fee)>0)
{
if ($this->Fee=="NULL")
$sql=$sql."Fee=NULL";
else
$sql=$sql."Fee='".$this->Fee."'";
$i++;
$this->updateList=$this->updateList."Fee=".$this->Fee.", ";
}
else
$sql=$sql."Fee=Fee";


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
$sql1="insert into service(";
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

if (strlen($this->Department_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Department_id";
if ($this->Department_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Department_id."'";
$this->updateList=$this->updateList."Department_id=".$this->Department_id.", ";
}

if (strlen($this->Delivery_time)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Delivery_time";
if ($this->Delivery_time=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Delivery_time."'";
$this->updateList=$this->updateList."Delivery_time=".$this->Delivery_time.", ";
}

if (strlen($this->Fee)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Fee";
if ($this->Fee=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Fee."'";
$this->updateList=$this->updateList."Fee=".$this->Fee.", ";
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
$sql="select max(Id) from service";
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
$sql="select Id,Name,Department_id,Delivery_time,Fee from service where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Name']=$row['Name'];
$tRows[$i]['Department_id']=$row['Department_id'];
$tRows[$i]['Delivery_time']=$row['Delivery_time'];
$tRows[$i]['Fee']=$row['Fee'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Id,Name,Department_id,Delivery_time,Fee from service where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Name']=$row['Name'];
$tRows[$i]['Department_id']=$row['Department_id'];
$tRows[$i]['Delivery_time']=$row['Delivery_time'];
$tRows[$i]['Fee']=$row['Fee'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
