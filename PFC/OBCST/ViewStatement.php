  <STYLE type=text/css>
    @media screen{
       thead{display:table-header-group}
       }
   @media print{
       thead{display:table-header-group}
      body{margin-top:0.5 cm;margin-left:1.5 cm;margin-right:1 cm;margin-bottom:1}
      tfoot{display:none}
 pre {page-break-after: always;}
   }
 </STYLE>


<?php
session_start();
require_once './class/utility.class.php';
require_once './class/class.old_obc_st.php';



$type=isset($_GET['rType'])?$_GET['rType']:"Both";
$yr=isset($_GET['rYear'])?$_GET['rYear']:date('Y');
$no1=isset($_GET['No1'])?$_GET['No1']:0;
$no2=isset($_GET['No2'])?$_GET['No2']:0;


$no1=is_numeric($no1)?$no1:'0';
$no2=is_numeric($no2)?$no2:'0';


if($type=="Both")
$type="'ST','OBC','MOBC'";
else
$type="'".$type."'";    

$cond="Type in (".$type.")  and cert_yr=".$yr." and cert_no between ".$no1." and ".$no2." order by cert_no";

//echo $cond;

$Title="Statement of  ST/OBC Certificate";
$headList=array("Certificate No","Origin Serial No","Name & Address","Circle","Sub Caste");
$align=array(2,2,1,2,2);
$valueList=array();
$objUtility=new Utility();
$objOld_obc_st=new Old_obc_st();

$row=$objOld_obc_st->getAllRecord($cond);
for($ii=0;$ii<count($row);$ii++)
{
    
    
$tvalue=$row[$ii]['Type']."-".$row[$ii]['Cert_no']."/".$row[$ii]['Cert_yr'];

$valueList[$ii][0]=$tvalue;

$tvalue=$row[$ii]['Origin_no'];
$valueList[$ii][1]=$tvalue;

$tvalue=$row[$ii]['Name']."<br>Co/-".$row[$ii]['Gurdian_name']."<br>".$row[$ii]['Vill'];

$valueList[$ii][2]=$tvalue;

$tvalue=$row[$ii]['Circle'];

$valueList[$ii][3]=$tvalue;

$tvalue=$row[$ii]['Subcaste'];
$valueList[$ii][4]=$tvalue;
}


$objOld_obc_st->genDataGridOnValueList($Title,$headList, $align, $valueList, 80,count($valueList));

 
?>


