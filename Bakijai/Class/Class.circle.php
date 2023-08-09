<body>
<?php
require_once '../class/class.config.php';
class Circle
{
private $Cir_code;
private $Circle;
private $Circle_ass;

//extra Old Variable to store Pre update Data
private $Old_Cir_code;
private $Old_Circle;
private $Old_Circle_ass;

public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Circle()
{
$objConfig=new Config();//Connects database
$Available=false;
$rowCommitted=0;
$colUpdated=0;
$updateList="";
$sql=" select count(*) from circle";
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
$sql=" select count(*) from circle where ".$condition;
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
$sql="select Cir_code,Circle from circle where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Cir_code']=$row['Cir_code'];//Primary Key-1
$tRow[$i]['Circle']=$row['Circle'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getCir_code()
{
return($this->Cir_code);
}

public function setCir_code($str)
{
$this->Cir_code=$str;
}

public function getCircle()
{
return($this->Circle);
}

public function setCircle($str)
{
$this->Circle=$str;
}

public function getCircle_ass()
{
return($this->Circle_ass);
}

public function setCircle_ass($str)
{
$this->Circle_ass=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Cir_code,Circle,Circle_ass from circle where Cir_code='".$this->Cir_code."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Circle'])>0)
$this->Old_Circle=$row['Circle'];
else
$this->Old_Circle="NULL";
if (strlen($row['Circle_ass'])>0)
$this->Old_Circle_ass=$row['Circle_ass'];
else
$this->Old_Circle_ass="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Cir_code,Circle,Circle_ass from circle where Cir_code='".$this->Cir_code."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
$this->Available=true;
$this->Circle=$row['Circle'];
$this->Circle_ass=$row['Circle_ass'];
}
else
$this->Available=false;
$this->returnSql=$sql;
return($this->Available);
} //end editrecord


public function DeleteRecord()
{
$sql="delete from circle where Cir_code='".$this->Cir_code."'";
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
$sql="update circle set ";
if ($this->Old_Circle!=$this->Circle &&  strlen($this->Circle)>0)
{
if ($this->Circle=="NULL")
$sql=$sql."Circle=NULL";
else
$sql=$sql."Circle='".$this->Circle."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Circle=".$this->Circle.", ";
}

if ($this->Old_Circle_ass!=$this->Circle_ass &&  strlen($this->Circle_ass)>0)
{
if ($this->Circle_ass=="NULL")
$sql=$sql."Circle_ass=NULL";
else
$sql=$sql."Circle_ass='".$this->Circle_ass."'";
$i++;
$this->updateList=$this->updateList."Circle_ass=".$this->Circle_ass.", ";
}
else
$sql=$sql."Circle_ass=Circle_ass";


$cond="  where Cir_code='".$this->Cir_code."'";
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
$sql1="insert into circle(";
$sql=" values (";
$mcol=0;
if (strlen($this->Cir_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Cir_code";
if ($this->Cir_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Cir_code."'";
$this->updateList=$this->updateList."Cir_code=".$this->Cir_code.", ";
}

if (strlen($this->Circle)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Circle";
if ($this->Circle=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Circle."'";
$this->updateList=$this->updateList."Circle=".$this->Circle.", ";
}

if (strlen($this->Circle_ass)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Circle_ass";
if ($this->Circle_ass=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Circle_ass."'";
$this->updateList=$this->updateList."Circle_ass=".$this->Circle_ass.", ";
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


public function maxCir_code()
{
$sql="select max(Cir_code) from circle";
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
$sql="select Cir_code,Circle,Circle_ass from circle where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Cir_code']=$row['Cir_code'];
$tRows[$i]['Circle']=$row['Circle'];
$tRows[$i]['Circle_ass']=$row['Circle_ass'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Cir_code,Circle,Circle_ass from circle where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Cir_code']=$row['Cir_code'];
$tRows[$i]['Circle']=$row['Circle'];
$tRows[$i]['Circle_ass']=$row['Circle_ass'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
