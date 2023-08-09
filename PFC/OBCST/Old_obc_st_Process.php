<?php
session_start();
require_once 'class/class.old_obc_st.php';
require_once 'class/utility.class.php';

//$objUtility=new Utility();
$objOld_obc_st=new Old_obc_st();
$objOld_obc_st->LockTable("old_obc_st");
//Get Post variable
if(isset($_GET['Opr'])) //A-Add/Save  E-Edit
$opr=$_GET['Opr'];
else
$opr=0;


$cond="1=2";

if(isset($_POST['Type']))
$cond="  Type='".$_POST['Type']."'";

if(isset($_POST['Cert_yr']))
$cond.=" and Cert_yr='".$_POST['Cert_yr']."'";

if(isset($_POST['Cert_no']))
$cond.=" and Cert_no='".$_POST['Cert_no']."'";

$sql="select Type,Cert_yr,Cert_no,Origin_no,Name,Gurdian_name,Vill,Circle,Subcaste from old_obc_st where ".$cond;
$header=array("Type","Cert_yr","Cert_no","Origin_no","Name","Gurdian_name","Vill","Circle","Subcaste");

$objOld_obc_st->DefaultMark=1;

if($opr=="E") {
if($objOld_obc_st->FetchData_IN_JSON_Object($header,$sql)>0)
$_SESSION['update']=1;
else
$_SESSION['update']=0;
//$ValueList=array();
//$objOld_obc_st->FetchData_IN_JSON_Object_By_ValueList($header,$ValueList);
}



if($opr=="A") {
$datatype=array("VARCHAR","INT","INT","VARCHAR","VARCHAR","VARCHAR","VARCHAR","VARCHAR","VARCHAR");

$maxlength=array("3","10","10","50","50","50","50","50","50");

$mvalue=array();
$List=array();
for($i=0;$i<count($header);$i++)
{
$FieldIndex=$header[$i];
$DataType=$datatype[$i];
$Max=$maxlength[$i];
if(isset($_POST[$FieldIndex]))
{
$Value=$_POST[$FieldIndex];
$objOld_obc_st->CommonSet ($FieldIndex, $Value, $DataType, 0, $Max);
$mvalue[$i]=$Value;
}
}

//if($objOld_obc_st->Available())

if($_SESSION['update']==1)
{
$result=$objOld_obc_st->UpdateRecord ();
$msg="Updated";
}
else
{
$result=$objOld_obc_st->SaveRecord ();  
$msg="Saved";
}

for($i=0;$i<count($header);$i++)
{
$List[0][$i]="";
if($result==false)
{
if(isset($mvalue[$i]))
$List[0][$i]=$mvalue[$i];
}
} //for loop

if($result==true){
$List[0][0]=$mvalue[0];   //Type
$List[0][1]=$mvalue[1];   //year
$List[0][2]=$objOld_obc_st->maxCert_no($mvalue[0],$mvalue[1]);
$LL=$objOld_obc_st->returnSql;
}
//Additional HTML Object May be Required to Pass parameter through JSON, like enabling disabilng button, alert message etc
$rcount=count($header);
$header[$rcount++]="Save";  //save button
//$header[$rcount++]="msg";  //message to client
$List[0][$i]="1-Save Data";
if($result)
{
$mode="Succesfully ".$msg;
$_SESSION['update']=0;
}
else
{
if($objOld_obc_st->colUpdated>0)
{
$mode="Transaction Failed ";
$mode.=$objOld_obc_st->ValidationErrorList;
$mode.=$objOld_obc_st->Error();
}
else
$mode="Nothing to Update";
if($_SESSION['update']==1)
$List[0][$i]="1-Update Data";
}

$objOld_obc_st->Alert_Message_Through_JSON=$mode;

$objOld_obc_st->FetchData_IN_JSON_Object_By_ValueList($header , $List) ;
}//end Opr=A

if($opr=="R") {
$header=array("Save");
$List[0][0]="1-Save Data";
$objOld_obc_st->FetchData_IN_JSON_Object_By_ValueList($header , $List) ;
$_SESSION['update']=0;
}//end Opr=R, ReseT Form
$objOld_obc_st->UnlockTable(0,"old_obc_st");
?>
