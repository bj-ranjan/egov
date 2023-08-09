<script type=text/javascript src="../Validation.js"></script>

<script language=javascript>
    <!--
    function home()
    {
    window.location="mainmenu.php";
    }
    
     function back()
    {
    window.location="Scstat.php?tag=0";
    }
    
    function go()
    {
        if(StringValid('Pno',1,1) && StringValid('Yr',1,1))
        {
            myform.action="Scstat.php?tag=1";
            myform.submit();    
        }
    }
</script>

<body>
    <?php
//Start FORMPHPBODY
    session_start();
    require_once './class/class.petition_master.php';
    require_once '../class/utility.class.php';
    require_once '../class/class.dbmanager.php';

//IN CASE LARGE AMOUNT OF RECORD USE MYSQL_QUERY TO FETCH RECORDS INSTEAD OF STORING IN ARRAY

    $objU = new Utility();
    $a = 0;
    $objPM = new Petition_master();
    $objDbm = new DBmanager();

    if (isset($_GET['tag']))
        $tag = $_GET['tag'];
    else
        $tag = 0;

    if ($tag == 0) {
        if(isset($_SESSION['pno']))
        $val=$_SESSION['pno'];
        else
        $val="";    
        ?>
        Enter Year and Petition Number separated by Comma    
        <form name="myform" method="post">
            <?php
	     $val=date('Y');
            $objDbm->genInputBox("Yr",$val,2,4,"white", "black", 12,"",0);
	     echo "<br>";
		$val="";
            $objDbm->genTextArea("Pno", $val, 3, 80, "white", "black", 12, "", 0);
            echo "<br>";
            $objDbm->genButton("Save", "View", 80, "orange", "black", 12, " onclick=go()");
            $objDbm->genButton("bk", "Back", 80, "white", "black", 12, " onclick=home()");
                        ?>   
        </form>        
    <?php }//tag=0 

if ($tag == 1) {

echo "<p align=center><font size=3 face=arial>Statement No-</p>";

$yr=$_POST['Yr'];

$_SESSION['pno']=$_POST['Pno'];
    $petnumbers="(".$_POST['Pno'].")";
$sql="SELECT PET_NO ,PROCESS_DATE, Applicant ,VILLAGE,Subcaste, Circle.Circle,INTRODUCED_BY  FROM PETITION_MASTER,Circle  WHERE PETITION_MASTER.Circle_code=Circle.Cir_code and  PET_YR ='".$yr."' AND PET_TYPE = 'CT' AND AST = 'Y' and Pet_no in ".$petnumbers;    

$title="Statement of SC Certificate";
$headlist=array("Petition No","Process Date","Applicant Name","Village","Sub Caste","Report submitted by CO","Introduced by");
$align=array(2,2,1,1,1,1,1) ;       
$objDbm->genDataGrid($title, $headlist, $align, $sql, 95);        

$objDbm->genButton("bk", "<-", 30, "white", "black", 12, " onclick=back()");

if (isset($_SESSION['username']))
$username=$_SESSION['username'];
else 
$username="";
?>
<p align=right>
<?php //echo $username;?>
</p>  
<?php
}//tag==1 ?>     
 
</body>
</html>
