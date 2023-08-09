<html>
<head>
<title>New Bakijai Case</title>
</head>
<script type=text/javascript src="../validation.js"></script>
<script src="../jquery-1.10.2.min.js"></script>
<script language="JavaScript" src="../DatePicker/htmlDatePicker.js" type="text/javascript"></script>
<link href="../DatePicker/htmlDatePicker.css" rel="stylesheet">

<script language=javascript>
<!--
//On keyup event It converts englissh to Unicode

function trans(Eng,Ass)
{
var data="Param="+document.getElementById(Eng).value;
MyAjaxFunction("POST","../class/Converter.php?tag=A",data,Ass,"TEXT");
}

function transE(Eng,EngN)
{
var data="Param="+document.getElementById(Eng).value;
MyAjaxFunction("POST","../class/Converter.php?tag=E",data,EngN,"TEXT");
}


 function map(Ass, e)
    {
//It converts each Keystroke in English to Unicode Assamese in Leap Format
        var ok = true;
        var a = document.getElementById(Ass).value;
        var b = a.replace("+", "@");
        var c = b.replace("&", ">");

        var s = document.getElementById(Ass).selectionStart;  //Take the current cursor Position
        var s1 = 0;

        var data = "Param=" + c;


        var unicode = e.keyCode ? e.keyCode : e.charCode;

        if (unicode == 53 || unicode == 54 || unicode == 55)//  Tra, Khya, Jna
        {
            s1 = 2;
            alert('Its  Combination of 3 Character');
        }

        if (unicode == 56)// * Sri
        {
            s1 = 3;
            alert('Its Combination of 4 Character');
        }
        var url = "../class/Converter.php?tag=S&Pos=" + s + "&Extra=" + s1;
        if ((unicode > 31 && unicode < 47) || unicode == 8)  //8-backspace
            ok = false;

        if (document.getElementById(Ass).value != "" && ok == true)
        {
            //MyAjaxFunction("POST", url, data, Ass, "pTEXT");  //or following lines
            document.getElementById(Ass).disabled = true;
            $.ajax({type: "POST", url: url, data: data, success: function (temp) {

                    var ind = temp.indexOf("#", 0);
                    if (ind > 0)
                        document.getElementById(Ass).value = temp.substr(0, ind);//
                    else
                        document.getElementById(Ass).value = temp;
                    var mylength = parseInt(temp.length);
                    var ind1 = temp.substr(ind + 1, mylength - (ind + 1));//
                    document.getElementById(Ass).disabled = false;
                    document.getElementById(Ass).setSelectionRange(ind1, ind1);

                }}); //End $Ajax  
        }
    }//map



function direct()
{
var mvalue=myform.Mid.value;
//load mvalue in Proper Primary Key Input Box (Preferably on Last Key)
myform.Case_id.value=mvalue;

var a=myform.Case_id.value ;//Primary Key
if ( isNaN(a)==false && a!="")
{
myform.action="Form_bakijai_main.php?tag=2&ptype=0";
myform.submit();
}
}

function notice()
{
var mvalue=myform.Editme.value;
window.location="Generatenotice.php?id="+mvalue;
}

function direct1()
{
var i;
i=0;
}

function setMe()
{
myform.Case_id.focus();
}

function resetme()
{
myform.action="Form_bakijai_main.php?tag=0";
myform.submit();
}

function redirect(i)
{
myform.action="Form_bakijai_main.php?tag=2&ptype=1&mtype="+i;
myform.submit();
}

function validate()
{
var pdate=myform.Pdate.value ;
var a=myform.Case_id.value ;// Primary Key
var b=myform.Start_date.value ;
var nd=myform.Nextdate.value ;
var c=myform.Case_no.value ;
var c_length=parseInt(c.length);
var d=myform.Fin_yr.value ;
var d_length=parseInt(d.length);
var e=myform.Bank.value ;
var e_index=myform.Bank.selectedIndex;
var f=myform.Branch.value ;
var f_index=myform.Branch.selectedIndex;
var g=myform.Full_name.value ;
var g_length=parseInt(g.length);
var h=myform.Full_name_ass.value ;
var h_length=parseInt(h.length);
var i=myform.Father.value ;
var i_length=parseInt(i.length);
var j=myform.Father_ass.value ;
var j_length=parseInt(j.length);
var l=myform.Polst_code.value ;
var l_index=myform.Polst_code.selectedIndex;
var m=myform.Circle.value ;
var m_index=myform.Circle.selectedIndex;
var n=myform.Mouza.value ;
var n_index=myform.Mouza.selectedIndex;
var o=myform.Vill_code.value ;
var o_index=myform.Vill_code.selectedIndex;
var q=myform.Amount.value ;
var r=myform.Balance.value ;
var z=myform.Req_letter_no.value ;
var z_length=parseInt(z.length);
var aa=myform.Req_letter_date.value ;
if ( isNumber(a)==true   && notNull(b) &&  isdate(b,1) &&  isdate(nd,0) && notNull(c) && validateString(c) && c_length<=50 &&  validateString(d) && d_length<=50 && notNull(e) && e_index>0  && 1==1 && notNull(f) && f_index>0  && notNull(g)   && validateString(h) && h_length<=100 && notNull(i) && validateString(i) && i_length<=50 && validateString(j) && j_length<=100 && l_index>0  && m_index>0  && n_index>0  && o_index>0  && isNumber(q)==true   && validateString(z) && z_length<=50  &&  isdate(aa,0) && isNumber(r))
{
if (Number(q)==0 || Number(q)<Number(r))
alert('Invalid Loan Amount')
else
{    
if (CompareDate(b,pdate)==1)
alert('Invalid Start Date')
else
{    
//if (CompareDate(nd,pdate)==-1 || CompareDate(nd,b)==0)
if (1==2)
alert('Invalid Next Date') 
else
{
if(isNumber(c)==true) //use /
{
myform.action="Insert_bakijai_main.php";
myform.submit();    
}
else
alert('Enter Case Number Properly')
}  //CompareDate(nd,b)==-1 || CompareDate(nd,b)==0)
} // CompareDate(b,pdate)==1
} //amount>0
} //isNumber()
else
alert('Invalid Data');

}//validate


function home()
{
window.location="mainmenu.php?tag=1";
}



//change the focus to Box(a)
function ChangeFocus(a)
{
//document.getElementById(a).focus();
}

function loadb()
{
myform.Case_id.value=myform.Mid.value;
myform.edit1.disabled=false;
}

function LoadTextBox()
{
var i=myform.Editme.selectedIndex;
if(i>0)
{
myform.Mid.value=myform.Editme.value;
myform.edit1.disabled=false;
myform.notice1.disabled=false;
}    
else
{
myform.Mid.value='';
myform.edit1.disabled=true;
//myform.notice1.disabled=true;
}

//alert('Write Java Script as per requirement');
}

//END JAVA
</script>
<body>
<?php
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.bakijai_main.php';
require_once './class/class.bank_master.php';
require_once './class/class.bankbranch.php';
require_once './class/class.police_station.php';
require_once './class/class.circle.php';
require_once './class/class.mouza.php';
require_once './class/class.village.php';
require_once '../class/class.converter.php';
require_once '../class/class.sentence.php';
require_once './class/class.baki_payment.php';
require_once 'header.php';

$objConv=new Converter();
$objSen=new Sentence();
$objCaseD=new Baki_payment();

$objUtility=new Utility();
$allowedroll=3; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: Mainmenu.php?unauth=1');

if ($objUtility->checkArea($_SESSION['myArea'], 1)==false) //1 for New Bakijai Case Register
header( 'Location: Mainmenu.php?unauth=1');

$objBakijai_main=new Bakijai_main();

$fullname="";
$father="";

if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if (!is_numeric($_tag))
$_tag=0;

if ($_tag>2)
$_tag=0;

if (isset($_GET['mtype']))
$mtype=$_GET['mtype'];
else
$mtype=0;

if (!is_numeric($mtype))
$mtype=0;

$mvalue=array();
$pkarray=array();

$pdate=date('d/m/Y');

if ($_tag==1)//Return from Action Form
{
if (isset($_SESSION['mvalue']))
{
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
$mvalue[18]=0;
$mvalue[0]=$objBakijai_main->MaxCase_id();
}
else
{
$mvalue[0]="0";//Case_id
$mvalue[1]="";//Start_date
$mvalue[2]="";//Case_no
$mvalue[3]="";//nextdate
$mvalue[4]="";//Bank
$mvalue[5]="";//Branch
$mvalue[6]="";//Full_name
$mvalue[7]="";//Full_name_ass
$mvalue[8]="";//Father
$mvalue[9]="";//Father_ass
$mvalue[10]="-1";//Polst_code
$mvalue[11]="-1";//Circle
$mvalue[12]="-1";//Mouza
$mvalue[13]="-1";//Vill_code
$mvalue[14]="";//Amount
$mvalue[15]="";//Balance
$mvalue[16]="";//Req_letter_no
$mvalue[17]="";//Req_letter_date
$mvalue[18]=0;
$mvalue[19]="";//Remarks
}//end isset mvalue
if (!isset($_SESSION['msg']))
$_SESSION['msg']="";
if (!isset($_SESSION['update']))
$_SESSION['update']=0;
}//tag=1 [Return from Action form]

if ($_tag==0) //Initial Page Loading
{
$_SESSION['oldId']=0;
$_SESSION['update']=0;
$_SESSION['msg']="";
$_SESSION['mymsg']="";
// Call $objBakijai_main->MaxCase_id() Function Here if required and Load in $mvalue[0]
$mvalue[0]=$objBakijai_main->MaxCase_id();
$mvalue[1]="";//Start_date
$mvalue[2]="";//Case_no
$mvalue[3]="";//Fin_yr
$mvalue[4]="";//Bank
$mvalue[5]="";//Branch
$mvalue[6]="";//Full_name
$mvalue[7]="";//Full_name_ass
$mvalue[8]="";//Father
$mvalue[9]="";//Father_ass
// Call $objBakijai_main->MaxPolst_code() Function Here if required and Load in $mvalue[10]
$mvalue[10]="-1";//Polst_code
// Call $objBakijai_main->MaxCircle() Function Here if required and Load in $mvalue[11]
$mvalue[11]="-1";//Circle
// Call $objBakijai_main->MaxMouza() Function Here if required and Load in $mvalue[12]
$mvalue[12]="-1";//Mouza
// Call $objBakijai_main->MaxVill_code() Function Here if required and Load in $mvalue[13]
$mvalue[13]="-1";//Vill_code
$mvalue[14]="";//Amount
$mvalue[15]="";//Balance
$mvalue[16]="";//Req_letter_no
$mvalue[17]="";//Req_letter_date
$mvalue[18]=0;//last Select Box for Editing
$mvalue[19]="";//Remarks
$_SESSION['mvalue']=$mvalue;
}//tag=0[Initial Loading]

if ($_tag==2)//Post Back 
{
$_SESSION['oldId']=0;
$_SESSION['msg']="";
if (isset($_GET['ptype']))
$ptype=$_GET['ptype'];
else
$ptype=0;

//Post Back on Select Box Change,Hence reserve the value
if ($ptype==1)
{
// CAll MaxNumber Function Here if require and Load in $mvalue
if (isset($_POST['Case_id']))
$mvalue[0]=$_POST['Case_id'];
else
$mvalue[0]=0;

if (isset($_POST['Start_date']))
$mvalue[1]=$_POST['Start_date'];
else
$mvalue[1]=0;

if (isset($_POST['Case_no']))
$mvalue[2]=$_POST['Case_no'];
else
$mvalue[2]=0;

if (isset($_POST['Nextdate']))
$mvalue[3]=$_POST['Nextdate'];
else
$mvalue[3]=0;

if (isset($_POST['Bank']))
$mvalue[4]=$_POST['Bank'];
else
$mvalue[4]=0;

if (isset($_POST['Branch']))
$mvalue[5]=$_POST['Branch'];
else
$mvalue[5]=0;

if (isset($_POST['Full_name']))
$mvalue[6]=$_POST['Full_name'];
else
$mvalue[6]=0;

if (isset($_POST['Full_name_ass']))
$mvalue[7]=$_POST['Full_name_ass'];
else
$mvalue[7]=0;

if (isset($_POST['Father']))
$mvalue[8]=$_POST['Father'];
else
$mvalue[8]=0;

if (isset($_POST['Father_ass']))
$mvalue[9]=$_POST['Father_ass'];
else
$mvalue[9]=0;

if (isset($_POST['Polst_code']))
$mvalue[10]=$_POST['Polst_code'];
else
$mvalue[10]=0;

if (!is_numeric($mvalue[10]))
$mvalue[10]=-1;
if (isset($_POST['Circle']))
$mvalue[11]=$_POST['Circle'];
else
$mvalue[11]=0;

if (!is_numeric($mvalue[11]))
$mvalue[11]=-1;
if (isset($_POST['Mouza']))
$mvalue[12]=$_POST['Mouza'];
else
$mvalue[12]=0;

if (!is_numeric($mvalue[12]))
$mvalue[12]=-1;
if (isset($_POST['Vill_code']))
$mvalue[13]=$_POST['Vill_code'];
else
$mvalue[13]=0;

if (!is_numeric($mvalue[13]))
$mvalue[13]=-1;
if (isset($_POST['Amount']))
$mvalue[14]=$_POST['Amount'];
else
$mvalue[14]=0;

if (isset($_POST['Balance']))
$mvalue[15]=$_POST['Balance'];
else
$mvalue[15]=0;

//$mvalue[15]=$mvalue[14];

if (isset($_POST['Req_letter_no']))
$mvalue[16]=$_POST['Req_letter_no'];
else
$mvalue[16]=0;

if (isset($_POST['Req_letter_date']))
$mvalue[17]=$_POST['Req_letter_date'];
else
$mvalue[17]=0;

if (isset($_POST['Editme']))
$mvalue[18]=$_POST['Editme'];
else
$mvalue[18]=0;

$mvalue[19]=isset($_POST['Remarks'])?$_POST['Remarks']:'';


if (isset($_POST['Fathername']))
$father=$_POST['Fathername'];
else
$father="";

if (isset($_POST['Fullname']))
$fullname=$_POST['Fullname'];
else
$fullname="";

if ($mtype==101) //Convert Full name
{
$mvalue[7]=$objConv->English2Unicode($fullname);
$tmp=$objConv->filterEnglish($fullname);
$mvalue[6]=$objSen->SentenceCase($tmp);
}

if ($mtype==102) //Convert Father name
{
$mvalue[9]=$objConv->English2Unicode($father);
$tmp=$objConv->filterEnglish($father);
$mvalue[8]=$objSen->SentenceCase($tmp);
}

} //ptype=1



if (isset($_POST['Case_id']))
$pkarray[0]=$_POST['Case_id'];
else
$pkarray[0]=0;
$objBakijai_main->setCase_id($pkarray[0]);
if ($objBakijai_main->EditRecord()) //i.e Data Available
{ 
if ($ptype==0) //Post Back on Edit Button Click
{
$mvalue[0]=$objBakijai_main->getCase_id();
$mvalue[1]=$objUtility->to_date($objBakijai_main->getStart_date());
$mvalue[2]=$objBakijai_main->getCase_no();

$objCaseD->setCase_id($mvalue[0]);
$objCaseD->setInstalment_no("0");

if ($objCaseD->EditRecord())
{
$mvalue[3]=$objUtility->to_date ($objCaseD->getNextdate());
$mvalue[15]=$objCaseD->getPaid_today();
}
else 
{
$mvalue[3]="";
$mvalue[15]=0;
}

//echo $objCaseD->returnSql; 

$mvalue[4]=$objBakijai_main->getBank();
$mvalue[5]=$objBakijai_main->getBranch();
$mvalue[6]=$objBakijai_main->getFull_name();
$mvalue[7]=$objBakijai_main->getFull_name_ass();
$mvalue[8]=$objBakijai_main->getFather();
$mvalue[9]=$objBakijai_main->getFather_ass();
$mvalue[10]=$objBakijai_main->getPolst_code();
$mvalue[11]=$objBakijai_main->getCircle();
$mvalue[12]=$objBakijai_main->getMouza();
$mvalue[13]=$objBakijai_main->getVill_code();
$mvalue[14]=$objBakijai_main->getAmount();
//$mvalue[15]=$objBakijai_main->getBalance();
$mvalue[16]=$objBakijai_main->getReq_letter_no();
$mvalue[17]=$objUtility->to_date($objBakijai_main->getReq_letter_date());
$mvalue[18]=0;//last Select Box for Editing
$mvalue[19]=$objBakijai_main->getRemarks();
} //ptype=0
$_SESSION['update']=1;
} 
else //data not available for edit
{
$_SESSION['update']=0;
if ($ptype==0)
{
$mvalue[0]=$pkarray[0];
$mvalue[1]="";
$mvalue[2]="";
$mvalue[3]="";
$mvalue[4]=-1;
$mvalue[5]=-1;
$mvalue[6]="";
$mvalue[7]="";
$mvalue[8]="";
$mvalue[9]="";
$mvalue[10]=-1;
$mvalue[11]=-1;
$mvalue[12]=-1;
$mvalue[13]=-1;
$mvalue[14]="";
$mvalue[15]="";
$mvalue[16]="";
$mvalue[17]="";
$mvalue[18]=0;//last Select Box for Editing
$mvalue[19]="";
}//ptype=0
} //EditRecord()
} //tag==2
if($roll==0 || $roll==2)
$dis="";
else 
{    
$dis=" disabled";  
if($_tag==0)
echo $objUtility->alert("Data Entry Restricted") ;   
}
//Start of FormDesign

if(!isset($mvalue[19]))
$mvalue[19]='';
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=100%>
<form name=myform action=insert_bakijai_main.php  method=POST >
<tr><td colspan=4 align=Center bgcolor=#ccffcc><font face=arial size=3>Entry/Edit Form for Bakijai Case<br></font><font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Case ID</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=5 name="Case_id" id="Case_id" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Case_id',1)"  onblur="ChangeColor('Case_id',2)" onchange=direct1() readonly>
<font color=red size=4 face=arial><b>*</b></font>
</td>
<?php $i++; //Now i=1?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Start Date</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=10 name="Start_date" id="Start_date" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Start_date',1)"  onblur="ChangeColor('Start_date',2)">
<img src="../DatePicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(Start_date);" alt="Click Here to Pick Date">
</td>
</tr>
<?php $i++; //Now i=2?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Case Number</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=20 name="Case_no" id="Case_no" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50 onfocus="ChangeColor('Case_no',1)"  onblur="ChangeColor('Case_no',2)">
<font color=red size=2 face=arial>Numeric Part Only</font>
</td>
<?php $i++; //Now i=3?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>First Trial Date</font></td><td align=left bgcolor=#FFFFCC>
<input type=hidden size=10 name="Fin_yr" id="Fin_yr" value="-" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50 onfocus="ChangeColor('Fin_yr',1)"  onblur="ChangeColor('Fin_yr',2)" >
<input type=text size=10 name="Nextdate" id="Nextdate" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=10 onfocus="ChangeColor('Nextdate',1)"  onblur="ChangeColor('Nextdate',2)" >
<input type=hidden size=10 name="Pdate" id="Pdate" value="<?php echo $pdate; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=10>
<img src="../DatePicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(Nextdate);" alt="Click Here to Pick Date">
</td>
</tr>
<?php $i++; //Now i=4?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Bank</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objBank_master=new Bank_master();
$objBank_master->setCondString("1=1 order by bank_name" ); //Change the condition for where clause accordingly
$row=$objBank_master->getRow();
?>
<select name=Bank style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" onchange=redirect(5)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Bank_name'])
{
?>
<option selected value="<?php echo $row[$ind]['Bank_name'];?>"><?php echo $row[$ind]['Bank_name'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Bank_name'];?>"><?php echo $row[$ind]['Bank_name'];
}
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
<?php $i++; //Now i=5?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Branch</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objBankbranch=new Bankbranch();
$objBankbranch->setCondString(" bank='".$mvalue[4]."'" ); //Change the condition for where clause accordingly
$row=$objBankbranch->getRow();
?>
<select name=Branch style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" >
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Branch'])
{
?>
<option selected value="<?php echo $row[$ind]['Branch'];?>"><?php echo $row[$ind]['Branch'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Branch'];?>"><?php echo $row[$ind]['Branch'];
}
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=6?>
<tr>
<td align=right bgcolor=#FFCCCC colspan="2">
<font color=blue size=1 face=arial>Type English Text which will be converted to Assamese in Preceeding box</font></td>
<td align=left bgcolor=#FFCCCC colspan="2">
<input type=text size=40 name="Fullname" id="Fullname" value="<?php echo $fullname; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 14px" maxlength=50 onfocus="ChangeColor('Fullname',1)"  onblur="ChangeColor('Fullname',2);transE('Fullname','Full_name')" onkeyup="trans('Fullname','Full_name_ass')">
</td>
</tr>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Name of Defaulter</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=40 name="Full_name" id="Full_name" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50 onfocus="ChangeColor('Full_name',1)"  onblur="ChangeColor('Full_name',2)" >
</td>
<?php $i++; //Now i=7?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>In Assamese</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=25 name="Full_name_ass" id="Full_name_ass" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" maxlength=100   onkeyup="map('Full_name_ass',event)">
</td>
</tr>
<tr>
<td align=right bgcolor=#FFCCCC colspan="2">
<font color=blue size=1 face=arial>Type English Text which will be converted to Assamese in Preceeding box</font></td>
<td align=left bgcolor=#FFCCCC colspan="2">
<input type=text size=40 name="FullnameF" id="FullnameF" value="" style="font-family: Arial;background-color:white;color:black; font-size: 14px" maxlength=50 onfocus="ChangeColor('FullnameF',1)"  onblur="ChangeColor('FullnameF',2);transE('FullnameF','Father')"  onkeyup="trans('FullnameF','Father_ass')">>
</td>
</tr>
<?php $i++; //Now i=8?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Gurdian's Name</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=40 name="Father" id="Father" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50   onblur="ChangeColor('Father',2)" >
<font color=red size=3 face=arial>*</font>
</td>
<?php $i++; //Now i=9?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>In Assamese</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=25 name="Father_ass" id="Father_ass" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black;font-size: 18px" maxlength=100  onkeyup="map('Father_ass',event)" onblur="ChangeColor('Father_ass',2)" >
</td>
</tr>
<?php $i++; //Now i=10?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Police Station</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objPolice_station=new Police_station();
$objPolice_station->setCondString(" code>0" ); //Change the condition for where clause accordingly
$row=$objPolice_station->getRow();
?>
<select name=Polst_code style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" >
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Code'])
{
?>
<option selected value="<?php echo $row[$ind]['Code'];?>"><?php echo $row[$ind]['Name'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Code'];?>"><?php echo $row[$ind]['Name'];
}
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
<?php $i++; //Now i=11?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Circle</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objCircle=new Circle();
$objCircle->setCondString("Cir_code>0" ); //Change the condition for where clause accordingly
$row=$objCircle->getRow();
?>
<select name=Circle style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" onchange=redirect(13)>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Cir_code'])
{
?>
<option selected value="<?php echo $row[$ind]['Cir_code'];?>"><?php echo $row[$ind]['Circle'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Cir_code'];?>"><?php echo $row[$ind]['Circle'];
}
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=12?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Mouza</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objMouza=new Mouza();
$objMouza->setCondString("Cir_code=".$mvalue[11]); //Change the condition for where clause accordingly
$row=$objMouza->getRow();
?>
<select name=Mouza style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" >
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Mouza_code'])
{
?>
<option selected value="<?php echo $row[$ind]['Mouza_code'];?>"><?php echo $row[$ind]['Mouza_name'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Mouza_code'];?>"><?php echo $row[$ind]['Mouza_name'];
}
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
<?php $i++; //Now i=13?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Village</font></td><td align=left bgcolor=#FFFFCC>
<?php 
$objVillage=new Village();
$objVillage->setCondString("Cir_code=".$mvalue[11]." order by vill_name" ); //Change the condition for where clause accordingly
$row=$objVillage->getRow();
?>
<select name=Vill_code style="font-family: Arial;background-color:white;color:black; font-size: 12px;width:160px" >
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Select-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Vill_code'])
{
?>
<option selected value="<?php echo $row[$ind]['Vill_code'];?>"><?php echo $row[$ind]['Vill_name'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Vill_code'];?>"><?php echo $row[$ind]['Vill_name'];
}
} //for loop
?>
</select>
<font color=red size=3 face=arial>*</font>
</td>
</tr>
<?php $i++; //Now i=14?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Amount of Loan(Rs.)</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=10 name="Amount" id="Amount" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Amount',1)"  onblur="ChangeColor('Amount',2)">
<font color=red size=3 face=arial>*</font>
</td>
<?php $i++; //Now i=15?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Already Paid(Rs)</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=10 name="Balance" id="Balance" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Balance',1)"  onblur="ChangeColor('Balance',2)">
</td>
</tr>
<?php $i++; //Now i=16?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Bank Letter No.</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=50 name="Req_letter_no" id="Req_letter_no" value="<?php echo $mvalue[$i]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50 onfocus="ChangeColor('Req_letter_no',1)"  onblur="ChangeColor('Req_letter_no',2)">
</td>
<?php $i++; //Now i=17?>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Letter Date</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=10 name="Req_letter_date" id="Req_letter_date" value="<?php echo $mvalue[$i]; ?>" onfocus="ChangeColor('Req_letter_date',1)"  onblur="ChangeColor('Req_letter_date',2)">
<img src="../DatePicker/images/calendar.png" align="absmiddle" width="25" height="25" onClick="GetDate(Req_letter_date);" alt="Click Here to Pick Date">
</td>
</tr>
<?php $i++; //Now i=17?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Remarks(Any)</font></td><td align=left bgcolor=#FFFFCC colspan="3">
<input type=text size=50 name="Remarks" id="Remarks" value="<?php echo $mvalue[19]; ?>" style="font-family: Arial;background-color:white;color:black; font-size: 12px" maxlength=50 >
</td>
</tr>

<?php $i++; //Now i=18?>
<tr><td align=right bgcolor=#FFFFCC>
<?php
if ($_SESSION['update']==1)
echo"<font size=2 face=arial color=#CC3333>Update Mode";
else
echo"<font size=2 face=arial color=#6666FF>Insert Mode";
?>
</td><td align=left bgcolor=#FFFFCC colspan="3">
<input type=button value=Save/Update  name=Save onclick=validate()  style="font-family:arial;font-weight:bold; font-size: 14px ; background-color:white;color:blue;width:100px" <?php echo $dis;?>>
<input type=button value=Menu  name=back1 onclick=home() onfocus="ChangeFocus('Case_id')" style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px">
<input type=button value=Reset  name=reset1 onclick=resetme() style="font-family:arial; font-size: 14px ; background-color:white;color:green;width:100px">
&nbsp;&nbsp;
<a href="../Keyboard.htm" target="blank">Phonetic KeyBoard</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="../lipi.htm" target="blank">Lipi KeyBoard</a>

</td></tr>
<tr><td align=right>
<?php 
$objBakijai_main->setCondString(" disposed='N' and court_case='N' and case_id not in( select case_id from baki_payment where INSTALMENT_NO>0)" ); //Change the condition for where clause accordingly
$row=$objBakijai_main->getRow();
?>
<input type=text name='Mid' id='Mid' value='' size='4'  onkeyup='loadb()'>
<select name=Editme style="font-family: Arial;background-color:white;color:black;font-size: 12px;width:100px" onchange=LoadTextBox()>
<?php $dval="0";?>
<option value="<?php echo $dval ;?>">-Click to Edit-
<?php 
for($ind=0;$ind<count($row);$ind++)
{
if ($mvalue[$i]==$row[$ind]['Case_id'])
{
?>
<option selected value="<?php echo $row[$ind]['Case_id'];?>"><?php echo $row[$ind]['Case_id'];?>
<?php 
}
else
{
?>
<option  value="<?php echo $row[$ind]['Case_id'];?>"><?php echo $row[$ind]['Case_id'];
}
} //for loop
?>
</select>
</td><td align=left COLSPAN="3"><font face="arial" size="3" color="blue">
<input type=button value=Edit  name=edit1 onclick=direct()  style="font-family:arial; font-size: 14px ; background-color:white;color:blue;width:100px" disabled>
<?PHP
if ($_SESSION['update']==0 && (strlen($_SESSION['mymsg'])>0 || $_SESSION['oldId']>0) ) 
{
?>
<a href="GenerateNotice.php?id=<?php echo $_SESSION['oldId'];?>" target=_blank>Generate Notice to Debtor</a>

<a href="GenerateForm3.php?id=<?php echo $_SESSION['oldId'];?>" target=_blank>Generate FORM-3</a>

<?PHP } 
?>



</TD>
</tr>
</table>
</form>
<?php

if ($mtype==100)
{
if (strlen($_SESSION['mymsg'])>0)  
echo $objUtility->alert ($_SESSION['mymsg']) ;  
}

if($mtype==0)
echo $objUtility->focus("Case_id");

if($mtype==1)//Postback from Case_id
echo $objUtility->focus("Start_date");

if($mtype==2)//Postback from Start_date
echo $objUtility->focus("Case_no");

if($mtype==3)//Postback from Case_no
echo $objUtility->focus("Fin_yr");

if($mtype==4)//Postback from Fin_yr
echo $objUtility->focus("Bank");

if($mtype==5)//Postback from Bank
echo $objUtility->focus("Branch");

if($mtype==6)//Postback from Branch
echo $objUtility->focus("Full_name");

if($mtype==7)//Postback from Full_name
echo $objUtility->focus("Full_name_ass");

if($mtype==8)//Postback from Full_name_ass
echo $objUtility->focus("Father");

if($mtype==9)//Postback from Father
echo $objUtility->focus("Father_ass");

if($mtype==10)//Postback from Father_ass
echo $objUtility->focus("Polst_code");

if($mtype==12)//Postback from Polst_code
echo $objUtility->focus("Circle");

if($mtype==13)//Postback from Circle
echo $objUtility->focus("Mouza");

if($mtype==14)//Postback from Mouza
echo $objUtility->focus("Vill_code");

if($mtype==15)//Postback from Vill_code
echo $objUtility->focus("Amount");

if($mtype==17)//Postback from Amount
echo $objUtility->focus("Balance");

if($mtype==18)//Postback from Balance
echo $objUtility->focus("Req_letter_no");

if($mtype==26)//Postback from Req_letter_no
echo $objUtility->focus("Req_letter_date");

if($mtype==27)//Postback from Req_letter_date
echo $objUtility->focus("Case_id");

//if ($mtype==101)
//echo $objUtility->focus("Fathername");    

if ($mtype==102)
echo $objUtility->focus("Polst_code");

?>
</body>
</html>
