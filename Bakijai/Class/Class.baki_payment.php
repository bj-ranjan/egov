<body>
<?php
require_once '../class/class.config.php';
require_once '../class/utility.class.php';
class Baki_payment
{
private $Case_id;
private $Pay_date;
private $Instalment_no;
private $Paid_today;
private $Payment_mode;
private $Receipt_no;
private $Rsl;
private $Nextdate;
private $Entry_date;
private $Fyear;
//extra Old Variable to store Pre update Data
private $Old_Case_id;
private $Old_Pay_date;
private $Old_Instalment_no;
private $Old_Paid_today;
private $Old_Payment_mode;
private $Old_Receipt_no;
private $Old_Rsl;
private $Old_Nextdate;
private $Old_Entry_date;

public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

private $Def_Paid_today="0";
private $Def_Payment_mode="NA";
//public function _construct($i) //for PHP6
public function Baki_payment()
{
$objConfig=new Config();//Connects database
$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from baki_payment";
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
$sql=" select count(*) from baki_payment where ".$condition;
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
$sql="select Case_id,Instalment_no,Payment_mode from baki_payment where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Case_id']=$row['Case_id'];//Primary Key-1
$tRow[$i]['Instalment_no']=$row['Instalment_no'];//Primary Key-2
$tRow[$i]['Payment_mode']=$row['Payment_mode'];//Posible Unique Field
$i++;
}
return($tRow);
}


public function getFyear()
{
return($this->Fyear);
}

public function setFyear($str)
{
$this->Fyear=$str;
}


public function getCase_id()
{
return($this->Case_id);
}

public function setCase_id($str)
{
$this->Case_id=$str;
}

public function getPay_date()
{
return($this->Pay_date);
}

public function setPay_date($str)
{
$this->Pay_date=$str;
}

public function getInstalment_no()
{
return($this->Instalment_no);
}

public function setInstalment_no($str)
{
$this->Instalment_no=$str;
}

public function getPaid_today()
{
return($this->Paid_today);
}

public function setPaid_today($str)
{
$this->Paid_today=$str;
}

public function getPayment_mode()
{
return($this->Payment_mode);
}

public function setPayment_mode($str)
{
$this->Payment_mode=$str;
}

public function getReceipt_no()
{
return($this->Receipt_no);
}

public function setReceipt_no($str)
{
$this->Receipt_no=$str;
}

public function getRsl()
{
return($this->Rsl);
}

public function setRsl($str)
{
$this->Rsl=$str;
}

public function getNextdate()
{
return($this->Nextdate);
}

public function setNextdate($str)
{
$this->Nextdate=$str;
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
$sql="select Case_id,Pay_date,Instalment_no,Paid_today,Payment_mode,Receipt_no,Rsl,Nextdate,Entry_date from baki_payment where Case_id='".$this->Case_id."' and Instalment_no='".$this->Instalment_no."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Pay_date'])>0)
$this->Old_Pay_date=substr($row['Pay_date'],0,10);
else
$this->Old_Pay_date="NULL";

if (strlen($row['Paid_today'])>0)
$this->Old_Paid_today=$row['Paid_today'];
else
$this->Old_Paid_today="NULL";

if (strlen($row['Payment_mode'])>0)
$this->Old_Payment_mode=$row['Payment_mode'];
else
$this->Old_Payment_mode="NULL";
if (strlen($row['Receipt_no'])>0)
$this->Old_Receipt_no=$row['Receipt_no'];
else
$this->Old_Receipt_no="NULL";
if (strlen($row['Rsl'])>0)
$this->Old_Rsl=$row['Rsl'];
else
$this->Old_Rsl="NULL";
if (strlen($row['Nextdate'])>0)
$this->Old_Nextdate=substr($row['Nextdate'],0,10);
else
$this->Old_Nextdate="NULL";
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
$sql="select Case_id,Pay_date,Instalment_no,Paid_today,Payment_mode,Receipt_no,Rsl,Nextdate,Entry_date from baki_payment where Case_id='".$this->Case_id."' and Instalment_no='".$this->Instalment_no."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
$this->Available=true;
$this->Pay_date=$row['Pay_date'];
$this->Paid_today=$row['Paid_today'];
$this->Payment_mode=$row['Payment_mode'];
$this->Receipt_no=$row['Receipt_no'];
$this->Rsl=$row['Rsl'];
$this->Nextdate=$row['Nextdate'];
$this->Entry_date=$row['Entry_date'];
}
else
$this->Available=false;
$this->returnSql=$sql;
return($this->Available);
} //end editrecord


public function AlreadyEntered()
{
$sql="select Instalment_no,Paid_today,Pay_date,Payment_mode,Receipt_no,Nextdate from baki_payment where Case_id='".$this->Case_id."' and Entry_date='".$this->Entry_date."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
$this->Instalment_no=$row['Instalment_no']; 
$this->Pay_date=$row['Pay_date'];
$this->Paid_today=$row['Paid_today'];
$this->Payment_mode=$row['Payment_mode'];
$this->Receipt_no=$row['Receipt_no'];
$this->Nextdate=$row['Nextdate'];
return(true);
}    
else
return(false);
} //end




public function DeleteRecord()
{
$sql="delete from baki_payment where Case_id='".$this->Case_id."' and Instalment_no='".$this->Instalment_no."'";
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
$sql="update baki_payment set ";
if ($this->Old_Pay_date!=$this->Pay_date &&  strlen($this->Pay_date)>0)
{
if ($this->Pay_date=="NULL")
$sql=$sql."Pay_date=NULL";
else
$sql=$sql."Pay_date='".$this->Pay_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Pay_date=".$this->Pay_date.", ";
}

if ($this->Old_Paid_today!=$this->Paid_today &&  strlen($this->Paid_today)>0)
{
if ($this->Paid_today=="NULL")
$sql=$sql."Paid_today=0";
else
$sql=$sql."Paid_today='".$this->Paid_today."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Paid_today=".$this->Paid_today.", ";
}
else
$sql=$sql."Paid_today=Paid_today,";


if ($this->Old_Payment_mode!=$this->Payment_mode &&  strlen($this->Payment_mode)>0)
{
if ($this->Payment_mode=="NULL")
$sql=$sql."Payment_mode=NULL";
else
$sql=$sql."Payment_mode='".$this->Payment_mode."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Payment_mode=".$this->Payment_mode.", ";
}

if ($this->Old_Receipt_no!=$this->Receipt_no &&  strlen($this->Receipt_no)>0)
{
if ($this->Receipt_no=="NULL")
$sql=$sql."Receipt_no=NULL";
else
$sql=$sql."Receipt_no='".$this->Receipt_no."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Receipt_no=".$this->Receipt_no.", ";
}


//if ($this->Old_Rsl!=$this->Rsl &&  strlen($this->Rsl)>0)
//{
//if ($this->Rsl=="NULL")
//$sql=$sql."Rsl=NULL";
//else
//$sql=$sql."Rsl='".$this->Rsl."'";
//$sql=$sql.",";
//$i++;
//$this->updateList=$this->updateList."Rsl=".$this->Rsl.", ";
//}


if ($this->Old_Nextdate!=$this->Nextdate &&  strlen($this->Nextdate)>0)
{
if ($this->Nextdate=="NULL")
$sql=$sql."Nextdate=NULL";
else
$sql=$sql."Nextdate='".$this->Nextdate."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Nextdate=".$this->Nextdate.", ";
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


$cond="  where Case_id=".$this->Case_id." and Instalment_no=".$this->Instalment_no;
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

//echo $this->Receipt_no;

$this->updateList="";
$sql1="insert into baki_payment(";
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

if (strlen($this->Pay_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Pay_date";
if ($this->Pay_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Pay_date."'";
$this->updateList=$this->updateList."Pay_date=".$this->Pay_date.", ";
}

if (strlen($this->Instalment_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Instalment_no";
if ($this->Instalment_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Instalment_no."'";
$this->updateList=$this->updateList."Instalment_no=".$this->Instalment_no.", ";
}

if (strlen($this->Paid_today)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Paid_today";
if ($this->Paid_today=="NULL")
$sql=$sql."0";
else
$sql=$sql."'".$this->Paid_today."'";
$this->updateList=$this->updateList."Paid_today=".$this->Paid_today.", ";
}


if (strlen($this->Payment_mode)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Payment_mode";
if ($this->Payment_mode=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Payment_mode."'";
$this->updateList=$this->updateList."Payment_mode=".$this->Payment_mode.", ";
}

if (strlen($this->Receipt_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Receipt_no";
if ($this->Receipt_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Receipt_no."'";
$this->updateList=$this->updateList."Receipt_no=".$this->Receipt_no.", ";
}

//$this->Rsl=$this->maxRsl();
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

if (strlen($this->Nextdate)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Nextdate";
if ($this->Nextdate=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Nextdate."'";
$this->updateList=$this->updateList."Nextdate=".$this->Nextdate.", ";
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

$sql1=$sql1.",fyear)";
$sql=$sql.",'".$this->Fyear."')";

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
$sql="select max(Case_id) from baki_payment";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}


public function maxRsl($yyyy)
{
$sql="select count(*) from baki_payment where fyear='".$yyyy."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}

public function ToalPaid($id)
{
$sql="select sum(paid_today) from baki_payment where payment_mode<>'OTS' and case_id=".$id;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
}

public function LastPaid($id)
{
//$sql="select sum(paid_today) from baki_payment where case_id=".$id." and entry_date<'".$this->Entry_date."'";
$sql="select sum(paid_today) from baki_payment where  payment_mode<>'OTS' and case_id=".$id;

$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
}

public function LastPaidBeforeDate($id,$mdate)
{
//$sql="select sum(paid_today) from baki_payment where case_id=".$id." and payment_mode<>'OTS' and pay_date<'".$mdate."'";
$sql="select sum(paid_today) from baki_payment where case_id=".$id." and payment_mode<>'OTS' and pay_date<'".$mdate."'";

//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
//echo " ".$row[0]."<br>";
$this->returnSql=$sql;
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
}


public function LastPaidFromDate($id,$mdate)
{
//$sql="select sum(paid_today) from baki_payment where case_id=".$id." and payment_mode<>'OTS' and pay_date<'".$mdate."'";
$sql="select sum(paid_today) from baki_payment where case_id=".$id." and payment_mode<>'OTS' and pay_date>='".$mdate."'";

//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
//echo " ".$row[0]."<br>";
$this->returnSql=$sql;
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
}


public function BalanecAmount($id)
{
$amt=0;
$sql="select amount from bakijai_main where case_id=".$id;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row[0])
$amt=$row[0];
else
$amt=0;
$paid=$this->ToalPaid($id);
$amt=$amt-$paid;
return($amt);
}

public function DefaultAmount($id)
{
$amt=0;
$sql="select amount from bakijai_main where case_id=".$id;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row[0])
$amt=$row[0];
else
$amt=0;
return($amt);
}

public function LastBalanecAmount($id)
{
$amt=0;
$sql="select amount from bakijai_main where case_id=".$id;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row[0])
$amt=$row[0];
else
$amt=0;
$paid=$this->LastPaid($id);
$amt=$amt-$paid;
return($amt);
}

public function LastBalanceBeforeDate($id,$yr,$mn)
{
$amt=0;
$sql="select amount from bakijai_main where case_id=".$id;

$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row[0])
$amt=$row[0];
else
$amt=0;
$mdate=$yr."-".$mn."-01";
$paid=$this->LastPaidBeforeDate($id, $mdate);
$amt=$amt-$paid;
//echo "=".$amt;
return($amt);
}


public function LastInstalment_no($id)
{
$sql="select max(Instalment_no) from baki_payment where case_id=".$id." and entry_date<'".$this->Entry_date."'";
//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
}


public function LastPayDate($id)
{
$inst=$this->LastInstalment_no($id);
$sql="select pay_date from baki_payment where case_id=".$id." and Instalment_no=".$inst;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row[0])
return($row[0]);
else
return("");
}

public function NextCallDate($id)
{
$inst=$this->maxInstalment_no($id)-1;
$sql="select nextdate from baki_payment where case_id=".$id." and Instalment_no=".$inst;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row[0])
return(substr($row[0],0,10));
else
return("");
}


public function maxInstalment_no($id)
{
$sql="select max(Instalment_no) from baki_payment where case_id=".$id;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}


public function CountInstalment($id)
{
$sql="select count(*) from baki_payment where Paid_today>0 and case_id=".$id;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row[0])
return($row[0]);
else
return(0);
}


public function getAllRecord()
{
$tRows=array();
$sql="select Case_id,Pay_date,Instalment_no,Paid_today,Payment_mode,Receipt_no,Rsl,Nextdate,Entry_date from baki_payment where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['Pay_date']=$row['Pay_date'];
$tRows[$i]['Instalment_no']=$row['Instalment_no'];
$tRows[$i]['Paid_today']=$row['Paid_today'];
$tRows[$i]['Payment_mode']=$row['Payment_mode'];
$tRows[$i]['Receipt_no']=$row['Receipt_no'];
$tRows[$i]['Rsl']=$row['Rsl'];
$tRows[$i]['Nextdate']=$row['Nextdate'];
$tRows[$i]['Entry_date']=$row['Entry_date'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Case_id,Pay_date,Instalment_no,Paid_today,Payment_mode,Receipt_no,Rsl,Nextdate,Entry_date from baki_payment where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['Pay_date']=$row['Pay_date'];
$tRows[$i]['Instalment_no']=$row['Instalment_no'];
$tRows[$i]['Paid_today']=$row['Paid_today'];
$tRows[$i]['Payment_mode']=$row['Payment_mode'];
$tRows[$i]['Receipt_no']=$row['Receipt_no'];
$tRows[$i]['Rsl']=$row['Rsl'];
$tRows[$i]['Nextdate']=$row['Nextdate'];
$tRows[$i]['Entry_date']=$row['Entry_date'];
$i++;
} //End While
return($tRows);
} //End getAllRecord

public function fYear($mdate)
{
$yr=substr($mdate,0,4);
$mn=substr($mdate,5,2);
$mn=round($mn);
if ($mn<4)
$tmp=($yr-1)."-".$yr;
else
$tmp=($yr)."-".($yr+1);
return($tmp);
}




}//End Class
?>
