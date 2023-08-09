<body>
<?php
require_once '../class/class.config.php';
class Village
{
private $Vill_code;
private $Vill_name;
private $Cir_code;
private $Vill_name_ass;
private $Revenue_Village;
//extra Old Variable to store Pre update Data
private $Old_Vill_code;
private $Old_Vill_name;
private $Old_Cir_code;
private $Old_Vill_name_ass;

public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Village()
{
$objConfig=new Config();//Connects database
$Available=false;
$rowCommitted=0;
$colUpdated=0;
$updateList="";
$sql=" select count(*) from village";
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
$sql=" select count(*) from village where ".$condition;
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
$sql="select Vill_code,Vill_name,Vill_name_ass from village where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Vill_code']=$row['Vill_code'];//Primary Key-1
$tRow[$i]['Vill_name']=$row['Vill_name'];//Posible Unique Field
$tRow[$i]['Vill_name_ass']=$row['Vill_name_ass'];
$i++;
}
return($tRow);
}
//$Revenue_Village

public function getRevenue_Village()
{
return($this->Revenue_Village);
}

public function setRevenue_Village($str)
{
$this->Revenue_Village=$str;
}



public function getVill_code()
{
return($this->Vill_code);
}

public function setVill_code($str)
{
$this->Vill_code=$str;
}

public function getVill_name()
{
return($this->Vill_name);
}

public function setVill_name($str)
{
$this->Vill_name=$str;
}

public function getCir_code()
{
return($this->Cir_code);
}

public function setCir_code($str)
{
$this->Cir_code=$str;
}

public function getVill_name_ass()
{
return($this->Vill_name_ass);
}

public function setVill_name_ass($str)
{
$this->Vill_name_ass=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Vill_code,Vill_name,Cir_code,Vill_name_ass from village where Vill_code='".$this->Vill_code."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Vill_name'])>0)
$this->Old_Vill_name=$row['Vill_name'];
else
$this->Old_Vill_name="NULL";
if (strlen($row['Cir_code'])>0)
$this->Old_Cir_code=$row['Cir_code'];
else
$this->Old_Cir_code="NULL";
if (strlen($row['Vill_name_ass'])>0)
$this->Old_Vill_name_ass=$row['Vill_name_ass'];
else
$this->Old_Vill_name_ass="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Vill_code,Vill_name,Cir_code,Vill_name_ass,Revenue_Village from village where Vill_code='".$this->Vill_code."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
$this->Available=true;
$this->Vill_name=$row['Vill_name'];
$this->Cir_code=$row['Cir_code'];
$this->Vill_name_ass=$row['Vill_name_ass'];
$this->Revenue_Village=$row['Revenue_Village'];
}
else
$this->Available=false;
$this->returnSql=$sql;
return($this->Available);
} //end editrecord


public function DeleteRecord()
{
$sql="delete from village where Vill_code='".$this->Vill_code."'";
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
$sql="update village set ";
if ($this->Old_Vill_name!=$this->Vill_name &&  strlen($this->Vill_name)>0)
{
if ($this->Vill_name=="NULL")
$sql=$sql."Vill_name=NULL";
else
$sql=$sql."Vill_name='".$this->Vill_name."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Vill_name=".$this->Vill_name.", ";
}

if ($this->Old_Cir_code!=$this->Cir_code &&  strlen($this->Cir_code)>0)
{
if ($this->Cir_code=="NULL")
$sql=$sql."Cir_code=NULL";
else
$sql=$sql."Cir_code='".$this->Cir_code."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Cir_code=".$this->Cir_code.", ";
}
//Revenue_Village
$sql=$sql."Revenue_Village=".$this->Revenue_Village;
$sql=$sql.",";
$i++;

if ($this->Old_Vill_name_ass!=$this->Vill_name_ass &&  strlen($this->Vill_name_ass)>0)
{
if ($this->Vill_name_ass=="NULL")
$sql=$sql."Vill_name_ass=NULL";
else
$sql=$sql."Vill_name_ass='".$this->Vill_name_ass."'";
$i++;
$this->updateList=$this->updateList."Vill_name_ass=".$this->Vill_name_ass.", ";
}
else
$sql=$sql."Vill_name_ass=Vill_name_ass";


$cond="  where Vill_code='".$this->Vill_code."'";
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
$sql1="insert into village(";
$sql=" values (";
$mcol=0;
if (strlen($this->Vill_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Vill_code";
if ($this->Vill_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Vill_code."'";
$this->updateList=$this->updateList."Vill_code=".$this->Vill_code.", ";
}
//Revenue_Village
if (strlen($this->Revenue_Village)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Revenue_Village";
if ($this->Revenue_Village=="NULL")
$sql=$sql."NULL";
else
$sql=$sql.$this->Revenue_Village;
//$this->updateList=$this->updateList."Revenue_Village=".$this->Vill_code.", ";
}

if (strlen($this->Vill_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Vill_name";
if ($this->Vill_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Vill_name."'";
$this->updateList=$this->updateList."Vill_name=".$this->Vill_name.", ";
}

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

if (strlen($this->Vill_name_ass)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Vill_name_ass";
if ($this->Vill_name_ass=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Vill_name_ass."'";
$this->updateList=$this->updateList."Vill_name_ass=".$this->Vill_name_ass.", ";
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


public function maxVill_code()
{
$sql="select max(Vill_code) from village";
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
$sql="select Vill_code,Vill_name,Cir_code,Vill_name_ass from village where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Vill_code']=$row['Vill_code'];
$tRows[$i]['Vill_name']=$row['Vill_name'];
$tRows[$i]['Cir_code']=$row['Cir_code'];
$tRows[$i]['Vill_name_ass']=$row['Vill_name_ass'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Vill_code,Vill_name,Cir_code,Vill_name_ass from village where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Vill_code']=$row['Vill_code'];
$tRows[$i]['Vill_name']=$row['Vill_name'];
$tRows[$i]['Cir_code']=$row['Cir_code'];
$tRows[$i]['Vill_name_ass']=$row['Vill_name_ass'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
