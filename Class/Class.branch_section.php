<body>
<?php
require_once 'class.config.php';
class Branch_section
{
private $Branch_code;
private $Branch_name;

//extra Old Variable to store Pre update Data
private $Old_Branch_code;
private $Old_Branch_name;

public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Branch_section()
{
$objConfig=new Config();//Connects database
$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from branch_section";
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
$sql=" select count(*) from branch_section where ".$condition;
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
$sql="select Branch_code,Branch_name from branch_section where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Branch_code']=$row['Branch_code'];//Primary Key-1
$tRow[$i]['Branch_name']=$row['Branch_name'];//Posible Unique Field
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

public function getBranch_name()
{
return($this->Branch_name);
}

public function setBranch_name($str)
{
$this->Branch_name=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Branch_code,Branch_name from branch_section where Branch_code='".$this->Branch_code."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Branch_name'])>0)
$this->Old_Branch_name=$row['Branch_name'];
else
$this->Old_Branch_name="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Branch_code,Branch_name from branch_section where Branch_code='".$this->Branch_code."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
$this->Available=true;
$this->Branch_name=$row['Branch_name'];
}
else
$this->Available=false;
$this->returnSql=$sql;
return($this->Available);
} //end editrecord


public function DeleteRecord()
{
$sql="delete from branch_section where Branch_code='".$this->Branch_code."'";
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
$sql="update branch_section set ";
if ($this->Old_Branch_name!=$this->Branch_name &&  strlen($this->Branch_name)>0)
{
if ($this->Branch_name=="NULL")
$sql=$sql."Branch_name=NULL";
else
$sql=$sql."Branch_name='".$this->Branch_name."'";
$i++;
$this->updateList=$this->updateList."Branch_name=".$this->Branch_name.", ";
}
else
$sql=$sql."Branch_name=Branch_name";


$cond="  where Branch_code='".$this->Branch_code."'";
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
$sql1="insert into branch_section(";
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

if (strlen($this->Branch_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Branch_name";
if ($this->Branch_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Branch_name."'";
$this->updateList=$this->updateList."Branch_name=".$this->Branch_name.", ";
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


public function maxBranch_code()
{
$sql="select max(Branch_code) from branch_section";
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
$sql="select Branch_code,Branch_name from branch_section where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Branch_code']=$row['Branch_code'];
$tRows[$i]['Branch_name']=$row['Branch_name'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Branch_code,Branch_name from branch_section where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Branch_code']=$row['Branch_code'];
$tRows[$i]['Branch_name']=$row['Branch_name'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
