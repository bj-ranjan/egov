<html>
<head>
<title>Duplicate Print</title>
</head>
<script type="text/javascript" src="../Validation.js"></script>
<script language=javascript>
<!--
function direct()
{
var i;
i=0;
}

function direct1()
{
var i;
i=0;
}
function setMe()
{
myform.Pet_yr.focus();
}

function redirect(i)
{
var a_index=myform.Pet_yr.value;
var b_index=myform.Pet_no.value;
if(Number(a_index)>0 && Number(b_index)>0)
{
myform.setAttribute("target","_self");
myform.action="PrintCert.php?tag=2&ptype=1&mtype="+i;
myform.submit();
}
}

function validate()
{
var j=myform.Pet_type.value;
var mc="Printcert.php?tag=1";

var a=myform.Pet_yr.value;
var b=myform.Pet_no.value;
var c=myform.Idate.value;
var d=myform.Idate1.value;
if(DateValid('Idate',1))
{
if (CompareDate(c,d)==-1)  
alert('Invalid Certificate Date');  
else
{
if(j=="PR")
mc="PRC.php?yr="+a+"&pno="+b+"&idate="+c;
if(j=="CT")
mc="Caste.php?yr="+a+"&pno="+b+"&idate="+c;
if(j=="NC")
mc="NCL.php?yr="+a+"&pno="+b+"&idate="+c;
if(j=="DM")
mc="Domicile.php?yr="+a+"&pno="+b+"&idate="+c;
if(j=="LH")
mc="NOK.php?yr="+a+"&pno="+b+"&idate="+c;
if(j=="BK")
mc="Bakijai.php?yr="+a+"&pno="+b+"&idate="+c;
}
} //datevalid

if(Number(a)>0 && Number(b)>0)
{
//myform.setAttribute("target","_self");//Open in Self
myform.setAttribute("target","_blank");//Open in New Window   
myform.action=mc;
myform.submit();
}
else
alert('Invalid Data');
}




function home()
{
window.location="mainmenu.php?tag=1";
}



//change the focus to Box(a)
function ChangeFocus(a)
{
document.getElementById(a).focus();
}

//change color on focus to Box(a)
function ChangeColor(el,i)
{
if (i==1) // on focus
document.getElementById(el).style.backgroundColor = '#99CC33';
if (i==2) //on lostfocus
{
document.getElementById(el).style.backgroundColor = 'white';
var temp=document.getElementById(el).value;
trimBlank(temp,el);
}
}//changeColor on Focus


function isNumber(ad)
{
if (isNaN(ad)==false && notNull(ad))
return(true);
else
return(false);
}
 
function LoadTextBox()
{
var i=myform.Editme.selectedIndex;
if(i>0)
myform.edit1.disabled=false;
else
myform.edit1.disabled=true;
//alert('Write Java Script as per requirement');
}
function trimBlank(str,a)
{

var newstr="";
var prev=0;
for (var i = 0; i < str.length; i++)
{
k=parseInt(str.charCodeAt(i));
if (k==32 && prev==0)
{
newstr=newstr;
}
else
{
newstr=newstr+str.substr(i,1);
}
if (k==32)
prev=0;
else
prev=1;
}
document.getElementById(a).value=newstr;
}//trimBlank


//END JAVA
</script>
<body>
<?php
//Start FORMBODY
session_start();
require_once '../class/utility.class.php';
require_once './class/class.petition_master.php';
require_once '../class/class.officer.php';
require_once './class/class.petition_type.php';
require_once 'header.php';
$objUtility=new Utility();

$Fees=0;
$allowedroll=2; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
$prdate="";
if (($roll==-1) || ($roll>$allowedroll))
header( 'Location: ../index.php');

if ($objUtility->checkArea($_SESSION['myArea'], 20)==false) //20 for Duplicate print
header( 'Location: Mainmenu.php?unauth=1');


$objPm=new Petition_master();
$offname="";
if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if (!is_numeric($_tag))
$_tag=0;

if ($_tag>2)
$_tag=0;
$dis=" disabled";
$processed=false;

$ptype="0";
if (isset($_GET['mtype']))
$mtype=$_GET['mtype'];
else
$mtype=0;

if (!is_numeric($mtype))
$mtype=0;

$present_date=date('d/m/Y');
$mvalue=array();
$pkarray=array();

if ($_tag==1)//Return from Action Form
{
$mvalue[0]=date('Y');
$mvalue[1]="0";//Pet_no
}//$_tag==1


if ($_tag==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";
$mvalue[0]=date('Y');
// Call $objPm->MaxPet_no() Function Here if required and Load in $mvalue[1]
$mvalue[1]="0";//Pet_no
// Call $objPm->MaxO_code() Function Here if required and Load in $mvalue[2]
$mvalue[2]="0";//O_code
$_SESSION['mvalue']=$mvalue;
}//tag=0[Initial Loading]



if ($_tag==2 && $mtype==2)//Post Back 
{
$_SESSION['msg']="";

if (isset($_POST['Pet_yr']))
$mvalue[0]=$_POST['Pet_yr'];
else
$mvalue[0]=0;

if (isset($_POST['Pet_no']))
$mvalue[1]=$_POST['Pet_no'];
else
$mvalue[1]=0;

if (!is_numeric($mvalue[1]))
$mvalue[1]=-1;
//echo "entered1";


$objPm->setPet_yr($mvalue[0]);
$objPm->setPet_no($mvalue[1]);

if ($objPm->EditRecord()) //i.e Data Available
{
$dis=" ";    
$_SESSION['Applicant']=$objPm->getApplicant();  
$ptype=$objPm->getPet_type();
$objPt=new Petition_type();
$objPt->setCode($objPm->getPet_type());
if($objPt->EditRecord())
{
$cert=$objPt->getAbvr();
$Fees=$objPt->getFees();
if ($Fees==0) //Set by Processor Assistant like Jambandi
$Fees=$objPm->getFees ();
}
else
$cert="";    
$by="";
$eby=" by  ".$objPm->getEntered_by();

if ($objPm->getAst()=="Y")
{
$by=" ".$objUtility->to_date($objPm->getProcess_date())." by ".$objPm->getProcessed_by();

$prdate=$objUtility->to_date($objPm->getProcess_date());

if($ptype=="PR" || $ptype=="NC" || $ptype=="CT" || $ptype=="DM" || $ptype=="LH" || $ptype=="BK")
$processed=true;
else
{
$processed=true;    
$dis=" disabled";
echo $objUtility->alert("Petition is Not Printable in Computer");
}    
}//$objPm->getAst()=="Y"
else
{
$dis=" disabled";
echo $objUtility->alert("Petition Not Yet Processed");
}

//if ($objPm->getBo()=="Y")
//$by=$by." and BO [".$objPm->getBo_name()."]";
if ($objPm->getStatus()=="Issued")
$status="Issued on ".$objUtility->to_date ($objPm->getIssue_date());    
else
$status=$objPm->getStatus();  

if ($objPm->getBo()=="Y")
$offname=$objPm->getBo_name();
else
$offname="";   
}
else
{
echo $objUtility->alert("Petition Not Available") ;
$dis=" disabled";
}

} //tag==2

//Start of FormDesign
?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>
<form name=myform action=""  method=POST >
<tr><td colspan=2 align=Center bgcolor=#6699CC><font face=arial size=3>PRINT ALREADY PROCESSED CERTIFICATE<br></font><font face=arial color=red size=2><?php echo  $_SESSION['msg'] ?></font></td></tr>
<?php $i=0; ?>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Select Year</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=4 id=Pet_yr name=Pet_yr value="<?php echo $mvalue[0];?>"  style="font-family: Arial;background-color:white;color:black; font-size: 14px;width:100px" onchange=redirect(1)>
</td>
</tr>
<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>Petition No</font></td><td align=left bgcolor=#FFFFCC>
<input type=text size=4 id=Pet_no name=Pet_no value="<?php echo $mvalue[1];?>"  style="font-family: Arial;background-color:white;color:black; font-size: 14px;width:100px" onchange=redirect(2)>
Issue Date <input type=text size=4 id=Idate name=Idate value="<?php echo $prdate;?>"  style="font-family: Arial;background-color:white;color:black; font-size: 14px;width:100px">
<input type=hidden size=4 id=Idate1 name=Idate1 value="<?php echo $prdate;?>"  style="font-family: Arial;background-color:white;color:black; font-size: 14px;width:100px">
<input type=hidden size=4 id=Pet_type name=Pet_type value="<?php echo $ptype;?>"  style="font-family: Arial;background-color:white;color:black; font-size: 14px;width:100px" >
</td>
</tr>

<tr>
<td align=right bgcolor=#FFFFCC><font color=black size=2 face=arial>&nbsp;</font>&nbsp</td>
<td align=left bgcolor=#FFFFCC>
<input type=button value="Print"  name=Save onclick=validate()  style="font-family:arial;font-weight:bold; font-size: 14px ; background-color:#CC66FF;color:blue;width:100px" <?php echo $dis;?>>
<input type=button value=Menu  name=back1 onclick=home() style="font-family:arial; font-size: 14px ; background-color:red;color:blue;width:100px">
</td>
</tr>
</table>

<?php
if($processed==true) //Postback on Petition No
{
?>
<table border=0 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=70%>
<tr><td colspan=2 align=Center bgcolor=#CCFF99><font face=arial size=2>DETAIL OF PETITION </font></td></tr>
<tr>
<td width="30%" align=right><font face=arial size=2>Name of Applicant</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $objPm->getApplicant();?></font></td>
</tr>
<tr>
<td width="30%" align=right><font face=arial size=2>Certificate Type</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $cert;?></font></td>
</tr>
<tr>
<td width="30%" align=right><font face=arial size=2>Forwarded on</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $objUtility->to_date($objPm->getPet_date()).$eby;?></font></td>
</tr> 
<tr>
<td width="30%" align=right><font face=arial size=2>Processed on</font></td>
<td width="70%" align=left><b><font face=arial size=2><?php echo $by ;?></font></td>
</tr>    

</table>    
    
<?php
}//$processed==true
        
?>      

</form>


</body>
</html>
