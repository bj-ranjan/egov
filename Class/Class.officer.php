<body>
<?php
require_once 'class.config.php';
class Officer
{
private $Slno;
private $Officer_name;
private $Designation;
private $Exist;

//extra Old Variable to store Pre update Data
private $Old_Slno;
private $Old_Officer_name;
private $Old_Designation;
private $Old_Exist;

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
$objConfig=new Config();//Connects database
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
$sql="select Slno,Officer_name,Designation from officer where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Slno']=$row['Slno'];//Primary Key-1
$tRow[$i]['Officer_name']=$row['Officer_name'];//Posible Unique Field
$tRow[$i]['Designation']=$row['Designation'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getSlno()
{
return($this->Slno);
}

public function setSlno($str)
{
$this->Slno=$str;
}

public function getOfficer_name()
{
return($this->Officer_name);
}

public function setOfficer_name($str)
{
$this->Officer_name=$str;
}

public function getDesignation()
{
return($this->Designation);
}

public function setDesignation($str)
{
$this->Designation=$str;
}

public function getExist()
{
return($this->Exist);
}

public function setExist($str)
{
$this->Exist=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Slno,Officer_name,Designation,Exist from officer where Slno='".$this->Slno."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Officer_name'])>0)
$this->Old_Officer_name=$row['Officer_name'];
else
$this->Old_Officer_name="NULL";
if (strlen($row['Designation'])>0)
$this->Old_Designation=$row['Designation'];
else
$this->Old_Designation="NULL";
if (strlen($row['Exist'])>0)
$this->Old_Exist=$row['Exist'];
else
$this->Old_Exist="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Slno,Officer_name,Designation,Exist from officer where Slno='".$this->Slno."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Officer_name=$row['Officer_name'];
$this->Designation=$row['Designation'];
$this->Exist=$row['Exist'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Slno from officer where Slno='".$this->Slno."'";
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
$sql="delete from officer where Slno='".$this->Slno."'";
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
if ($this->Old_Officer_name!=$this->Officer_name &&  strlen($this->Officer_name)>0)
{
if ($this->Officer_name=="NULL")
$sql=$sql."Officer_name=NULL";
else
$sql=$sql."Officer_name='".$this->Officer_name."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Officer_name=".$this->Officer_name.", ";
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

if ($this->Old_Exist!=$this->Exist &&  strlen($this->Exist)>0)
{
if ($this->Exist==0)
$sql=$sql."Exist=0";
else
$sql=$sql."Exist=1";
$i++;
$this->updateList=$this->updateList."Exist=".$this->Exist.", ";
}
else
$sql=$sql."Exist=Exist";


$cond="  where Slno='".$this->Slno."'";
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
if (strlen($this->Slno)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Slno";
if ($this->Slno=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Slno."'";
$this->updateList=$this->updateList."Slno=".$this->Slno.", ";
}

if (strlen($this->Officer_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Officer_name";
if ($this->Officer_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Officer_name."'";
$this->updateList=$this->updateList."Officer_name=".$this->Officer_name.", ";
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

if (strlen($this->Exist)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Exist";
if ($this->Exist==0)
$sql=$sql."0";
else
$sql=$sql."1";
$this->updateList=$this->updateList."Exist=".$this->Exist.", ";
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


public function maxSlno()
{
$sql="select max(Slno) from officer";
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
$sql="select Slno,Officer_name,Designation,Exist from officer where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Slno']=$row['Slno'];
$tRows[$i]['Officer_name']=$row['Officer_name'];
$tRows[$i]['Designation']=$row['Designation'];
$tRows[$i]['Exist']=$row['Exist'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Slno,Officer_name,Designation,Exist from officer where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Slno']=$row['Slno'];
$tRows[$i]['Officer_name']=$row['Officer_name'];
$tRows[$i]['Designation']=$row['Designation'];
$tRows[$i]['Exist']=$row['Exist'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
