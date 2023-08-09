<body>
<?php
require_once '../class/class.config.php';
class Petition_type
{
private $Code;
private $Detail;
private $Running;
private $Xohari_serviceid;
private $Abvr;

private $Fees;
//extra Old Variable to store Pre update Data
private $Old_Code;
private $Old_Detail;
private $Old_Running;
private $Old_Xohari_serviceid;
private $Old_Fees;
//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

private $Def_Running="Y";
private $Def_Xohari_serviceid="0";
//public function _construct($i) //for PHP6
public function Petition_type()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from petition_type";
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
$sql=" select count(*) from petition_type where ".$condition;
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
$sql="select Code,Detail,Abvr from petition_type where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Code']=$row['Code'];//Primary Key-1
$tRow[$i]['Detail']=$row['Detail'];//Posible Unique Field
$tRow[$i]['Abvr']=$row['Abvr'];//Posible Unique Field
$i++;
}
$this->returnSql=$sql;
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
//$Abvr
public function getAbvr()
{
return($this->Abvr);
}

public function setAbvr($str)
{
$this->Abvr=$str;
}


public function getDetail()
{
return($this->Detail);
}

public function setDetail($str)
{
$this->Detail=$str;
}

public function getFees()
{
return($this->Fees);
}

public function setFees($str)
{
$this->Fees=$str;
}

public function getRunning()
{
return($this->Running);
}

public function setRunning($str)
{
$this->Running=$str;
}

public function getXohari_serviceid()
{
return($this->Xohari_serviceid);
}

public function setXohari_serviceid($str)
{
$this->Xohari_serviceid=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Code,Detail,Running,Xohari_serviceid from petition_type where Code='".$this->Code."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Detail'])>0)
$this->Old_Detail=$row['Detail'];
else
$this->Old_Detail="NULL";

if (strlen($row['Fees'])>0)
$this->Old_Fees=$row['Fees'];
else
$this->Old_Fees="NULL";

if (strlen($row['Running'])>0)
$this->Old_Running=$row['Running'];
else
$this->Old_Running="NULL";
if (strlen($row['Xohari_serviceid'])>0)
$this->Old_Xohari_serviceid=$row['Xohari_serviceid'];
else
$this->Old_Xohari_serviceid="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Fees,Abvr, Code,Detail,Running,Xohari_serviceid from petition_type where Code='".$this->Code."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$mrow=mysql_fetch_array($result);
if ($mrow)
{
//$this->Available=true;
$this->Abvr=$mrow['Abvr'];
$this->Fees=$mrow['Fees'];
$this->Detail=$mrow['Detail'];
$this->Running=$mrow['Running'];
$this->Xohari_serviceid=$mrow['Xohari_serviceid'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Code from petition_type where Code='".$this->Code."'";
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
$sql="delete from petition_type where Code='".$this->Code."'";
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
$sql="update petition_type set ";
if ($this->Old_Detail!=$this->Detail &&  strlen($this->Detail)>0)
{
if ($this->Detail=="NULL")
$sql=$sql."Detail=NULL";
else
$sql=$sql."Detail='".$this->Detail."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Detail=".$this->Detail.", ";
}

if ($this->Old_Fees!=$this->Fees &&  strlen($this->Fees)>0)
{
if ($this->Fees=="NULL")
$sql=$sql."Fees=NULL";
else
$sql=$sql."Fees='".$this->Fees."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Fees=".$this->Fees.", ";
}

if ($this->Old_Running!=$this->Running &&  strlen($this->Running)>0)
{
if ($this->Running=="NULL")
$sql=$sql."Running=NULL";
else
$sql=$sql."Running='".$this->Running."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Running=".$this->Running.", ";
}

if ($this->Old_Xohari_serviceid!=$this->Xohari_serviceid &&  strlen($this->Xohari_serviceid)>0)
{
if ($this->Xohari_serviceid=="NULL")
$sql=$sql."Xohari_serviceid=NULL";
else
$sql=$sql."Xohari_serviceid='".$this->Xohari_serviceid."'";
$i++;
$this->updateList=$this->updateList."Xohari_serviceid=".$this->Xohari_serviceid.", ";
}
else
$sql=$sql."Xohari_serviceid=Xohari_serviceid";


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
$sql1="insert into petition_type(";
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

if (strlen($this->Fees)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Fees";
if ($this->Fees=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Fees."'";
$this->updateList=$this->updateList."Fees=".$this->Fees.", ";
}


if (strlen($this->Detail)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Detail";
if ($this->Detail=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Detail."'";
$this->updateList=$this->updateList."Detail=".$this->Detail.", ";
}

if (strlen($this->Running)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Running";
if ($this->Running=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Running."'";
$this->updateList=$this->updateList."Running=".$this->Running.", ";
}

if (strlen($this->Xohari_serviceid)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Xohari_serviceid";
if ($this->Xohari_serviceid=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Xohari_serviceid."'";
$this->updateList=$this->updateList."Xohari_serviceid=".$this->Xohari_serviceid.", ";
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


public function getAllRecord()
{
$tRows=array();
$sql="select Code,Detail,Running,Xohari_serviceid from petition_type where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Code']=$row['Code'];
$tRows[$i]['Detail']=$row['Detail'];
$tRows[$i]['Running']=$row['Running'];
$tRows[$i]['Xohari_serviceid']=$row['Xohari_serviceid'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Code,Detail,Running,Xohari_serviceid from petition_type where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Code']=$row['Code'];
$tRows[$i]['Detail']=$row['Detail'];
$tRows[$i]['Running']=$row['Running'];
$tRows[$i]['Xohari_serviceid']=$row['Xohari_serviceid'];
$i++;
} //End While
return($tRows);
} //End getAllRecord

public function ReceivedSummary($date)
{
$tRows=array();
$i=0;
$sql="select Pet_type,Count(*) from Petition_Master where Pet_date='".$date."' group by Pet_type having count(*)>0 order by Pet_type";
$result=mysql_query($sql);
//echo $sql;
//echo count($row)."<br>";
while ($row=mysql_fetch_array($result))
{
//echo  $i.".".$row[0]."=".$row[1]."<br>";   
$this->setCode($row[0]) ;  
if($this->EditRecord())
{
$tRows[$i]['Pet_type']=$this->getAbvr();
$tRows[$i]['Total']=$row[1];
$i++;
}
}
//echo "<br>i=".$i;
return($tRows);
}

public function ProcessedSummary($date)
{
$tRows=array();
$i=0;
$sql="select Pet_type,count(*) as Total from Petition_Master where AST='Y' and Process_date='".$date."' group by Pet_type having Total>0 order by Pet_type";
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$this->setCode($row['Pet_type']) ;  
if($this->EditRecord() && $row['Total']>0)
{
$tRows[$i]['Pet_type']=$this->getAbvr();
$tRows[$i]['Total']=$row['Total'];
$i++;
}
}
return($tRows);
}

public function PendingSummary($date)
{
$tRows=array();
$i=0;
$sql="select Pet_type,count(*) as Total from Petition_Master where AST='N' and Pet_date<='".$date."' group by Pet_type having Total>0 order by Pet_type";
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$this->setCode($row['Pet_type']) ;  
if($this->EditRecord() && $row['Total']>0)
{
$tRows[$i]['Pet_type']=$this->getAbvr();
$tRows[$i]['Total']=$row['Total'];
$i++;
}
}
return($tRows);
}

public function IssueSummary($date)
{
$tRows=array();
$i=0;
$sql="select Pet_type,count(*) as Total from Petition_Master where AST='Y' and Status='Issued' and  Issue_date='".$date."' group by Pet_type having Total>0 order by Pet_type";
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$this->setCode($row['Pet_type']) ;  
if($this->EditRecord() && $row['Total']>0)
{
$tRows[$i]['Pet_type']=$this->getAbvr();
$tRows[$i]['Total']=$row['Total'];
$i++;
}
}
return($tRows);
}

}//End Class
?>
