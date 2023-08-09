   
<?php
//header('Refresh: 120;url=IndexPage.php');
session_start();
require_once "PFCMenuhead.html";
require_once '../class/utility.class.php';


$objUtility=new Utility();

$_SESSION['prev']=0;

//start
$roll=$objUtility->VerifyRoll();

if ($roll==-1 || ($_SESSION['branch']!=4 && $_SESSION['branch']>0)) //Not bakijai
{
$_SESSION['returnmsg']="You are not authosied for PFC" ; 
header( 'Location: ../index.php?tag=1');    
}



//end




   
if (isset($_GET['unauth']))  //Check area of authority
echo $objUtility->alert ("Unauthorised Area");

if (isset($_SESSION['uid']))
$user=$_SESSION['uid'];
else 
$user="";
if (isset($_SESSION['firstlogin']))
{
if($_SESSION['firstlogin']=="Y")
header( 'Location: index.php?tag=0');
}

?>


</body>
</html>
