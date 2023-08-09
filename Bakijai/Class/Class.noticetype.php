<body>
<?php
require_once '../class/class.config.php';
class Noticetype
{
private $Code;
private $Noticedetail;

//extra Old Variable to store Pre update Data
private $Old_Code;
private $Old_Noticedetail;

public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Noticetype()
{
$objConfig=new Config();//Connects database
$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from noticetype";
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
$sql=" select count(*) from noticetype where ".$condition;
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
$sql="select Code,Noticedetail from noticetype where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Code']=$row['Code'];//Primary Key-1
$tRow[$i]['Noticedetail']=$row['Noticedetail'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getCode()
{
return($this->Code);
}

public function setCode($str)
{
$this->Code=$str;
}

public function getNoticedetail()
{
return($this->Noticedetail);
}

public function setNoticedetail($str)
{
$this->Noticedetail=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Code,Noticedetail from noticetype where Code='".$this->Code."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Noticedetail'])>0)
$this->Old_Noticedetail=$row['Noticedetail'];
else
$this->Old_Noticedetail="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Code,Noticedetail from noticetype where Code='".$this->Code."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
$this->Available=true;
$this->Noticedetail=$row['Noticedetail'];
}
else
$this->Available=false;
$this->returnSql=$sql;
return($this->Available);
} //end editrecord


public function DeleteRecord()
{
$sql="delete from noticetype where Code='".$this->Code."'";
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
$sql="update noticetype set ";
if ($this->Old_Noticedetail!=$this->Noticedetail &&  strlen($this->Noticedetail)>0)
{
if ($this->Noticedetail=="NULL")
$sql=$sql."Noticedetail=NULL";
else
$sql=$sql."Noticedetail='".$this->Noticedetail."'";
$i++;
$this->updateList=$this->updateList."Noticedetail=".$this->Noticedetail.", ";
}
else
$sql=$sql."Noticedetail=Noticedetail";


$cond="  where Code='".$this->Code."'";
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
$sql1="insert into noticetype(";
$sql=" values (";
$mcol=0;
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

if (strlen($this->Noticedetail)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Noticedetail";
if ($this->Noticedetail=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Noticedetail."'";
$this->updateList=$this->updateList."Noticedetail=".$this->Noticedetail.", ";
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


public function maxCode()
{
$sql="select max(Code) from noticetype";
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
$sql="select Code,Noticedetail from noticetype where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Code']=$row['Code'];
$tRows[$i]['Noticedetail']=$row['Noticedetail'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Code,Noticedetail from noticetype where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Code']=$row['Code'];
$tRows[$i]['Noticedetail']=$row['Noticedetail'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
