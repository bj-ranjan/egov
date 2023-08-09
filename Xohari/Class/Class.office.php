<body>
<?php
require_once 'class.xconfig.php';
class Office
{
private $Id;
private $Name;
private $Off_code;
private $Address;
private $District_id;
private $Subdivision_id;
private $Block_id;
private $Department_id;
private $Code;

//extra Old Variable to store Pre update Data
private $Old_Id;
private $Old_Name;
private $Old_Off_code;
private $Old_Address;
private $Old_District_id;
private $Old_Subdivision_id;
private $Old_Block_id;
private $Old_Department_id;
private $Old_Code;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Office()
{
$objConfig=new xConfig();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from office";
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
$sql=" select count(*) from office where ".$condition;
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
$sql="select Id,Name from office where ".$this->condString;
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

public function getOff_code()
{
return($this->Off_code);
}

public function setOff_code($str)
{
$this->Off_code=$str;
}

public function getAddress()
{
return($this->Address);
}

public function setAddress($str)
{
$this->Address=$str;
}

public function getDistrict_id()
{
return($this->District_id);
}

public function setDistrict_id($str)
{
$this->District_id=$str;
}

public function getSubdivision_id()
{
return($this->Subdivision_id);
}

public function setSubdivision_id($str)
{
$this->Subdivision_id=$str;
}

public function getBlock_id()
{
return($this->Block_id);
}

public function setBlock_id($str)
{
$this->Block_id=$str;
}

public function getDepartment_id()
{
return($this->Department_id);
}

public function setDepartment_id($str)
{
$this->Department_id=$str;
}

public function getCode()
{
return($this->Code);
}

public function setCode($str)
{
$this->Code=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Id,Name,Off_code,Address,District_id,Subdivision_id,Block_id,Department_id,Code from office where Id='".$this->Id."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Name'])>0)
$this->Old_Name=$row['Name'];
else
$this->Old_Name="NULL";
if (strlen($row['Off_code'])>0)
$this->Old_Off_code=$row['Off_code'];
else
$this->Old_Off_code="NULL";
if (strlen($row['Address'])>0)
$this->Old_Address=$row['Address'];
else
$this->Old_Address="NULL";
if (strlen($row['District_id'])>0)
$this->Old_District_id=$row['District_id'];
else
$this->Old_District_id="NULL";
if (strlen($row['Subdivision_id'])>0)
$this->Old_Subdivision_id=$row['Subdivision_id'];
else
$this->Old_Subdivision_id="NULL";
if (strlen($row['Block_id'])>0)
$this->Old_Block_id=$row['Block_id'];
else
$this->Old_Block_id="NULL";
if (strlen($row['Department_id'])>0)
$this->Old_Department_id=$row['Department_id'];
else
$this->Old_Department_id="NULL";
if (strlen($row['Code'])>0)
$this->Old_Code=$row['Code'];
else
$this->Old_Code="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Id,Name,Off_code,Address,District_id,Subdivision_id,Block_id,Department_id,Code from office where Id='".$this->Id."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Name=$row['Name'];
$this->Off_code=$row['Off_code'];
$this->Address=$row['Address'];
$this->District_id=$row['District_id'];
$this->Subdivision_id=$row['Subdivision_id'];
$this->Block_id=$row['Block_id'];
$this->Department_id=$row['Department_id'];
$this->Code=$row['Code'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Id from office where Id='".$this->Id."'";
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
$sql="delete from office where Id='".$this->Id."'";
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
$sql="update office set ";
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

if ($this->Old_Off_code!=$this->Off_code &&  strlen($this->Off_code)>0)
{
if ($this->Off_code=="NULL")
$sql=$sql."Off_code=NULL";
else
$sql=$sql."Off_code='".$this->Off_code."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Off_code=".$this->Off_code.", ";
}

if ($this->Old_Address!=$this->Address &&  strlen($this->Address)>0)
{
if ($this->Address=="NULL")
$sql=$sql."Address=NULL";
else
$sql=$sql."Address='".$this->Address."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Address=".$this->Address.", ";
}

if ($this->Old_District_id!=$this->District_id &&  strlen($this->District_id)>0)
{
if ($this->District_id=="NULL")
$sql=$sql."District_id=NULL";
else
$sql=$sql."District_id='".$this->District_id."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."District_id=".$this->District_id.", ";
}

if ($this->Old_Subdivision_id!=$this->Subdivision_id &&  strlen($this->Subdivision_id)>0)
{
if ($this->Subdivision_id=="NULL")
$sql=$sql."Subdivision_id=NULL";
else
$sql=$sql."Subdivision_id='".$this->Subdivision_id."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Subdivision_id=".$this->Subdivision_id.", ";
}

if ($this->Old_Block_id!=$this->Block_id &&  strlen($this->Block_id)>0)
{
if ($this->Block_id=="NULL")
$sql=$sql."Block_id=NULL";
else
$sql=$sql."Block_id='".$this->Block_id."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Block_id=".$this->Block_id.", ";
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

if ($this->Old_Code!=$this->Code &&  strlen($this->Code)>0)
{
if ($this->Code=="NULL")
$sql=$sql."Code=NULL";
else
$sql=$sql."Code='".$this->Code."'";
$i++;
$this->updateList=$this->updateList."Code=".$this->Code.", ";
}
else
$sql=$sql."Code=Code";


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
$sql1="insert into office(";
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

if (strlen($this->Off_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Off_code";
if ($this->Off_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Off_code."'";
$this->updateList=$this->updateList."Off_code=".$this->Off_code.", ";
}

if (strlen($this->Address)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Address";
if ($this->Address=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Address."'";
$this->updateList=$this->updateList."Address=".$this->Address.", ";
}

if (strlen($this->District_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."District_id";
if ($this->District_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->District_id."'";
$this->updateList=$this->updateList."District_id=".$this->District_id.", ";
}

if (strlen($this->Subdivision_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Subdivision_id";
if ($this->Subdivision_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Subdivision_id."'";
$this->updateList=$this->updateList."Subdivision_id=".$this->Subdivision_id.", ";
}

if (strlen($this->Block_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Block_id";
if ($this->Block_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Block_id."'";
$this->updateList=$this->updateList."Block_id=".$this->Block_id.", ";
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

if (strlen($this->Code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Code";
if ($this->Code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Code."'";
$this->updateList=$this->updateList."Code=".$this->Code.", ";
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
$sql="select max(Id) from office";
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
$sql="select Id,Name,Off_code,Address,District_id,Subdivision_id,Block_id,Department_id,Code from office where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Name']=$row['Name'];
$tRows[$i]['Off_code']=$row['Off_code'];
$tRows[$i]['Address']=$row['Address'];
$tRows[$i]['District_id']=$row['District_id'];
$tRows[$i]['Subdivision_id']=$row['Subdivision_id'];
$tRows[$i]['Block_id']=$row['Block_id'];
$tRows[$i]['Department_id']=$row['Department_id'];
$tRows[$i]['Code']=$row['Code'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Id,Name,Off_code,Address,District_id,Subdivision_id,Block_id,Department_id,Code from office where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Name']=$row['Name'];
$tRows[$i]['Off_code']=$row['Off_code'];
$tRows[$i]['Address']=$row['Address'];
$tRows[$i]['District_id']=$row['District_id'];
$tRows[$i]['Subdivision_id']=$row['Subdivision_id'];
$tRows[$i]['Block_id']=$row['Block_id'];
$tRows[$i]['Department_id']=$row['Department_id'];
$tRows[$i]['Code']=$row['Code'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
