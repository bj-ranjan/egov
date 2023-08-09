<html>
<head>
<title></title>
</head>
<body>
<?php
session_start();
require_once '../class/utility.class.php';
require_once 'header.php';


$objUtility=new Utility();
//$allowedroll=1; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
//echo "session-".$_SESSION['roll']."<br>";
//echo $roll;
if ($roll==-1 || ($_SESSION['branch']!=4 && $_SESSION['branch']>0)) //Not PFC
{    
$_SESSION['returnmsg']="You are not authosied for Public Facilitaion Center" ; 
header( 'Location: ../index.php?tag=1');
}
//echo $_SESSION['uid'];
  
if (isset($_GET['unauth']))
echo $objUtility->alert ("Unauthorised Area");
    
    
if (isset($_SESSION['username']))
$user=$_SESSION['username'];
else
$user="";  
$_SESSION['msg']="";
?>
<table border=1 align=center cellpadding=3 cellspacing=0 style=border-collapse: collapse; width=100%>
<tr><td colspan=4 align=Center bgcolor=#ccffcc><font face=arial size=4>Main Menu for Public Facilitaion Center</font></td></tr>
<tr>
<td align=center bgcolor=#FF6699 width="20%">
<font face="arial" size="4"> 
Master Data Entry
</td>
<td align=center bgcolor=#FF6699 width="30%">
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
<a href=../bakijai/form_village.php?tag=0  style='text-decoration: none'>New Village</a>
</td>
<td align=left bgcolor=#FFFFCC width="25%" valign="top">
<font face="arial" size="3"> 
<a href=pet_entry.php?tag=0  style='text-decoration: none'>Petition Entry</a>
<br><br>
<a href=PetitionList.php?tag=0  style='text-decoration: none'>Process Public Petition</a>
<br><br>
<a href=ProcessJama.php?tag=0  style='text-decoration: none'>Update Jamabandi Petition</a>
<br><br>
<a href=ProcessERoll.php?tag=0  style='text-decoration: none'>Update Voter Certificate</a>
<br><br>
<a href=ProcessLH.php?tag=0  style='text-decoration: none'>Update Legal Heir</a>
<br><br>
<a href=Issue.php?tag=0  style='text-decoration: none'>Issue Petition</a>
<br><br>
</td>
<td align=left bgcolor=#FFFFCC width="25%" valign="top">
<font face="arial" size="2"> 
<a href=DateWiseReceipt.php?tag=0  style='text-decoration: none'>Date wise Receipt of Petition</a>
<br><br>
<a href=DailyCollection.php?tag=0  style='text-decoration: none'>Collection Report</a>
<br><br>
<a href=Search.php?tag=0  style='text-decoration: none'>Search Status of Petition</a>
<br><br>
<a href=SelectpetType.php?tag=0  style='text-decoration: none'>Periodic Report</a>
</td>
<td align=left bgcolor=#FFFFCC width="25%" valign="top">
<font face="arial" size="3"> 
<a href=../index.php?tag=0  style='text-decoration: none'>Logout<font face="arial" size="2" color="red">(<?php echo $user;?>)</a>
<br><br>
<font face="arial" size="3"> 
<a href=../changepwd.php?tag=0  style='text-decoration: none'>Change Password</a>
<br><br>
<a href=../Bakijai/Mainmenu.php?tag=0  style='text-decoration: none'>Bakijai Menu</a>
<br><br>
<a href=../Startmenu.php?tag=0  style='text-decoration: none'>Home</a>
<br><br>
</td>
</tr>
</table>
</form>
</body>
</html>
