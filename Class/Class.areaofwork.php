<body>
<?php
require_once 'class.config.php';
class Areaofwork
{
private $Branch_code;
private $Area_code;
private $Area_name;

//extra Old Variable to store Pre update Data
private $Old_Branch_code;
private $Old_Area_code;
private $Old_Area_name;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Areaofwork()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from areaofwork";
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
$sql=" select count(*) from areaofwork where ".$condition;
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
$sql="select Area_code,Area_name from areaofwork where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Area_code']=$row['Area_code'];//Primary Key-1
$tRow[$i]['Area_name']=$row['Area_name'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getBranch_code()
{
return($this->Branch_code);
}

public function setBranch_code($str)
{
$this->Branch_code=$str;
}

public function getArea_code()
{
return($this->Area_code);
}

public function setArea_code($str)
{
$this->Area_code=$str;
}

public function getArea_name()
{
return($this->Area_name);
}

public function setArea_name($str)
{
$this->Area_name=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Branch_code,Area_code,Area_name from areaofwork where Area_code='".$this->Area_code."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Branch_code'])>0)
$this->Old_Branch_code=$row['Branch_code'];
else
$this->Old_Branch_code="NULL";
if (strlen($row['Area_name'])>0)
$this->Old_Area_name=$row['Area_name'];
else
$this->Old_Area_name="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Branch_code,Area_code,Area_name from areaofwork where Area_code='".$this->Area_code."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Branch_code=$row['Branch_code'];
$this->Area_name=$row['Area_name'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Branch_code from areaofwork where Area_code='".$this->Area_code."'";
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
$sql="delete from areaofwork where Area_code='".$this->Area_code."'";
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
$sql="update areaofwork set ";
if ($this->Old_Branch_code!=$this->Branch_code &&  strlen($this->Branch_code)>0)
{
if ($this->Branch_code=="NULL")
$sql=$sql."Branch_code=NULL";
else
$sql=$sql."Branch_code='".$this->Branch_code."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Branch_code=".$this->Branch_code.", ";
}

if ($this->Old_Area_name!=$this->Area_name &&  strlen($this->Area_name)>0)
{
if ($this->Area_name=="NULL")
$sql=$sql."Area_name=NULL";
else
$sql=$sql."Area_name='".$this->Area_name."'";
$i++;
$this->updateList=$this->updateList."Area_name=".$this->Area_name.", ";
}
else
$sql=$sql."Area_name=Area_name";


$cond="  where Area_code='".$this->Area_code."'";
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
$sql1="insert into areaofwork(";
$sql=" values (";
$mcol=0;
if (strlen($this->Branch_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Branch_code";
if ($this->Branch_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Branch_code."'";
$this->updateList=$this->updateList."Branch_code=".$this->Branch_code.", ";
}

if (strlen($this->Area_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Area_code";
if ($this->Area_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Area_code."'";
$this->updateList=$this->updateList."Area_code=".$this->Area_code.", ";
}

if (strlen($this->Area_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Area_name";
if ($this->Area_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Area_name."'";
$this->updateList=$this->updateList."Area_name=".$this->Area_name.", ";
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


public function maxArea_code()
{
$sql="select max(Area_code) from areaofwork";
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
$sql="select Branch_code,Area_code,Area_name from areaofwork where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Branch_code']=$row['Branch_code'];
$tRows[$i]['Area_code']=$row['Area_code'];
$tRows[$i]['Area_name']=$row['Area_name'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Branch_code,Area_code,Area_name from areaofwork where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Branch_code']=$row['Branch_code'];
$tRows[$i]['Area_code']=$row['Area_code'];
$tRows[$i]['Area_name']=$row['Area_name'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
