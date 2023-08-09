<?php
require_once '../class/class.config.php';
class Pfc_collection
{
private $Id;
private $Cal_yr;
private $Cal_month;
private $Sl_no;
private $Collection_date;
private $Jama_fee;
private $Er_fee;
private $Other_fee;
private $Total;

//extra Old Variable to store Pre update Data
private $Old_Id;
private $Old_Cal_yr;
private $Old_Cal_month;
private $Old_Sl_no;
private $Old_Collection_date;
private $Old_Jama_fee;
private $Old_Er_fee;
private $Old_Other_fee;
private $Old_Total;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

private $Def_Jama_fee="0";
private $Def_Er_fee="0";
private $Def_Other_fee="0";
//public function _construct($i) //for PHP6
public function Pfc_collection()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from pfc_collection";
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
$sql=" select count(*) from pfc_collection where ".$condition;
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
$sql="select Cal_yr,Cal_month,Cal_yr from pfc_collection where ".$this->condString;
$this->returnSql=$sql;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Cal_yr']=$row['Cal_yr'];//Primary Key-1
$tRow[$i]['Cal_month']=$row['Cal_month'];//Primary Key-2
$tRow[$i]['Cal_yr']=$row['Cal_yr'];//Posible Unique Field
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

public function getCal_yr()
{
return($this->Cal_yr);
}

public function setCal_yr($str)
{
$this->Cal_yr=$str;
}

public function getCal_month()
{
return($this->Cal_month);
}

public function setCal_month($str)
{
$this->Cal_month=$str;
}

public function getSl_no()
{
return($this->Sl_no);
}

public function setSl_no($str)
{
$this->Sl_no=$str;
}

public function getCollection_date()
{
return($this->Collection_date);
}

public function setCollection_date($str)
{
$this->Collection_date=$str;
}

public function getJama_fee()
{
return($this->Jama_fee);
}

public function setJama_fee($str)
{
$this->Jama_fee=$str;
}

public function getEr_fee()
{
return($this->Er_fee);
}

public function setEr_fee($str)
{
$this->Er_fee=$str;
}

public function getOther_fee()
{
return($this->Other_fee);
}

public function setOther_fee($str)
{
$this->Other_fee=$str;
}

public function getTotal()
{
return($this->Total);
}

public function setTotal($str)
{
$this->Total=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Id,Cal_yr,Cal_month,Sl_no,Collection_date,Jama_fee,Er_fee,Other_fee,Total from pfc_collection where Cal_yr='".$this->Cal_yr."' and Cal_month='".$this->Cal_month."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Id'])>0)
$this->Old_Id=$row['Id'];
else
$this->Old_Id="NULL";
if (strlen($row['Sl_no'])>0)
$this->Old_Sl_no=$row['Sl_no'];
else
$this->Old_Sl_no="NULL";
if (strlen($row['Collection_date'])>0)
$this->Old_Collection_date=substr($row['Collection_date'],0,10);
else
$this->Old_Collection_date="NULL";
if (strlen($row['Jama_fee'])>0)
$this->Old_Jama_fee=$row['Jama_fee'];
else
$this->Old_Jama_fee="NULL";
if (strlen($row['Er_fee'])>0)
$this->Old_Er_fee=$row['Er_fee'];
else
$this->Old_Er_fee="NULL";
if (strlen($row['Other_fee'])>0)
$this->Old_Other_fee=$row['Other_fee'];
else
$this->Old_Other_fee="NULL";
if (strlen($row['Total'])>0)
$this->Old_Total=$row['Total'];
else
$this->Old_Total="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Id,Cal_yr,Cal_month,Sl_no,Collection_date,Jama_fee,Er_fee,Other_fee,Total from pfc_collection where Cal_yr='".$this->Cal_yr."' and Cal_month='".$this->Cal_month."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Id=$row['Id'];
$this->Sl_no=$row['Sl_no'];
$this->Collection_date=$row['Collection_date'];
$this->Jama_fee=$row['Jama_fee'];
$this->Er_fee=$row['Er_fee'];
$this->Other_fee=$row['Other_fee'];
$this->Total=$row['Total'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Id from pfc_collection where Cal_yr='".$this->Cal_yr."' and Cal_month='".$this->Cal_month."'";
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
$sql="delete from pfc_collection where Cal_yr='".$this->Cal_yr."' and Cal_month='".$this->Cal_month."'";
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
$sql="update pfc_collection set ";
if ($this->Old_Id!=$this->Id &&  strlen($this->Id)>0)
{
if ($this->Id=="NULL")
$sql=$sql."Id=NULL";
else
$sql=$sql."Id='".$this->Id."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Id=".$this->Id.", ";
}

if ($this->Old_Sl_no!=$this->Sl_no &&  strlen($this->Sl_no)>0)
{
if ($this->Sl_no=="NULL")
$sql=$sql."Sl_no=NULL";
else
$sql=$sql."Sl_no='".$this->Sl_no."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Sl_no=".$this->Sl_no.", ";
}

if ($this->Old_Collection_date!=$this->Collection_date &&  strlen($this->Collection_date)>0)
{
if ($this->Collection_date=="NULL")
$sql=$sql."Collection_date=NULL";
else
$sql=$sql."Collection_date='".$this->Collection_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Collection_date=".$this->Collection_date.", ";
}

if ($this->Old_Jama_fee!=$this->Jama_fee &&  strlen($this->Jama_fee)>0)
{
if ($this->Jama_fee=="NULL")
$sql=$sql."Jama_fee=NULL";
else
$sql=$sql."Jama_fee='".$this->Jama_fee."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Jama_fee=".$this->Jama_fee.", ";
}

if ($this->Old_Er_fee!=$this->Er_fee &&  strlen($this->Er_fee)>0)
{
if ($this->Er_fee=="NULL")
$sql=$sql."Er_fee=NULL";
else
$sql=$sql."Er_fee='".$this->Er_fee."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Er_fee=".$this->Er_fee.", ";
}

if ($this->Old_Other_fee!=$this->Other_fee &&  strlen($this->Other_fee)>0)
{
if ($this->Other_fee=="NULL")
$sql=$sql."Other_fee=NULL";
else
$sql=$sql."Other_fee='".$this->Other_fee."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Other_fee=".$this->Other_fee.", ";
}

if ($this->Old_Total!=$this->Total &&  strlen($this->Total)>0)
{
if ($this->Total=="NULL")
$sql=$sql."Total=NULL";
else
$sql=$sql."Total='".$this->Total."'";
$i++;
$this->updateList=$this->updateList."Total=".$this->Total.", ";
}
else
$sql=$sql."Total=Total";


$cond="  where Cal_yr='".$this->Cal_yr."' and Cal_month='".$this->Cal_month."'";
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
$sql1="insert into pfc_collection(";
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

if (strlen($this->Cal_yr)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Cal_yr";
if ($this->Cal_yr=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Cal_yr."'";
$this->updateList=$this->updateList."Cal_yr=".$this->Cal_yr.", ";
}

if (strlen($this->Cal_month)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Cal_month";
if ($this->Cal_month=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Cal_month."'";
$this->updateList=$this->updateList."Cal_month=".$this->Cal_month.", ";
}

if (strlen($this->Sl_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Sl_no";
if ($this->Sl_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Sl_no."'";
$this->updateList=$this->updateList."Sl_no=".$this->Sl_no.", ";
}

if (strlen($this->Collection_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Collection_date";
if ($this->Collection_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Collection_date."'";
$this->updateList=$this->updateList."Collection_date=".$this->Collection_date.", ";
}

if (strlen($this->Jama_fee)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Jama_fee";
if ($this->Jama_fee=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Jama_fee."'";
$this->updateList=$this->updateList."Jama_fee=".$this->Jama_fee.", ";
}

if (strlen($this->Er_fee)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Er_fee";
if ($this->Er_fee=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Er_fee."'";
$this->updateList=$this->updateList."Er_fee=".$this->Er_fee.", ";
}

if (strlen($this->Other_fee)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Other_fee";
if ($this->Other_fee=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Other_fee."'";
$this->updateList=$this->updateList."Other_fee=".$this->Other_fee.", ";
}

if (strlen($this->Total)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Total";
if ($this->Total=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Total."'";
$this->updateList=$this->updateList."Total=".$this->Total.", ";
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


public function maxCal_yr()
{
$sql="select max(Cal_yr) from pfc_collection";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}
public function maxCal_month()
{
$sql="select max(Cal_month) from pfc_collection";
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
$sql="select Id,Cal_yr,Cal_month,Sl_no,Collection_date,Jama_fee,Er_fee,Other_fee,Total from pfc_collection where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Cal_yr']=$row['Cal_yr'];
$tRows[$i]['Cal_month']=$row['Cal_month'];
$tRows[$i]['Sl_no']=$row['Sl_no'];
$tRows[$i]['Collection_date']=$row['Collection_date'];
$tRows[$i]['Jama_fee']=$row['Jama_fee'];
$tRows[$i]['Er_fee']=$row['Er_fee'];
$tRows[$i]['Other_fee']=$row['Other_fee'];
$tRows[$i]['Total']=$row['Total'];
$i++;
} //End While
$this->returnSql=$sql;
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Id,Cal_yr,Cal_month,Sl_no,Collection_date,Jama_fee,Er_fee,Other_fee,Total from pfc_collection where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Cal_yr']=$row['Cal_yr'];
$tRows[$i]['Cal_month']=$row['Cal_month'];
$tRows[$i]['Sl_no']=$row['Sl_no'];
$tRows[$i]['Collection_date']=$row['Collection_date'];
$tRows[$i]['Jama_fee']=$row['Jama_fee'];
$tRows[$i]['Er_fee']=$row['Er_fee'];
$tRows[$i]['Other_fee']=$row['Other_fee'];
$tRows[$i]['Total']=$row['Total'];
$i++;
} //End While
$this->returnSql=$sql;
return($tRows);
} //End getAllRecord

public function Max($fld,$cond)
{
if(strlen($cond)<3)
$cond=true;
$sql="select max(".$fld.") from pfc_collection where ".$cond;
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
$sql="select sum(".$fld.") from pfc_collection where ".$cond;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
}

}//End Class
?>
