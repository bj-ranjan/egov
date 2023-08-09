<html>
<title></title>
</head>
<script language=javascript>
<!--

function home()
{
window.location="mainmenu.php?tag=1";
}

function notNull(str)
{
var k=0;
var found=false;
var mylength=str.length;
for (var i = 0; i < str.length; i++) 
{  
k=parseInt(str.charCodeAt(i)); 
if (k!=32)
found=true;
}
return(found);
}

function isNumber(ad)
{
if (isNaN(ad)==false && notNull(ad))
return(true);
else
return(false);
}

function home()
{
window.location="mainmenu.php?tag=1";
}

function validate()
{
var a=myform.days.value ;// Primary Key

if (isNumber(a))
{
if (Number(a)>0)
    {
myform.action="ListPayStatement.php?tag=2";
myform.submit();
    }
    else
 alert('Invalid ID')
}
else
alert('Invalid ID');
}

function isdate(dt,tag)
{
//var dt=myform.Est_On.value;
var ln=parseInt(dt.length);
var dd;
var mm;
var yyyy;
var leapday;
var tt=true;
var i=dt.indexOf("/");
dd=dt.substr(0,i);
var j=dt.indexOf("/",(i+1));
mm=dt.substr((i+1),(j-i-1));
yyyy=dt.substr((j+1),(ln-j-1));
if(isNaN(yyyy)==false)
{
var t=parseInt(yyyy%4);
if(t==0)
leapday=29;
else
leapday=28;
}
if((tag==0) && ln==0)  //for null field No check
tt=true;
else
{
if (isNaN(dd)==false && isNaN(mm)==false && isNaN(yyyy)==false)
{
dd=Number(dd);
mm=Number(mm);
yyyy=Number(yyyy);
if( (mm>0) && (mm<13) && (dd>0) && (dd<32))
{
if((mm==4)||(mm==6)||(mm==9)||(mm==11)) //30st day
{
if (dd>30)
{
alert('Invalid Date '+dt+'(DD Part out of range)');
tt=false;
}
} // mm==4
if (mm==2)
{
if (dd>leapday)
{
alert('Invalid Date '+dt+'(DD Part)');
tt=false;
}
} //mm==2
}
else //mm>0 && dd>0
{
alert('Invalid Date '+dt+'(Month out of range)');
tt=false;
}
}
else  // Non numeric figure appears
{
alert('Invalid date '+dt);
tt=false;
}
}// not null
return(tt);
}

</script>
<body>


       
<?php

session_start();
require_once '../class/utility.php';
require_once '../class/utility.class.php';
require_once '../class/class.dbmanager.php';
require_once './class/class.baki_payment.php';
require_once './class/class.bakijai_main.php';
$objUtility=new Utility();

$roll=$objUtility->VerifyRoll();
if (($roll==-1))
header( 'Location: mainmenu.php?unauth=1');

$objDm=new DBManager();

if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

$objUtil=new myutility();
$gross=0;
$bal=0;
if (!isset($_SESSION['id']))
$_SESSION['id']="0";

if ($_tag==2)
$_SESSION['id']=$_POST['days'] ; 

?>
<form name="myform" method="post"> 
    <font color="blue" size="2" face="arial">  
    <p align="center">
Pay Detail Statement for Case ID
<input type="text" size="12" name="days" value="<?php echo $_SESSION['id']?>" maxlength="10">
 
<input type="button" value="List" onclick="validate()">
<input type="button" value="Menu" onclick="home()">
<br>
With Interest(6.25)
<?php
$objDm->genCheckBox("Int", false, "white", "black", 12, "", 0);
?>
    </p> 
    <hr>
</form>      

 <?php


if ($_tag==2)
{
if (isset($_POST['days']))
$_SESSION['id']=$_POST['days'];
else
$_SESSION['id']="0";
  
$int=0;
if(isset($_POST['Int']))
$int=1;

//echo  "tag=2 ".$_SESSION['day']."<br>" ;
$objBm=new Bakijai_main();
$objBm->setCase_id($_SESSION['id']);

if ($objBm->EditRecord())
{
$mstr="Case Detail-".$objBm->getBank().",".$objBm->getBranch()."(";
$mstr=$mstr.$objBm->getCase_no()."/".$objBm->getFin_yr().")";
}
$objBp=new Baki_payment();
$objBp->setCase_id($_SESSION['id']);

?>
<table border=1 cellpadding=2 cellspacing=0 align=center style=border-collapse: collapse; width=90%>        
<tr><td colspan="4" align="center"><font face="arial" size="3" color="red">
<?php echo $mstr;?>            
</td>
    </tr>       
       <tr><td colspan="2" align="right"><font face="arial" size="2" color="blue">
Name of Defaulter            
</td>
 <td colspan="2" align="left"><font face="arial" size="2" color="blue">
 <?php echo $objBm->getFull_name();;?>    
        </td></tr>
<tr><td colspan="2" align="right" valign="top"><font face="arial" size="2" color="blue">
Address            
</td>
 <td colspan="2" align="left" valign="top"><font face="arial" size="2" color="blue">
 <?php echo $objBm->getFather()."<br>Village-".$objBm->getVillage();;?>    
        </td></tr>  
<tr><td colspan="2" align="right"><font face="arial" size="2" color="blue">
Defaulting Amount
</td>
 <td colspan="2" align="left"><font face="arial" size="2" color="blue">
     Rs.<?php echo $objUtil->convert2standard($objBm->getAmount());?>    
        </td></tr>
<tr><td colspan="2" align="right"><font face="arial" size="2" color="blue">
Amount Already Paid
</td>
 <td colspan="2" align="left"><font face="arial" size="2" color="blue">
     Rs.<?php echo $objUtil->convert2standard($objBp->LastPaid($_SESSION['id']));?>    
        </td></tr>
<?php if($int==1){ ?>
<tr><td colspan="2" align="right"><font face="arial" size="2" color="blue">
Interest to be Paid
</td>
 <td colspan="2" align="left"><font face="arial" size="2" color="blue">
     Rs.<?php echo $objUtil->convert2standard($objBp->LastPaid($_SESSION['id']));?>    
        </td></tr>

<?php  }  ?>
<tr><td colspan="2" align="right"><font face="arial" size="2" color="blue">
Balance to be Paid
</td>
 <td colspan="2" align="left"><font face="arial" size="2" color="blue">
     Rs.<?php echo $objUtil->convert2standard($objBp->BalanecAmount($_SESSION['id']));?>    
        </td></tr>
<tr><td colspan="2" align="right"><font face="arial" size="2" color="blue">
Next Date
</td>
 <td colspan="2" align="left"><font face="arial" size="2" color="blue">
    <?php echo $objUtility->to_date($objBp->NextCallDate($_SESSION['id']));
    if($objBm->getDisposed()=="Y")
    echo "Case Disposed on ".$objUtility->to_date ($objBm->getDisposed_date())." by ".$objBm->getPayment_mode();
    ?>    
        </td></tr>

       <tr><td align="center" width="20%" bgcolor="#999966"><font face="arial" size="2">SlNo</td>
       <td align="center" width="20%" bgcolor="#999966"><font face="arial" size="2">Pay Date</td>   
        <td align="center" width="30%" bgcolor="#999966"><font face="arial" size="2">Amount</td> 
     <td align="center" width="30%" bgcolor="#999966"><font face="arial" size="2">Receipt No</td> 
      </tr> 
     
<?php  
$paid=0;
$str=" Paid_today>0 and case_id=".$_SESSION['id']."  order by Instalment_no";
$objBp->setCondString($str);
$row=$objBp->getAllRecord();
for($ii=0;$ii<count($row);$ii++)
{
$paid=$paid+$row[$ii]['Paid_today'];
?>      
  <tr>
 <td align="center" ><font face="arial" size="2"><?php echo $ii+1?></td>
 <td align="center" ><font face="arial" size="2"><?php echo $objUtility->to_date($row[$ii]['Pay_date']);?></td>   
 <td align="right"><font face="arial" size="2"><?php echo $objUtil->convert2standard($row[$ii]['Paid_today']);?></td>          
    <td><font face="arial" size="2"><?php echo $row[$ii]['Receipt_no'];?></td>          
        
      </tr>
<?php }?>  
      
<tr><td colspan="2" align="right"><font face="arial" size="3" color="blue"> 
Total Paid</td>    <td align="right">
        <?php echo $objUtil->convert2standard($paid);?>
    </td><td>&nbsp;</td></tr> 
        </table>        
<?php
} //$tag==2
?>
</table>
</body>
</html>
