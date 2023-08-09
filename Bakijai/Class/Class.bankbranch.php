<body>
<?php
require_once '../class/class.config.php';
class Bankbranch
{
private $Rsl;
private $Bank;
private $Branch;

//extra Old Variable to store Pre update Data
private $Old_Rsl;
private $Old_Bank;
private $Old_Branch;

public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Bankbranch()
{
$objConfig=new Config();//Connects database
$Available=false;
$rowCommitted=0;
$colUpdated=0;
$updateList="";
$sql=" select count(*) from bankbranch";
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
$sql=" select count(*) from bankbranch where ".$condition;
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
$sql="select Bank,Branch,Branch from bankbranch where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Bank']=$row['Bank'];//Primary Key-1
$tRow[$i]['Branch']=$row['Branch'];//Primary Key-2
$i++;
}
return($tRow);
}


public function getRsl()
{
return($this->Rsl);
}

public function setRsl($str)
{
$this->Rsl=$str;
}

public function getBank()
{
return($this->Bank);
}

public function setBank($str)
{
$this->Bank=$str;
}

public function getBranch()
{
return($this->Branch);
}

public function setBranch($str)
{
$this->Branch=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Rsl,Bank,Branch from bankbranch where Bank='".$this->Bank."' and Branch='".$this->Branch."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Rsl'])>0)
$this->Old_Rsl=$row['Rsl'];
else
$this->Old_Rsl="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Rsl,Bank,Branch from bankbranch where Bank='".$this->Bank."' and Branch='".$this->Branch."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
$this->Available=true;
$this->Rsl=$row['Rsl'];
}
else
$this->Available=false;
$this->returnSql=$sql;
return($this->Available);
} //end editrecord

public function maxRsl()
{
$sql="select max(rsl) from bankbranch";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}

public function DeleteRecord()
{
$sql="delete from bankbranch where Bank='".$this->Bank."' and Branch='".$this->Branch."'";
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
$sql="update bankbranch set ";
if ($this->Old_Rsl!=$this->Rsl &&  strlen($this->Rsl)>0)
{
if ($this->Rsl=="NULL")
$sql=$sql."Rsl=NULL";
else
$sql=$sql."Rsl='".$this->Rsl."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Rsl=".$this->Rsl.", ";
}


$cond="  where Bank='".$this->Bank."' and Branch='".$this->Branch."'";
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
$sql1="insert into bankbranch(";
$sql=" values (";
$mcol=0;
if (strlen($this->Rsl)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Rsl";
if ($this->Rsl=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Rsl."'";
$this->updateList=$this->updateList."Rsl=".$this->Rsl.", ";
}

if (strlen($this->Bank)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Bank";
if ($this->Bank=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Bank."'";
$this->updateList=$this->updateList."Bank=".$this->Bank.", ";
}

if (strlen($this->Branch)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Branch";
if ($this->Branch=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Branch."'";
$this->updateList=$this->updateList."Branch=".$this->Branch.", ";
}

$sql1=$sql1.")";
$sql=$sql.")";
$sqlstring=$sql1.$sql;
$this->returnSql=$sqlstring;
$this->rowCommitted= mysql_affected_rows();

if (mysql_query($sqlstring))
return(true);
else
return(false);
}//End Save Record


public function getAllRecord()
{
$tRows=array();
$sql="select Rsl,Bank,Branch from bankbranch where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Rsl']=$row['Rsl'];
$tRows[$i]['Bank']=$row['Bank'];
$tRows[$i]['Branch']=$row['Branch'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Rsl,Bank,Branch from bankbranch where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Rsl']=$row['Rsl'];
$tRows[$i]['Bank']=$row['Bank'];
$tRows[$i]['Branch']=$row['Branch'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
