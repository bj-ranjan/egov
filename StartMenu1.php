<html>
<head>
<title></title>

<fieldset  style="width:100%;background-COLOR:#ffcc66;height:600;border:none;" align=center>
</head>
<body>
<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.PWD.php';
require_once './class/class.userlogin.php';
require_once 'header.php';

$objUL=new Userlogin();
$objPwd=new Pwd();
$mdate=date('Y-m-d');
$objUL->setCondString("log_date='".$mdate."'");
$row=$objUL->getAllRecord();

$objUtility=new Utility();
//$allowedroll=1; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
//echo "session-".$_SESSION['roll']."<br>";
//echo $roll;
if ($roll==-1)
header( 'Location: index.php');
//echo $_SESSION['uid'];
    
$objUtility=new Utility();

$_SESSION['prev']=0;

//start
$roll=$objUtility->VerifyRoll();

if ($roll!=0) //Not Admonistrator
{
header( 'Location: index.php?tag=1');    
}


if (isset($_SESSION['usernanme']))
$user=$_SESSION['usernanme'];
else
$user="";   
$_SESSION['msg']="";
?>
<table border=1 align=center cellpadding=3 cellspacing=0 style=border-collapse: collapse; width=100%>
<tr><td colspan=4 align=Center bgcolor=#ccffcc><font face=arial size=4>Main Menu for Egovernance</font></td></tr>
<tr>
<td align=center bgcolor=#FF6699 width="25%">
<font face="arial" size="4"> 
Master Data Entry
</td>
<td align=center bgcolor=#FF6699 width="25%">
<font face="arial" size="4"> 
Link
</td>
<td align=center bgcolor=#FF6699 width="25%">
<font face="arial" size="4"> 
Link
</td>
<td align=center bgcolor=#FF6699 width="25%">
<font face="arial" size="4"> 
Utility
</td>
</tr>
<tr>
<td align=left bgcolor=#FFFFCC width="25%" valign="top">
<font face="arial" size="3"> 
<a href=./bakijai/form_bank_master.php?tag=0  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;New Bank</a>
<br><br>
<a href=./bakijai/form_bankbranch.php?tag=0  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;New Branch</a>
<br><br>
<a href=./bakijai/form_circle.php?tag=0  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;New Circle</a>
<br><br>
<a href=./bakijai/form_Mouza.php?tag=0  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;New Mouza</a>
<br><br>
<a href=./bakijai/form_village.php?tag=0  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;New Village</a>
<br><br>
<a href=form_branch_section.php?tag=0  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;Manage Branch</a>
<br><br>
<a href=form_Areaofwork.php?tag=0  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;Manage Area of Work</a>
<br><br>
<a href=form_officer.php?tag=0  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;Enter Officer Name</a>

</td>
<td align=left bgcolor=#FFFFCC width="25%" valign="top">
<a href=./bakijai/Mainmenu.php?tag=0  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;Bakijai Management</a>
<br><br>
<a href=./PFC/Mainmenu.php?tag=0  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;Public Facilitaion Center</a>
<br><br>
<a href=./DAK/DakEntry.php?tag=0  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;DAK</a>
<br><br>
<a href=./DAK/EditDak.php?tag=0  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;Dak Status Updation</a>
<br><br>
<a href=./HC/Mainmenu.php?tag=0  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;High Court Case</a>
</td>

<td align=left bgcolor=#FFFFCC width="25%" valign="top">
<font face="arial" size="3"> 
<font face="arial" size="3"> 
</td>
<td align=left bgcolor=#FFFFCC width="25%" valign="top">
<font face="arial" size="3"> 
<a href=index.php?tag=1&mtype=20  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;Logout<font face="arial" size="2" color="red">(<?php echo $user;?>)</a>
<br><br>
<font face="arial" size="3"> 
<a href=form_pwd.php?tag=0  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;User Management</a>
<br><br>
<font face="arial" size="3"> 
<a href=changepwd.php?tag=0  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;Change Password</a>
<br><br>
<a href=form_backup.php?tag=0  style='text-decoration: none'><img src="menusymb.gif" >&nbsp;Backup Database</a>
<br><br>
</td>
</tr>
<tr><td colspan="4" align="center">
Today's Login
 <font face="arial" size="3" color="red">        
  <?php
  for($i=0;$i<count($row);$i++)
  {
  $objPwd->setUid($row[$i]['Uid']);
  if ($objPwd->EditRecord())
  echo $objPwd->getFullname().",  ";
  
  }
  ?>
    </td>
</table>
</form>
</body>
</html>
