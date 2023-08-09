<body>
<?php
require_once '../class/class.config.php';
class Hc_casemaster
{
private $Serial;
private $Case_no;
private $Dep_code;
private $Branch_code;
private $Brief_history;
private $Present_status;
private $File_no;
private $Due_dateparawise;
private $Closed;
private $Last_date;
private $Signed_by;
private $T3;
private $T4;
private $T5;

//extra Old Variable to store Pre update Data
private $Old_Serial;
private $Old_Case_no;
private $Old_Dep_code;
private $Old_Branch_code;
private $Old_Brief_history;
private $Old_Present_status;
private $Old_File_no;
private $Old_Due_dateparawise;
private $Old_Closed;
private $Old_Last_date;
private $Old_Signed_by;
private $Old_T3;
private $Old_T4;
private $Old_T5;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

private $Def_Closed="N";
//public function _construct($i) //for PHP6
public function Hc_casemaster()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from hc_casemaster";
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
$sql=" select count(*) from hc_casemaster where ".$condition;
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
$sql="select Serial,Case_no from hc_casemaster where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Serial']=$row['Serial'];//Primary Key-1
$tRow[$i]['Case_no']=$row['Case_no'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getSerial()
{
return($this->Serial);
}

public function setSerial($str)
{
$this->Serial=$str;
}

public function getCase_no()
{
return($this->Case_no);
}

public function setCase_no($str)
{
$this->Case_no=$str;
}

public function getDep_code()
{
return($this->Dep_code);
}

public function setDep_code($str)
{
$this->Dep_code=$str;
}

public function getBranch_code()
{
return($this->Branch_code);
}

public function setBranch_code($str)
{
$this->Branch_code=$str;
}

public function getBrief_history()
{
return($this->Brief_history);
}

public function setBrief_history($str)
{
$this->Brief_history=$str;
}

public function getPresent_status()
{
return($this->Present_status);
}

public function setPresent_status($str)
{
$this->Present_status=$str;
}

public function getFile_no()
{
return($this->File_no);
}

public function setFile_no($str)
{
$this->File_no=$str;
}

public function getDue_dateparawise()
{
return($this->Due_dateparawise);
}

public function setDue_dateparawise($str)
{
$this->Due_dateparawise=$str;
}

public function getClosed()
{
return($this->Closed);
}

public function setClosed($str)
{
$this->Closed=$str;
}

public function getLast_date()
{
return($this->Last_date);
}

public function setLast_date($str)
{
$this->Last_date=$str;
}

public function getSigned_by()
{
return($this->Signed_by);
}

public function setSigned_by($str)
{
$this->Signed_by=$str;
}

public function getT3()
{
return($this->T3);
}

public function setT3($str)
{
$this->T3=$str;
}

public function getT4()
{
return($this->T4);
}

public function setT4($str)
{
$this->T4=$str;
}

public function getT5()
{
return($this->T5);
}

public function setT5($str)
{
$this->T5=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Serial,Case_no,Dep_code,Branch_code,Brief_history,Present_status,File_no,Due_dateparawise,Closed,Last_date,Signed_by,T3,T4,T5 from hc_casemaster where Serial='".$this->Serial."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Case_no'])>0)
$this->Old_Case_no=$row['Case_no'];
else
$this->Old_Case_no="NULL";
if (strlen($row['Dep_code'])>0)
$this->Old_Dep_code=$row['Dep_code'];
else
$this->Old_Dep_code="NULL";
if (strlen($row['Branch_code'])>0)
$this->Old_Branch_code=$row['Branch_code'];
else
$this->Old_Branch_code="NULL";
if (strlen($row['Brief_history'])>0)
$this->Old_Brief_history=$row['Brief_history'];
else
$this->Old_Brief_history="NULL";
if (strlen($row['Present_status'])>0)
$this->Old_Present_status=$row['Present_status'];
else
$this->Old_Present_status="NULL";
if (strlen($row['File_no'])>0)
$this->Old_File_no=$row['File_no'];
else
$this->Old_File_no="NULL";
if (strlen($row['Due_dateparawise'])>0)
$this->Old_Due_dateparawise=substr($row['Due_dateparawise'],0,10);
else
$this->Old_Due_dateparawise="NULL";
if (strlen($row['Closed'])>0)
$this->Old_Closed=$row['Closed'];
else
$this->Old_Closed="NULL";
if (strlen($row['Last_date'])>0)
$this->Old_Last_date=substr($row['Last_date'],0,10);
else
$this->Old_Last_date="NULL";
if (strlen($row['Signed_by'])>0)
$this->Old_Signed_by=$row['Signed_by'];
else
$this->Old_Signed_by="NULL";
if (strlen($row['T3'])>0)
$this->Old_T3=$row['T3'];
else
$this->Old_T3="NULL";
if (strlen($row['T4'])>0)
$this->Old_T4=$row['T4'];
else
$this->Old_T4="NULL";
if (strlen($row['T5'])>0)
$this->Old_T5=$row['T5'];
else
$this->Old_T5="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Serial,Case_no,Dep_code,Branch_code,Brief_history,Present_status,File_no,Due_dateparawise,Closed,Last_date,Signed_by,T3,T4,T5 from hc_casemaster where Serial='".$this->Serial."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Case_no=$row['Case_no'];
$this->Dep_code=$row['Dep_code'];
$this->Branch_code=$row['Branch_code'];
$this->Brief_history=$row['Brief_history'];
$this->Present_status=$row['Present_status'];
$this->File_no=$row['File_no'];
$this->Due_dateparawise=$row['Due_dateparawise'];
$this->Closed=$row['Closed'];
$this->Last_date=$row['Last_date'];
$this->Signed_by=$row['Signed_by'];
$this->T3=$row['T3'];
$this->T4=$row['T4'];
$this->T5=$row['T5'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Serial from hc_casemaster where Serial='".$this->Serial."'";
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
$sql="delete from hc_casemaster where Serial='".$this->Serial."'";
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
$sql="update hc_casemaster set ";
if ($this->Old_Case_no!=$this->Case_no &&  strlen($this->Case_no)>0)
{
if ($this->Case_no=="NULL")
$sql=$sql."Case_no=NULL";
else
$sql=$sql."Case_no='".$this->Case_no."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Case_no=".$this->Case_no.", ";
}

if ($this->Old_Dep_code!=$this->Dep_code &&  strlen($this->Dep_code)>0)
{
if ($this->Dep_code=="NULL")
$sql=$sql."Dep_code=NULL";
else
$sql=$sql."Dep_code='".$this->Dep_code."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Dep_code=".$this->Dep_code.", ";
}

if ($this->Old_Branch_code!=$this->Branch_code &&  strlen($this->Branch_code)>0)
{
if ($this->Branch_code=="NULL")
$sql=$sql."Branch_code=NULL";
else
$sql=$sql."Branch_code='".$this->Branch_code."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Branch_code=".$this->Branch_code.", ";
}

if ($this->Old_Brief_history!=$this->Brief_history &&  strlen($this->Brief_history)>0)
{
if ($this->Brief_history=="NULL")
$sql=$sql."Brief_history=NULL";
else
$sql=$sql."Brief_history='".$this->Brief_history."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Brief_history=".$this->Brief_history.", ";
}

if ($this->Old_Present_status!=$this->Present_status &&  strlen($this->Present_status)>0)
{
if ($this->Present_status=="NULL")
$sql=$sql."Present_status=NULL";
else
$sql=$sql."Present_status='".$this->Present_status."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Present_status=".$this->Present_status.", ";
}

if ($this->Old_File_no!=$this->File_no &&  strlen($this->File_no)>0)
{
if ($this->File_no=="NULL")
$sql=$sql."File_no=NULL";
else
$sql=$sql."File_no='".$this->File_no."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."File_no=".$this->File_no.", ";
}

if ($this->Old_Due_dateparawise!=$this->Due_dateparawise &&  strlen($this->Due_dateparawise)>0)
{
if ($this->Due_dateparawise=="NULL")
$sql=$sql."Due_dateparawise=NULL";
else
$sql=$sql."Due_dateparawise='".$this->Due_dateparawise."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Due_dateparawise=".$this->Due_dateparawise.", ";
}

if ($this->Old_Closed!=$this->Closed &&  strlen($this->Closed)>0)
{
if ($this->Closed=="NULL")
$sql=$sql."Closed=NULL";
else
$sql=$sql."Closed='".$this->Closed."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Closed=".$this->Closed.", ";
}

if ($this->Old_Last_date!=$this->Last_date &&  strlen($this->Last_date)>0)
{
if ($this->Last_date=="NULL")
$sql=$sql."Last_date=NULL";
else
$sql=$sql."Last_date='".$this->Last_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Last_date=".$this->Last_date.", ";
}

if ($this->Old_Signed_by!=$this->Signed_by &&  strlen($this->Signed_by)>0)
{
if ($this->Signed_by=="NULL")
$sql=$sql."Signed_by=NULL";
else
$sql=$sql."Signed_by='".$this->Signed_by."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Signed_by=".$this->Signed_by.", ";
}

if ($this->Old_T3!=$this->T3 &&  strlen($this->T3)>0)
{
if ($this->T3=="NULL")
$sql=$sql."T3=NULL";
else
$sql=$sql."T3='".$this->T3."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."T3=".$this->T3.", ";
}

if ($this->Old_T4!=$this->T4 &&  strlen($this->T4)>0)
{
if ($this->T4=="NULL")
$sql=$sql."T4=NULL";
else
$sql=$sql."T4='".$this->T4."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."T4=".$this->T4.", ";
}

if ($this->Old_T5!=$this->T5 &&  strlen($this->T5)>0)
{
if ($this->T5=="NULL")
$sql=$sql."T5=NULL";
else
$sql=$sql."T5='".$this->T5."'";
$i++;
$this->updateList=$this->updateList."T5=".$this->T5.", ";
}
else
$sql=$sql."T5=T5";


$cond="  where Serial='".$this->Serial."'";
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
$sql1="insert into hc_casemaster(";
$sql=" values (";
$mcol=0;
if (strlen($this->Serial)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Serial";
if ($this->Serial=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Serial."'";
$this->updateList=$this->updateList."Serial=".$this->Serial.", ";
}

if (strlen($this->Case_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Case_no";
if ($this->Case_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Case_no."'";
$this->updateList=$this->updateList."Case_no=".$this->Case_no.", ";
}

if (strlen($this->Dep_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Dep_code";
if ($this->Dep_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Dep_code."'";
$this->updateList=$this->updateList."Dep_code=".$this->Dep_code.", ";
}

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

if (strlen($this->Brief_history)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Brief_history";
if ($this->Brief_history=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Brief_history."'";
$this->updateList=$this->updateList."Brief_history=".$this->Brief_history.", ";
}

if (strlen($this->Present_status)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Present_status";
if ($this->Present_status=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Present_status."'";
$this->updateList=$this->updateList."Present_status=".$this->Present_status.", ";
}

if (strlen($this->File_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."File_no";
if ($this->File_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->File_no."'";
$this->updateList=$this->updateList."File_no=".$this->File_no.", ";
}

if (strlen($this->Due_dateparawise)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Due_dateparawise";
if ($this->Due_dateparawise=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Due_dateparawise."'";
$this->updateList=$this->updateList."Due_dateparawise=".$this->Due_dateparawise.", ";
}

if (strlen($this->Closed)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Closed";
if ($this->Closed=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Closed."'";
$this->updateList=$this->updateList."Closed=".$this->Closed.", ";
}

if (strlen($this->Last_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Last_date";
if ($this->Last_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Last_date."'";
$this->updateList=$this->updateList."Last_date=".$this->Last_date.", ";
}

if (strlen($this->Signed_by)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Signed_by";
if ($this->Signed_by=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Signed_by."'";
$this->updateList=$this->updateList."Signed_by=".$this->Signed_by.", ";
}

if (strlen($this->T3)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."T3";
if ($this->T3=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->T3."'";
$this->updateList=$this->updateList."T3=".$this->T3.", ";
}

if (strlen($this->T4)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."T4";
if ($this->T4=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->T4."'";
$this->updateList=$this->updateList."T4=".$this->T4.", ";
}

if (strlen($this->T5)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."T5";
if ($this->T5=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->T5."'";
$this->updateList=$this->updateList."T5=".$this->T5.", ";
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


public function maxSerial()
{
$sql="select max(Serial) from hc_casemaster";
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
$sql="select Serial,Case_no,Dep_code,Branch_code,Brief_history,Present_status,File_no,Due_dateparawise,Closed,Last_date,Signed_by,T3,T4,T5 from hc_casemaster where ".$this->condString;
$i=0;
$this->returnSql=$sql;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Serial']=$row['Serial'];
$tRows[$i]['Case_no']=$row['Case_no'];
$tRows[$i]['Dep_code']=$row['Dep_code'];
$tRows[$i]['Branch_code']=$row['Branch_code'];
$tRows[$i]['Brief_history']=$row['Brief_history'];
$tRows[$i]['Present_status']=$row['Present_status'];
$tRows[$i]['File_no']=$row['File_no'];
$tRows[$i]['Due_dateparawise']=$row['Due_dateparawise'];
$tRows[$i]['Closed']=$row['Closed'];
$tRows[$i]['Last_date']=$row['Last_date'];
$tRows[$i]['Signed_by']=$row['Signed_by'];
$tRows[$i]['T3']=$row['T3'];
$tRows[$i]['T4']=$row['T4'];
$tRows[$i]['T5']=$row['T5'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Serial,Case_no,Dep_code,Branch_code,Brief_history,Present_status,File_no,Due_dateparawise,Closed,Last_date,Signed_by,T3,T4,T5 from hc_casemaster where ".$this->condString." LIMIT ".$totrec;
$i=0;
$this->returnSql=$sql;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Serial']=$row['Serial'];
$tRows[$i]['Case_no']=$row['Case_no'];
$tRows[$i]['Dep_code']=$row['Dep_code'];
$tRows[$i]['Branch_code']=$row['Branch_code'];
$tRows[$i]['Brief_history']=$row['Brief_history'];
$tRows[$i]['Present_status']=$row['Present_status'];
$tRows[$i]['File_no']=$row['File_no'];
$tRows[$i]['Due_dateparawise']=$row['Due_dateparawise'];
$tRows[$i]['Closed']=$row['Closed'];
$tRows[$i]['Last_date']=$row['Last_date'];
$tRows[$i]['Signed_by']=$row['Signed_by'];
$tRows[$i]['T3']=$row['T3'];
$tRows[$i]['T4']=$row['T4'];
$tRows[$i]['T5']=$row['T5'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
