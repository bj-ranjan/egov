<html>
<head>
<title></title>
</head>
<body>
<?php
session_start();
require_once '../class/utility.class.php';

$objUtility=new Utility();
//$allowedroll=1; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
//echo "session-".$_SESSION['roll']."<br>";
//echo $roll;
if ($roll==-1 || ($_SESSION['branch']!=1 && $_SESSION['branch']>0)) //Not bakijai
{
$_SESSION['returnmsg']="You are not authosied for Bakijai" ; 
header( 'Location: ../index.php?tag=1');    
}
 

if (isset($_GET['unauth']))  //Check area of authority
echo $objUtility->alert ("Unauthorised Area");

//echo $_SESSION['uid'];
    
if (isset($_SESSION['username']))
$user=$_SESSION['username'];
else
$user="";  
$_SESSION['msg']="";
?>
<table border=1 align=center cellpadding=3 cellspacing=0 style=border-collapse: collapse; width=100%>
<tr><td colspan=4 align=Center bgcolor=#ccffcc><font face=arial size=4>Main Menu for Bakijai Management</font></td></tr>
<tr>
<td align=center bgcolor=#FF6699 width="25%">
<font face="arial" size="4"> 
Master Data Entry
</td>
<td align=center bgcolor=#FF6699 width="25%">
<font face="arial" size="4"> 
Entry/Update
</td>
<td align=center bgcolor=#FF6699 width="25%">
<font face="arial" size="4"> 
Report
</td>
<td align=center bgcolor=#FF6699 width="25%">
<font face="arial" size="4"> 
Utility
</td>
</tr>
<tr>
<td align=left bgcolor=#FFFFCC width="25%" valign="top">
<font face="arial" size="3"> 
<a href=form_bank_master.php?tag=0  style='text-decoration: none'>New Bank</a>
<br><br>
<a href=form_bankbranch.php?tag=0  style='text-decoration: none'>New Branch</a>
<br><br>
<a href=form_circle.php?tag=0  style='text-decoration: none'>New Circle</a>
<br><br>
<a href=form_Mouza.php?tag=0  style='text-decoration: none'>New Mouza</a>
<br><br>
<a href=form_village.php?tag=0  style='text-decoration: none'>New Village</a>
</td>
<td align=left bgcolor=#FFFFCC width="25%" valign="top">
<font face="arial" size="3"> 
<a href=form_bakijai_main.php?tag=0  style='text-decoration: none'>New Bakijai Case</a>
<br><br>
<a href=form_baki_payment.php?tag=0  style='text-decoration: none'>Collection Updation</a>
<br><br>
<a href=oldpay.php?tag=0  style='text-decoration: none'>Update Old Payment</a>
<br><br>
<?php if (1==1){?>
<a href=form_bank_deposit.php?tag=0  style='text-decoration: none'>Updation of Bank Deposit</a>
<br><br>
<?php }?>
<a href=Notice.php?tag=0  style='text-decoration: none'>Issue Notice</a>
<br><br>
<a href=changeofficer.php?tag=0  style='text-decoration: none'>Change of Certificate Officer</a>
<br><br>
<a href=form_baki_interest.php?tag=0  style='text-decoration: none'>Bakijai Interest</a>
<br><br>
<a href=CommonNotice.php?tag=0  style='text-decoration: none'>Issue Common Notice</a>
<br><br>
</td>
<td align=left bgcolor=#FFFFCC width="25%" valign="top">
<font face="arial" size="2"> 
<a href=SelectMonth1.php?tag=0  style='text-decoration: none'>Monthly Collection Report</a>
<br><br>
<a href=SelectMonth.php?tag=0  style='text-decoration: none'>Monthly/Yearly Report(PDF)</a>
<br><br>
<a href=ListOlderCase.php?tag=0  style='text-decoration: none'>View Older Case</a>
<br><br>
<a href=ListDefaultingCase.php?tag=0  style='text-decoration: none'>View Defaulting Case Status</a>
<br><br>
<a href=ListCaseonDueDate.php?tag=0  style='text-decoration: none'>View Case Due on Particular Date</a>
<br><br>
<a href=ListPayStatement.php?tag=0  style='text-decoration: none'>View Case Id Wise Statement</a>
<br><br>
<a href=ListBankWiseCase.php?tag=0  style='text-decoration: none'>View Case Detail(Bank Wise)</a>
<br><br>
<a href=SelectBankBranch.php?tag=0  style='text-decoration: none'>Bank & Branch Wise Case</a>
<br><br>
<a href=ListDisposedCase.php?tag=0  style='text-decoration: none'>View Disposed Case</a>
<br><br>
<a href=ListNoticeDetail.php?tag=0  style='text-decoration: none'>View Notice Issue Detail</a>
<br><br>
<a href=CourtCase.php?tag=0  style='text-decoration: none'>High Court Case</a>
<br><br>
<a href=Search.php?tag=0  style='text-decoration: none'>Search Case ID by Name</a>
<br><br>
<a href=ListCircleWiseCase.php?tag=0  style='text-decoration: none'>List Circle Wise Case</a>

</td>
<td align=left bgcolor=#FFFFCC width="25%" valign="top">
<font face="arial" size="3"> 
<a href=../index.php?tag=0  style='text-decoration: none'>Logout<font face="arial" size="2" color="red">(<?php echo $user;?>)</a>
<br><br>
<font face="arial" size="3"> 
<a href=../changepwd.php?tag=0  style='text-decoration: none'>Change Password</a>
<br><br>
<a href=../PFC/Mainmenu.php?tag=0  style='text-decoration: none'>PFC Menu</a>
<br><br>
<a href=../PFC/ProcessBakijai.php?tag=0  style='text-decoration: none'>Dispose/Print Bakijai Certificate</a>
<br><br>
<a href=../Startmenu.php?tag=0  style='text-decoration: none'>Home</a>

</td>
</tr>
</table>
</form>
</body>
</html>
