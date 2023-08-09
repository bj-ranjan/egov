<?php
require_once 'class.config.php';
class Monthname
{
private $Monthcode;
private $Montheng;
private $No_days;

//extra Old Variable to store Pre update Data
private $Old_Monthcode;
private $Old_Montheng;
private $Old_No_days;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Monthname()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from monthname";
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
$sql=" select count(*) from monthname where ".$condition;
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
$sql="select Monthcode,Montheng from monthname where ".$this->condString;
$this->returnSql=$sql;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Monthcode']=$row['Monthcode'];//Primary Key-1
$tRow[$i]['Montheng']=$row['Montheng'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getMonthcode()
{
return($this->Monthcode);
}

public function setMonthcode($str)
{
$this->Monthcode=$str;
}

public function getMontheng()
{
return($this->Montheng);
}

public function setMontheng($str)
{
$this->Montheng=$str;
}

public function getNo_days()
{
return($this->No_days);
}

public function setNo_days($str)
{
$this->No_days=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Monthcode,Montheng,No_days from monthname where Monthcode='".$this->Monthcode."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Montheng'])>0)
$this->Old_Montheng=$row['Montheng'];
else
$this->Old_Montheng="NULL";
if (strlen($row['No_days'])>0)
$this->Old_No_days=$row['No_days'];
else
$this->Old_No_days="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Monthcode,Montheng,No_days from monthname where Monthcode='".$this->Monthcode."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Montheng=$row['Montheng'];
$this->No_days=$row['No_days'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Monthcode from monthname where Monthcode='".$this->Monthcode."'";
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
$sql="delete from monthname where Monthcode='".$this->Monthcode."'";
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
$sql="update monthname set ";
if ($this->Old_Montheng!=$this->Montheng &&  strlen($this->Montheng)>0)
{
if ($this->Montheng=="NULL")
$sql=$sql."Montheng=NULL";
else
$sql=$sql."Montheng='".$this->Montheng."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Montheng=".$this->Montheng.", ";
}

if ($this->Old_No_days!=$this->No_days &&  strlen($this->No_days)>0)
{
if ($this->No_days=="NULL")
$sql=$sql."No_days=NULL";
else
$sql=$sql."No_days='".$this->No_days."'";
$i++;
$this->updateList=$this->updateList."No_days=".$this->No_days.", ";
}
else
$sql=$sql."No_days=No_days";


$cond="  where Monthcode='".$this->Monthcode."'";
$this->returnSql=$sql.$cond;
$this->colUpdated=$i;

if (mysql_query($sql.$cond))
{
$this->rowCommitted= mysql_affected_rows();
return(true);
}
else
return(false);
}//End Update Record



public function SaveRecord()
{
$this->updateList="";
$sql1="insert into monthname(";
$sql=" values (";
$mcol=0;
if (strlen($this->Monthcode)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Monthcode";
if ($this->Monthcode=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Monthcode."'";
$this->updateList=$this->updateList."Monthcode=".$this->Monthcode.", ";
}

if (strlen($this->Montheng)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Montheng";
if ($this->Montheng=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Montheng."'";
$this->updateList=$this->updateList."Montheng=".$this->Montheng.", ";
}

if (strlen($this->No_days)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."No_days";
if ($this->No_days=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->No_days."'";
$this->updateList=$this->updateList."No_days=".$this->No_days.", ";
}

$sql1=$sql1.")";
$sql=$sql.")";
$sqlstring=$sql1.$sql;
$this->returnSql=$sqlstring;

if (mysql_query($sqlstring))
{
$this->rowCommitted= mysql_affected_rows();
$this->colUpdated=$mcol;
return(true);
}
else
{
$this->colUpdated=0;
return(false);
}
}//End Save Record


public function maxMonthcode()
{
$sql="select max(Monthcode) from monthname";
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
$sql="select Monthcode,Montheng,No_days from monthname where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Monthcode']=$row['Monthcode'];
$tRows[$i]['Montheng']=$row['Montheng'];
$tRows[$i]['No_days']=$row['No_days'];
$i++;
} //End While
$this->returnSql=$sql;
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Monthcode,Montheng,No_days from monthname where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Monthcode']=$row['Monthcode'];
$tRows[$i]['Montheng']=$row['Montheng'];
$tRows[$i]['No_days']=$row['No_days'];
$i++;
} //End While
$this->returnSql=$sql;
return($tRows);
} //End getAllRecord

public function Max($fld,$cond)
{
if(strlen($cond)<3)
$cond=true;
$sql="select max(".$fld.") from monthname where ".$cond;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
}

public function Sum($fld,$cond)
{
if(strlen($cond)<3)
$cond=true;
$sql="select sum(".$fld.") from monthname where ".$cond;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
}

}//End Class
?>
