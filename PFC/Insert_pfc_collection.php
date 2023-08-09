<body>
<?//php include("connection.php"); ?>
<?php
session_start();
require_once '../class/utility.class.php';
require_once './class/class.pfc_collection.php';
require_once '../class/class.monthname.php';

$mvalue=array();
$myTag=0;
$myNull=false;
$mvalue=array();
$objUtility=new Utility();
$objPfc_collection=new Pfc_collection();
$Err="<font face=arial size=1 color=blue>";


//Start Validation //Cal_yr

if (isset($_POST['Cal_yr'])) //If HTML Field is Availbale
{
$_Cal_yr=$_POST['Cal_yr'];
$mvalue[0]=$_Cal_yr;
if (!is_numeric($_Cal_yr))
{
$myTag++;
echo "Cal_yr Error<br>";
}
}
else //Post Data Not Available
$_Cal_yr="NULL";


//Start Validation //Cal_month

if (isset($_POST['Cal_month'])) //If HTML Field is Availbale
{
$_Cal_month=$_POST['Cal_month'];
$mvalue[1]=$_Cal_month;
if (!is_numeric($_Cal_month))
{
$myTag++;
echo "Cal_month Error<br>";
}
}
else //Post Data Not Available
$_Cal_month="NULL";


//Start Validation //Collection_date

if (isset($_POST['Collection_date'])) //If HTML Field is Availbale
{
$_Collection_date=$_POST['Collection_date'];
$mvalue[2]=$_Collection_date;
if ($objUtility->isdate($_Collection_date)==false)
{
$myTag++;
echo "Collection_date Error<br>";
}
else
$_Collection_date=$objUtility->to_mysqldate($_Collection_date);
}
else //Post Data Not Available
$_Collection_date="NULL";


//Start Validation //Jama_fee

if (isset($_POST['Jama_fee'])) //If HTML Field is Availbale
{
$_Jama_fee=$_POST['Jama_fee'];
$mvalue[3]=$_Jama_fee;
if (!is_numeric($_Jama_fee))
{
$myTag++;
echo "Jama_fee Error<br>";
}
}
else //Post Data Not Available
$_Jama_fee="NULL";


//Start Validation //Er_fee

if (isset($_POST['Er_fee'])) //If HTML Field is Availbale
{
$_Er_fee=$_POST['Er_fee'];
$mvalue[4]=$_Er_fee;
if (!is_numeric($_Er_fee))
{
$myTag++;
echo "Er_fee Error<br>";
}
}
else //Post Data Not Available
$_Er_fee="NULL";


//Start Validation //Other_fee

if (isset($_POST['Other_fee'])) //If HTML Field is Availbale
{
$_Other_fee=$_POST['Other_fee'];
$mvalue[5]=$_Other_fee;
if (!is_numeric($_Other_fee))
{
$myTag++;
echo "Other_fee Error<br>";
}
}
else //Post Data Not Available
$_Other_fee="NULL";


//Start Validation //Total

if (isset($_POST['Total'])) //If HTML Field is Availbale
{
$_Total=$_POST['Total'];
$mvalue[6]=$_Total;
if (!is_numeric($_Total))
{
$myTag++;
echo "Total Error<br>";
}
}
else //Post Data Not Available
$_Total="NULL";



$mmode="";
if ($myTag>0) //Validation Fails
{
$_SESSION['msg']="Failed to Update(Data Type Error)<br>".$Err;
$mmode="Validation Error";
}

if ($myTag==0) //Validation OK
{
$objPfc_collection->setCal_yr($_Cal_yr);
$objPfc_collection->setCal_month($_Cal_month);
$objPfc_collection->setCollection_date($_Collection_date);
$objPfc_collection->setJama_fee($_Jama_fee);
$objPfc_collection->setEr_fee($_Er_fee);
$objPfc_collection->setOther_fee($_Other_fee);
$objPfc_collection->setTotal($_Total);
$objPfc_collection->setId($objPfc_collection->Max("Id", "1=1")+1);
$cond="Cal_yr=".$_Cal_yr;
$slno=$objPfc_collection->Max("Sl_no", $cond)+1;
$objPfc_collection->setSl_no($slno);
if($objPfc_collection->SaveRecord()==false)
{
$sql=$objPfc_collection->returnSql;    
$_SESSION['msg']="SQL Error(See Error Log File)";
$objUtility->saveSqlLog("Error",$sql);
$mmode="SQL Commit Error(Check Error Log File)";
}
else
{
$mmode="Updated Successfully ID is-".$slno."/".$_Cal_yr;
$sql=$objPfc_collection->returnSql;
//Clear the Required Field back to Entry Form
$mvalue[0]=date('Y');//Cal_yr
$mvalue[1]="0";//Cal_month
$mvalue[2]="";//Collection_date
$mvalue[3]="";//Jama_fee
$mvalue[4]="";//Er_fee
$mvalue[5]="";//Other_fee
$mvalue[6]="";//Total
//$objUtility->saveSqlLog("Pfc_collection",$sql);
$objUtility->CreateLogFile("PFC_collection", $sql, 2, "M");

} //saverecord
} //$mytag==0 
$_SESSION['mvalue']=$mvalue; //Load Array for return to Form

//header( 'Location: Form_pfc_collection.php?tag=1');
//If Java Script Message is Required Uncommenet following
$msg=$mmode;
echo $objUtility->AlertNRedirect($msg, "pfc_collection.php?tag=1");
?>
</body>
</html>
