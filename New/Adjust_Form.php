<html>
<head>
<title>ADJUST</title>
<?php
//If you uncomment menuhead.php then pls comment session_start(), since it is already declared in menuhead.php
session_start();
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/kolkata");
?>
<script src="jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="validation2018.js"></script>
<script type="text/javascript">
<!--

//START JQUERY BLOCK

//Yr(varchar) //Mn(int) //Bank(varchar) //Opcase(int) //Amt(int) 

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
            opt=JsonArray['Code'][i]['Opt'];
            opt="'"+opt+"'";
            detail=JsonArray['Code'][i]['Detail'];
                var myopt='<option value='+opt+'>'+detail+'</option>';
                //$("#SelectBox2").append(myopt)  ;
$("select[name='"+obj+"']").append(myopt);
            } //end for loop
            //$("#SelectBox2").val(selectval);
$("select[name='"+obj+"']").val(selectval);
}
 
 
//Load A Select Box Items ,on Change Event of Parent Select Box using JSON
$(" #SelectBox1").change(function(event){
var DATA="Param1="+ $("SelectBox1").val();
var URL="AjaxCall/JsonCreator_adjust.php" ;
$.ajax({type:"POST",url: URL,data:DATA, success: function(result){
        
         var JsonArray = JSON.parse(result);
          Push_Item('selectbox_id',JsonArray);
    }}); //End $Ajax
}); //END Zpc Change Event
}); //Document Ready Function

//END JQUERY BLOCK


function EditThroughJSON()
{
var data=ConstructDataString();
var Box=['Yr','Mn','Bank','Opcase','Amt'];
var bType=[0,0,0,0,0];//0-value 1-SelectedIndex 2-checked  3-innerHTML   4-enables/disabled if value=1 or 0  40-enable/disable with value
JSONParsedString("adjust_Process.php?Opr=E" ,data,Box,0,bType,'Save');
}


function direct()
{
if (NumericValid('Yr',1,'Positive') && NumericValid('Mn',1,'Positive') && SelectBoxIndex('Bank')>0)
{
myform.action="Adjust_Form.php?tag=2";
myform.submit();
}
}

function direct1()
{
var i;
i=0;
}


function setMe()
{
myform.Yr.focus();
}



function redirect(i)
{
}//End Redirect



function validate()
{
var b=myform.Mn.value ;// Primary Key
var d=myform.Opcase.value ;
var e=myform.Amt.value ;
if ( NumericValid('Yr',1,'Positive','Year')  && NumericValid('Mn',0,'Positive','Month')==true && SelectBoxIndex('Bank')>0  &&  NumericValid('Opcase',0,'Any','Opcase')==true &&  NumericValid('Amt',0,'Any','Amt')==true &&  1==1)
{
var mdata=ConstructDataString();
//document.getElementById('SaveData').value=1;
//document.getElementById('Save').disabled=true;
//document.getElementById('back1').disabled=true;
setVal('SaveData', 1);
DisObj('Save');
myform.action="Adjust_Form.php?"+mdata;
myform.submit();
}
else
{
 document.getElementById('DivError').innerHTML = 'Validation Error Found at Client Side';
}
}//End Validate




function home()
{
DisObj('Save');
DisObj('back1');
window.location="mainmenu.php?tag=1";
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
var Box=['Yr','Mn','Bank','Opcase','Amt'];
var data;
var mBox=['Save'];
var bType=[40];
for(var i=0;i<Box.length;i++)
{
var obj=Box[i];
setVal(obj,"")
}
window.location="adjust_Form.php?tag=0";
}

function ConstructDataString()
{
var data="Type=1";
//In Case of Check Box Use Following
//if(document.getElementById('CheckBoxId').checked==true)
//data=data+"&CheckBoxId=1";

var Obj=['Yr','Mn','Bank','Opcase','Amt'];
for(var i=0;i<Obj.length;i++)
{
var box=Obj[i];
data=data+"&"+box+"="+getVal(box);
}
return(data);
}
//END JAVA


//var j1=myform.rollno.selectedIndex;//Returns Numeric Index from 0
//var j2=myform.box1.checked;//Return true if check box is checked
//var j=myform.rollno.value;
//var mylength=parseInt(j.length);
//var mystr=j.substr(0, 3);// 0 to length 3
//var ni=j.indexOf(",",3);// search from 3
//var name = confirm("Return to Main Menu?")
//if (name == true)
//window.location="mainmenu.php?tag=1";
//StringValid('a',0,0) 'a'- Input Box Id, First(0- Allow Null,1- Not Null) Second(0- Simple Validation(With Single Quote Allow),1- No Quote, 2- Strong Validation)
//NumericValid('a',0,type) 'a'- Input Box Id, First(0- Allow Null,1- Not Null) Second(type: 'Positive'(>0), 'Negative'(<0), 'NonNegative'(>=0), 'Zero'(=0),'Any'(any Number)'

//myform.setAttribute("target","_self");//Open in Self
//myform.setAttribute("target","_blank");//Open in New Window
//myform.action="Insert_adjust.php";

</script>
<link href="./class/table.css" rel="stylesheet"/>
<script type="text/javascript">
//$(document).ready(function() //Onload event of Form
//{
//alert('Document Loaded');
//var data="Acc_no="+$("#Acc_no").val();
//MyAjaxFunction("POST","Requestfile.php",data,'DivArea','HTML');
//$("#Yr").change(function(event){
//$("#DivMsg").hide();
//});

//var mname = [" ","January","February","March","April","May","June","July","August","September","October","November","December"];
//$("#ChekBoxId").prop('checked', true); //Set heckbox Property
//$("#Save").click(function(event){
//alert('You Clicked me');
// var aa=$("#Box1").val();//Asign Value of  Box1 to variable aa
// $("#Box1").val(5); //Asign 5 to   Box1
//});

//var data=ConstructDataString();
//var iBoxId="Bank";///Change PK input Box ID Accordingly
//MyAjaxFunction("POST","./ServerRequest/Load_adjust.php?mtype=Editme&mval="+document.getElementById(iBoxId).value,data,'DivEdit',"HTML");

//MyAjaxFunction("POST","./ServerRequest/Load_adjust.php?mtype=Bank&mval="+document.getElementById('Bank').value  ,data,'DivBank',"HTML");

//$("#id").blur(function(event){
//$("#Row1").show();
//$("#Row2").hide();
//$("#Female").animate({height:"-=5px"});
//$("#Female").animate({fontSize:"-=2px"});
//});

//Remove Select Box item Single
//$("#SelectBoxId option[value='11']").remove();

//Remove Select Box item Loop
//for(var i=7;i<=12;i++)
//$("#SelectBoxId option[value='"+i+"']").remove();

//Append Select Box item Single
//$("#SelectBoxId").append('<option value="9">September</option>');
//Append Select Box item Group
//var mid="#SelectBoxId";
//for(var i=1;i<=j;i++)
//{
//var opt="<option value="+i+">"+mname[i]+"</option>";
//$(mid).append(opt);
//}//for loop
//Unload Event through JQuery
//$.ajaxSetup ({
//cache: false
//});
//$(window).unload(function() {
//$.ajax({
//url:   'logout.php',async : false
//});
//return false;
//}); //unload


//MyAjaxFunction("POST","LoadSelectBoxAdjust.php?type=1",data,'TargetId',"HTML");



//}); //Document Ready Function
</script>

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
//Yr(varchar) //Mn(int) //Bank(varchar) //Opcase(int) //Amt(int) 
require_once './class/utility.class.php';
require_once './class/class.adjust.php';
//require_once './class/class.sentence.php';

//Start Function/Method Guide

//$val=$objAdjust->FetchColumn($table, $field, $condition, $default);
//Read Single Field from Table depending on condition and Return Default if not Available

//$Trow=$objAdjust->FetchRecords($sql);

//$objAdjust->ExecuteBatchData($Table, $FldList, $ValueList, $Packet) //DBManager

//$objAdjust->JoinUpdate($DstTable, $SrcTable, $DstField, $SrcFld, $cond)

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

$objAdjust=new Adjust();

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

//Check CSRF Token for Actual Request

if ($save == 1) {
$prev_token=isset($_SESSION['csrf_token'])?$_SESSION['csrf_token']:'--';
$posted_token=isset($_POST['csrf_token'])?$_POST['csrf_token']:'xx';

if($posted_token!=$prev_token)
{
$page = 'login.htm';
$k = $objAdjust->FolderLevel($level);
$page = $level . $page;

if (isset($_SERVER['HTTP_REFERER']))
$page =$_SERVER['HTTP_REFERER'];
echo 'Bad Source: '.$page;
echo $objAdjust->OpenWindow('', $page, 2);
}
}

$present_date=date('d/m/Y');
$mvalue=array();

if ($_tag==0 && $save==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";
$mvalue=InitArray();
$_SESSION['mvalue']=$mvalue;
//$mvalue[1]=$objAdjust->MaxMn();
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
//$mvalue[1]=$objAdjust->MaxMn();
}//tag=1 [Return from Action form]

if ($_tag==2)//Post Back 
{
$_SESSION['msg']="";
if (isset($_GET['ptype']))
$ptype=$_GET['ptype'];
else
$ptype=0;


if (isset($_POST['Yr']))
$objAdjust->setYr($_POST['Yr']);//Push Primary Key Data to Class
if (isset($_POST['Mn']))
$objAdjust->setMn($_POST['Mn']);//Push Primary Key Data to Class
if (isset($_POST['Bank']))
$objAdjust->setBank($_POST['Bank']);//Push Primary Key Data to Class
if ($objAdjust->EditRecord()) //i.e Data Available
{ 
$mvalue[0]=$objAdjust->getYr();
$mvalue[1]=$objAdjust->getMn();
$mvalue[2]=$objAdjust->getBank();
$mvalue[3]=$objAdjust->getOpcase();
$mvalue[4]=$objAdjust->getAmt();
$mvalue[5]=0;//last Select Box for Editing
$_SESSION['update']=1;
} 
else //data not available for edit
{
$mvalue[0]=$_POST['Yr'];
$mvalue[1]=$_POST['Mn'];
$mvalue[2]=$_POST['Bank'];
$_SESSION['update']=0;
} //EditRecord()
//echo $objAdjust->returnSql;
} //tag==2

if (isset($_SESSION['msg']))
$returnmessage=$_SESSION['msg'];
else
$returnmessage="";

$mvalue=VerifyArray($mvalue);

//Start of FormDesign
//Header Line
$objAdjust->TextHeader("Entry/Edit Form for Adjust",95,2,$HeadColor,$fcol,3);

echo "<div align=center id=".chr(34)."DivMsg".chr(34)."><font face=arial size=2 color=red>".$returnmessage."</font></div>";

echo "<form name=myform action=Form_Adjust.php method=post>";
echo "<table class=".chr(34)."myTable myTable-rounded".chr(34)." align=".chr(34)."center".Chr(34)."  width=95%>";
$i=0;
//ROW-1
echo "<thead>";
echo "<tr>";
$objAdjust->bcol=$BodyColor;//Set Back Color Table Cell
$objAdjust->TdText(3, 2,"Enter Year", 0, 0, 0);
$objAdjust->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objAdjust->TdInputBox(1,$bcol,"Yr",$mvalue[0],4,4,$function,1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objAdjust->genInputBox("Yr",$mvalue[0],4,4,$bcol, $fcol, $font,$function,1);
//echo "</td>";
//</TD>

echo "</tr>";
echo "</thead>";
//ROW-2
echo "<tbody>";
echo "<tr>";
$objAdjust->bcol=$BodyColor;//Set Back Color Table Cell
$objAdjust->TdText(3, 2,"Enter Month Code", 0, 0, 0);
$objAdjust->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objAdjust->TdInputBox(1,$bcol,"Mn",$mvalue[1],8,0,$function,1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objAdjust->genInputBox("Mn",$mvalue[1],8,0,$bcol, $fcol, $font,$function,1);
//echo "</td>";
//</TD>

echo "</tr>";
//ROW-3
echo "<tr>";
$objAdjust->bcol=$BodyColor;//Set Back Color Table Cell
$objAdjust->TdText(3, 2,"Bank", 0, 0, 0);
$objAdjust->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct()";
$query="Select Bank_name from bank_master where  1=1  order by bank_name";
echo "<td>";
echo "<div id=DivBank>";
$objAdjust->genSelectBox("Bank" , $query,$mvalue[2] , 120, $bcol, $fcol, $font, $function);
echo "</div>";
echo "</td>";

echo "</tr>";
//ROW-4
echo "<tr>";
$objAdjust->bcol=$BodyColor;//Set Back Color Table Cell
$objAdjust->TdText(3, 2,"Adjust Opening Case", 0, 0, 0);
$objAdjust->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objAdjust->TdInputBox(1,$bcol,"Opcase",$mvalue[3],8,0,$function,0);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objAdjust->genInputBox("Opcase",$mvalue[3],8,0,$bcol, $fcol, $font,$function,0);
//echo "</td>";
//</TD>

echo "</tr>";
//ROW-5
echo "<tr>";
$objAdjust->bcol=$BodyColor;//Set Back Color Table Cell
$objAdjust->TdText(3, 2,"Adjust Amount", 0, 0, 0);
$objAdjust->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objAdjust->TdInputBox(1,$bcol,"Amt",$mvalue[4],8,0,$function,0);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objAdjust->genInputBox("Amt",$mvalue[4],8,0,$bcol, $fcol, $font,$function,0);
//echo "</td>";
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
$objAdjust->genHiddenBox("SaveData",0);
$objAdjust->bcol="white";//Set Back Color for Html Box
//$genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
//$objAdjust->genButton("Save", $cap,100 ,"#CCFF66","black", $font," onclick=validate()");
$objAdjust->genCSSButton("Save", $cap,100 ,0,12,0," onclick=validate()");
//$objAdjust->genButton("back1","Menu",100 , "#FFFF66","black", $font," onclick=home()");
//$objAdjust->genCSSButton("back1","Menu",100 ,2,12,2," onclick=home()");
$objAdjust->genHiddenBox("XML",0);
$objAdjust->CSRF_TokenWithHiddenBox();
echo "</td></tr>";
echo "</tbody></table></form>";
//Generate data Grid

$title="";
$headlist=array("Yr","Mn","Bank","Opcase","Amt");
$align=array(1,1,1,1,1);
$sql="Select Yr,Mn,Bank,Opcase,Amt from adjust ";
//$objAdjust->genDataGrid($title, $headlist, $align, $sql,80);

if($mtype==0)
echo $objUtility->focus("Yr");

if (isset($_SESSION['mvalue']))
unset($_SESSION['mvalue']);
if (isset($_SESSION['msg']))
unset($_SESSION['msg']);

//This function will Initialise Array
function InitArray()
{
$temp=array();
//$objAdjust=new Adjust();
$temp[0]="";//Yr
// Call $objAdjust->MaxMn() Function Here if required and Load in $mvalue[1]
$temp[1]="";//Mn
$temp[2]="";//Bank
$temp[3]="0";//Opcase
$temp[4]="0";//Amt
$temp[5]="0";//
$temp[6]="";//Reserve 
$temp[7]="";//Reserve
$temp[8]="";//Reserve 
$temp[9]="";//Reserve
return($temp);
}//GenInitArray


//Verify If all Array Index are loaded
function VerifyArray($myvalue)
{
$temp=array();
for($i=0;$i<=10;$i++)
{
$temp[$i]="";
}


//$temp[0]=0; //Sometimes this type assignment may be required

for($i=0;$i<=10;$i++)
{
if(isset($myvalue[$i]))
$temp[$i]=$myvalue[$i];
}

return($temp);
}//VerifyArray


//Code for Posting Form Data to Database Table
if ($save == 1) {
    $myTag=0;
        $Err="Error List-";

$prev_token=isset($_SESSION['prev_csrf_token'])?$_SESSION['prev_csrf_token']:'--';
$posted_token=isset($_POST['csrf_token'])?$_POST['csrf_token']:'xx';

if($posted_token!=$prev_token)
{
$page = 'login.htm';
$k = $objAdjust->FolderLevel($level);
$page = $level . $page;

if (isset($_SERVER['HTTP_REFERER']))
$page =$_SERVER['HTTP_REFERER'];

echo $objAdjust->OpenWindow('', $page, 2);
}

$objAdjust->LockTable("adjust");
$rvalue=array();
//Required for Edit and Insert in same Form
if (1==2){
if ($_SESSION['update']==1)
{
if (isset($_POST['Mn'])) //If Last Pk Field is available
$_Mn=$_POST['Mn'];
else
$_Mn=0;
}

if ($_SESSION['update']==0)
$_Mn=$objAdjust->maxMn();
}

//Push Yr
$object="Yr";
$mvalue[0]=isset($_POST[$object])?$_POST[$object]:(isset($_GET[$object])?$_GET[$object]:'');

$objAdjust->setYr($mvalue[0]);
$rvalue[0]=$mvalue[0];

//Push Mn
$object="Mn";
$mvalue[1]=isset($_POST[$object])?$_POST[$object]:(isset($_GET[$object])?$_GET[$object]:'');

$objAdjust->setMn($mvalue[1]);
$rvalue[1]=$mvalue[1];

//Push Bank
$object="Bank";
$mvalue[2]=isset($_POST[$object])?$_POST[$object]:(isset($_GET[$object])?$_GET[$object]:'');

$objAdjust->setBank($mvalue[2]);// Primary Key
$rvalue[2]=$mvalue[2];

//Push Opcase
$object="Opcase";
$mvalue[3]=isset($_POST[$object])?$_POST[$object]:(isset($_GET[$object])?$_GET[$object]:'');

$objAdjust->setOpcase($mvalue[3]);
$rvalue[3]=$mvalue[3];

//Push Amt
$object="Amt";
$mvalue[4]=isset($_POST[$object])?$_POST[$object]:(isset($_GET[$object])?$_GET[$object]:'');

$objAdjust->setAmt($mvalue[4]);
$rvalue[4]=$mvalue[4];



$Er="";
$returnmsg="";

$result=$objAdjust->Available();


if ($result==false)
{
$result=$objAdjust->SaveRecord();
$mmode="Data Entered Successfully";
$returnmsg=$mmode;
}
else
{
$result=$objAdjust->UpdateRecord();
if($objAdjust->colUpdated>0)
$mmode=" Data Updated Successfully";
else
$mmode="Zero Row Updated";
$returnmsg=$mmode;
}//$_SESSION['update']==0
if ($result)
{
$sql=$objAdjust->returnSql;
$objUtility->CreateLogFile("Adjust",$sql,1,"D");
$mvalue = InitArray();
//if(isset($rvalue[0]))
//$mvalue[0]=$rvalue[0]; //reinitialise mvalue with prev value
$_SESSION['update']=0;
}
else //Fails
{
$Er= $objAdjust->Error();
$objUtility->saveErrorLog();
$Er=$objAdjust->ValidationErrorList;
$returnmsg=$Er;
if($objAdjust->colUpdated>0)
$mmode="Transaction Fails,Contact Administrator";
else
$mmode="Nothing to Update";
//echo $objAdjust->Error();
}//$result
$_SESSION['mvalue'] = $mvalue;
$_SESSION['msg'] = $returnmsg;
$objAdjust->UnlockTable(0,"adjust");
//header( 'Location: Form_adjust.php?tag=1');
//If Java Script Message is Required Uncommenet following
$msg=$mmode;
echo $objUtility->AlertNRedirect($msg, "Adjust_Form.php?tag=1");
}//$save=1
?>
</body>
</html>
