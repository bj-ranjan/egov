<body>
<?php
require_once '../class/class.config.php';
class Update_history
{
private $Case_id;
private $Rsl;
private $Detail;
private $User_code;
private $Entry_date;

//extra Old Variable to store Pre update Data
private $Old_Case_id;
private $Old_Rsl;
private $Old_Detail;
private $Old_User_code;
private $Old_Entry_date;

public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

private $Def_Case_id="0";
private $Def_Rsl="0";
//public function _construct($i) //for PHP6
public function Update_history()
{
$objConfig=new Config();//Connects database
$Available=false;
$rowCommitted=0;
$colUpdated=0;
$updateList="";
$sql=" select count(*) from update_history";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
$this->recordCount=$row[0];
else
$this->recordCount=0;
$this->condString="1=1";

$this->User_code=$_SESSION['uid'];
$this->Entry_date=date('Y-m-d');
}//End constructor

public function ExecuteQuery($sql)
{
$result=mysql_query($sql);
$this->rowCommitted= mysql_affected_rows();
return($result);
}

public function rowCount($condition)
{
$sql=" select count(*) from update_history where ".$condition;
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
$sql="select Case_id,Rsl,Detail from update_history where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Case_id']=$row['Case_id'];//Primary Key-1
$tRow[$i]['Rsl']=$row['Rsl'];//Primary Key-2
$tRow[$i]['Detail']=$row['Detail'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getCase_id()
{
return($this->Case_id);
}

public function setCase_id($str)
{
$this->Case_id=$str;
}

public function getRsl()
{
return($this->Rsl);
}

public function setRsl($str)
{
$this->Rsl=$str;
}

public function getDetail()
{
return($this->Detail);
}

public function setDetail($str)
{
$this->Detail=$str;
}

public function getUser_code()
{
return($this->User_code);
}

public function setUser_code($str)
{
$this->User_code=$str;
}

public function getEntry_date()
{
return($this->Entry_date);
}

public function setEntry_date($str)
{
$this->Entry_date=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Case_id,Rsl,Detail,User_code,Entry_date from update_history where Case_id='".$this->Case_id."' and Rsl='".$this->Rsl."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Detail'])>0)
$this->Old_Detail=$row['Detail'];
else
$this->Old_Detail="NULL";
if (strlen($row['User_code'])>0)
$this->Old_User_code=$row['User_code'];
else
$this->Old_User_code="NULL";
if (strlen($row['Entry_date'])>0)
$this->Old_Entry_date=substr($row['Entry_date'],0,10);
else
$this->Old_Entry_date="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Case_id,Rsl,Detail,User_code,Entry_date from update_history where Case_id='".$this->Case_id."' and Rsl='".$this->Rsl."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
$this->Available=true;
$this->Detail=$row['Detail'];
$this->User_code=$row['User_code'];
$this->Entry_date=$row['Entry_date'];
}
else
$this->Available=false;
$this->returnSql=$sql;
return($this->Available);
} //end editrecord


public function DeleteRecord()
{
$sql="delete from update_history where Case_id='".$this->Case_id."' and Rsl='".$this->Rsl."'";
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
$sql="update update_history set ";
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

if ($this->Old_User_code!=$this->User_code &&  strlen($this->User_code)>0)
{
if ($this->User_code=="NULL")
$sql=$sql."User_code=NULL";
else
$sql=$sql."User_code='".$this->User_code."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."User_code=".$this->User_code.", ";
}

if ($this->Old_Entry_date!=$this->Entry_date &&  strlen($this->Entry_date)>0)
{
if ($this->Entry_date=="NULL")
$sql=$sql."Entry_date=NULL";
else
$sql=$sql."Entry_date='".$this->Entry_date."'";
$i++;
$this->updateList=$this->updateList."Entry_date=".$this->Entry_date.", ";
}
else
$sql=$sql."Entry_date=Entry_date";


$cond="  where Case_id='".$this->Case_id."' and Rsl='".$this->Rsl."'";
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
$sql1="insert into update_history(";
$sql=" values (";
$mcol=0;
if (strlen($this->Case_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Case_id";
if ($this->Case_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Case_id."'";
$this->updateList=$this->updateList."Case_id=".$this->Case_id.", ";
}

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

if (strlen($this->User_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."User_code";
if ($this->User_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->User_code."'";
$this->updateList=$this->updateList."User_code=".$this->User_code.", ";
}

if (strlen($this->Entry_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Entry_date";
if ($this->Entry_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Entry_date."'";
$this->updateList=$this->updateList."Entry_date=".$this->Entry_date.", ";
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


public function maxCase_id()
{
$sql="select max(Case_id) from update_history";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}
public function maxRsl($i)
{
$sql="select max(Rsl) from update_history where case_id=".$i;
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
$sql="select Case_id,Rsl,Detail,User_code,Entry_date from update_history where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['Rsl']=$row['Rsl'];
$tRows[$i]['Detail']=$row['Detail'];
$tRows[$i]['User_code']=$row['User_code'];
$tRows[$i]['Entry_date']=$row['Entry_date'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Case_id,Rsl,Detail,User_code,Entry_date from update_history where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['Rsl']=$row['Rsl'];
$tRows[$i]['Detail']=$row['Detail'];
$tRows[$i]['User_code']=$row['User_code'];
$tRows[$i]['Entry_date']=$row['Entry_date'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
