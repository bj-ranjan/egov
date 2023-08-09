<body>
<?php
require_once '../class/class.config.php';
class Bakijai_casedate
{
private $Case_id;
private $Day;
private $Notice_type;
private $Appeared;
private $Appeared_date;
private $Action_taken;
private $Note_of_action;
private $Entry_date;
private $Next_date;

//extra Old Variable to store Pre update Data
private $Old_Case_id;
private $Old_Day;
private $Old_Notice_type;
private $Old_Appeared;
private $Old_Appeared_date;
private $Old_Action_taken;
private $Old_Note_of_action;
private $Old_Entry_date;
private $Old_Next_date;

public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

private $Def_Appeared="N";
private $Def_Action_taken="N";
//public function _construct($i) //for PHP6
public function Bakijai_casedate()
{
$objConfig=new Config();//Connects database
$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from bakijai_casedate";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
$this->recordCount=$row[0];
else
$this->recordCount=0;
$this->condString="1=1";
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
$sql=" select count(*) from bakijai_casedate where ".$condition;
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
$sql="select Case_id,Day,Appeared from bakijai_casedate where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Case_id']=$row['Case_id'];//Primary Key-1
$tRow[$i]['Day']=$row['Day'];//Primary Key-2
$tRow[$i]['Appeared']=$row['Appeared'];//Posible Unique Field
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

public function getDay()
{
return($this->Day);
}

public function setDay($str)
{
$this->Day=$str;
}

public function getNotice_type()
{
return($this->Notice_type);
}

public function setNotice_type($str)
{
$this->Notice_type=$str;
}

public function getAppeared()
{
return($this->Appeared);
}

public function setAppeared($str)
{
$this->Appeared=$str;
}

public function getAppeared_date()
{
return($this->Appeared_date);
}

public function setAppeared_date($str)
{
$this->Appeared_date=$str;
}

public function getAction_taken()
{
return($this->Action_taken);
}

public function setAction_taken($str)
{
$this->Action_taken=$str;
}

public function getNote_of_action()
{
return($this->Note_of_action);
}

public function setNote_of_action($str)
{
$this->Note_of_action=$str;
}

public function getEntry_date()
{
return($this->Entry_date);
}

public function setEntry_date($str)
{
$this->Entry_date=$str;
}

public function getNext_date()
{
return($this->Next_date);
}

public function setNext_date($str)
{
$this->Next_date=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Case_id,Day,Notice_type,Appeared,Appeared_date,Action_taken,Note_of_action,Entry_date,Next_date from bakijai_casedate where Case_id='".$this->Case_id."' and Day='".$this->Day."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Notice_type'])>0)
$this->Old_Notice_type=$row['Notice_type'];
else
$this->Old_Notice_type="NULL";
if (strlen($row['Appeared'])>0)
$this->Old_Appeared=$row['Appeared'];
else
$this->Old_Appeared="NULL";
if (strlen($row['Appeared_date'])>0)
$this->Old_Appeared_date=substr($row['Appeared_date'],0,10);
else
$this->Old_Appeared_date="NULL";
if (strlen($row['Action_taken'])>0)
$this->Old_Action_taken=$row['Action_taken'];
else
$this->Old_Action_taken="NULL";
if (strlen($row['Note_of_action'])>0)
$this->Old_Note_of_action=$row['Note_of_action'];
else
$this->Old_Note_of_action="NULL";
if (strlen($row['Entry_date'])>0)
$this->Old_Entry_date=substr($row['Entry_date'],0,10);
else
$this->Old_Entry_date="NULL";
if (strlen($row['Next_date'])>0)
$this->Old_Next_date=substr($row['Next_date'],0,10);
else
$this->Old_Next_date="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Case_id,Day,Notice_type,Appeared,Appeared_date,Action_taken,Note_of_action,Entry_date,Next_date from bakijai_casedate where Case_id='".$this->Case_id."' and Day='".$this->Day."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
$this->Available=true;
$this->Notice_type=$row['Notice_type'];
$this->Appeared=$row['Appeared'];
$this->Appeared_date=$row['Appeared_date'];
$this->Action_taken=$row['Action_taken'];
$this->Note_of_action=$row['Note_of_action'];
$this->Entry_date=$row['Entry_date'];
$this->Next_date=$row['Next_date'];
}
else
$this->Available=false;
$this->returnSql=$sql;
return($this->Available);
} //end editrecord


public function DeleteRecord()
{
$sql="delete from bakijai_casedate where Case_id='".$this->Case_id."' and Day='".$this->Day."'";
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
$sql="update bakijai_casedate set ";
if ($this->Old_Notice_type!=$this->Notice_type &&  strlen($this->Notice_type)>0)
{
if ($this->Notice_type=="NULL")
$sql=$sql."Notice_type=NULL";
else
$sql=$sql."Notice_type='".$this->Notice_type."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Notice_type=".$this->Notice_type.", ";
}

if ($this->Old_Appeared!=$this->Appeared &&  strlen($this->Appeared)>0)
{
if ($this->Appeared=="NULL")
$sql=$sql."Appeared=NULL";
else
$sql=$sql."Appeared='".$this->Appeared."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Appeared=".$this->Appeared.", ";
}

if ($this->Old_Appeared_date!=$this->Appeared_date &&  strlen($this->Appeared_date)>0)
{
if ($this->Appeared_date=="NULL")
$sql=$sql."Appeared_date=NULL";
else
$sql=$sql."Appeared_date='".$this->Appeared_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Appeared_date=".$this->Appeared_date.", ";
}

if ($this->Old_Action_taken!=$this->Action_taken &&  strlen($this->Action_taken)>0)
{
if ($this->Action_taken=="NULL")
$sql=$sql."Action_taken=NULL";
else
$sql=$sql."Action_taken='".$this->Action_taken."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Action_taken=".$this->Action_taken.", ";
}

if ($this->Old_Note_of_action!=$this->Note_of_action &&  strlen($this->Note_of_action)>0)
{
if ($this->Note_of_action=="NULL")
$sql=$sql."Note_of_action=NULL";
else
$sql=$sql."Note_of_action='".$this->Note_of_action."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Note_of_action=".$this->Note_of_action.", ";
}

if ($this->Old_Entry_date!=$this->Entry_date &&  strlen($this->Entry_date)>0)
{
if ($this->Entry_date=="NULL")
$sql=$sql."Entry_date=NULL";
else
$sql=$sql."Entry_date='".$this->Entry_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Entry_date=".$this->Entry_date.", ";
}

if ($this->Old_Next_date!=$this->Next_date &&  strlen($this->Next_date)>0)
{
if ($this->Next_date=="NULL")
$sql=$sql."Next_date=NULL";
else
$sql=$sql."Next_date='".$this->Next_date."'";
$i++;
$this->updateList=$this->updateList."Next_date=".$this->Next_date.", ";
}
else
$sql=$sql."Next_date=Next_date";


$cond="  where Case_id=".$this->Case_id." and Day=".$this->Day;
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
$sql1="insert into bakijai_casedate(";
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
$sql=$sql."".$this->Case_id."";
$this->updateList=$this->updateList."Case_id=".$this->Case_id.", ";
}

if (strlen($this->Day)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Day";
if ($this->Day=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."".$this->Day."";
$this->updateList=$this->updateList."Day=".$this->Day.", ";
}

if (strlen($this->Notice_type)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Notice_type";
if ($this->Notice_type=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."".$this->Notice_type."";
$this->updateList=$this->updateList."Notice_type=".$this->Notice_type.", ";
}

if (strlen($this->Appeared)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Appeared";
if ($this->Appeared=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Appeared."'";
$this->updateList=$this->updateList."Appeared=".$this->Appeared.", ";
}

if (strlen($this->Appeared_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Appeared_date";
if ($this->Appeared_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Appeared_date."'";
$this->updateList=$this->updateList."Appeared_date=".$this->Appeared_date.", ";
}

if (strlen($this->Action_taken)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Action_taken";
if ($this->Action_taken=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Action_taken."'";
$this->updateList=$this->updateList."Action_taken=".$this->Action_taken.", ";
}

if (strlen($this->Note_of_action)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Note_of_action";
if ($this->Note_of_action=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Note_of_action."'";
$this->updateList=$this->updateList."Note_of_action=".$this->Note_of_action.", ";
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

if (strlen($this->Next_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Next_date";
if ($this->Next_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Next_date."'";
$this->updateList=$this->updateList."Next_date=".$this->Next_date.", ";
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


public function maxCase_id()
{
$sql="select max(Case_id) from bakijai_casedate";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}
public function maxDay($id)
{
$sql="select max(Day) from bakijai_casedate where case_id=".$id;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}

public function LastDay($id)
{
$sql="select max(day) from bakijai_casedate where case_id=".$id." and entry_date<'".$this->Entry_date."'";
//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
}


public function NextCallDate($id)
{
$inst=$this->LastDay($id);
$sql="select next_date from bakijai_casedate where case_id=".$id." and day=".$inst;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row[0])
return($row[0]);
else
return("");
}



public function getAllRecord()
{
$tRows=array();
$sql="select Case_id,Day,Notice_type,Appeared,Appeared_date,Action_taken,Note_of_action,Entry_date,Next_date from bakijai_casedate where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['Day']=$row['Day'];
$tRows[$i]['Notice_type']=$row['Notice_type'];
$tRows[$i]['Appeared']=$row['Appeared'];
$tRows[$i]['Appeared_date']=$row['Appeared_date'];
$tRows[$i]['Action_taken']=$row['Action_taken'];
$tRows[$i]['Note_of_action']=$row['Note_of_action'];
$tRows[$i]['Entry_date']=$row['Entry_date'];
$tRows[$i]['Next_date']=$row['Next_date'];
$tRows[$i]['Notice_Detail']=$this->NoticeDetail($row['Notice_type']);

$i++;
} //End While
return($tRows);
} //End getAllRecord

public function NoticeDetail($code)
{
$sql="select Noticedetail from noticetype where Code='".$code."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
return($row[0]);
else
return("");
}

public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Case_id,Day,Notice_type,Appeared,Appeared_date,Action_taken,Note_of_action,Entry_date,Next_date from bakijai_casedate where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['Day']=$row['Day'];
$tRows[$i]['Notice_type']=$row['Notice_type'];
$tRows[$i]['Appeared']=$row['Appeared'];
$tRows[$i]['Appeared_date']=$row['Appeared_date'];
$tRows[$i]['Action_taken']=$row['Action_taken'];
$tRows[$i]['Note_of_action']=$row['Note_of_action'];
$tRows[$i]['Entry_date']=$row['Entry_date'];
$tRows[$i]['Next_date']=$row['Next_date'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
