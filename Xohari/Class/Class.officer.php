<body>
<?php
require_once 'class.xconfig.php';
class Officer
{
private $Id;
private $Name;
private $Designation;
private $Phone_no;
private $Office_id;
private $Service_id;

//extra Old Variable to store Pre update Data
private $Old_Id;
private $Old_Name;
private $Old_Designation;
private $Old_Phone_no;
private $Old_Office_id;
private $Old_Service_id;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Officer()
{
$objConfig=new xConfig();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from officer";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
$this->recordCount=$row[0];
else
$this->recordCount=0;
$this->condString="1=1";
$this->Office_id=1;
$this->Id=0;
}//End constructor

public function ExecuteQuery($sql)
{
$result=mysql_query($sql);
$this->rowCommitted= mysql_affected_rows();
return($result);
}

public function rowCount($condition)
{
$sql=" select count(*) from officer where ".$condition;
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
$sql="select Id,Name from officer where ".$this->condString;
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

public function getDesignation()
{
return($this->Designation);
}

public function setDesignation($str)
{
$this->Designation=$str;
}

public function getPhone_no()
{
return($this->Phone_no);
}

public function setPhone_no($str)
{
$this->Phone_no=$str;
}

public function getOffice_id()
{
return($this->Office_id);
}

public function setOffice_id($str)
{
$this->Office_id=$str;
}

public function getService_id()
{
return($this->Service_id);
}

public function setService_id($str)
{
$this->Service_id=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Id,Name,Designation,Phone_no,Office_id,Service_id from officer where Id='".$this->Id."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Name'])>0)
$this->Old_Name=$row['Name'];
else
$this->Old_Name="NULL";
if (strlen($row['Designation'])>0)
$this->Old_Designation=$row['Designation'];
else
$this->Old_Designation="NULL";
if (strlen($row['Phone_no'])>0)
$this->Old_Phone_no=$row['Phone_no'];
else
$this->Old_Phone_no="NULL";
if (strlen($row['Office_id'])>0)
$this->Old_Office_id=$row['Office_id'];
else
$this->Old_Office_id="NULL";
if (strlen($row['Service_id'])>0)
$this->Old_Service_id=$row['Service_id'];
else
$this->Old_Service_id="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Id,Name,Designation,Phone_no,Office_id,Service_id from officer where Id='".$this->Id."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Name=$row['Name'];
$this->Designation=$row['Designation'];
$this->Phone_no=$row['Phone_no'];
$this->Office_id=$row['Office_id'];
$this->Service_id=$row['Service_id'];
return(true);
}
else
return(false);
} //end EditRecord


public function EditOfficerDetail($sid)
{
$sql="select Id,Name,Designation,Phone_no,Office_id,Service_id from officer where Service_id=".$sid;
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Id=$row['Id'];
$this->Name=$row['Name'];
$this->Designation=$row['Designation'];
$this->Phone_no=$row['Phone_no'];
$this->Office_id=$row['Office_id'];
$this->Service_id=$row['Service_id'];
return(true);
}
else
return(false);
} //end EditRecord



public function Available()
{
$sql="select Id from officer where Id='".$this->Id."'";
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
$sql="delete from officer where Id='".$this->Id."'";
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
$sql="update officer set ";
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

if ($this->Old_Designation!=$this->Designation &&  strlen($this->Designation)>0)
{
if ($this->Designation=="NULL")
$sql=$sql."Designation=NULL";
else
$sql=$sql."Designation='".$this->Designation."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Designation=".$this->Designation.", ";
}

if ($this->Old_Phone_no!=$this->Phone_no &&  strlen($this->Phone_no)>0)
{
if ($this->Phone_no=="NULL")
$sql=$sql."Phone_no=NULL";
else
$sql=$sql."Phone_no='".$this->Phone_no."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Phone_no=".$this->Phone_no.", ";
}

if ($this->Old_Office_id!=$this->Office_id &&  strlen($this->Office_id)>0)
{
if ($this->Office_id=="NULL")
$sql=$sql."Office_id=NULL";
else
$sql=$sql."Office_id='".$this->Office_id."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Office_id=".$this->Office_id.", ";
}

if ($this->Old_Service_id!=$this->Service_id &&  strlen($this->Service_id)>0)
{
if ($this->Service_id=="NULL")
$sql=$sql."Service_id=NULL";
else
$sql=$sql."Service_id='".$this->Service_id."'";
$i++;
$this->updateList=$this->updateList."Service_id=".$this->Service_id.", ";
}
else
$sql=$sql."Service_id=Service_id";


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
$sql1="insert into officer(";
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

if (strlen($this->Designation)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Designation";
if ($this->Designation=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Designation."'";
$this->updateList=$this->updateList."Designation=".$this->Designation.", ";
}

if (strlen($this->Phone_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Phone_no";
if ($this->Phone_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Phone_no."'";
$this->updateList=$this->updateList."Phone_no=".$this->Phone_no.", ";
}

if (strlen($this->Office_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Office_id";
if ($this->Office_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Office_id."'";
$this->updateList=$this->updateList."Office_id=".$this->Office_id.", ";
}

if (strlen($this->Service_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Service_id";
if ($this->Service_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Service_id."'";
$this->updateList=$this->updateList."Service_id=".$this->Service_id.", ";
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
$sql="select max(Id) from officer";
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
$sql="select Id,Name,Designation,Phone_no,Office_id,Service_id from officer where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Name']=$row['Name'];
$tRows[$i]['Designation']=$row['Designation'];
$tRows[$i]['Phone_no']=$row['Phone_no'];
$tRows[$i]['Office_id']=$row['Office_id'];
$tRows[$i]['Service_id']=$row['Service_id'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Id,Name,Designation,Phone_no,Office_id,Service_id from officer where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Name']=$row['Name'];
$tRows[$i]['Designation']=$row['Designation'];
$tRows[$i]['Phone_no']=$row['Phone_no'];
$tRows[$i]['Office_id']=$row['Office_id'];
$tRows[$i]['Service_id']=$row['Service_id'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
