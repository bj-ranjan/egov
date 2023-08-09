<?php
require_once '../class/class.config.php';
//New Line
require_once './class/class.petition_changed.php';
require_once '../class/class.sentence.php';

class Petition_master
{
private $Bo_name;    
private $Id;
private $Pet_type;
private $Pet_yr;
private $Pet_date;
private $Pet_no;
private $Applicant;
private $Relation;
private $Father;
private $Mother;
private $District;
private $Sub_division;
private $Circle_code;
private $Ps_code;
private $Mauza_code;
private $Vill_code;
private $Village;
private $Ward;
private $Co_letter;
private $Co_letter_dt;
private $Bpl;
private $Introduced_by;
private $Ast;
private $Ast_report;
private $Process_date;
private $Processed_by;
private $Bo;
private $Status;
private $Issue_date;
private $Rejected_reason;
private $Exp_dt;
private $Fees;
private $Court_fee;
private $Purpose;
private $Income;
private $Sex;
private $Dob;
private $Period;
private $Patta_no;
private $Patta_type;
private $Caste;
private $Subcaste;
private $Lac_no;
private $Part_no;
private $House_no;
private $Phone;
private $Bakijai_CaseId;
private $Entered_by;
private $Circle;
private $Mauza;
private $Ps;

private $Issued_by;
private $Challan_no;
private $Challan_amount;
private $Enclosure;
private $Xohari_requestid;

private $Old_Issued_by;
private $Old_Challan_no;
private $Old_Challan_amount;
private $Old_Enclosure;
private $Old_Xohari_requestid;


//extra Old Variable to store Pre update Data
private $Old_Bo_name;
private $Old_Id;
private $Old_Pet_type;
private $Old_Pet_yr;
private $Old_Pet_date;
private $Old_Pet_no;
private $Old_Applicant;
private $Old_Relation;
private $Old_Father;
private $Old_Mother;
private $Old_District;
private $Old_Sub_division;
private $Old_Circle_code;
private $Old_Ps_code;
private $Old_Mauza_code;
private $Old_Vill_code;
private $Old_Village;
private $Old_Ward;
private $Old_Co_letter;
private $Old_Co_letter_dt;
private $Old_Bpl;
private $Old_Introduced_by;
private $Old_Ast;
private $Old_Ast_report;
private $Old_Process_date;
private $Old_Processed_by;
private $Old_Bo;
private $Old_Status;
private $Old_Issue_date;
private $Old_Rejected_reason;
private $Old_Exp_dt;
private $Old_Fees;
private $Old_Court_fee;
private $Old_Purpose;
private $Old_Income;
private $Old_Sex;
private $Old_Dob;
private $Old_Period;
private $Old_Patta_no;
private $Old_Caste;
private $Old_Subcaste;
private $Old_Lac_no;
private $Old_Part_no;
private $Old_House_no;
private $Old_Phone;
private $Old_Bakijai_CaseId;
private $Old_Entered_by;
private $Old_Circle;
private $Old_Mauza;
private $Old_Ps;

//public $Available;
public $recordCount;
public $returnSql;
private $condString;
public $rowCommitted;
public $colUpdated;
public $updateList;

private $Def_District="Nalbari";
private $Def_Sub_division="Nalbari";
//public function _construct($i) //for PHP6
public function Petition_master()
{
$objConfig=new Config();//Connects database
//$this->Available=false;
$this->rowCommitted=0;
$this->colUpdated=0;
$this->updateList="";
$sql=" select count(*) from petition_master";
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
$sql=" select count(*) from petition_master where ".$condition;
$this->returnSql=$sql;
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
$sql="select Pet_yr,Pet_no,Pet_type,Xohari_requestid from petition_master where ".$this->condString;
$result=mysql_query($sql);
$this->returnSql=$sql;
while ($row=mysql_fetch_array($result))
{
$tRow[$i]['Pet_yr']=$row['Pet_yr'];//Primary Key-1
$tRow[$i]['Pet_no']=$row['Pet_no'];//Primary Key-2
$tRow[$i]['Pet_type']=$row['Pet_type'];//Posible Unique Field
$tRow[$i]['Xid']=$row['Xohari_requestid'];
$i++;
}
return($tRow);
}

public function getBo_name()
{
return($this->Bo_name);
}

public function setBo_name($str)
{
$this->Bo_name=$str;
}


public function getId()
{
return($this->Id);
}

public function setId($str)
{
$this->Id=$str;
}

public function getPet_type()
{
return($this->Pet_type);
}

public function setPet_type($str)
{
$this->Pet_type=$str;
}

public function getPet_yr()
{
return($this->Pet_yr);
}

public function setPet_yr($str)
{
$this->Pet_yr=$str;
}

public function getPet_date()
{
return($this->Pet_date);
}

public function setPet_date($str)
{
$this->Pet_date=$str;
}

public function getPet_no()
{
return($this->Pet_no);
}

public function setPet_no($str)
{
$this->Pet_no=$str;
}

public function getApplicant()
{
return($this->Applicant);
}

public function setApplicant($str)
{
$this->Applicant=$str;
}

public function getRelation()
{
return($this->Relation);
}

public function setRelation($str)
{
$this->Relation=$str;
}

//$Enclosure
public function getEnclosure()
{
return($this->Enclosure);
}

public function setEnclosure($str)
{
$this->Enclosure=$str;
}

public function getFather()
{
return($this->Father);
}

public function setFather($str)
{
$this->Father=$str;
}

public function getMother()
{
return($this->Mother);
}

public function setMother($str)
{
$this->Mother=$str;
}

public function getDistrict()
{
return($this->District);
}

public function setDistrict($str)
{
$this->District=$str;
}

public function getSub_division()
{
return($this->Sub_division);
}

public function setSub_division($str)
{
$this->Sub_division=$str;
}

public function getCircle_code()
{
return($this->Circle_code);
}

public function setCircle_code($str)
{
$this->Circle_code=$str;
}

public function getPs_code()
{
return($this->Ps_code);
}

public function setPs_code($str)
{
$this->Ps_code=$str;
}

public function getMauza_code()
{
return($this->Mauza_code);
}

public function setMauza_code($str)
{
$this->Mauza_code=$str;
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

public function getWard()
{
return($this->Ward);
}

public function setWard($str)
{
$this->Ward=$str;
}

public function getCo_letter()
{
return($this->Co_letter);
}

public function setCo_letter($str)
{
$this->Co_letter=$str;
}

public function getCo_letter_dt()
{
return($this->Co_letter_dt);
}

public function setCo_letter_dt($str)
{
$this->Co_letter_dt=$str;
}

public function getBpl()
{
return($this->Bpl);
}

public function setBpl($str)
{
$this->Bpl=$str;
}

public function getIntroduced_by()
{
return($this->Introduced_by);
}

public function setIntroduced_by($str)
{
$this->Introduced_by=$str;
}

public function getAst()
{
return($this->Ast);
}

public function setAst($str)
{
$this->Ast=$str;
}

public function getAst_report()
{
return($this->Ast_report);
}

public function setAst_report($str)
{
$this->Ast_report=$str;
}

public function getProcess_date()
{
return($this->Process_date);
}

public function setProcess_date($str)
{
$this->Process_date=$str;
}

public function getProcessed_by()
{
return($this->Processed_by);
}

public function setProcessed_by($str)
{
$this->Processed_by=$str;
}

public function getBo()
{
return($this->Bo);
}

public function setBo($str)
{
$this->Bo=$str;
}

public function getStatus()
{
return($this->Status);
}

public function setStatus($str)
{
$this->Status=$str;
}

public function getIssue_date()
{
return($this->Issue_date);
}

public function setIssue_date($str)
{
$this->Issue_date=$str;
}

public function getRejected_reason()
{
return($this->Rejected_reason);
}

public function setRejected_reason($str)
{
$this->Rejected_reason=$str;
}

public function getExp_dt()
{
return($this->Exp_dt);
}

public function setExp_dt($str)
{
$this->Exp_dt=$str;
}

public function getFees()
{
return($this->Fees);
}

public function setFees($str)
{
$this->Fees=$str;
}

public function getCourt_fee()
{
return($this->Court_fee);
}

public function setCourt_fee($str)
{
$this->Court_fee=$str;
}

public function getPurpose()
{
return($this->Purpose);
}

public function setPurpose($str)
{
$this->Purpose=$str;
}

public function getIncome()
{
return($this->Income);
}

public function setIncome($str)
{
$this->Income=$str;
}

public function getSex()
{
return($this->Sex);
}

public function setSex($str)
{
$this->Sex=$str;
}

public function getDob()
{
return($this->Dob);
}

public function setDob($str)
{
$this->Dob=$str;
}

public function getPeriod()
{
return($this->Period);
}

public function setPeriod($str)
{
$this->Period=$str;
}

public function getPatta_no()
{
return($this->Patta_no);
}

public function setPatta_no($str)
{
$this->Patta_no=$str;
}

public function getPatta_type()
{
return($this->Patta_type);
}

public function setPatta_type($str)
{
$this->Patta_type=$str;
}


public function getCaste()
{
return($this->Caste);
}

public function setCaste($str)
{
$this->Caste=$str;
}

public function getSubcaste()
{
return($this->Subcaste);
}

public function setSubcaste($str)
{
$this->Subcaste=$str;
}

public function getLac_no()
{
return($this->Lac_no);
}

public function setLac_no($str)
{
$this->Lac_no=$str;
}

public function getPart_no()
{
return($this->Part_no);
}

public function setPart_no($str)
{
$this->Part_no=$str;
}

public function getHouse_no()
{
return($this->House_no);
}

public function setHouse_no($str)
{
$this->House_no=$str;
}

public function getIssued_by()
{
return($this->Issued_by);
}

public function setIssued_by($str)
{
$this->Issued_by=$str;
}

public function getChallan_no()
{
return($this->Challan_no);
}

public function setChallan_no($str)
{
$this->Challan_no=$str;
}

public function getChallan_amount()
{
return($this->Challan_amount);
}

public function setChallan_amount($str)
{
$this->Challan_amount=$str;
}

public function getPhone()
{
return($this->Phone);
}

public function setPhone($str)
{
$this->Phone=$str;
}

public function getBakijai_CaseId()
{
return($this->Bakijai_CaseId);
}

public function setBakijai_CaseId($str)
{
$this->Bakijai_CaseId=$str;
}

public function getEntered_by()
{
return($this->Entered_by);
}

public function setEntered_by($str)
{
$this->Entered_by=$str;
}

public function getCircle()
{
return($this->Circle);
}

public function setCircle($str)
{
$this->Circle=$str;
}

public function getMauza()
{
return($this->Mauza);
}

public function setMauza($str)
{
$this->Mauza=$str;
}

public function getPs()
{
return($this->Ps);
}

public function setPs($str)
{
$this->Ps=$str;
}

//$Xohari_requestid
public function getXohari_requestid()
{
return($this->Xohari_requestid);
}

public function setXohari_requestid($str)
{
$this->Xohari_requestid=$str;
}


public function setCondString($str)
{
$this->condString=$str;
}



private function copyVariable()
{
$sql="select Bo_name,Issued_by,Xohari_requestid,Challan_no,Challan_amount,Enclosure,Id,Pet_type,Pet_yr,Pet_date,Pet_no,Applicant,Relation,Father,Mother,District,Sub_division,Circle_code,Ps_code,Mauza_code,Vill_code,Village,Ward,Co_letter,Co_letter_dt,Bpl,Introduced_by,Ast,Ast_report,Process_date,Processed_by,Bo,Status,Issue_date,Rejected_reason,Exp_dt,Fees,Court_fee,Purpose,Income,Sex,Dob,Period,Patta_no,Caste,Subcaste,Lac_no,Part_no,House_no,Phone,Bakijai_CaseId,Entered_by,Circle,Mauza,Ps from petition_master where Pet_yr='".$this->Pet_yr."' and Pet_no='".$this->Pet_no."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
if (strlen($row['Issued_by'])>0)
$this->Old_Issued_by=$row['Issued_by'];
else
$this->Old_Issued_by="NULL"; 

if (strlen($row['Bo_name'])>0)
$this->Old_Bo_name=$row['Bo_name'];
else
$this->Old_Bo_name="NULL";

if (strlen($row['Xohari_requestid'])>0)
$this->Old_Xohari_requestid=$row['Xohari_requestid'];
else
$this->Old_Xohari_requestid="NULL"; 

if (strlen($row['Enclosure'])>0)
$this->Old_Enclosure=$row['Enclosure'];
else
$this->Old_Enclosure="NULL"; 

if (strlen($row['Challan_no'])>0)
$this->Old_Challan_no=$row['Challan_no'];
else
$this->Old_Challan_no="NULL"; 
    
if (strlen($row['Challan_amount'])>0)
$this->Old_Challan_amount=$row['Challan_amount'];
else
$this->Old_Challan_amount="NULL"; 

if (strlen($row['Id'])>0)
$this->Old_Id=$row['Id'];
else
$this->Old_Id="NULL";
if (strlen($row['Pet_type'])>0)
$this->Old_Pet_type=$row['Pet_type'];
else
$this->Old_Pet_type="NULL";
if (strlen($row['Pet_date'])>0)
$this->Old_Pet_date=substr($row['Pet_date'],0,10);
else
$this->Old_Pet_date="NULL";
if (strlen($row['Applicant'])>0)
$this->Old_Applicant=$row['Applicant'];
else
$this->Old_Applicant="NULL";
if (strlen($row['Relation'])>0)
$this->Old_Relation=$row['Relation'];
else
$this->Old_Relation="NULL";
if (strlen($row['Father'])>0)
$this->Old_Father=$row['Father'];
else
$this->Old_Father="NULL";
if (strlen($row['Mother'])>0)
$this->Old_Mother=$row['Mother'];
else
$this->Old_Mother="NULL";
if (strlen($row['District'])>0)
$this->Old_District=$row['District'];
else
$this->Old_District="NULL";
if (strlen($row['Sub_division'])>0)
$this->Old_Sub_division=$row['Sub_division'];
else
$this->Old_Sub_division="NULL";
if (strlen($row['Circle_code'])>0)
$this->Old_Circle_code=$row['Circle_code'];
else
$this->Old_Circle_code="NULL";
if (strlen($row['Ps_code'])>0)
$this->Old_Ps_code=$row['Ps_code'];
else
$this->Old_Ps_code="NULL";
if (strlen($row['Mauza_code'])>0)
$this->Old_Mauza_code=$row['Mauza_code'];
else
$this->Old_Mauza_code="NULL";
if (strlen($row['Vill_code'])>0)
$this->Old_Vill_code=$row['Vill_code'];
else
$this->Old_Vill_code="NULL";
if (strlen($row['Village'])>0)
$this->Old_Village=$row['Village'];
else
$this->Old_Village="NULL";
if (strlen($row['Ward'])>0)
$this->Old_Ward=$row['Ward'];
else
$this->Old_Ward="NULL";
if (strlen($row['Co_letter'])>0)
$this->Old_Co_letter=$row['Co_letter'];
else
$this->Old_Co_letter="NULL";
if (strlen($row['Co_letter_dt'])>0)
$this->Old_Co_letter_dt=$row['Co_letter_dt'];
else
$this->Old_Co_letter_dt="NULL";
if (strlen($row['Bpl'])>0)
$this->Old_Bpl=$row['Bpl'];
else
$this->Old_Bpl="NULL";
if (strlen($row['Introduced_by'])>0)
$this->Old_Introduced_by=$row['Introduced_by'];
else
$this->Old_Introduced_by="NULL";
if (strlen($row['Ast'])>0)
$this->Old_Ast=$row['Ast'];
else
$this->Old_Ast="NULL";
if (strlen($row['Ast_report'])>0)
$this->Old_Ast_report=$row['Ast_report'];
else
$this->Old_Ast_report="NULL";
if (strlen($row['Process_date'])>0)
$this->Old_Process_date=substr($row['Process_date'],0,10);
else
$this->Old_Process_date="NULL";
if (strlen($row['Processed_by'])>0)
$this->Old_Processed_by=$row['Processed_by'];
else
$this->Old_Processed_by="NULL";
if (strlen($row['Bo'])>0)
$this->Old_Bo=$row['Bo'];
else
$this->Old_Bo="NULL";
if (strlen($row['Status'])>0)
$this->Old_Status=$row['Status'];
else
$this->Old_Status="NULL";
if (strlen($row['Issue_date'])>0)
$this->Old_Issue_date=substr($row['Issue_date'],0,10);
else
$this->Old_Issue_date="NULL";
if (strlen($row['Rejected_reason'])>0)
$this->Old_Rejected_reason=$row['Rejected_reason'];
else
$this->Old_Rejected_reason="NULL";
if (strlen($row['Exp_dt'])>0)
$this->Old_Exp_dt=substr($row['Exp_dt'],0,10);
else
$this->Old_Exp_dt="NULL";
if (strlen($row['Fees'])>0)
$this->Old_Fees=$row['Fees'];
else
$this->Old_Fees="NULL";
if (strlen($row['Court_fee'])>0)
$this->Old_Court_fee=$row['Court_fee'];
else
$this->Old_Court_fee="NULL";
if (strlen($row['Purpose'])>0)
$this->Old_Purpose=$row['Purpose'];
else
$this->Old_Purpose="NULL";
if (strlen($row['Income'])>0)
$this->Old_Income=$row['Income'];
else
$this->Old_Income="NULL";
if (strlen($row['Sex'])>0)
$this->Old_Sex=$row['Sex'];
else
$this->Old_Sex="NULL";
if (strlen($row['Dob'])>0)
$this->Old_Dob=substr($row['Dob'],0,10);
else
$this->Old_Dob="NULL";
if (strlen($row['Period'])>0)
$this->Old_Period=$row['Period'];
else
$this->Old_Period="NULL";
if (strlen($row['Patta_no'])>0)
$this->Old_Patta_no=$row['Patta_no'];
else
$this->Old_Patta_no="NULL";
if (strlen($row['Caste'])>0)
$this->Old_Caste=$row['Caste'];
else
$this->Old_Caste="NULL";
if (strlen($row['Subcaste'])>0)
$this->Old_Subcaste=$row['Subcaste'];
else
$this->Old_Subcaste="NULL";
if (strlen($row['Lac_no'])>0)
$this->Old_Lac_no=$row['Lac_no'];
else
$this->Old_Lac_no="NULL";
if (strlen($row['Part_no'])>0)
$this->Old_Part_no=$row['Part_no'];
else
$this->Old_Part_no="NULL";
if (strlen($row['House_no'])>0)
$this->Old_House_no=$row['House_no'];
else
$this->Old_House_no="NULL";
if (strlen($row['Phone'])>0)
$this->Old_Phone=$row['Phone'];
else
$this->Old_Phone="NULL";
if (strlen($row['Bakijai_CaseId'])>0)
$this->Old_Bakijai_CaseId=$row['Bakijai_CaseId'];
else
$this->Old_Bakijai_CaseId="NULL";
if (strlen($row['Entered_by'])>0)
$this->Old_Entered_by=$row['Entered_by'];
else
$this->Old_Entered_by="NULL";
if (strlen($row['Circle'])>0)
$this->Old_Circle=$row['Circle'];
else
$this->Old_Circle="NULL";
if (strlen($row['Mauza'])>0)
$this->Old_Mauza=$row['Mauza'];
else
$this->Old_Mauza="NULL";
if (strlen($row['Ps'])>0)
$this->Old_Ps=$row['Ps'];
else
$this->Old_Ps="NULL";
return(true);
}
else
return(false);
} //end copy variable

public function EditRecord()
{
$sql="select Bo_name,Enclosure,Challan_amount,Challan_no,Issued_by,Id,Pet_type,Pet_yr,Pet_date,Pet_no,Applicant,Relation,Father,Mother,District,Sub_division,Circle_code,Ps_code,Mauza_code,Vill_code,Village,Ward,Co_letter,Co_letter_dt,Bpl,Introduced_by,Ast,Ast_report,Process_date,Processed_by,Bo,Status,Issue_date,Rejected_reason,Exp_dt,Fees,Court_fee,Purpose,Income,Sex,Dob,Period,Patta_no,Caste,Subcaste,Lac_no,Part_no,House_no,Phone,Bakijai_CaseId,Entered_by,Circle,Mauza,Ps,Patta_type,Xohari_requestid from petition_master where Pet_yr='".$this->Pet_yr."' and Pet_no='".$this->Pet_no."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Bo_name=$row['Bo_name'];
$this->Id=$row['Id'];
$this->Pet_type=$row['Pet_type'];
$this->Pet_date=$row['Pet_date'];
$this->Applicant=$row['Applicant'];
$this->Relation=$row['Relation'];
$this->Father=$row['Father'];
$this->Patta_type=$row['Patta_type'];
$this->Mother=$row['Mother'];
$this->District=$row['District'];
$this->Sub_division=$row['Sub_division'];
$this->Circle_code=$row['Circle_code'];
$this->Ps_code=$row['Ps_code'];
$this->Mauza_code=$row['Mauza_code'];
$this->Vill_code=$row['Vill_code'];
$this->Village=$row['Village'];
$this->Ward=$row['Ward'];
$this->Co_letter=$row['Co_letter'];
$this->Co_letter_dt=$row['Co_letter_dt'];
$this->Bpl=$row['Bpl'];
$this->Introduced_by=$row['Introduced_by'];
$this->Ast=$row['Ast'];
$this->Ast_report=$row['Ast_report'];
$this->Process_date=$row['Process_date'];
$this->Processed_by=$row['Processed_by'];
$this->Bo=$row['Bo'];
$this->Status=$row['Status'];
$this->Issue_date=$row['Issue_date'];
$this->Rejected_reason=$row['Rejected_reason'];
$this->Exp_dt=$row['Exp_dt'];
$this->Fees=$row['Fees'];
$this->Court_fee=$row['Court_fee'];
$this->Purpose=$row['Purpose'];
$this->Income=$row['Income'];
$this->Sex=$row['Sex'];
$this->Dob=$row['Dob'];
$this->Period=$row['Period'];
$this->Patta_no=$row['Patta_no'];
$this->Caste=$row['Caste'];
$this->Subcaste=$row['Subcaste'];
$this->Lac_no=$row['Lac_no'];
$this->Part_no=$row['Part_no'];
$this->House_no=$row['House_no'];
$this->Phone=$row['Phone'];
$this->Bakijai_CaseId=$row['Bakijai_CaseId'];
$this->Entered_by=$row['Entered_by'];
$this->Circle=$row['Circle'];
$this->Mauza=$row['Mauza'];
$this->Ps=$row['Ps'];
$this->Xohari_requestid=$row['Xohari_requestid'];
//Challan_amount,Challan_no,Issued_by
$this->Challan_amount=$row['Challan_amount'];
$this->Challan_no=$row['Challan_no'];
$this->Issued_by=$row['Issued_by'];
$this->Enclosure=$row['Enclosure'];
return(true);
}
else
return(false);
} //end EditRecord


public function EditXohari($id)
{
$sql="select Bo_name,Enclosure,Challan_amount,Challan_no,Issued_by,Id,Pet_type,Pet_yr,Pet_date,Pet_no,Applicant,Relation,Father,Mother,District,Sub_division,Circle_code,Ps_code,Mauza_code,Vill_code,Village,Ward,Co_letter,Co_letter_dt,Bpl,Introduced_by,Ast,Ast_report,Process_date,Processed_by,Bo,Status,Issue_date,Rejected_reason,Exp_dt,Fees,Court_fee,Purpose,Income,Sex,Dob,Period,Patta_no,Caste,Subcaste,Lac_no,Part_no,House_no,Phone,Bakijai_CaseId,Entered_by,Circle,Mauza,Ps,Patta_type,Xohari_requestid from petition_master where Xohari_requestid='".$id."'";
$this->returnSql=$sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($row)
{
//$this->Available=true;
$this->Bo_name=$row['Bo_name'];
$this->Id=$row['Id'];
$this->Pet_no=$row['Pet_no'];
$this->Pet_yr=$row['Pet_yr'];
$this->Pet_type=$row['Pet_type'];
$this->Pet_date=$row['Pet_date'];
$this->Applicant=$row['Applicant'];
$this->Relation=$row['Relation'];
$this->Father=$row['Father'];
$this->Patta_type=$row['Patta_type'];
$this->Mother=$row['Mother'];
$this->District=$row['District'];
$this->Sub_division=$row['Sub_division'];
$this->Circle_code=$row['Circle_code'];
$this->Ps_code=$row['Ps_code'];
$this->Mauza_code=$row['Mauza_code'];
$this->Vill_code=$row['Vill_code'];
$this->Village=$row['Village'];
$this->Ward=$row['Ward'];
$this->Co_letter=$row['Co_letter'];
$this->Co_letter_dt=$row['Co_letter_dt'];
$this->Bpl=$row['Bpl'];
$this->Introduced_by=$row['Introduced_by'];
$this->Ast=$row['Ast'];
$this->Ast_report=$row['Ast_report'];
$this->Process_date=$row['Process_date'];
$this->Processed_by=$row['Processed_by'];
$this->Bo=$row['Bo'];
$this->Status=$row['Status'];
$this->Issue_date=$row['Issue_date'];
$this->Rejected_reason=$row['Rejected_reason'];
$this->Exp_dt=$row['Exp_dt'];
$this->Fees=$row['Fees'];
$this->Court_fee=$row['Court_fee'];
$this->Purpose=$row['Purpose'];
$this->Income=$row['Income'];
$this->Sex=$row['Sex'];
$this->Dob=$row['Dob'];
$this->Period=$row['Period'];
$this->Patta_no=$row['Patta_no'];
$this->Caste=$row['Caste'];
$this->Subcaste=$row['Subcaste'];
$this->Lac_no=$row['Lac_no'];
$this->Part_no=$row['Part_no'];
$this->House_no=$row['House_no'];
$this->Phone=$row['Phone'];
$this->Bakijai_CaseId=$row['Bakijai_CaseId'];
$this->Entered_by=$row['Entered_by'];
$this->Circle=$row['Circle'];
$this->Mauza=$row['Mauza'];
$this->Ps=$row['Ps'];
$this->Xohari_requestid=$row['Xohari_requestid'];
//Challan_amount,Challan_no,Issued_by
$this->Challan_amount=$row['Challan_amount'];
$this->Challan_no=$row['Challan_no'];
$this->Issued_by=$row['Issued_by'];
$this->Enclosure=$row['Enclosure'];
return(true);
}
else
return(false);
} //end EditXohari

public function Available()
{
$sql="select Id from petition_master where Pet_yr='".$this->Pet_yr."' and Pet_no='".$this->Pet_no."'";
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
$sql="delete from petition_master where Pet_yr='".$this->Pet_yr."' and Pet_no='".$this->Pet_no."'";
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
$sql="update petition_master set ";
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

if ($this->Old_Bo_name!=$this->Bo_name &&  strlen($this->Bo_name)>0)
{
if ($this->Bo_name=="NULL")
$sql=$sql."Bo_name=NULL";
else
$sql=$sql."Bo_name='".$this->Bo_name."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Bo_name=".$this->Bo_name.", ";
}


if ($this->Old_Pet_type!=$this->Pet_type &&  strlen($this->Pet_type)>0)
{
if ($this->Pet_type=="NULL")
$sql=$sql."Pet_type=NULL";
else
$sql=$sql."Pet_type='".$this->Pet_type."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Pet_type=".$this->Pet_type.", ";
}

if ($this->Old_Enclosure!=$this->Enclosure &&  strlen($this->Enclosure)>0)
{
if ($this->Enclosure=="NULL")
$sql=$sql."Enclosure=NULL";
else
$sql=$sql."Enclosure='".$this->Enclosure."'";
$sql=$sql.",";
$i++;
}

if ($this->Old_Pet_date!=$this->Pet_date &&  strlen($this->Pet_date)>0)
{
if ($this->Pet_date=="NULL")
$sql=$sql."Pet_date=NULL";
else
$sql=$sql."Pet_date='".$this->Pet_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Pet_date=".$this->Pet_date.", ";
}

//Xohari_requestid
if ($this->Old_Xohari_requestid!=$this->Xohari_requestid &&  strlen($this->Xohari_requestid)>0)
{
if ($this->Xohari_requestid=="NULL")
$sql=$sql."Xohari_requestid=NULL";
else
$sql=$sql."Xohari_requestid='".$this->Xohari_requestid."'";
$sql=$sql.",";
$i++;
}

if ($this->Old_Applicant!=$this->Applicant &&  strlen($this->Applicant)>0)
{
if ($this->Applicant=="NULL")
$sql=$sql."Applicant=NULL";
else
$sql=$sql."Applicant='".$this->Applicant."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Applicant=".$this->Applicant.", ";
}

if ($this->Old_Challan_amount!=$this->Challan_amount &&  strlen($this->Challan_amount)>0)
{
if ($this->Challan_amount=="NULL")
$sql=$sql."Challan_amount=NULL";
else
$sql=$sql."Challan_amount='".$this->Challan_amount."'";
$sql=$sql.",";
$i++;
}

if ($this->Old_Challan_no!=$this->Challan_no &&  strlen($this->Challan_no)>0)
{
if ($this->Challan_no=="NULL")
$sql=$sql."Challan_no=NULL";
else
$sql=$sql."Challan_no='".$this->Challan_no."'";
$sql=$sql.",";
$i++;
}

if ($this->Old_Issued_by!=$this->Issued_by &&  strlen($this->Issued_by)>0)
{
if ($this->Issued_by=="NULL")
$sql=$sql."Issued_by=NULL";
else
$sql=$sql."Issued_by='".$this->Issued_by."'";
$sql=$sql.",";
$i++;
}

if ($this->Old_Relation!=$this->Relation &&  strlen($this->Relation)>0)
{
if ($this->Relation=="NULL")
$sql=$sql."Relation=NULL";
else
$sql=$sql."Relation='".$this->Relation."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Relation=".$this->Relation.", ";
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

if ($this->Old_Mother!=$this->Mother &&  strlen($this->Mother)>0)
{
if ($this->Mother=="NULL")
$sql=$sql."Mother=NULL";
else
$sql=$sql."Mother='".$this->Mother."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Mother=".$this->Mother.", ";
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

if ($this->Old_Sub_division!=$this->Sub_division &&  strlen($this->Sub_division)>0)
{
if ($this->Sub_division=="NULL")
$sql=$sql."Sub_division=NULL";
else
$sql=$sql."Sub_division='".$this->Sub_division."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Sub_division=".$this->Sub_division.", ";
}

if ($this->Old_Circle_code!=$this->Circle_code &&  strlen($this->Circle_code)>0)
{
if ($this->Circle_code=="NULL")
$sql=$sql."Circle_code=NULL";
else
$sql=$sql."Circle_code='".$this->Circle_code."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Circle_code=".$this->Circle_code.", ";
}

if ($this->Old_Ps_code!=$this->Ps_code &&  strlen($this->Ps_code)>0)
{
if ($this->Ps_code=="NULL")
$sql=$sql."Ps_code=NULL";
else
$sql=$sql."Ps_code='".$this->Ps_code."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Ps_code=".$this->Ps_code.", ";
}

if ($this->Old_Mauza_code!=$this->Mauza_code &&  strlen($this->Mauza_code)>0)
{
if ($this->Mauza_code=="NULL")
$sql=$sql."Mauza_code=NULL";
else
$sql=$sql."Mauza_code='".$this->Mauza_code."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Mauza_code=".$this->Mauza_code.", ";
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

if ($this->Old_Ward!=$this->Ward &&  strlen($this->Ward)>0)
{
if ($this->Ward=="NULL")
$sql=$sql."Ward=NULL";
else
$sql=$sql."Ward='".$this->Ward."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Ward=".$this->Ward.", ";
}

if ($this->Old_Co_letter!=$this->Co_letter &&  strlen($this->Co_letter)>0)
{
if ($this->Co_letter=="NULL")
$sql=$sql."Co_letter=NULL";
else
$sql=$sql."Co_letter='".$this->Co_letter."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Co_letter=".$this->Co_letter.", ";
}

if ($this->Old_Co_letter_dt!=$this->Co_letter_dt &&  strlen($this->Co_letter_dt)>0)
{
if ($this->Co_letter_dt=="NULL")
$sql=$sql."Co_letter_dt=NULL";
else
$sql=$sql."Co_letter_dt='".$this->Co_letter_dt."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Co_letter_dt=".$this->Co_letter_dt.", ";
}

if ($this->Old_Bpl!=$this->Bpl &&  strlen($this->Bpl)>0)
{
if ($this->Bpl=="NULL")
$sql=$sql."Bpl=NULL";
else
$sql=$sql."Bpl='".$this->Bpl."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Bpl=".$this->Bpl.", ";
}

if ($this->Old_Introduced_by!=$this->Introduced_by &&  strlen($this->Introduced_by)>0)
{
if ($this->Introduced_by=="NULL")
$sql=$sql."Introduced_by=NULL";
else
$sql=$sql."Introduced_by='".$this->Introduced_by."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Introduced_by=".$this->Introduced_by.", ";
}

if ($this->Old_Ast!=$this->Ast &&  strlen($this->Ast)>0)
{
if ($this->Ast=="NULL")
$sql=$sql."Ast=NULL";
else
$sql=$sql."Ast='".$this->Ast."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Ast=".$this->Ast.", ";
}

if ($this->Old_Ast_report!=$this->Ast_report &&  strlen($this->Ast_report)>0)
{
if ($this->Ast_report=="NULL")
$sql=$sql."Ast_report=NULL";
else
$sql=$sql."Ast_report='".$this->Ast_report."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Ast_report=".$this->Ast_report.", ";
}

if ($this->Old_Process_date!=$this->Process_date &&  strlen($this->Process_date)>0)
{
if ($this->Process_date=="NULL")
$sql=$sql."Process_date=NULL";
else
$sql=$sql."Process_date='".$this->Process_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Process_date=".$this->Process_date.", ";
}

if ($this->Old_Processed_by!=$this->Processed_by &&  strlen($this->Processed_by)>0)
{
if ($this->Processed_by=="NULL")
$sql=$sql."Processed_by=NULL";
else
$sql=$sql."Processed_by='".$this->Processed_by."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Processed_by=".$this->Processed_by.", ";
}

if ($this->Old_Bo!=$this->Bo &&  strlen($this->Bo)>0)
{
if ($this->Bo=="NULL")
$sql=$sql."Bo=NULL";
else
$sql=$sql."Bo='".$this->Bo."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Bo=".$this->Bo.", ";
}

if ($this->Old_Status!=$this->Status &&  strlen($this->Status)>0)
{
if ($this->Status=="NULL")
$sql=$sql."Status=NULL";
else
$sql=$sql."Status='".$this->Status."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Status=".$this->Status.", ";
}

if ($this->Old_Issue_date!=$this->Issue_date &&  strlen($this->Issue_date)>0)
{
if ($this->Issue_date=="NULL")
$sql=$sql."Issue_date=NULL";
else
$sql=$sql."Issue_date='".$this->Issue_date."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Issue_date=".$this->Issue_date.", ";
}

if ($this->Old_Rejected_reason!=$this->Rejected_reason &&  strlen($this->Rejected_reason)>0)
{
if ($this->Rejected_reason=="NULL")
$sql=$sql."Rejected_reason=NULL";
else
$sql=$sql."Rejected_reason='".$this->Rejected_reason."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Rejected_reason=".$this->Rejected_reason.", ";
}

if ($this->Old_Exp_dt!=$this->Exp_dt &&  strlen($this->Exp_dt)>0)
{
if ($this->Exp_dt=="NULL")
$sql=$sql."Exp_dt=NULL";
else
$sql=$sql."Exp_dt='".$this->Exp_dt."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Exp_dt=".$this->Exp_dt.", ";
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

if ($this->Old_Court_fee!=$this->Court_fee &&  strlen($this->Court_fee)>0)
{
if ($this->Court_fee=="NULL")
$sql=$sql."Court_fee=NULL";
else
$sql=$sql."Court_fee='".$this->Court_fee."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Court_fee=".$this->Court_fee.", ";
}

if ($this->Old_Purpose!=$this->Purpose &&  strlen($this->Purpose)>0)
{
if ($this->Purpose=="NULL")
$sql=$sql."Purpose=NULL";
else
$sql=$sql."Purpose='".$this->Purpose."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Purpose=".$this->Purpose.", ";
}

if ($this->Old_Income!=$this->Income &&  strlen($this->Income)>0)
{
if ($this->Income=="NULL")
$sql=$sql."Income=NULL";
else
$sql=$sql."Income='".$this->Income."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Income=".$this->Income.", ";
}

if ($this->Old_Sex!=$this->Sex &&  strlen($this->Sex)>0)
{
if ($this->Sex=="NULL")
$sql=$sql."Sex=NULL";
else
$sql=$sql."Sex='".$this->Sex."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Sex=".$this->Sex.", ";
}

if ($this->Old_Dob!=$this->Dob &&  strlen($this->Dob)>0)
{
if ($this->Dob=="NULL")
$sql=$sql."Dob=NULL";
else
$sql=$sql."Dob='".$this->Dob."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Dob=".$this->Dob.", ";
}

if ($this->Old_Period!=$this->Period &&  strlen($this->Period)>0)
{
if ($this->Period=="NULL")
$sql=$sql."Period=NULL";
else
$sql=$sql."Period='".$this->Period."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Period=".$this->Period.", ";
}

if ($this->Old_Patta_no!=$this->Patta_no &&  strlen($this->Patta_no)>0)
{
if ($this->Patta_no=="NULL")
$sql=$sql."Patta_no=NULL";
else
$sql=$sql."Patta_no='".$this->Patta_no."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Patta_no=".$this->Patta_no.", ";
}

if ($this->Old_Caste!=$this->Caste &&  strlen($this->Caste)>0)
{
if ($this->Caste=="NULL")
$sql=$sql."Caste=NULL";
else
$sql=$sql."Caste='".$this->Caste."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Caste=".$this->Caste.", ";
}

if ($this->Old_Subcaste!=$this->Subcaste &&  strlen($this->Subcaste)>0)
{
if ($this->Subcaste=="NULL")
$sql=$sql."Subcaste=NULL";
else
$sql=$sql."Subcaste='".$this->Subcaste."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Subcaste=".$this->Subcaste.", ";
}

if ($this->Old_Lac_no!=$this->Lac_no &&  strlen($this->Lac_no)>0)
{
if ($this->Lac_no=="NULL")
$sql=$sql."Lac_no=NULL";
else
$sql=$sql."Lac_no='".$this->Lac_no."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Lac_no=".$this->Lac_no.", ";
}

if ($this->Old_Part_no!=$this->Part_no &&  strlen($this->Part_no)>0)
{
if ($this->Part_no=="NULL")
$sql=$sql."Part_no=NULL";
else
$sql=$sql."Part_no='".$this->Part_no."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Part_no=".$this->Part_no.", ";
}

if ($this->Old_House_no!=$this->House_no &&  strlen($this->House_no)>0)
{
if ($this->House_no=="NULL")
$sql=$sql."House_no=NULL";
else
$sql=$sql."House_no='".$this->House_no."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."House_no=".$this->House_no.", ";
}

if ($this->Old_Phone!=$this->Phone &&  strlen($this->Phone)>0)
{
if ($this->Phone=="NULL")
$sql=$sql."Phone=NULL";
else
$sql=$sql."Phone='".$this->Phone."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Phone=".$this->Phone.", ";
}

if ($this->Old_Bakijai_CaseId!=$this->Bakijai_CaseId &&  strlen($this->Bakijai_CaseId)>0)
{
if ($this->Bakijai_CaseId=="NULL")
$sql=$sql."Bakijai_CaseId=NULL";
else
$sql=$sql."Bakijai_CaseId='".$this->Bakijai_CaseId."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Bakijai_CaseId=".$this->Bakijai_CaseId.", ";
}

if ($this->Old_Entered_by!=$this->Entered_by &&  strlen($this->Entered_by)>0)
{
if ($this->Entered_by=="NULL")
$sql=$sql."Entered_by=NULL";
else
$sql=$sql."Entered_by='".$this->Entered_by."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Entered_by=".$this->Entered_by.", ";
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

if ($this->Old_Mauza!=$this->Mauza &&  strlen($this->Mauza)>0)
{
if ($this->Mauza=="NULL")
$sql=$sql."Mauza=NULL";
else
$sql=$sql."Mauza='".$this->Mauza."'";
$sql=$sql.",";
$i++;
$this->updateList=$this->updateList."Mauza=".$this->Mauza.", ";
}

if ($this->Old_Ps!=$this->Ps &&  strlen($this->Ps)>0)
{
if ($this->Ps=="NULL")
$sql=$sql."Ps=NULL";
else
$sql=$sql."Ps='".$this->Ps."'";
$i++;
$this->updateList=$this->updateList."Ps=".$this->Ps.", ";
}
else
$sql=$sql."Ps=Ps";


$cond="  where Pet_yr='".$this->Pet_yr."' and Pet_no=".$this->Pet_no;
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
$sql1="insert into petition_master(";
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

if (strlen($this->Pet_type)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Pet_type";
if ($this->Pet_type=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Pet_type."'";
$this->updateList=$this->updateList."Pet_type=".$this->Pet_type.", ";
}

if (strlen($this->Pet_yr)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Pet_yr";
if ($this->Pet_yr=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Pet_yr."'";
$this->updateList=$this->updateList."Pet_yr=".$this->Pet_yr.", ";
}


if (strlen($this->Bo_name)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Bo_name";
if ($this->Bo_name=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Bo_name."'";
$this->updateList=$this->updateList."Bo_name=".$this->Bo_name.", ";
}

if (strlen($this->Enclosure)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Enclosure";
if ($this->Enclosure=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Enclosure."'";
$this->Enclosure=$this->Enclosure."Enclosure=".$this->Enclosure.", ";
}

echo "From Class".$this->Challan_no." ".$this->Challan_amount."<br>";
if (strlen($this->Challan_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Challan_no";
if ($this->Challan_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Challan_no."'";
$this->updateList=$this->updateList."Challan_no=".$this->Challan_no.", ";
}


if (strlen($this->Challan_amount)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Challan_amount";
if ($this->Challan_amount=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Challan_amount."'";
$this->updateList=$this->updateList."Challan_amount=".$this->Challan_amount.", ";
}


if (strlen($this->Issued_by)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Issued_by";
if ($this->Issued_by=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Issued_by."'";
$this->updateList=$this->updateList."Issued_by=".$this->Issued_by.", ";
}


if (strlen($this->Pet_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Pet_date";
if ($this->Pet_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Pet_date."'";
$this->updateList=$this->updateList."Pet_date=".$this->Pet_date.", ";
}



if (strlen($this->Patta_type)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Patta_type";
if ($this->Patta_type=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Patta_type."'";
$this->updateList=$this->updateList."Patta_type=".$this->Patta_type.", ";
}

//Xohari_requestid
if (strlen($this->Xohari_requestid)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Xohari_requestid";
if ($this->Xohari_requestid=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Xohari_requestid."'";
$this->updateList=$this->updateList."Xohari_requestid=".$this->Xohari_requestid.", ";
}



if (strlen($this->Pet_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Pet_no";
if ($this->Pet_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Pet_no."'";
$this->updateList=$this->updateList."Pet_no=".$this->Pet_no.", ";
}

if (strlen($this->Applicant)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Applicant";
if ($this->Applicant=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Applicant."'";
$this->updateList=$this->updateList."Applicant=".$this->Applicant.", ";
}

if (strlen($this->Relation)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Relation";
if ($this->Relation=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Relation."'";
$this->updateList=$this->updateList."Relation=".$this->Relation.", ";
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

if (strlen($this->Mother)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Mother";
if ($this->Mother=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Mother."'";
$this->updateList=$this->updateList."Mother=".$this->Mother.", ";
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

if (strlen($this->Sub_division)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Sub_division";
if ($this->Sub_division=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Sub_division."'";
$this->updateList=$this->updateList."Sub_division=".$this->Sub_division.", ";
}

if (strlen($this->Circle_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Circle_code";
if ($this->Circle_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Circle_code."'";
$this->updateList=$this->updateList."Circle_code=".$this->Circle_code.", ";
}

if (strlen($this->Ps_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Ps_code";
if ($this->Ps_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Ps_code."'";
$this->updateList=$this->updateList."Ps_code=".$this->Ps_code.", ";
}

if (strlen($this->Mauza_code)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Mauza_code";
if ($this->Mauza_code=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Mauza_code."'";
$this->updateList=$this->updateList."Mauza_code=".$this->Mauza_code.", ";
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

if (strlen($this->Ward)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Ward";
if ($this->Ward=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Ward."'";
$this->updateList=$this->updateList."Ward=".$this->Ward.", ";
}

if (strlen($this->Co_letter)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Co_letter";
if ($this->Co_letter=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Co_letter."'";
$this->updateList=$this->updateList."Co_letter=".$this->Co_letter.", ";
}

if (strlen($this->Co_letter_dt)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Co_letter_dt";
if ($this->Co_letter_dt=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Co_letter_dt."'";
$this->updateList=$this->updateList."Co_letter_dt=".$this->Co_letter_dt.", ";
}

if (strlen($this->Bpl)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Bpl";
if ($this->Bpl=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Bpl."'";
$this->updateList=$this->updateList."Bpl=".$this->Bpl.", ";
}

if (strlen($this->Introduced_by)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Introduced_by";
if ($this->Introduced_by=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Introduced_by."'";
$this->updateList=$this->updateList."Introduced_by=".$this->Introduced_by.", ";
}

if (strlen($this->Ast)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Ast";
if ($this->Ast=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Ast."'";
$this->updateList=$this->updateList."Ast=".$this->Ast.", ";
}

if (strlen($this->Ast_report)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Ast_report";
if ($this->Ast_report=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Ast_report."'";
$this->updateList=$this->updateList."Ast_report=".$this->Ast_report.", ";
}

if (strlen($this->Process_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Process_date";
if ($this->Process_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Process_date."'";
$this->updateList=$this->updateList."Process_date=".$this->Process_date.", ";
}

if (strlen($this->Processed_by)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Processed_by";
if ($this->Processed_by=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Processed_by."'";
$this->updateList=$this->updateList."Processed_by=".$this->Processed_by.", ";
}

if (strlen($this->Bo)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Bo";
if ($this->Bo=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Bo."'";
$this->updateList=$this->updateList."Bo=".$this->Bo.", ";
}

if (strlen($this->Status)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Status";
if ($this->Status=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Status."'";
$this->updateList=$this->updateList."Status=".$this->Status.", ";
}

if (strlen($this->Issue_date)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Issue_date";
if ($this->Issue_date=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Issue_date."'";
$this->updateList=$this->updateList."Issue_date=".$this->Issue_date.", ";
}

if (strlen($this->Rejected_reason)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Rejected_reason";
if ($this->Rejected_reason=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Rejected_reason."'";
$this->updateList=$this->updateList."Rejected_reason=".$this->Rejected_reason.", ";
}

if (strlen($this->Exp_dt)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Exp_dt";
if ($this->Exp_dt=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Exp_dt."'";
$this->updateList=$this->updateList."Exp_dt=".$this->Exp_dt.", ";
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

if (strlen($this->Court_fee)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Court_fee";
if ($this->Court_fee=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Court_fee."'";
$this->updateList=$this->updateList."Court_fee=".$this->Court_fee.", ";
}

if (strlen($this->Purpose)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Purpose";
if ($this->Purpose=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Purpose."'";
$this->updateList=$this->updateList."Purpose=".$this->Purpose.", ";
}

if (strlen($this->Income)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Income";
if ($this->Income=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Income."'";
$this->updateList=$this->updateList."Income=".$this->Income.", ";
}

if (strlen($this->Sex)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Sex";
if ($this->Sex=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Sex."'";
$this->updateList=$this->updateList."Sex=".$this->Sex.", ";
}

if (strlen($this->Dob)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Dob";
if ($this->Dob=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Dob."'";
$this->updateList=$this->updateList."Dob=".$this->Dob.", ";
}

if (strlen($this->Period)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Period";
if ($this->Period=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Period."'";
$this->updateList=$this->updateList."Period=".$this->Period.", ";
}

if (strlen($this->Patta_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Patta_no";
if ($this->Patta_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Patta_no."'";
$this->updateList=$this->updateList."Patta_no=".$this->Patta_no.", ";
}

if (strlen($this->Caste)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Caste";
if ($this->Caste=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Caste."'";
$this->updateList=$this->updateList."Caste=".$this->Caste.", ";
}

if (strlen($this->Subcaste)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Subcaste";
if ($this->Subcaste=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Subcaste."'";
$this->updateList=$this->updateList."Subcaste=".$this->Subcaste.", ";
}

if (strlen($this->Lac_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Lac_no";
if ($this->Lac_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Lac_no."'";
$this->updateList=$this->updateList."Lac_no=".$this->Lac_no.", ";
}

if (strlen($this->Part_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Part_no";
if ($this->Part_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Part_no."'";
$this->updateList=$this->updateList."Part_no=".$this->Part_no.", ";
}

if (strlen($this->House_no)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."House_no";
if ($this->House_no=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->House_no."'";
$this->updateList=$this->updateList."House_no=".$this->House_no.", ";
}

if (strlen($this->Phone)>9)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Phone";
if ($this->Phone=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Phone."'";
$this->updateList=$this->updateList."Phone=".$this->Phone.", ";
}

if (strlen($this->Bakijai_CaseId)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Bakijai_CaseId";
if ($this->Bakijai_CaseId=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Bakijai_CaseId."'";
$this->updateList=$this->updateList."Bakijai_CaseId=".$this->Bakijai_CaseId.", ";
}

if (strlen($this->Entered_by)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Entered_by";
if ($this->Entered_by=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Entered_by."'";
$this->updateList=$this->updateList."Entered_by=".$this->Entered_by.", ";
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

if (strlen($this->Mauza)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Mauza";
if ($this->Mauza=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Mauza."'";
$this->updateList=$this->updateList."Mauza=".$this->Mauza.", ";
}

if (strlen($this->Ps)>0)
{
$mcol++;
if ($mcol>1)
{
$sql1=$sql1.",";
$sql=$sql.",";
}
$sql1=$sql1."Ps";
if ($this->Ps=="NULL")
$sql=$sql."NULL";
else
$sql=$sql."'".$this->Ps."'";
$this->updateList=$this->updateList."Ps=".$this->Ps.", ";
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


public function maxPet_no($yr)
{
$sql="select max(Pet_no) from petition_master where Pet_yr='".$yr."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]+1);
else
return(1);
}

public function maxID()
{
$sql="select max(id) from petition_master ";
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
$sql="select Bo_name,Enclosure,Challan_no,Challan_amount,Issued_by,Id,Pet_type,Pet_yr,Xohari_requestid,Pet_date,Pet_no,Applicant,Relation,Father,Mother,District,Sub_division,Circle_code,Ps_code,Mauza_code,Vill_code,Village,Ward,Co_letter,Co_letter_dt,Bpl,Introduced_by,Ast,Ast_report,Process_date,Processed_by,Bo,Status,Issue_date,Rejected_reason,Exp_dt,Fees,Court_fee,Purpose,Income,Sex,Dob,Period,Patta_no,Caste,Subcaste,Lac_no,Part_no,House_no,Phone,Bakijai_CaseId,Entered_by,Circle,Mauza,Ps from petition_master where ".$this->condString;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Bo_name']=$row['Bo_name'];    
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Xohari_requestid']=$row['Xohari_requestid'];
$tRows[$i]['Pet_type']=$row['Pet_type'];

$tRows[$i]['Challan_no']=$row['Challan_no'];
$tRows[$i]['Challan_amount']=$row['Challan_amount'];
$tRows[$i]['Issued_by']=$row['Issued_by'];
//Enclosure
$tRows[$i]['Enclosure']=$row['Enclosure'];

$tRows[$i]['Pet_yr']=$row['Pet_yr'];
$tRows[$i]['Pet_date']=$row['Pet_date'];
$tRows[$i]['Pet_no']=$row['Pet_no'];
$tRows[$i]['Applicant']=$row['Applicant'];
$tRows[$i]['Relation']=$row['Relation'];
$tRows[$i]['Father']=$row['Father'];
$tRows[$i]['Mother']=$row['Mother'];
$tRows[$i]['District']=$row['District'];
$tRows[$i]['Sub_division']=$row['Sub_division'];
$tRows[$i]['Circle_code']=$row['Circle_code'];
$tRows[$i]['Ps_code']=$row['Ps_code'];
$tRows[$i]['Mauza_code']=$row['Mauza_code'];
$tRows[$i]['Vill_code']=$row['Vill_code'];
$tRows[$i]['Village']=$row['Village'];
$tRows[$i]['Ward']=$row['Ward'];
$tRows[$i]['Co_letter']=$row['Co_letter'];
$tRows[$i]['Co_letter_dt']=$row['Co_letter_dt'];
$tRows[$i]['Bpl']=$row['Bpl'];
$tRows[$i]['Introduced_by']=$row['Introduced_by'];
$tRows[$i]['Ast']=$row['Ast'];
$tRows[$i]['Ast_report']=$row['Ast_report'];
$tRows[$i]['Process_date']=$row['Process_date'];
$tRows[$i]['Processed_by']=$row['Processed_by'];
$tRows[$i]['Bo']=$row['Bo'];
$tRows[$i]['Status']=$row['Status'];
$tRows[$i]['Issue_date']=$row['Issue_date'];
$tRows[$i]['Rejected_reason']=$row['Rejected_reason'];
$tRows[$i]['Exp_dt']=$row['Exp_dt'];
$tRows[$i]['Fees']=$row['Fees'];
$tRows[$i]['Court_fee']=$row['Court_fee'];
$tRows[$i]['Purpose']=$row['Purpose'];
$tRows[$i]['Income']=$row['Income'];
$tRows[$i]['Sex']=$row['Sex'];
$tRows[$i]['Dob']=$row['Dob'];
$tRows[$i]['Period']=$row['Period'];
$tRows[$i]['Patta_no']=$row['Patta_no'];
$tRows[$i]['Caste']=$row['Caste'];
$tRows[$i]['Subcaste']=$row['Subcaste'];
$tRows[$i]['Lac_no']=$row['Lac_no'];
$tRows[$i]['Part_no']=$row['Part_no'];
$tRows[$i]['House_no']=$row['House_no'];
$tRows[$i]['Phone']=$row['Phone'];
$tRows[$i]['Bakijai_CaseId']=$row['Bakijai_CaseId'];
$tRows[$i]['Entered_by']=$row['Entered_by'];
$tRows[$i]['Circle']=$row['Circle'];
$tRows[$i]['Mauza']=$row['Mauza'];
$tRows[$i]['Ps']=$row['Ps'];
$i++;
} //End While
return($tRows);
} //End getAllRecord



public function getTopRecord($totrec)
{
$tRows=array();
$sql="select Bo_name,Enclosure,Challan_no,Challan_amount,Issued_by,Id,Pet_type,Pet_yr,Pet_date,Xohari_requestid,Pet_no,Applicant,Relation,Father,Mother,District,Sub_division,Circle_code,Ps_code,Mauza_code,Vill_code,Village,Ward,Co_letter,Co_letter_dt,Bpl,Introduced_by,Ast,Ast_report,Process_date,Processed_by,Bo,Status,Issue_date,Rejected_reason,Exp_dt,Fees,Court_fee,Purpose,Income,Sex,Dob,Period,Patta_no,Caste,Subcaste,Lac_no,Part_no,House_no,Phone,Bakijai_CaseId,Entered_by,Circle,Mauza,Ps from petition_master where ".$this->condString." LIMIT ".$totrec;
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]['Id']=$row['Id'];
$tRows[$i]['Bo_name']=$row['Bo_name'];   
$tRows[$i]['Xohari_requestid']=$row['Xohari_requestid'];
$tRows[$i]['Pet_type']=$row['Pet_type'];
$tRows[$i]['Pet_yr']=$row['Pet_yr'];

$tRows[$i]['Challan_no']=$row['Challan_no'];
$tRows[$i]['Challan_amount']=$row['Challan_amount'];
$tRows[$i]['Issued_by']=$row['Issued_by'];
$tRows[$i]['Enclosure']=$row['Enclosure'];

$tRows[$i]['Pet_date']=$row['Pet_date'];
$tRows[$i]['Pet_no']=$row['Pet_no'];
$tRows[$i]['Applicant']=$row['Applicant'];
$tRows[$i]['Relation']=$row['Relation'];
$tRows[$i]['Father']=$row['Father'];
$tRows[$i]['Mother']=$row['Mother'];
$tRows[$i]['District']=$row['District'];
$tRows[$i]['Sub_division']=$row['Sub_division'];
$tRows[$i]['Circle_code']=$row['Circle_code'];
$tRows[$i]['Ps_code']=$row['Ps_code'];
$tRows[$i]['Mauza_code']=$row['Mauza_code'];
$tRows[$i]['Vill_code']=$row['Vill_code'];
$tRows[$i]['Village']=$row['Village'];
$tRows[$i]['Ward']=$row['Ward'];
$tRows[$i]['Co_letter']=$row['Co_letter'];
$tRows[$i]['Co_letter_dt']=$row['Co_letter_dt'];
$tRows[$i]['Bpl']=$row['Bpl'];
$tRows[$i]['Introduced_by']=$row['Introduced_by'];
$tRows[$i]['Ast']=$row['Ast'];
$tRows[$i]['Ast_report']=$row['Ast_report'];
$tRows[$i]['Process_date']=$row['Process_date'];
$tRows[$i]['Processed_by']=$row['Processed_by'];
$tRows[$i]['Bo']=$row['Bo'];
$tRows[$i]['Status']=$row['Status'];
$tRows[$i]['Issue_date']=$row['Issue_date'];
$tRows[$i]['Rejected_reason']=$row['Rejected_reason'];
$tRows[$i]['Exp_dt']=$row['Exp_dt'];
$tRows[$i]['Fees']=$row['Fees'];
$tRows[$i]['Court_fee']=$row['Court_fee'];
$tRows[$i]['Purpose']=$row['Purpose'];
$tRows[$i]['Income']=$row['Income'];
$tRows[$i]['Sex']=$row['Sex'];
$tRows[$i]['Dob']=$row['Dob'];
$tRows[$i]['Period']=$row['Period'];
$tRows[$i]['Patta_no']=$row['Patta_no'];
$tRows[$i]['Caste']=$row['Caste'];
$tRows[$i]['Subcaste']=$row['Subcaste'];
$tRows[$i]['Lac_no']=$row['Lac_no'];
$tRows[$i]['Part_no']=$row['Part_no'];
$tRows[$i]['House_no']=$row['House_no'];
$tRows[$i]['Phone']=$row['Phone'];
$tRows[$i]['Bakijai_CaseId']=$row['Bakijai_CaseId'];
$tRows[$i]['Entered_by']=$row['Entered_by'];
$tRows[$i]['Circle']=$row['Circle'];
$tRows[$i]['Mauza']=$row['Mauza'];
$tRows[$i]['Ps']=$row['Ps'];
$i++;
} //End While
return($tRows);
} //End getAllRecord
public function getYearList()
{
$tRows=array();
$sql="select distinct pet_yr from petition_master  order by pet_yr";
$i=0;
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result))
{
$tRows[$i]=$row[0];
$i++;
} //End While
return($tRows);
} //End getYearList

//record Applicant f=father origin entry Detail in Petition Change Table
public function RecordOrigin($Pet_yr,$Pet_no,$Applicant,$Father,$Mother)
{
if(strlen($Applicant)>0 || strlen($Father)>0 || strlen($Mother)>0)
{
$objPc=new Petition_changed();
$this->setPet_yr($Pet_yr);
$this->setPet_no($Pet_no);
if($this->EditRecord())
{
if($this->getApplicant()!=$Applicant || $this->getFather()!=$Father || $this->getMother()!=$Mother)
{
$objPc->setPet_yr($Pet_yr);
$objPc->setPet_no($Pet_no);
$objPc->setPet_type($this->getPet_type());
$objPc->setApplicant($this->getApplicant());
$objPc->setFather($this->getFather());
$objPc->setMother($this->getMother());
if($objPc->SaveRecord()) //Saved origin Data in petition change table , Hence Update petitionMaster with New Data
{
$objSen=new Sentence();
$Applicant=$objSen->SentenceCase($Applicant);
$Father=$objSen->SentenceCase($Father);
$Mother=$objSen->SentenceCase($Mother);

$this->setApplicant($Applicant);
$this->setFather($Father);
$this->setMother($Mother);
$this->UpdateRecord();
//echo $this->returnSql;
}//$objPc->SaveRecord()

}//$this->getApplicant()!=$Applicant

} //Editrecord
}//strlen()
}//RecordOrigin

public function Sum($fld,$cond)
{
if(strlen($cond)<3)
$cond=true;
$sql="select sum(".$fld.") from Petition_Master where ".$cond;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
}

public function Max($fld,$cond)
{
if(strlen($cond)<3)
$cond=true;
$sql="select max(".$fld.") from Petition_Master where ".$cond;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if (strlen($row[0])>0)
return($row[0]);
else
return(0);
}

public function getSignedBy($ptype)
{
$sql="select Signed_by from Petition_type where Code='".$ptype."'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
return($row[0]);   
}

}//End Class
?>
