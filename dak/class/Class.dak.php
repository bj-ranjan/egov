<body>
<?php
require_once '../class/class.config.php';
class Dak_entry
{
private $Dak_id;
private $Recvd_yr;
private $Subject;
private $Recvd_from;
private $Ltr_no;
private $Ltr_dt;
private $Ltr_format;
private $Priority;
private $Mark_branch;
private $Entry_date;
private $Reply;
private $Target_date;
private $Disposed;
private $Branch_code;
private $Remarks;


//extra Old Variable to store Pre update Data
private $Old_Remarks;
private $Old_Dak_id;
private $Old_Recvd_yr;
private $Old_Subject;
private $Old_Recvd_from;
private $Old_Ltr_no;
private $Old_Ltr_dt;
private $Old_Ltr_format;
private $Old_Priority;
private $Old_Mark_branch;
private $Old_Entry_date;
private $Old_Reply;
private $Old_Target_date;
private $Old_Disposed;
private $Old_Branch_code;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

private $Def_Disposed="N";
private $Def_Branch_code="0";
//public function _construct($i) //for PHP6
public function Dak_entry()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from dak_entry";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
$this->recordCount=$row[0];
else
$this->recordCount=0;
$this->condString="1=1";
$this->Recvd_yr=date('Y');
}//End constructor

public function ExecuteQuery($sql)
{
$result=mysql_query($sql);
$this->rowCommitted= mysql_affected_rows();
return($result);
}

public function rowCount($condition)
{
$sql=" select count(*) from dak_entry where ".$condition;
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
$sql="select Dak_id,Recvd_yr,Disposed from dak_entry where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Dak_id']=$row['Dak_id'];//Primary Key-1
$tRow[$i]['Recvd_yr']=$row['Recvd_yr'];//Primary Key-2
$tRow[$i]['Disposed']=$row['Disposed'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getDak_id()
{
return($this->Dak_id);
}

public function setDak_id($str)
{
$this->Dak_id=$str;
}

public function getRecvd_yr()
{
return($this->Recvd_yr);
}

public function setRecvd_yr($str)
{
$this->Recvd_yr=$str;
}

public function getRemarks()
{
return($this->Remarks);
}

public function setRemarks($str)
{
$this->Remarks=$str;
}



public function getSubject()
{
return($this->Subject);
}

public function setSubject($str)
{
$this->Subject=$str;
}

public function getRecvd_from()
{
return($this->Recvd_from);
}

public function setRecvd_from($str)
{
$this->Recvd_from=$str;
}

public function getLtr_no()
{
return($this->Ltr_no);
}

public function setLtr_no($str)
{
$this->Ltr_no=$str;
}

public function getLtr_dt()
{
return($this->Ltr_dt);
}

public function setLtr_dt($str)
{
$this->Ltr_dt=$str;
}

public function getLtr_format()
{
return($this->Ltr_format);
}

public function setLtr_format($str)
{
$this->Ltr_format=$str;
}

public function getPriority()
{
return($this->Priority);
}

public function setPriority($str)
{
$this->Priority=$str;
}

public function getMark_branch()
{
return($this->Mark_branch);
}

public function setMark_branch($str)
{
$this->Mark_branch=$str;
}

public function getEntry_date()
{
return($this->Entry_date);
}

public function setEntry_date($str)
{
$this->Entry_date=$str;
}

public function getReply()
{
return($this->Reply);
}

public function setReply($str)
{
$this->Reply=$str;
}

public function getTarget_date()
{
return($this->Target_date);
}

public function setTarget_date($str)
{
$this->Target_date=$str;
}

public function getDisposed()
{
return($this->Disposed);
}

public function setDisposed($str)
{
$this->Disposed=$str;
}

public function getBranch_code()
{
return($this->Branch_code);
}

public function setBranch_code($str)
{
$this->Branch_code=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Dak_id,Recvd_yr,Subject,Recvd_from,Ltr_no,Ltr_dt,Ltr_format,Priority,Mark_branch,Entry_date,Reply,Target_date,Disposed,Branch_code,Remarks from dak_entry where Dak_id='".$this->Dak_id."' and Recvd_yr='".$this->Recvd_yr."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Subject'])>0)
$this->Old_Subject=$row['Subject'];
else
$this->Old_Subject="NULL";
if (strlen($row['Recvd_from'])>0)
$this->Old_Recvd_from=$row['Recvd_from'];
else
$this->Old_Recvd_from="NULL";
if (strlen($row['Ltr_no'])>0)
$this->Old_Ltr_no=$row['Ltr_no'];
else
$this->Old_Ltr_no="NULL";
if (strlen($row['Ltr_dt'])>0)
$this->Old_Ltr_dt=substr($row['Ltr_dt'],0,10);
else
$this->Old_Ltr_dt="NULL";
if (strlen($row['Ltr_format'])>0)
$this->Old_Ltr_format=$row['Ltr_format'];
else
$this->Old_Ltr_format="NULL";
if (strlen($row['Priority'])>0)
$this->Old_Priority=$row['Priority'];
else
$this->Old_Priority="NULL";
if (strlen($row['Mark_branch'])>0)
$this->Old_Mark_branch=$row['Mark_branch'];
else
$this->Old_Mark_branch="NULL";
if (strlen($row['Entry_date'])>0)
$this->Old_Entry_date=substr($row['Entry_date'],0,10);
else
$this->Old_Entry_date="NULL";
if (strlen($row['Reply'])>0)
$this->Old_Reply=$row['Reply'];
else
$this->Old_Reply="NULL";
if (strlen($row['Target_date'])>0)
$this->Old_Target_date=substr($row['Target_date'],0,10);
else
$this->Old_Target_date="NULL";
if (strlen($row['Disposed'])>0)
$this->Old_Disposed=$row['Disposed'];
else
$this->Old_Disposed="NULL";
if (strlen($row['Branch_code'])>0)
$this->Old_Branch_code=$row['Branch_code'];
else
$this->Old_Branch_code="NULL";

if (strlen($row['Remarks'])>0)
$this->Old_Remarks=$row['Remarks'];
else
$this->Old_Remarks="NULL";

return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Dak_id,Recvd_yr,Subject,Recvd_from,Ltr_no,Ltr_dt,Ltr_format,Priority,Mark_branch,Entry_date,Reply,Target_date,Disposed,Branch_code,Remarks from dak_entry where Dak_id='".$this->Dak_id."' and Recvd_yr='".$this->Recvd_yr."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Subject=$row['Subject'];
$this->Recvd_from=$row['Recvd_from'];
$this->Ltr_no=$row['Ltr_no'];
$this->Ltr_dt=$row['Ltr_dt'];
$this->Ltr_format=$row['Ltr_format'];
$this->Priority=$row['Priority'];
$this->Mark_branch=$row['Mark_branch'];
$this->Entry_date=$row['Entry_date'];
$this->Reply=$row['Reply'];
$this->Target_date=$row['Target_date'];
$this->Disposed=$row['Disposed'];
$this->Branch_code=$row['Branch_code'];
$this->Remarks=$row['Remarks'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Dak_id from dak_entry where Dak_id='".$this->Dak_id."' and Recvd_yr='".$this->Recvd_yr."'";
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
$sql="delete from dak_entry where Dak_id='".$this->Dak_id."' and Recvd_yr='".$this->Recvd_yr."'";
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
$sql="update dak_entry set ";
if ($this->Old_Subject!=$this->Subject &&  strlen($this->Subject)>0)
{
if ($this->Subject=="NULL")
$sql=$sql."Subject=NULL";
else
$sql=$sql."Subject='".$this->Subject."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Subject=".$this->Subject.", ";
}

if ($this->Old_Recvd_from!=$this->Recvd_from &&  strlen($this->Recvd_from)>0)
{
if ($this->Recvd_from=="NULL")
$sql=$sql."Recvd_from=NULL";
else
$sql=$sql."Recvd_from='".$this->Recvd_from."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Recvd_from=".$this->Recvd_from.", ";
}

if ($this->Old_Ltr_no!=$this->Ltr_no &&  strlen($this->Ltr_no)>0)
{
if ($this->Ltr_no=="NULL")
$sql=$sql."Ltr_no=NULL";
else
$sql=$sql."Ltr_no='".$this->Ltr_no."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Ltr_no=".$this->Ltr_no.", ";
}

if ($this->Old_Ltr_dt!=$this->Ltr_dt &&  strlen($this->Ltr_dt)>0)
{
if ($this->Ltr_dt=="NULL")
$sql=$sql."Ltr_dt=NULL";
else
$sql=$sql."Ltr_dt='".$this->Ltr_dt."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Ltr_dt=".$this->Ltr_dt.", ";
}

if ($this->Old_Ltr_format!=$this->Ltr_format &&  strlen($this->Ltr_format)>0)
{
if ($this->Ltr_format=="NULL")
$sql=$sql."Ltr_format=NULL";
else
$sql=$sql."Ltr_format='".$this->Ltr_format."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Ltr_format=".$this->Ltr_format.", ";
}

if ($this->Remarks=="NULL")
$sql=$sql."Remarks=NULL";
else
$sql=$sql."Remarks='".$this->Remarks."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Remarks=".$this->Remarks.", ";



if ($this->Old_Priority!=$this->Priority &&  strlen($this->Priority)>0)
{
if ($this->Priority=="NULL")
$sql=$sql."Priority=NULL";
else
$sql=$sql."Priority='".$this->Priority."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Priority=".$this->Priority.", ";
}

if ($this->Old_Mark_branch!=$this->Mark_branch &&  strlen($this->Mark_branch)>0)
{
if ($this->Mark_branch=="NULL")
$sql=$sql."Mark_branch=NULL";
else
$sql=$sql."Mark_branch='".$this->Mark_branch."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Mark_branch=".$this->Mark_branch.", ";
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

if ($this->Old_Reply!=$this->Reply &&  strlen($this->Reply)>0)
{
if ($this->Reply=="NULL")
$sql=$sql."Reply=NULL";
else
$sql=$sql."Reply='".$this->Reply."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Reply=".$this->Reply.", ";
}

if ($this->Old_Target_date!=$this->Target_date &&  strlen($this->Target_date)>0)
{
if ($this->Target_date=="NULL")
$sql=$sql."Target_date=NULL";
else
$sql=$sql."Target_date='".$this->Target_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Target_date=".$this->Target_date.", ";
}

if ($this->Old_Disposed!=$this->Disposed &&  strlen($this->Disposed)>0)
{
if ($this->Disposed=="NULL")
$sql=$sql."Disposed=NULL";
else
$sql=$sql."Disposed='".$this->Disposed."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Disposed=".$this->Disposed.", ";
}

if ($this->Old_Branch_code!=$this->Branch_code &&  strlen($this->Branch_code)>0)
{
if ($this->Branch_code=="NULL")
$sql=$sql."Branch_code=NULL";
else
$sql=$sql."Branch_code='".$this->Branch_code."'";
$i++;
$this->updateList=$this->updateList."Branch_code=".$this->Branch_code.", ";
}
else
$sql=$sql."Branch_code=Branch_code";


$cond="  where Dak_id=".$this->Dak_id." and Recvd_yr='".$this->Recvd_yr."'";
$this->returnSql=$sql.$cond;
$this->rowCommitted= mysql_affected_rows();
$this->colUpdated=$i;

if (mysql_query($sql.$cond))
return(true);
else
return(false);
}//End Update Record


public function getBranchName($code)
{
$i=0;
$tRow="";
$sql="select Branch_name from branch_section where Branch_code=".$code; 
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$tRow=$row['Branch_name'];//Posible Unique Field
return($tRow);
}





public function SaveRecord()
{
$this->updateList="";
$sql1="insert into dak_entry(";
$sql=" values (";
$mcol=0;
if (strlen($this->Dak_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Dak_id";
if ($this->Dak_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Dak_id."'";
$this->updateList=$this->updateList."Dak_id=".$this->Dak_id.", ";
}

if (strlen($this->Recvd_yr)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Recvd_yr";
if ($this->Recvd_yr=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Recvd_yr."'";
$this->updateList=$this->updateList."Recvd_yr=".$this->Recvd_yr.", ";
}

if (strlen($this->Remarks)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Remarks";
if ($this->Remarks=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Remarks."'";
$this->updateList=$this->updateList."Remarks=".$this->Remarks.", ";
}

if (strlen($this->Subject)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Subject";
if ($this->Subject=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Subject."'";
$this->updateList=$this->updateList."Subject=".$this->Subject.", ";
}

if (strlen($this->Recvd_from)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Recvd_from";
if ($this->Recvd_from=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Recvd_from."'";
$this->updateList=$this->updateList."Recvd_from=".$this->Recvd_from.", ";
}

if (strlen($this->Ltr_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Ltr_no";
if ($this->Ltr_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Ltr_no."'";
$this->updateList=$this->updateList."Ltr_no=".$this->Ltr_no.", ";
}

if (strlen($this->Ltr_dt)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Ltr_dt";
if ($this->Ltr_dt=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Ltr_dt."'";
$this->updateList=$this->updateList."Ltr_dt=".$this->Ltr_dt.", ";
}

if (strlen($this->Ltr_format)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Ltr_format";
if ($this->Ltr_format=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Ltr_format."'";
$this->updateList=$this->updateList."Ltr_format=".$this->Ltr_format.", ";
}

if (strlen($this->Priority)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Priority";
if ($this->Priority=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Priority."'";
$this->updateList=$this->updateList."Priority=".$this->Priority.", ";
}

if (strlen($this->Mark_branch)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Mark_branch";
if ($this->Mark_branch=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Mark_branch."'";
$this->updateList=$this->updateList."Mark_branch=".$this->Mark_branch.", ";
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

if (strlen($this->Reply)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Reply";
if ($this->Reply=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Reply."'";
$this->updateList=$this->updateList."Reply=".$this->Reply.", ";
}

if (strlen($this->Target_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Target_date";
if ($this->Target_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Target_date."'";
$this->updateList=$this->updateList."Target_date=".$this->Target_date.", ";
}

if (strlen($this->Disposed)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Disposed";
if ($this->Disposed=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Disposed."'";
$this->updateList=$this->updateList."Disposed=".$this->Disposed.", ";
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


public function maxDak_id()
{
$sql="select max(Dak_id) from dak_entry where Recvd_yr='".$this->Recvd_yr."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}
public function maxRecvd_yr()
{
$sql="select max(Recvd_yr) from dak_entry";
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
$sql="select Disposed,Dispose_date,Dak_id,Recvd_yr,Subject,Recvd_from,Ltr_no,Ltr_dt,Ltr_format,Priority,Mark_branch,Entry_date,Reply,Target_date,Disposed,Branch_code,Remarks from dak_entry where ".$this->condString;
$i=0;
$result=mysql_query($sql);
$this->returnSql=$sql;
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Dispose']=$row['Disposed'];     
$tRows[$i]['Dispose_date']=$row['Dispose_date'];    
$tRows[$i]['Dak_id']=$row['Dak_id'];
$tRows[$i]['Recvd_yr']=$row['Recvd_yr'];
$tRows[$i]['Subject']=$row['Subject'];
$tRows[$i]['Recvd_from']=$row['Recvd_from'];
$tRows[$i]['Ltr_no']=$row['Ltr_no'];
$tRows[$i]['Ltr_dt']=$row['Ltr_dt'];
$tRows[$i]['Ltr_format']=$row['Ltr_format'];
$tRows[$i]['Priority']=$row['Priority'];
$tRows[$i]['Mark_branch']=$row['Mark_branch'];
$tRows[$i]['Entry_date']=$row['Entry_date'];
$tRows[$i]['Reply']=$row['Reply'];
$tRows[$i]['Target_date']=$row['Target_date'];
$tRows[$i]['Disposed']=$row['Disposed'];
$tRows[$i]['Branch_code']=$row['Branch_code'];
$tRows[$i]['Remarks']=$row['Remarks'];

$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Dak_id,Recvd_yr,Subject,Recvd_from,Ltr_no,Ltr_dt,Ltr_format,Priority,Mark_branch,Entry_date,Reply,Target_date,Disposed,Branch_code from dak_entry where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Dak_id']=$row['Dak_id'];
$tRows[$i]['Recvd_yr']=$row['Recvd_yr'];
$tRows[$i]['Subject']=$row['Subject'];
$tRows[$i]['Recvd_from']=$row['Recvd_from'];
$tRows[$i]['Ltr_no']=$row['Ltr_no'];
$tRows[$i]['Ltr_dt']=$row['Ltr_dt'];
$tRows[$i]['Ltr_format']=$row['Ltr_format'];
$tRows[$i]['Priority']=$row['Priority'];
$tRows[$i]['Mark_branch']=$row['Mark_branch'];
$tRows[$i]['Entry_date']=$row['Entry_date'];
$tRows[$i]['Reply']=$row['Reply'];
$tRows[$i]['Target_date']=$row['Target_date'];
$tRows[$i]['Disposed']=$row['Disposed'];
$tRows[$i]['Branch_code']=$row['Branch_code'];
$i++;
} //End While
return($tRows);
} //End getAllRecord

public function getColor($targetDate,$disposeDate,$dispose)
{
//Green #99FF66
//Orange #FF9966
//Red #FF3366
$mcolor="";
$today=date('Y-m-d');
if($dispose=='N')
{
if($targetDate>$today)
$mcolor="#99FF66";
if($targetDate==$today)
$mcolor="yellow";
if($targetDate<$today)
$mcolor="#FF3366";
} //$dispose=='N'

if($dispose=='Y')
{
if($disposeDate<=$targetDate)
$mcolor="#99FF66";
if($disposeDate>$targetDate)
$mcolor="#FF3366";
} //$dispose=='N'

return($mcolor);
}


}//End Class
?>
