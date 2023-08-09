
<?php
require_once '../class/class.config.php';
require_once '../class/utility.class.php';
require_once 'class.baki_payment.php';
class Bakijai_main
{
private $Case_id;
private $Start_date;
private $Case_no;
private $Fin_yr;
private $Bank;
private $Branch;
private $Full_name;
private $Full_name_ass;
private $Father;
private $Father_ass;
private $District;
private $Polst_code;
private $Circle;
private $Mouza;
private $Vill_code;
private $Village;
private $Amount;
private $Balance;
private $No_of_notice_served;
private $Disposed;
private $Disposed_date;
private $Payment_mode;
private $Certificate_officer;
private $User_code;
private $Court_case;
private $Req_letter_no;
private $Req_letter_date;
private $Entry_date;
private $Remarks;
//extra Old Variable to store Pre update Data
private $Old_Case_id;
private $Old_Start_date;
private $Old_Case_no;
private $Old_Fin_yr;
private $Old_Bank;
private $Old_Branch;
private $Old_Full_name;
private $Old_Full_name_ass;
private $Old_Father;
private $Old_Father_ass;
private $Old_District;
private $Old_Polst_code;
private $Old_Circle;
private $Old_Mouza;
private $Old_Vill_code;
private $Old_Village;
private $Old_Amount;
private $Old_Balance;
private $Old_No_of_notice_served;
private $Old_Disposed;
private $Old_Disposed_date;
private $Old_Payment_mode;
private $Old_Certificate_officer;
private $Old_User_code;
private $Old_Court_case;
private $Old_Req_letter_no;
private $Old_Req_letter_date;
private $Old_Entry_date;
private $Old_Remarks;


public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

private $Def_District="Nalbari";
private $Def_Disposed="N";
private $Def_Payment_mode="Cash";
private $Def_Court_case="N";
//public function _construct($i) //for PHP6
public function Bakijai_main()
{
$objConfig=new Config();//Connects database
$Available=false;
$rowCommitted=0;
$colUpdated=0;
$updateList="";
$sql=" select count(*) from bakijai_main";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
$this->recordCount=$row[0];
else
$this->recordCount=0;
$this->condString="1=1";
if (isset($_SESSION['uid']))
$this->User_code=$_SESSION['uid'];
else
$this->User_code="-";    
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
$sql=" select count(*) from bakijai_main where ".$condition;
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
$sql="select Case_id,Case_no from bakijai_main where ".$this->condString;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Case_id']=$row['Case_id'];//Primary Key-1
$tRow[$i]['Case_no']=$row['Case_no'];//Posible Unique Field
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

public function getStart_date()
{
return($this->Start_date);
}

public function setStart_date($str)
{
$this->Start_date=$str;
}

public function getCase_no()
{
return($this->Case_no);
}

public function setCase_no($str)
{
$this->Case_no=$str;
}

public function getFin_yr()
{
return($this->Fin_yr);
}

public function setFin_yr($str)
{
$this->Fin_yr=$str;
}

public function getBank()
{
return($this->Bank);
}

public function setBank($str)
{
$this->Bank=$str;
}

public function getBranch()
{
return($this->Branch);
}

public function setBranch($str)
{
$this->Branch=$str;
}


public function getRemarks()
{
return($this->Remarks);
}

public function setRemarks($str)
{
$this->Remarks=$str;
}


public function getFull_name()
{
return($this->Full_name);
}

public function setFull_name($str)
{
$this->Full_name=$str;
}

public function getFull_name_ass()
{
return($this->Full_name_ass);
}

public function setFull_name_ass($str)
{
$this->Full_name_ass=$str;
}

public function getFather()
{
return($this->Father);
}

public function setFather($str)
{
$this->Father=$str;
}

public function getFather_ass()
{
return($this->Father_ass);
}

public function setFather_ass($str)
{
$this->Father_ass=$str;
}

public function getDistrict()
{
return($this->District);
}

public function setDistrict($str)
{
$this->District=$str;
}

public function getPolst_code()
{
return($this->Polst_code);
}

public function setPolst_code($str)
{
$this->Polst_code=$str;
}

public function getCircle()
{
return($this->Circle);
}

public function setCircle($str)
{
$this->Circle=$str;
}

public function getMouza()
{
return($this->Mouza);
}

public function setMouza($str)
{
$this->Mouza=$str;
}

public function getVill_code()
{
return($this->Vill_code);
}

public function setVill_code($str)
{
$this->Vill_code=$str;
}

public function getVillage()
{
return($this->Village);
}

public function setVillage($str)
{
$this->Village=$str;
}

public function getAmount()
{
return($this->Amount);
}

public function setAmount($str)
{
$this->Amount=$str;
}

public function getBalance()
{
return($this->Balance);
}

public function setBalance($str)
{
$this->Balance=$str;
}

public function getNo_of_notice_served()
{
return($this->No_of_notice_served);
}

public function setNo_of_notice_served($str)
{
$this->No_of_notice_served=$str;
}

public function getDisposed()
{
return($this->Disposed);
}

public function setDisposed($str)
{
$this->Disposed=$str;
}

public function getDisposed_date()
{
return($this->Disposed_date);
}

public function setDisposed_date($str)
{
$this->Disposed_date=$str;
}

public function getPayment_mode()
{
return($this->Payment_mode);
}

public function setPayment_mode($str)
{
$this->Payment_mode=$str;
}

public function getCertificate_officer()
{
return($this->Certificate_officer);
}

public function setCertificate_officer($str)
{
$this->Certificate_officer=$str;
}

public function getUser_code()
{
return($this->User_code);
}

public function setUser_code($str)
{
$this->User_code=$str;
}

public function getCourt_case()
{
return($this->Court_case);
}

public function setCourt_case($str)
{
$this->Court_case=$str;
}

public function getReq_letter_no()
{
return($this->Req_letter_no);
}

public function setReq_letter_no($str)
{
$this->Req_letter_no=$str;
}

public function getReq_letter_date()
{
return($this->Req_letter_date);
}

public function setReq_letter_date($str)
{
$this->Req_letter_date=$str;
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
$sql="select Case_id,Start_date,Case_no,Fin_yr,Bank,Branch,Full_name,Full_name_ass,Father,Father_ass,District,Polst_code,Circle,Mouza,Vill_code,Village,Amount,Balance,No_of_notice_served,Disposed,Disposed_date,Payment_mode,Certificate_officer,User_code,Court_case,Req_letter_no,Req_letter_date,Entry_date from bakijai_main where Case_id='".$this->Case_id."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Start_date'])>0)
$this->Old_Start_date=substr($row['Start_date'],0,10);
else
$this->Old_Start_date="NULL";
if (strlen($row['Case_no'])>0)
$this->Old_Case_no=$row['Case_no'];
else
$this->Old_Case_no="NULL";
if (strlen($row['Fin_yr'])>0)
$this->Old_Fin_yr=$row['Fin_yr'];
else
$this->Old_Fin_yr="NULL";
if (strlen($row['Bank'])>0)
$this->Old_Bank=$row['Bank'];
else
$this->Old_Bank="NULL";
if (strlen($row['Branch'])>0)
$this->Old_Branch=$row['Branch'];
else
$this->Old_Branch="NULL";
if (strlen($row['Full_name'])>0)
$this->Old_Full_name=$row['Full_name'];
else
$this->Old_Full_name="NULL";
if (strlen($row['Full_name_ass'])>0)
$this->Old_Full_name_ass=$row['Full_name_ass'];
else
$this->Old_Full_name_ass="NULL";
if (strlen($row['Father'])>0)
$this->Old_Father=$row['Father'];
else
$this->Old_Father="NULL";
if (strlen($row['Father_ass'])>0)
$this->Old_Father_ass=$row['Father_ass'];
else
$this->Old_Father_ass="NULL";
if (strlen($row['District'])>0)
$this->Old_District=$row['District'];
else
$this->Old_District="NULL";
if (strlen($row['Polst_code'])>0)
$this->Old_Polst_code=$row['Polst_code'];
else
$this->Old_Polst_code="NULL";
if (strlen($row['Circle'])>0)
$this->Old_Circle=$row['Circle'];
else
$this->Old_Circle="NULL";
if (strlen($row['Mouza'])>0)
$this->Old_Mouza=$row['Mouza'];
else
$this->Old_Mouza="NULL";
if (strlen($row['Vill_code'])>0)
$this->Old_Vill_code=$row['Vill_code'];
else
$this->Old_Vill_code="NULL";
if (strlen($row['Village'])>0)
$this->Old_Village=$row['Village'];
else
$this->Old_Village="NULL";
if (strlen($row['Amount'])>0)
$this->Old_Amount=$row['Amount'];
else
$this->Old_Amount="NULL";
if (strlen($row['Balance'])>0)
$this->Old_Balance=$row['Balance'];
else
$this->Old_Balance="NULL";
if (strlen($row['No_of_notice_served'])>0)
$this->Old_No_of_notice_served=$row['No_of_notice_served'];
else
$this->Old_No_of_notice_served="NULL";
if (strlen($row['Disposed'])>0)
$this->Old_Disposed=$row['Disposed'];
else
$this->Old_Disposed="NULL";
if (strlen($row['Disposed_date'])>0)
$this->Old_Disposed_date=substr($row['Disposed_date'],0,10);
else
$this->Old_Disposed_date="NULL";
if (strlen($row['Payment_mode'])>0)
$this->Old_Payment_mode=$row['Payment_mode'];
else
$this->Old_Payment_mode="NULL";
if (strlen($row['Certificate_officer'])>0)
$this->Old_Certificate_officer=$row['Certificate_officer'];
else
$this->Old_Certificate_officer="NULL";
if (strlen($row['User_code'])>0)
$this->Old_User_code=$row['User_code'];
else
$this->Old_User_code="NULL";
if (strlen($row['Court_case'])>0)
$this->Old_Court_case=$row['Court_case'];
else
$this->Old_Court_case="NULL";
if (strlen($row['Req_letter_no'])>0)
$this->Old_Req_letter_no=$row['Req_letter_no'];
else
$this->Old_Req_letter_no="NULL";
if (strlen($row['Req_letter_date'])>0)
$this->Old_Req_letter_date=substr($row['Req_letter_date'],0,10);
else
$this->Old_Req_letter_date="NULL";
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
$sql="select Case_id,Start_date,Case_no,Fin_yr,Bank,Branch,Full_name,Full_name_ass,Father,Father_ass,District,Polst_code,Circle,Mouza,Vill_code,Village,Amount,Balance,No_of_notice_served,Disposed,Disposed_date,Payment_mode,Certificate_officer,User_code,Court_case,Req_letter_no,Req_letter_date,Entry_date,Remarks from bakijai_main where Case_id='".$this->Case_id."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
$this->Available=true;
$this->Start_date=$row['Start_date'];
$this->Case_no=$row['Case_no'];
$this->Fin_yr=$row['Fin_yr'];
$this->Bank=$row['Bank'];
$this->Branch=$row['Branch'];
$this->Full_name=$row['Full_name'];
$this->Full_name_ass=$row['Full_name_ass'];
$this->Father=$row['Father'];
$this->Father_ass=$row['Father_ass'];
$this->District=$row['District'];
$this->Polst_code=$row['Polst_code'];
$this->Circle=$row['Circle'];
$this->Mouza=$row['Mouza'];
$this->Vill_code=$row['Vill_code'];
$this->Village=$row['Village'];
$this->Amount=$row['Amount'];
$this->Balance=$row['Balance'];
$this->No_of_notice_served=$row['No_of_notice_served'];
$this->Disposed=$row['Disposed'];
$this->Disposed_date=$row['Disposed_date'];
$this->Payment_mode=$row['Payment_mode'];
$this->Certificate_officer=$row['Certificate_officer'];
$this->User_code=$row['User_code'];
$this->Court_case=$row['Court_case'];
$this->Req_letter_no=$row['Req_letter_no'];
$this->Req_letter_date=$row['Req_letter_date'];
$this->Entry_date=$row['Entry_date'];
$this->Remarks=$row['Remarks'];
}
else
$this->Available=false;
$this->returnSql=$sql;
return($this->Available);
} //end editrecord


public function DeleteRecord()
{
$sql="delete from bakijai_main where Case_id='".$this->Case_id."'";
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
$sql="update bakijai_main set ";
if ($this->Old_Start_date!=$this->Start_date &&  strlen($this->Start_date)>0)
{
if ($this->Start_date=="NULL")
$sql=$sql."Start_date=NULL";
else
$sql=$sql."Start_date='".$this->Start_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Start_date=".$this->Start_date.", ";
}

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

if ($this->Old_Fin_yr!=$this->Fin_yr &&  strlen($this->Fin_yr)>0)
{
if ($this->Fin_yr=="NULL")
$sql=$sql."Fin_yr=NULL";
else
$sql=$sql."Fin_yr='".$this->Fin_yr."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Fin_yr=".$this->Fin_yr.", ";
}

if ($this->Old_Bank!=$this->Bank &&  strlen($this->Bank)>0)
{
if ($this->Bank=="NULL")
$sql=$sql."Bank=NULL";
else
$sql=$sql."Bank='".$this->Bank."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Bank=".$this->Bank.", ";
}

if ($this->Old_Branch!=$this->Branch &&  strlen($this->Branch)>0)
{
if ($this->Branch=="NULL")
$sql=$sql."Branch=NULL";
else
$sql=$sql."Branch='".$this->Branch."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Branch=".$this->Branch.", ";
}

if ($this->Old_Full_name!=$this->Full_name &&  strlen($this->Full_name)>0)
{
if ($this->Full_name=="NULL")
$sql=$sql."Full_name=NULL";
else
$sql=$sql."Full_name='".$this->Full_name."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Full_name=".$this->Full_name.", ";
}

if ($this->Old_Full_name_ass!=$this->Full_name_ass &&  strlen($this->Full_name_ass)>0)
{
if ($this->Full_name_ass=="NULL")
$sql=$sql."Full_name_ass=NULL";
else
$sql=$sql."Full_name_ass='".$this->Full_name_ass."'";
$sql=$sql.",";
$i++;
//$this->updateList=$this->updateList."Full_name_ass=".$this->Full_name_ass.", ";
}

if ($this->Old_Father!=$this->Father &&  strlen($this->Father)>0)
{
if ($this->Father=="NULL")
$sql=$sql."Father=NULL";
else
$sql=$sql."Father='".$this->Father."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Father=".$this->Father.", ";
}

if ($this->Old_Father_ass!=$this->Father_ass &&  strlen($this->Father_ass)>0)
{
if ($this->Father_ass=="NULL")
$sql=$sql."Father_ass=NULL";
else
$sql=$sql."Father_ass='".$this->Father_ass."'";
$sql=$sql.",";
$i++;
//$this->updateList=$this->updateList."Father_ass=".$this->Father_ass.", ";
}

if ($this->Old_District!=$this->District &&  strlen($this->District)>0)
{
if ($this->District=="NULL")
$sql=$sql."District=NULL";
else
$sql=$sql."District='".$this->District."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."District=".$this->District.", ";
}

if ($this->Old_Polst_code!=$this->Polst_code &&  strlen($this->Polst_code)>0)
{
if ($this->Polst_code=="NULL")
$sql=$sql."Polst_code=NULL";
else
$sql=$sql."Polst_code='".$this->Polst_code."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Polst_code=".$this->Polst_code.", ";
}

if ($this->Old_Circle!=$this->Circle &&  strlen($this->Circle)>0)
{
if ($this->Circle=="NULL")
$sql=$sql."Circle=NULL";
else
$sql=$sql."Circle='".$this->Circle."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Circle=".$this->Circle.", ";
}

if ($this->Old_Mouza!=$this->Mouza &&  strlen($this->Mouza)>0)
{
if ($this->Mouza=="NULL")
$sql=$sql."Mouza=NULL";
else
$sql=$sql."Mouza='".$this->Mouza."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Mouza=".$this->Mouza.", ";
}

if ($this->Old_Vill_code!=$this->Vill_code &&  strlen($this->Vill_code)>0)
{
if ($this->Vill_code=="NULL")
$sql=$sql."Vill_code=NULL";
else
$sql=$sql."Vill_code='".$this->Vill_code."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Vill_code=".$this->Vill_code.", ";
}


$rem=$this->Remarks;
$rem=str_replace("'","''",$rem);
if ($this->Remarks=="NULL")
$sql=$sql."Remarks=NULL";
else
$sql=$sql."Remarks='".$rem."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Vill_code=".$this->Remarks.", ";



if ($this->Old_Village!=$this->Village &&  strlen($this->Village)>0)
{
if ($this->Village=="NULL")
$sql=$sql."Village=NULL";
else
$sql=$sql."Village='".$this->Village."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Village=".$this->Village.", ";
}

if ($this->Old_Amount!=$this->Amount &&  strlen($this->Amount)>0)
{
if ($this->Amount=="NULL")
$sql=$sql."Amount=NULL";
else
$sql=$sql."Amount='".$this->Amount."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Amount=".$this->Amount.", ";
}

if ($this->Old_Balance!=$this->Balance &&  strlen($this->Balance)>0)
{
if ($this->Balance=="NULL")
$sql=$sql."Balance=NULL";
else
$sql=$sql."Balance='".$this->Balance."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Balance=".$this->Balance.", ";
}

if ($this->Old_No_of_notice_served!=$this->No_of_notice_served &&  strlen($this->No_of_notice_served)>0)
{
if ($this->No_of_notice_served=="NULL")
$sql=$sql."No_of_notice_served=NULL";
else
$sql=$sql."No_of_notice_served='".$this->No_of_notice_served."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."No_of_notice_served=".$this->No_of_notice_served.", ";
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

if ($this->Old_Disposed_date!=$this->Disposed_date &&  strlen($this->Disposed_date)>0)
{
if ($this->Disposed_date=="NULL")
$sql=$sql."Disposed_date=NULL";
else
$sql=$sql."Disposed_date='".$this->Disposed_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Disposed_date=".$this->Disposed_date.", ";
}


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

if ($this->Old_Certificate_officer!=$this->Certificate_officer &&  strlen($this->Certificate_officer)>0)
{
if ($this->Certificate_officer=="NULL")
$sql=$sql."Certificate_officer=NULL";
else
$sql=$sql."Certificate_officer='".$this->Certificate_officer."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Certificate_officer=".$this->Certificate_officer.", ";
}

//if ($this->Old_User_code!=$this->User_code &&  strlen($this->User_code)>0)
//{
//if ($this->User_code=="NULL")
//$sql=$sql."User_code=NULL";
//else
//$sql=$sql."User_code='".$this->User_code."'";
//$sql=$sql.",";
//$i++;
//$this->updateList=$this->updateList."User_code=".$this->User_code.", ";
//}

if ($this->Old_Court_case!=$this->Court_case &&  strlen($this->Court_case)>0)
{
if ($this->Court_case=="NULL")
$sql=$sql."Court_case=NULL";
else
$sql=$sql."Court_case='".$this->Court_case."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Court_case=".$this->Court_case.", ";
}

if ($this->Old_Req_letter_no!=$this->Req_letter_no &&  strlen($this->Req_letter_no)>0)
{
if ($this->Req_letter_no=="NULL")
$sql=$sql."Req_letter_no=NULL";
else
$sql=$sql."Req_letter_no='".$this->Req_letter_no."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Req_letter_no=".$this->Req_letter_no.", ";
}

if ($this->Old_Req_letter_date!=$this->Req_letter_date &&  strlen($this->Req_letter_date)>0)
{
if ($this->Req_letter_date=="NULL")
$sql=$sql."Req_letter_date=NULL";
else
$sql=$sql."Req_letter_date='".$this->Req_letter_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Req_letter_date=".$this->Req_letter_date;
}

//if ($this->Old_Entry_date!=$this->Entry_date &&  strlen($this->Entry_date)>0)
//{
//if ($this->Entry_date=="NULL")
//$sql=$sql."Entry_date=NULL";
//else
$sql=$sql."Entry_date=Entry_date";
//$i++;
//$this->updateList=$this->updateList."Entry_date=".$this->Entry_date.", ";
//}
//else
//$sql=$sql."Entry_date=Entry_date";


$cond="  where Case_id='".$this->Case_id."'";
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
$sql1="insert into bakijai_main(";
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

if (strlen($this->Start_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Start_date";
if ($this->Start_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Start_date."'";
$this->updateList=$this->updateList."Start_date=".$this->Start_date.", ";
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

if (strlen($this->Fin_yr)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Fin_yr";
if ($this->Fin_yr=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Fin_yr."'";
$this->updateList=$this->updateList."Fin_yr=".$this->Fin_yr.", ";
}

if (strlen($this->Bank)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Bank";
if ($this->Bank=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Bank."'";
$this->updateList=$this->updateList."Bank=".$this->Bank.", ";
}

if (strlen($this->Branch)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Branch";
if ($this->Branch=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Branch."'";
$this->updateList=$this->updateList."Branch=".$this->Branch.", ";
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
$this->updateList=$this->updateList."Branch=".$this->Remarks.", ";
}



if (strlen($this->Full_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Full_name";
if ($this->Full_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Full_name."'";
$this->updateList=$this->updateList."Full_name=".$this->Full_name.", ";
}

if (strlen($this->Full_name_ass)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Full_name_ass";
if ($this->Full_name_ass=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Full_name_ass."'";
$this->updateList=$this->updateList."Full_name_ass=".$this->Full_name_ass.", ";
}

if (strlen($this->Father)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Father";
if ($this->Father=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Father."'";
$this->updateList=$this->updateList."Father=".$this->Father.", ";
}

if (strlen($this->Father_ass)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Father_ass";
if ($this->Father_ass=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Father_ass."'";
$this->updateList=$this->updateList."Father_ass=".$this->Father_ass.", ";
}

if (strlen($this->District)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."District";
if ($this->District=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->District."'";
$this->updateList=$this->updateList."District=".$this->District.", ";
}

if (strlen($this->Polst_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Polst_code";
if ($this->Polst_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Polst_code."'";
$this->updateList=$this->updateList."Polst_code=".$this->Polst_code.", ";
}

if (strlen($this->Circle)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Circle";
if ($this->Circle=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Circle."'";
$this->updateList=$this->updateList."Circle=".$this->Circle.", ";
}

if (strlen($this->Mouza)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Mouza";
if ($this->Mouza=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Mouza."'";
$this->updateList=$this->updateList."Mouza=".$this->Mouza.", ";
}

if (strlen($this->Vill_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Vill_code";
if ($this->Vill_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Vill_code."'";
$this->updateList=$this->updateList."Vill_code=".$this->Vill_code.", ";
}

if (strlen($this->Village)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Village";
if ($this->Village=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Village."'";
$this->updateList=$this->updateList."Village=".$this->Village.", ";
}

if (strlen($this->Amount)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Amount";
if ($this->Amount=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Amount."'";
$this->updateList=$this->updateList."Amount=".$this->Amount.", ";
}

if (strlen($this->Balance)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Balance";
if ($this->Balance=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Balance."'";
$this->updateList=$this->updateList."Balance=".$this->Balance.", ";
}

if (strlen($this->No_of_notice_served)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."No_of_notice_served";
if ($this->No_of_notice_served=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->No_of_notice_served."'";
$this->updateList=$this->updateList."No_of_notice_served=".$this->No_of_notice_served.", ";
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

if (strlen($this->Disposed_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Disposed_date";
if ($this->Disposed_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Disposed_date."'";
$this->updateList=$this->updateList."Disposed_date=".$this->Disposed_date.", ";
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

if (strlen($this->Certificate_officer)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Certificate_officer";
if ($this->Certificate_officer=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Certificate_officer."'";
$this->updateList=$this->updateList."Certificate_officer=".$this->Certificate_officer.", ";
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

if (strlen($this->Court_case)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Court_case";
if ($this->Court_case=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Court_case."'";
$this->updateList=$this->updateList."Court_case=".$this->Court_case.", ";
}

if (strlen($this->Req_letter_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Req_letter_no";
if ($this->Req_letter_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Req_letter_no."'";
$this->updateList=$this->updateList."Req_letter_no=".$this->Req_letter_no.", ";
}

if (strlen($this->Req_letter_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Req_letter_date";
if ($this->Req_letter_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Req_letter_date."'";
$this->updateList=$this->updateList."Req_letter_date=".$this->Req_letter_date.", ";
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
$sql="select max(Case_id) from bakijai_main";
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
$sql="select Remarks,Case_id,Start_date,Case_no,Fin_yr,Bank,Branch,Full_name,Full_name_ass,Father,Father_ass,District,Polst_code,Circle,Mouza,Vill_code,Village,Amount,Balance,No_of_notice_served,Disposed,Disposed_date,Payment_mode,Certificate_officer,User_code,Court_case,Req_letter_no,Req_letter_date,Entry_date from bakijai_main where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Remarks']=$row['Remarks'];
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['Start_date']=$row['Start_date'];
$tRows[$i]['Case_no']=$row['Case_no'];
$tRows[$i]['Fin_yr']=$row['Fin_yr'];
$tRows[$i]['Bank']=$row['Bank'];
$tRows[$i]['Branch']=$row['Branch'];
$tRows[$i]['Full_name']=$row['Full_name'];
$tRows[$i]['Full_name_ass']=$row['Full_name_ass'];
$tRows[$i]['Father']=$row['Father'];
$tRows[$i]['Father_ass']=$row['Father_ass'];
$tRows[$i]['District']=$row['District'];
$tRows[$i]['Polst_code']=$row['Polst_code'];
$tRows[$i]['Circle']=$row['Circle'];
$tRows[$i]['Mouza']=$row['Mouza'];
$tRows[$i]['Vill_code']=$row['Vill_code'];
$tRows[$i]['Village']=$row['Village'];
$tRows[$i]['Amount']=$row['Amount'];
$tRows[$i]['Balance']=$row['Balance'];
$tRows[$i]['No_of_notice_served']=$row['No_of_notice_served'];
$tRows[$i]['Disposed']=$row['Disposed'];
$tRows[$i]['Disposed_date']=$row['Disposed_date'];
$tRows[$i]['Payment_mode']=$row['Payment_mode'];
$tRows[$i]['Certificate_officer']=$row['Certificate_officer'];
$tRows[$i]['User_code']=$row['User_code'];
$tRows[$i]['Court_case']=$row['Court_case'];
$tRows[$i]['Req_letter_no']=$row['Req_letter_no'];
$tRows[$i]['Req_letter_date']=$row['Req_letter_date'];
$tRows[$i]['Entry_date']=$row['Entry_date'];
$i++;
} //End While
$this->returnSql=$sql;
return($tRows);
} //End getAllRecord


public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Case_id,Start_date,Case_no,Fin_yr,Bank,Branch,Full_name,Full_name_ass,Father,Father_ass,District,Polst_code,Circle,Mouza,Vill_code,Village,Amount,Balance,No_of_notice_served,Disposed,Disposed_date,Payment_mode,Certificate_officer,User_code,Court_case,Req_letter_no,Req_letter_date,Entry_date from bakijai_main where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['Start_date']=$row['Start_date'];
$tRows[$i]['Case_no']=$row['Case_no'];
$tRows[$i]['Fin_yr']=$row['Fin_yr'];
$tRows[$i]['Bank']=$row['Bank'];
$tRows[$i]['Branch']=$row['Branch'];
$tRows[$i]['Full_name']=$row['Full_name'];
$tRows[$i]['Full_name_ass']=$row['Full_name_ass'];
$tRows[$i]['Father']=$row['Father'];
$tRows[$i]['Father_ass']=$row['Father_ass'];
$tRows[$i]['District']=$row['District'];
$tRows[$i]['Polst_code']=$row['Polst_code'];
$tRows[$i]['Circle']=$row['Circle'];
$tRows[$i]['Mouza']=$row['Mouza'];
$tRows[$i]['Vill_code']=$row['Vill_code'];
$tRows[$i]['Village']=$row['Village'];
$tRows[$i]['Amount']=$row['Amount'];
$tRows[$i]['Balance']=$row['Balance'];
$tRows[$i]['No_of_notice_served']=$row['No_of_notice_served'];
$tRows[$i]['Disposed']=$row['Disposed'];
$tRows[$i]['Disposed_date']=$row['Disposed_date'];
$tRows[$i]['Payment_mode']=$row['Payment_mode'];
$tRows[$i]['Certificate_officer']=$row['Certificate_officer'];
$tRows[$i]['User_code']=$row['User_code'];
$tRows[$i]['Court_case']=$row['Court_case'];
$tRows[$i]['Req_letter_no']=$row['Req_letter_no'];
$tRows[$i]['Req_letter_date']=$row['Req_letter_date'];
$tRows[$i]['Entry_date']=$row['Entry_date'];
$i++;
} //End While
return($tRows);
} //End getAllRecord


public function getSelectedRecord($mday)
{
$tRows=array();
$sql="select Case_id,Full_name,Amount from Bakijai_main where disposed='N' and court_case='N' order by case_id";
$objBp=new Baki_payment();
$objU=new Utility();
$i=0;
$result=mysql_query($sql);
$date1=date('Y-m-d');
while ($row=mysql_fetch_array($result))
{
$date2=$objBp->NextCallDate($row['Case_id']);
if (strlen($date2)>4)
{
$lap=$objU->dateDiff($date1, $date2);
if ($lap>=$mday)
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['Full_name']=$row['Full_name'];
$tRows[$i]['Amount']=$row['Amount'];
$tRows[$i]['Lapsday']=$lap;
$tRows[$i]['Duedate']=$objU->to_date($date2);
$tRows[$i]['Balance']=$objBp->BalanecAmount($row['Case_id']);
$i++;
} //end if
} //end if
} //End While
return($tRows);
} //End getSelected

public function getDueCase($date1)
{
$tRows=array();
$sql="select Case_id,Full_name,Amount from Bakijai_main where disposed='N' and court_case='N' order by case_id";
$objBp=new Baki_payment();
$objU=new Utility();
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$date2=$objBp->NextCallDate($row['Case_id']);
if (strlen($date2)>2)
{
if ($objU->dateDiff($date1, $date2)==0)
{
$tRows[$i]['Case_id']=$row['Case_id'];
$tRows[$i]['Full_name']=$row['Full_name'];
$tRows[$i]['Amount']=$row['Amount'];
$tRows[$i]['Duedate']=$objU->to_date($date2);
$date2=$objBp->LastPayDate($row['Case_id']);
$tRows[$i]['Lastdate']=$objU->to_date($date2);
$tRows[$i]['Balance']=$objBp->BalanecAmount($row['Case_id']);
$i++;
} //end if
} //date
} //End While
return($tRows);
} //End getSelected

public function InterestDue($caseid,$asondate)
{
$paid=0;
$total=0;
$this->setCase_id($caseid);
if($this->EditRecord())
{
$amount=$this->getAmount();
$date2=substr($this->getStart_date(),0,10);
}
else
{
$amount=0;
$date2=date('Y-m-d');
}
$objUtility=new Utility();
$objBp=new Baki_payment();
$str=" Paid_today>0 and case_id=".$caseid."  order by Pay_date";
$objBp->setCondString($str);
$row=$objBp->getAllRecord();
//echo "row".count($row);
if(count($row)==0)
{
$nodays=$objUtility->dateDiff(date('Y-m-d'), $date2);   
$total=round(($amount*6.25*$nodays)/36500);    
}
else
{
for($ii=0;$ii<count($row);$ii++)
{
$due=$amount-$paid;    
$date1=substr($row[$ii]['Pay_date'],0,10);
$nodays=$objUtility->dateDiff($date1, $date2);
//echo $date1."-".$date2."=".$nodays."<br>";
$paid=$paid+$row[$ii]['Paid_today'];
$interest=round(($due*6.25*$nodays)/36500);
//echo $ii.".".$nodays."-".$due."<br>";
$date2=$date1;
$total=$total+$interest;
}  
}
//echo $total;
return($total);
} //end Interestdue

public function PaidUptoDate($id,$mdate)
{
//$sql="select sum(paid_today) from baki_payment where case_id=".$id." and payment_mode<>'OTS' and pay_date<'".$mdate."'";
$sql="select sum(paid_today) from baki_payment where case_id=".$id." and payment_mode<>'OTS' and pay_date<='".$mdate."'";

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

}//End Class
?>
