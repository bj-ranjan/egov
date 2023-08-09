<html>
<head>
<title>OLD_OBC_ST</title>
<?php
//If you uncomment menuhead.php then pls comment session_start(), since it is already declared in menuhead.php
session_start();
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/kolkata");
include("header.php");
//include("menuhead.php");
?>
<script src="jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="Validation.js"></script>
<script type="text/javascript">
<!--

//START JQUERY BLOCK

//Type(varchar) //Cert_yr(int) //Cert_no(bigint) //Origin_no(varchar) //Name(varchar) //Gurdian_name(varchar) //Vill(varchar) //Circle(varchar) //Subcaste(varchar) 

$(document).ready(function() 
{
 
 
function Push_Item(obj,JsonArray)
{
         var boxsize = JsonArray['BoxSize'];
         var selectval= JsonArray['SelectVal'];  
         
         var opt;
         var detail;
$("select[name='"+obj+"']").empty();
            //$("#SelectBox2").empty();  //Clear the Select Box Gp 
            for (var i = 0; i < boxsize; i++)
            {
            opt="'"+JsonArray['Code'][i]['Opt']+"'";
            detail=JsonArray['Code'][i]['Detail'];
                var myopt='<option value='+opt+'>'+detail+'</option>';
                //$("#SelectBox2").append(myopt)  ;
$("select[name='"+obj+"']").append(myopt);
            } //end for loop
            //$("#SelectBox2").val(selectval);
$("select[name='"+obj+"']").val(selectval);
}
 
 
 
$(" #Type").change(function(event){
var DATA="Param1="+$(" #Type").val();
DATA=DATA+"&Param2="+$(" #Cert_yr").val();
var URL="JSONCreator_old_obc_st.php" ;

$.ajax({type:"POST",url: URL,data:DATA, success: function(result){
   
   var JsonArray = JSON.parse(result);
   var max=JsonArray['Max'];
   Push_Item('Subcaste',JsonArray)
   $(" #Cert_no").val(max);          
    }}); //End $Ajax
}); //END Zpc Change Event 
 
 
//Load A Select Box Items ,on Change Event of Parent Select Box using JSON


$(" #Cert_no").change(function(event){
EditThroughJSON();
}); //END Zpc Change Event


}); //Document Ready Function

//END JQUERY BLOCK

function checkdata()
{
var DATA=ConstructDataString();    

var URL="EnableButton.php" ;

$.ajax({type:"POST",url: URL,data:DATA, success: function(result){
             if(result>0)
             EnuObj('a');
         else
             DisObj('a');
    }}); //End $Ajax

}


function EditThroughJSON()
{
if(SelectBoxIndex('Type')>0){    
var data=ConstructDataString();
var Box=['Origin_no','Name','Gurdian_name','Vill','Circle','Subcaste'];
var bType=[0,0,0,0,0,0,0,0,0];//0-value 1-SelectedIndex 2-checked  3-innerHTML   4-enables/disabled if value=1 or 0  40-enable/disable with value
JSONParsedString("old_obc_st_Process.php?Opr=E" ,data,Box,0,bType,'Save');
}
}

function viewst()
{
if(NumericValid('rYear',1,'Positive')==true && NumericValid('No1',1,'Positive')==true && NumericValid('No2',1,'Positive')==true)    
{
var data=ConstructDataString();    
window.open("viewStatement.php?"+data,'_blank');
}
else
    alert('Invalid Selection');
}



function direct1()
{
var i;
i=0;
}

function setMe()
{
myform.Type.focus();
}



function validate()
{

if ( SelectBoxIndex('Type')>0  && NumericValid('Cert_yr',1,'Positive')==true   && NumericValid('Cert_no',1,'Positive')==true   && StringValid('Origin_no',1,1) && StringValid('Name',0,1) && StringValid('Gurdian_name',0,1) && StringValid('Vill',0,1) && SelectBoxIndex('Circle')>0 && SelectBoxIndex('Subcaste')>0)
{
var mdata=ConstructDataString();

setVal('SaveData', 1);
DisObj('Save');
DisObj('back1');
var Box=['Save','Type','Cert_yr','Cert_no','Origin_no','Name','Gurdian_name','Vill','Circle','Subcaste'];
var bType=[40,0,0,0,0,0,0,0,0,0];
//0-value 1-SelectedIndex 2-checked 3-innerHTML 4-enable/disable  40- enable/disable with value, 42-enable/disables with checked  50-value with setting cursor position
JSONParsedString("old_obc_st_Process.php?Opr=A" ,mdata,Box,0,bType,'SaveData');
myform.Origin_no.focus();
}
else
{
if (SelectBoxIndex('Type')==0)//0-Simple Validation
{
alert('Check Type');
document.getElementById('Type').focus();
}
else if (NumericValid('Cert_yr',1,'Positive')==false)
{
alert('Non Numeric Value in Cert_yr');
document.getElementById('Cert_yr').focus();
}
else if (NumericValid('Cert_no',1,'Positive')==false)
{
alert('Non Numeric Value in Cert_no');
document.getElementById('Cert_no').focus();
}
else if (StringValid('Origin_no',0,1)==false)//0-Simple Validation
{
alert('Check Origin_no');
document.getElementById('Origin_no').focus();
}
else if (StringValid('Name',0,1)==false)//0-Simple Validation
{
alert('Check Name');
document.getElementById('Name').focus();
}
else if (StringValid('Gurdian_name',0,1)==false)//0-Simple Validation
{
alert('Check Gurdian_name');
document.getElementById('Gurdian_name').focus();
}
else if (StringValid('Vill',0,1)==false)//0-Simple Validation
{
alert('Check Vill');
document.getElementById('Vill').focus();
}
else if (SelectBoxIndex('Circle')==0)//0-Simple Validation
{
alert('Check Circle');
document.getElementById('Circle').focus();
}
else if (SelectBoxIndex('Subcaste')==0)//0-Simple Validation
{
alert('Check Subcaste');
document.getElementById('Subcaste').focus();
}
else 
alert('Enter Correct Data');
}
}//End Validate




function home()
{
DisObj('Save');
DisObj('back1');
window.location="../mainmenu.php?tag=1";
}



//change the focus to Box(a)
function ChangeFocus(a)
{
//document.getElementById(a).focus();
}


function LoadTextBox()
{
var i=document.getElementById('Editme').selectedIndex;
if(i>0)
document.getElementById('edit1').disabled=false;
else
document.getElementById('edit1').disabled=true;
//alert('Write Java Script as per requirement');
}

//Reset Form
function res()
{
window.open("Old_obc_st_Form.php","_self");
}

function ConstructDataString()
{
var data="X=1";
//In Case of Check Box Use Following
//if(document.getElementById('CheckBoxId').checked==true)
//data=data+"&CheckBoxId=1";

var Obj=['Type','Cert_yr','Cert_no','Origin_no','Name','Gurdian_name','Vill','Circle','Subcaste','rType','rYear','No1','No2'];
for(var i=0;i<Obj.length;i++)
{
//alert(data);    
var box=Obj[i];
data=data+"&"+box+"="+document.getElementById(box).value;;
}
return(data);
}
//END JAVA

</script>
<link href="./class/table.css" rel="stylesheet"/>


<link href="./class/FaceBox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="./class/facebox.js" type="text/javascript"></script>

<script type="text/javascript">
jQuery(document).ready(function($) {
$('a[rel*=facebox]').facebox({
loadingImage : 'image/loading.gif',
closeImage   : 'image/closelabel.png'
})
})
</script>


</head>
<body>
<?php
//Start FORMPHPBODY
//Type(varchar) //Cert_yr(int) //Cert_no(bigint) //Origin_no(varchar) //Name(varchar) //Gurdian_name(varchar) //Vill(varchar) //Circle(varchar) //Subcaste(varchar) 
require_once './class/utility.class.php';
require_once './class/class.old_obc_st.php';
//require_once './class/class.sentence.php';

//Start Function/Method Guide

//$val=$objOld_obc_st->FetchColumn($table, $field, $condition, $default);
//Read Single Field from Table depending on condition and Return Default if not Available

//$Trow=$objOld_obc_st->FetchRecords($sql);

//$objOld_obc_st->ExecuteBatchData($Table, $FldList, $ValueList, $Packet) //DBManager

//$objOld_obc_st->JoinUpdate($DstTable, $SrcTable, $DstField, $SrcFld, $cond)

//End Function/Method Guide

//Set Select Box Property
$bcol="white";
$fcol="black";
$font="14";

//Set Table Color
$HeadColor="#EEE8D6";
$BodyColor=$bcol;
$FootColor="#CCCC99";
//$BottomColor="WHITE";
$BottomColor=$FootColor;



//SAMPLE HREF LINK FOR POPUP WINDOW
//echo "<a href=".chr(34)."PopupForm.php".chr(34)." rel='facebox'>Popup Window</a>";




$objUtility=new Utility();
$allowedroll=0; //Change according to Business Logic
$roll=$objUtility->VerifyRoll();
//if (($roll==-1) || ($roll>$allowedroll))
//echo $objUtility->AlertNRedirect("","mainmenu.php?tag=1")
//header( 'Location: mainmenu.php?unauth=1');

$objOld_obc_st=new Old_obc_st();

$_tag=isset($_GET['tag'])?$_GET['tag']:'0';

//$Area=isset($_SESSION['myArea'])?$_SESSION['myArea']:'0';

//if ($objUtility->checkArea($_SESSION['myArea'], 12)==false) //e.g 12 for Eroll Certificate
//header( 'Location: Mainmenu.php?unauth=1');

$_tag=!is_numeric($_tag)?'0':$_tag;

if ($_tag>2)
$_tag=0;

$mtype=isset($_GET['mtype'])?$_GET['mtype']:'0';

if (!is_numeric($mtype))
$mtype=0;

$save=isset($_POST['SaveData'])?$_POST['SaveData']:'0';

$present_date=date('d/m/Y');
$mvalue=array();

if ($_tag==0 && $save==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";
$mvalue=InitArray();
$_SESSION['mvalue']=$mvalue;
//$mvalue[1]=$objOld_obc_st->MaxCert_yr();
//$mvalue[2]=$objOld_obc_st->MaxCert_no();
}//tag=0[Initial Loading]

if ($_tag==1)//Return from Action Form
{
if (isset($_SESSION['mvalue']))
$mvalue=$_SESSION['mvalue']; //Load Session value Returned in Array
else
$mvalue=InitArray();

if (!isset($_SESSION['msg']))
$_SESSION['msg']="";
if (!isset($_SESSION['update']))
$_SESSION['update']=0;
//$mvalue[1]=$objOld_obc_st->MaxCert_yr();
//$mvalue[2]=$objOld_obc_st->MaxCert_no();
}//tag=1 [Return from Action form]


if (isset($_SESSION['msg']))
$returnmessage=$_SESSION['msg'];
else
$returnmessage="";

$mvalue=VerifyArray($mvalue);

//Start of FormDesign
//Header Line
$objOld_obc_st->TextHeader("Detail Entry of OBC and ST Certificate",95,2,$HeadColor,$fcol,3);

echo "<div align=center id=".chr(34)."DivMsg".chr(34)."><font face=arial size=2 color=red>".$returnmessage."</font></div>";

echo "<form name=myform action=Form_Old_obc_st.php method=post>";
echo "<table class=".chr(34)."myTable myTable-rounded".chr(34)." align=".chr(34)."center".Chr(34)."  width=95%>";
$i=0;
//ROW-1
echo "<thead>";
echo "<tr>";
$objOld_obc_st->bcol=$BodyColor;//Set Back Color Table Cell
$objOld_obc_st->TdText(3, 2,"Certificate Type", 0, 0, 0);
$objOld_obc_st->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)

//TdInputBox(1,$bcol,"Type",$mvalue[0],3,3,$function,0);
$ValueList[0][0]="ST";
$ValueList[1][0]="OBC";
$ValueList[2][0]="MOBC";
//Input Box and Check Box Surronded by <TD>
echo "<td>";
$objOld_obc_st->genSelectBoxByValueArray("Type", $ValueList, "0", 160, $bcol, $fcol, $font, "");
//$objOld_obc_st->genInputBox("Type",$mvalue[0],3,3,$bcol, $fcol, $font,$function,0);
echo "</td>";


echo "</tr>";
echo "</thead>";
//ROW-2
echo "<tbody>";
echo "<tr>";
$objOld_obc_st->bcol=$BodyColor;//Set Back Color Table Cell
$objOld_obc_st->TdText(3, 2,"Certificate Year", 0, 0, 0);
$objOld_obc_st->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objOld_obc_st->TdInputBox(1,$bcol,"Cert_yr",$mvalue[1],8,0,$function,1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objOld_obc_st->genInputBox("Cert_yr",$mvalue[1],8,0,$bcol, $fcol, $font,$function,1);
//echo "</td>";
//</TD>

echo "</tr>";
//ROW-3
echo "<tr>";
$objOld_obc_st->bcol=$BodyColor;//Set Back Color Table Cell
$objOld_obc_st->TdText(3, 2,"Certificate No", 0, 0, 0);
$objOld_obc_st->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objOld_obc_st->TdInputBox(1,$bcol,"Cert_no",$mvalue[2],8,0,$function,1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objOld_obc_st->genInputBox("Cert_no",$mvalue[2],8,0,$bcol, $fcol, $font,$function,1);
//echo "</td>";
//</TD>

echo "</tr>";
//ROW-4
echo "<tr>";
$objOld_obc_st->bcol=$BodyColor;//Set Back Color Table Cell
$objOld_obc_st->TdText(3, 2,"Origin Serial No", 0, 0, 0);
$objOld_obc_st->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objOld_obc_st->TdInputBox(1,$bcol,"Origin_no",$mvalue[3],20,50,$function,0);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objOld_obc_st->genInputBox("Origin_no",$mvalue[3],50,50,$bcol, $fcol, $font,$function,0);
//echo "</td>";
//</TD>

echo "</tr>";
//ROW-5
echo "<tr>";
$objOld_obc_st->bcol=$BodyColor;//Set Back Color Table Cell
$objOld_obc_st->TdText(3, 2,"Name", 0, 0, 0);
$objOld_obc_st->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objOld_obc_st->TdInputBox(1,$bcol,"Name",$mvalue[4],50,50,$function,0);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objOld_obc_st->genInputBox("Name",$mvalue[4],50,50,$bcol, $fcol, $font,$function,0);
//echo "</td>";
//</TD>

echo "</tr>";
//ROW-6
echo "<tr>";
$objOld_obc_st->bcol=$BodyColor;//Set Back Color Table Cell
$objOld_obc_st->TdText(3, 2,"Gurdian Name", 0, 0, 0);
$objOld_obc_st->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objOld_obc_st->TdInputBox(1,$bcol,"Gurdian_name",$mvalue[5],50,50,$function,0);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objOld_obc_st->genInputBox("Gurdian_name",$mvalue[5],50,50,$bcol, $fcol, $font,$function,0);
//echo "</td>";
//</TD>

echo "</tr>";
//ROW-7
echo "<tr>";
$objOld_obc_st->bcol=$BodyColor;//Set Back Color Table Cell
$objOld_obc_st->TdText(3, 2,"Village", 0, 0, 0);
$objOld_obc_st->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objOld_obc_st->TdInputBox(1,$bcol,"Vill",$mvalue[6],50,50,$function,0);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objOld_obc_st->genInputBox("Vill",$mvalue[6],50,50,$bcol, $fcol, $font,$function,0);
//echo "</td>";
//</TD>

echo "</tr>";
//ROW-8
echo "<tr>";
$objOld_obc_st->bcol=$BodyColor;//Set Back Color Table Cell
$objOld_obc_st->TdText(3, 2,"Circle", 0, 0, 0);
$objOld_obc_st->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
//$objOld_obc_st->TdInputBox(1,$bcol,"Circle",$mvalue[7],50,50,$function,0);

//Input Box and Check Box Surronded by <TD>
echo "<td>";
$List=$objOld_obc_st->PopulateValueList("select Circle from Circle where CIR_CODE >0");
$objOld_obc_st->genSelectBoxByValueArray("Circle", $List, $mvalue[8], 200, $bcol, $fcol, $font, "");

//$objOld_obc_st->genInputBox("Circle",$mvalue[7],50,50,$bcol, $fcol, $font,$function,0);
echo "</td>";
//</TD>

echo "</tr>";
//ROW-9
echo "<tr>";
$objOld_obc_st->bcol=$BodyColor;//Set Back Color Table Cell
$objOld_obc_st->TdText(3, 2,"Sub Caste", 0, 0, 0);
$objOld_obc_st->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
//$objOld_obc_st->TdInputBox(1,$bcol,"Subcaste",$mvalue[8],50,50,$function,0);

//Input Box and Check Box Surronded by <TD>
echo "<td>";
$objOld_obc_st->genSelectBoxByValueArray("Subcaste", $List=array(), $mvalue[8], 200, $bcol, $fcol, $font, "");
//$objOld_obc_st->genInputBox("Subcaste",$mvalue[8],50,50,$bcol, $fcol, $font,$function,0);
echo "</td>";
//</TD>

echo "</tr>";
echo "<tr>";
echo "<td align=right bgcolor=".$FootColor.">";
if ($_SESSION['update']==1)
{
echo"<font size=1 face=arial color=#CC3333>Updation Mode";
$cap="Update Data";
}
else
{
echo"<font size=1 face=arial color=#6666FF>New Entry Mode";
$cap="Save Data";
}
echo "</td>";
echo "<td align=left colspan=1 bgcolor=".$FootColor.">";
$objOld_obc_st->genHiddenBox("SaveData",0);
$objOld_obc_st->bcol="white";//Set Back Color for Html Box
//$genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
//$objOld_obc_st->genButton("Save", $cap,100 ,"#CCFF66","black", $font," onclick=validate()");
$objOld_obc_st->genCSSButton("Save", $cap,100 ,0,12,0," onclick=validate()");
//$objOld_obc_st->genButton("back1","Menu",100 , "#FFFF66","black", $font," onclick=home()");
$objOld_obc_st->genCSSButton("back1","Home",100 ,2,12,2," onclick=home()");
$objOld_obc_st->genHiddenBox("XML",0);
$objOld_obc_st->genButton("res1","Reset",100 , "#CCFFFF","black", $font," onclick=res()");
echo "</td></tr>";
echo "<tr><td align=right bgcolor=".$BodyColor."><font color=red size=2 face=arial>";
echo "</td>";
echo "<td colspan=1 align=left bgcolor=".$BodyColor.">";
echo "<div id=DivEdit></div>";
echo "</td></tr><tr>";
echo "<td  align=left bgcolor=".$BottomColor.">";
echo "<td colspan=1 align=left bgcolor=".$BottomColor.">";
//genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
///$objOld_obc_st->genButton("edit1","Edit",100 ,"#CCFFFF","black", $font," onclick=direct()");
//$objOld_obc_st->genButton("res1","Reset",100 , "#CCFFFF","black", $font," onclick=res()");
echo "</td></tr>";
echo "<tr><td colspan=2 align=center>";
echo "<table border=0>";

$ValueList[0][0]="Both";
$ValueList[1][0]="ST";
$ValueList[2][0]="OBC";
$ValueList[3][0]="MOBC";
echo "<tr><td align=right>Cert Type</td><td>";
$fun=" onchange=checkdata()";
$objOld_obc_st->DefaultOptRequired=0;
$objOld_obc_st->genSelectBoxByValueArray("rType", $ValueList, "Both", 100, $bcol, $fcol, $font, $fun);
echo "<td align=right>Year</td>";
$objOld_obc_st->TdInputBox(1, $bcol, "rYear", date('Y'), 4, 4, $fun, 0);
echo "<td align=right>Start No</td>";
$objOld_obc_st->TdInputBox(1, $bcol, "No1", "", 6, 6, $fun, 0);
echo "<td align=right>Last No</td>";
$objOld_obc_st->TdInputBox(1, $bcol, "No2", "", 6, 6, $fun, 0);
echo "<td align=center>";
$objOld_obc_st->genButton("a", "View Statement", 140, $bcol, $fcol, 10, " onclick=viewst()");
echo "</td>";
echo "</tr>";

echo "</tbody></table></form>";
//Generate data Grid

$title="";
$headlist=array("Type","Cert_yr","Cert_no","Origin_no","Name","Gurdian_name","Vill","Circle","Subcaste");
$align=array(1,1,1,1,1,1,1,1,1);
$sql="Select Type,Cert_yr,Cert_no,Origin_no,Name,Gurdian_name,Vill,Circle,Subcaste from old_obc_st ";
//$objOld_obc_st->genDataGrid($title, $headlist, $align, $sql,80);


echo $objUtility->focus("Cert_no");

if (isset($_SESSION['mvalue']))
unset($_SESSION['mvalue']);
if (isset($_SESSION['msg']))
unset($_SESSION['msg']);

//This function will Initialise Array
function InitArray()
{
$temp=array();
//$objOld_obc_st=new Old_obc_st();
$temp[0]="";//Type
// Call $objOld_obc_st->MaxCert_yr() Function Here if required and Load in $mvalue[1]
$temp[1]=date('Y');
// Call $objOld_obc_st->MaxCert_no() Function Here if required and Load in $mvalue[2]
$temp[2]="";//$objOld_obc_st->MaxCert_no(date('Y')) ;
$temp[3]="";//Origin_no
$temp[4]="";//Name
$temp[5]="";//Gurdian_name
$temp[6]="";//Vill
$temp[7]="";//Circle
$temp[8]="";//Subcaste
$temp[9]="0";//
$temp[10]="";//Reserve 
$temp[11]="";//Reserve
$temp[12]="";//Reserve 
$temp[13]="";//Reserve
return($temp);
}//GenInitArray


//Verify If all Array Index are loaded
function VerifyArray($myvalue)
{
$temp=array();
for($i=0;$i<=14;$i++)
{
$temp[$i]="";
}


//$temp[0]=0; //Sometimes this type assignment may be required

for($i=0;$i<=14;$i++)
{
if(isset($myvalue[$i]))
$temp[$i]=$myvalue[$i];
}

return($temp);
}//VerifyArray

?>
</body>
</html>
