<body>
<?php
require_once 'class.xconfig.php';
class Request_status
{
private $Id;
private $Request_id;
private $Status_id;
private $Remark;
private $Date;
private $Updated_by;

//extra Old Variable to store Pre update Data
private $Old_Id;
private $Old_Request_id;
private $Old_Status_id;
private $Old_Remark;
private $Old_Date;
private $Old_Updated_by;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

private $Def_Status_id="0";
//public function _construct($i) //for PHP6
public function Request_status()
{
$objConfig=new xConfig();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from request_status";
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
$sql=" select count(*) from request_status where ".$condition;
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
$sql="select Id,Request_id from request_status where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Id']=$row['Id'];//Primary Key-1
$tRow[$i]['Request_id']=$row['Request_id'];//Posible Unique Field
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

public function getRequest_id()
{
return($this->Request_id);
}

public function setRequest_id($str)
{
$this->Request_id=$str;
}

public function getStatus_id()
{
return($this->Status_id);
}

public function setStatus_id($str)
{
$this->Status_id=$str;
}

public function getRemark()
{
return($this->Remark);
}

public function setRemark($str)
{
$this->Remark=$str;
}

public function getDate()
{
return($this->Date);
}

public function setDate($str)
{
$this->Date=$str;
}

public function getUpdated_by()
{
return($this->Updated_by);
}

public function setUpdated_by($str)
{
$this->Updated_by=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Id,Request_id,Status_id,Remark,Date,Updated_by from request_status where Id='".$this->Id."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Request_id'])>0)
$this->Old_Request_id=$row['Request_id'];
else
$this->Old_Request_id="NULL";
if (strlen($row['Status_id'])>0)
$this->Old_Status_id=$row['Status_id'];
else
$this->Old_Status_id="NULL";
if (strlen($row['Remark'])>0)
$this->Old_Remark=$row['Remark'];
else
$this->Old_Remark="NULL";
if (strlen($row['Date'])>0)
$this->Old_Date=substr($row['Date'],0,10);
else
$this->Old_Date="NULL";
if (strlen($row['Updated_by'])>0)
$this->Old_Updated_by=$row['Updated_by'];
else
$this->Old_Updated_by="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Id,Request_id,Status_id,Remark,Date,Updated_by from request_status where Id='".$this->Id."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Request_id=$row['Request_id'];
$this->Status_id=$row['Status_id'];
$this->Remark=$row['Remark'];
$this->Date=$row['Date'];
$this->Updated_by=$row['Updated_by'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Id from request_status where Request_id='".$this->Request_id."' and Status_id='".$this->Status_id."'";
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
$sql="delete from request_status where Id='".$this->Id."'";
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
$sql="update request_status set ";
if ($this->Old_Request_id!=$this->Request_id &&  strlen($this->Request_id)>0)
{
if ($this->Request_id=="NULL")
$sql=$sql."Request_id=NULL";
else
$sql=$sql."Request_id='".$this->Request_id."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Request_id=".$this->Request_id.", ";
}

if ($this->Old_Status_id!=$this->Status_id &&  strlen($this->Status_id)>0)
{
if ($this->Status_id=="NULL")
$sql=$sql."Status_id=NULL";
else
$sql=$sql."Status_id='".$this->Status_id."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Status_id=".$this->Status_id.", ";
}

if ($this->Old_Remark!=$this->Remark &&  strlen($this->Remark)>0)
{
if ($this->Remark=="NULL")
$sql=$sql."Remark=NULL";
else
$sql=$sql."Remark='".$this->Remark."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Remark=".$this->Remark.", ";
}

if ($this->Old_Date!=$this->Date &&  strlen($this->Date)>0)
{
if ($this->Date=="NULL")
$sql=$sql."Date=NULL";
else
$sql=$sql."Date='".$this->Date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Date=".$this->Date.", ";
}

if ($this->Old_Updated_by!=$this->Updated_by &&  strlen($this->Updated_by)>0)
{
if ($this->Updated_by=="NULL")
$sql=$sql."Updated_by=NULL";
else
$sql=$sql."Updated_by='".$this->Updated_by."'";
$i++;
$this->updateList=$this->updateList."Updated_by=".$this->Updated_by.", ";
}
else
$sql=$sql."Updated_by=Updated_by";


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
$sql1="insert into request_status(";
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

if (strlen($this->Request_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Request_id";
if ($this->Request_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Request_id."'";
$this->updateList=$this->updateList."Request_id=".$this->Request_id.", ";
}

if (strlen($this->Status_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Status_id";
if ($this->Status_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Status_id."'";
$this->updateList=$this->updateList."Status_id=".$this->Status_id.", ";
}

if (strlen($this->Remark)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Remark";
if ($this->Remark=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Remark."'";
$this->updateList=$this->updateList."Remark=".$this->Remark.", ";
}

if (strlen($this->Date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Date";
if ($this->Date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Date."'";
$this->updateList=$this->updateList."Date=".$this->Date.", ";
}

if (strlen($this->Updated_by)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Updated_by";
if ($this->Updated_by=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Updated_by."'";
$this->updateList=$this->updateList."Updated_by=".$this->Updated_by.", ";
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
$sql="select max(Id) from request_status";
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
$sql="select Id,Request_id,Status_id,Remark,Date,Updated_by from request_status where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Request_id']=$row['Request_id'];
$tRows[$i]['Status_id']=$row['Status_id'];
$tRows[$i]['Remark']=$row['Remark'];
$tRows[$i]['Date']=$row['Date'];
$tRows[$i]['Updated_by']=$row['Updated_by'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Id,Request_id,Status_id,Remark,Date,Updated_by from request_status where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Request_id']=$row['Request_id'];
$tRows[$i]['Status_id']=$row['Status_id'];
$tRows[$i]['Remark']=$row['Remark'];
$tRows[$i]['Date']=$row['Date'];
$tRows[$i]['Updated_by']=$row['Updated_by'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
