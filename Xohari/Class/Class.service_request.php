<body>
<?php
require_once 'class.xconfig.php';
require_once 'class.office.php';
class Service_request
{
private $Id;
private $Request_id;
private $Applicant_name;
private $Applicant_phone_no;
private $Applicant_address;
private $Recieve_date;
private $Rejected;
private $Delivery_date;
private $Doc_missing;
private $Reject_reason;
private $Service_id;
private $Officer_id;
private $Office_id;

//extra Old Variable to store Pre update Data
private $Old_Id;
private $Old_Request_id;
private $Old_Applicant_name;
private $Old_Applicant_phone_no;
private $Old_Applicant_address;
private $Old_Recieve_date;
private $Old_Rejected;
private $Old_Delivery_date;
private $Old_Doc_missing;
private $Old_Reject_reason;
private $Old_Service_id;
private $Old_Officer_id;
private $Old_Office_id;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

//public function _construct($i) //for PHP6
public function Service_request()
{
$objConfig=new xConfig();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from service_request";
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
$sql=" select count(*) from service_request where ".$condition;
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
$sql="select Request_id,Applicant_name from service_request where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Request_id']=$row['Request_id'];//Primary Key-1
$tRow[$i]['Applicant_name']=$row['Applicant_name'];//Posible Unique Field
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

public function getRequest_id()
{
return($this->Request_id);
}

public function setRequest_id($str)
{
$this->Request_id=$str;
}

public function getApplicant_name()
{
return($this->Applicant_name);
}

public function setApplicant_name($str)
{
$this->Applicant_name=$str;
}

public function getApplicant_phone_no()
{
return($this->Applicant_phone_no);
}

public function setApplicant_phone_no($str)
{
$this->Applicant_phone_no=$str;
}

public function getApplicant_address()
{
return($this->Applicant_address);
}

public function setApplicant_address($str)
{
$this->Applicant_address=$str;
}

public function getRecieve_date()
{
return($this->Recieve_date);
}

public function setRecieve_date($str)
{
$this->Recieve_date=$str;
}

public function getRejected()
{
return($this->Rejected);
}

public function setRejected($str)
{
$this->Rejected=$str;
}

public function getDelivery_date()
{
return($this->Delivery_date);
}

public function setDelivery_date($str)
{
$this->Delivery_date=$str;
}

public function getDoc_missing()
{
return($this->Doc_missing);
}

public function setDoc_missing($str)
{
$this->Doc_missing=$str;
}

public function getReject_reason()
{
return($this->Reject_reason);
}

public function setReject_reason($str)
{
$this->Reject_reason=$str;
}

public function getService_id()
{
return($this->Service_id);
}

public function setService_id($str)
{
$this->Service_id=$str;
}

public function getOfficer_id()
{
return($this->Officer_id);
}

public function setOfficer_id($str)
{
$this->Officer_id=$str;
}

public function getOffice_id()
{
return($this->Office_id);
}

public function setOffice_id($str)
{
$this->Office_id=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Id,Request_id,Applicant_name,Applicant_phone_no,Applicant_address,Recieve_date,Rejected,Delivery_date,Doc_missing,Reject_reason,Service_id,Officer_id,Office_id from service_request where Request_id='".$this->Request_id."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Id'])>0)
$this->Old_Id=$row['Id'];
else
$this->Old_Id="NULL";
if (strlen($row['Applicant_name'])>0)
$this->Old_Applicant_name=$row['Applicant_name'];
else
$this->Old_Applicant_name="NULL";
if (strlen($row['Applicant_phone_no'])>0)
$this->Old_Applicant_phone_no=$row['Applicant_phone_no'];
else
$this->Old_Applicant_phone_no="NULL";
if (strlen($row['Applicant_address'])>0)
$this->Old_Applicant_address=$row['Applicant_address'];
else
$this->Old_Applicant_address="NULL";
if (strlen($row['Recieve_date'])>0)
$this->Old_Recieve_date=substr($row['Recieve_date'],0,10);
else
$this->Old_Recieve_date="NULL";
if (strlen($row['Rejected'])>0)
$this->Old_Rejected=$row['Rejected'];
else
$this->Old_Rejected="NULL";
if (strlen($row['Delivery_date'])>0)
$this->Old_Delivery_date=substr($row['Delivery_date'],0,10);
else
$this->Old_Delivery_date="NULL";
if (strlen($row['Doc_missing'])>0)
$this->Old_Doc_missing=$row['Doc_missing'];
else
$this->Old_Doc_missing="NULL";
if (strlen($row['Reject_reason'])>0)
$this->Old_Reject_reason=$row['Reject_reason'];
else
$this->Old_Reject_reason="NULL";
if (strlen($row['Service_id'])>0)
$this->Old_Service_id=$row['Service_id'];
else
$this->Old_Service_id="NULL";
if (strlen($row['Officer_id'])>0)
$this->Old_Officer_id=$row['Officer_id'];
else
$this->Old_Officer_id="NULL";
if (strlen($row['Office_id'])>0)
$this->Old_Office_id=$row['Office_id'];
else
$this->Old_Office_id="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Id,Request_id,Applicant_name,Applicant_phone_no,Applicant_address,Recieve_date,Rejected,Delivery_date,Doc_missing,Reject_reason,Service_id,Officer_id,Office_id from service_request where Request_id='".$this->Request_id."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Id=$row['Id'];
$this->Applicant_name=$row['Applicant_name'];
$this->Applicant_phone_no=$row['Applicant_phone_no'];
$this->Applicant_address=$row['Applicant_address'];
$this->Recieve_date=$row['Recieve_date'];
$this->Rejected=$row['Rejected'];
$this->Delivery_date=$row['Delivery_date'];
$this->Doc_missing=$row['Doc_missing'];
$this->Reject_reason=$row['Reject_reason'];
$this->Service_id=$row['Service_id'];
$this->Officer_id=$row['Officer_id'];
$this->Office_id=$row['Office_id'];
return(true);
}
else
return(false);
} //end EditRecord


public function Available()
{
$sql="select Id from service_request where Request_id='".$this->Request_id."'";
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
$sql="delete from service_request where Request_id='".$this->Request_id."'";
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
$sql="update service_request set ";
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

if ($this->Old_Applicant_name!=$this->Applicant_name &&  strlen($this->Applicant_name)>0)
{
if ($this->Applicant_name=="NULL")
$sql=$sql."Applicant_name=NULL";
else
$sql=$sql."Applicant_name='".$this->Applicant_name."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Applicant_name=".$this->Applicant_name.", ";
}

if ($this->Old_Applicant_phone_no!=$this->Applicant_phone_no &&  strlen($this->Applicant_phone_no)>0)
{
if ($this->Applicant_phone_no=="NULL")
$sql=$sql."Applicant_phone_no=NULL";
else
$sql=$sql."Applicant_phone_no='".$this->Applicant_phone_no."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Applicant_phone_no=".$this->Applicant_phone_no.", ";
}

if ($this->Old_Applicant_address!=$this->Applicant_address &&  strlen($this->Applicant_address)>0)
{
if ($this->Applicant_address=="NULL")
$sql=$sql."Applicant_address=NULL";
else
$sql=$sql."Applicant_address='".$this->Applicant_address."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Applicant_address=".$this->Applicant_address.", ";
}

if ($this->Old_Recieve_date!=$this->Recieve_date &&  strlen($this->Recieve_date)>0)
{
if ($this->Recieve_date=="NULL")
$sql=$sql."Recieve_date=NULL";
else
$sql=$sql."Recieve_date='".$this->Recieve_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Recieve_date=".$this->Recieve_date.", ";
}

if ($this->Old_Rejected!=$this->Rejected &&  strlen($this->Rejected)>0)
{
if ($this->Rejected=="NULL")
$sql=$sql."Rejected=NULL";
else
$sql=$sql."Rejected='".$this->Rejected."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Rejected=".$this->Rejected.", ";
}

if ($this->Old_Delivery_date!=$this->Delivery_date &&  strlen($this->Delivery_date)>0)
{
if ($this->Delivery_date=="NULL")
$sql=$sql."Delivery_date=NULL";
else
$sql=$sql."Delivery_date='".$this->Delivery_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Delivery_date=".$this->Delivery_date.", ";
}

if ($this->Old_Doc_missing!=$this->Doc_missing &&  strlen($this->Doc_missing)>0)
{
if ($this->Doc_missing=="NULL")
$sql=$sql."Doc_missing=NULL";
else
$sql=$sql."Doc_missing='".$this->Doc_missing."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Doc_missing=".$this->Doc_missing.", ";
}

if ($this->Old_Reject_reason!=$this->Reject_reason &&  strlen($this->Reject_reason)>0)
{
if ($this->Reject_reason=="NULL")
$sql=$sql."Reject_reason=NULL";
else
$sql=$sql."Reject_reason='".$this->Reject_reason."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Reject_reason=".$this->Reject_reason.", ";
}

if ($this->Old_Service_id!=$this->Service_id &&  strlen($this->Service_id)>0)
{
if ($this->Service_id=="NULL")
$sql=$sql."Service_id=NULL";
else
$sql=$sql."Service_id='".$this->Service_id."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Service_id=".$this->Service_id.", ";
}

if ($this->Old_Officer_id!=$this->Officer_id &&  strlen($this->Officer_id)>0)
{
if ($this->Officer_id=="NULL")
$sql=$sql."Officer_id=NULL";
else
$sql=$sql."Officer_id='".$this->Officer_id."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Officer_id=".$this->Officer_id.", ";
}

if ($this->Old_Office_id!=$this->Office_id &&  strlen($this->Office_id)>0)
{
if ($this->Office_id=="NULL")
$sql=$sql."Office_id=NULL";
else
$sql=$sql."Office_id='".$this->Office_id."'";
$i++;
$this->updateList=$this->updateList."Office_id=".$this->Office_id.", ";
}
else
$sql=$sql."Office_id=Office_id";


$cond="  where Request_id='".$this->Request_id."'";
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
$sql1="insert into service_request(";
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

if (strlen($this->Request_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Request_id";
if ($this->Request_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Request_id."'";
$this->updateList=$this->updateList."Request_id=".$this->Request_id.", ";
}

if (strlen($this->Applicant_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Applicant_name";
if ($this->Applicant_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Applicant_name."'";
$this->updateList=$this->updateList."Applicant_name=".$this->Applicant_name.", ";
}

if (strlen($this->Applicant_phone_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Applicant_phone_no";
if ($this->Applicant_phone_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Applicant_phone_no."'";
$this->updateList=$this->updateList."Applicant_phone_no=".$this->Applicant_phone_no.", ";
}

if (strlen($this->Applicant_address)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Applicant_address";
if ($this->Applicant_address=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Applicant_address."'";
$this->updateList=$this->updateList."Applicant_address=".$this->Applicant_address.", ";
}

if (strlen($this->Recieve_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Recieve_date";
if ($this->Recieve_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Recieve_date."'";
$this->updateList=$this->updateList."Recieve_date=".$this->Recieve_date.", ";
}

if (strlen($this->Rejected)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Rejected";
if ($this->Rejected=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Rejected."'";
$this->updateList=$this->updateList."Rejected=".$this->Rejected.", ";
}

if (strlen($this->Delivery_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Delivery_date";
if ($this->Delivery_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Delivery_date."'";
$this->updateList=$this->updateList."Delivery_date=".$this->Delivery_date.", ";
}

if (strlen($this->Doc_missing)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Doc_missing";
if ($this->Doc_missing=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Doc_missing."'";
$this->updateList=$this->updateList."Doc_missing=".$this->Doc_missing.", ";
}

if (strlen($this->Reject_reason)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Reject_reason";
if ($this->Reject_reason=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Reject_reason."'";
$this->updateList=$this->updateList."Reject_reason=".$this->Reject_reason.", ";
}

if (strlen($this->Service_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Service_id";
if ($this->Service_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Service_id."'";
$this->updateList=$this->updateList."Service_id=".$this->Service_id.", ";
}

if (strlen($this->Officer_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Officer_id";
if ($this->Officer_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Officer_id."'";
$this->updateList=$this->updateList."Officer_id=".$this->Officer_id.", ";
}

if (strlen($this->Office_id)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Office_id";
if ($this->Office_id=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Office_id."'";
$this->updateList=$this->updateList."Office_id=".$this->Office_id.", ";
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
$sql="select Id,Request_id,Applicant_name,Applicant_phone_no,Applicant_address,Recieve_date,Rejected,Delivery_date,Doc_missing,Reject_reason,Service_id,Officer_id,Office_id from service_request where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Request_id']=$row['Request_id'];
$tRows[$i]['Applicant_name']=$row['Applicant_name'];
$tRows[$i]['Applicant_phone_no']=$row['Applicant_phone_no'];
$tRows[$i]['Applicant_address']=$row['Applicant_address'];
$tRows[$i]['Recieve_date']=$row['Recieve_date'];
$tRows[$i]['Rejected']=$row['Rejected'];
$tRows[$i]['Delivery_date']=$row['Delivery_date'];
$tRows[$i]['Doc_missing']=$row['Doc_missing'];
$tRows[$i]['Reject_reason']=$row['Reject_reason'];
$tRows[$i]['Service_id']=$row['Service_id'];
$tRows[$i]['Officer_id']=$row['Officer_id'];
$tRows[$i]['Office_id']=$row['Office_id'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function maxId($yr)
{
$sql="select max(id) from service_request where substr(recieve_date,1,4)='".$yr."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}


public function maxRequestId($yr)
{
$objOff=new Office();
$objOff->setId("1");
if ($objOff->EditRecord())
{    
$code=$objOff->getCode();
$code=$code.$this->maxId($yr)."/".$yr ;
return($code);
}
else
return("-");
}


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Id,Request_id,Applicant_name,Applicant_phone_no,Applicant_address,Recieve_date,Rejected,Delivery_date,Doc_missing,Reject_reason,Service_id,Officer_id,Office_id from service_request where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Request_id']=$row['Request_id'];
$tRows[$i]['Applicant_name']=$row['Applicant_name'];
$tRows[$i]['Applicant_phone_no']=$row['Applicant_phone_no'];
$tRows[$i]['Applicant_address']=$row['Applicant_address'];
$tRows[$i]['Recieve_date']=$row['Recieve_date'];
$tRows[$i]['Rejected']=$row['Rejected'];
$tRows[$i]['Delivery_date']=$row['Delivery_date'];
$tRows[$i]['Doc_missing']=$row['Doc_missing'];
$tRows[$i]['Reject_reason']=$row['Reject_reason'];
$tRows[$i]['Service_id']=$row['Service_id'];
$tRows[$i]['Officer_id']=$row['Officer_id'];
$tRows[$i]['Office_id']=$row['Office_id'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
}//End Class
?>
