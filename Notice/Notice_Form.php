<html>
<head>
<title>New Notice</title>
<?php
session_start();
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set("Asia/kolkata");
//include("header.php");
?>
<script type="text/javascript" src="validation.js"></script>
<script type="text/javascript">
<!--


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
//myform.action="Insert_notice.php";



function EditThroughJSON()
{
var data=ConstructDataString();
var Box=['Slno','Link_file','Link_description','Active','Isnew'];
var bType=[0,0,0,0,0];//0-value 1-SelectedIndex 2-checked  3-innerHTML   4-enables/disabled if value=1 or 0  40-enable/disable with value
JSONParsedString("notice_Process.php?Opr=E" ,data,Box,0,bType,'Save');
}


function gen()
{
var data="";    
MyAjaxFunction("POST","genNotice.php",data,"DivNotice","MSGHTML")    ;
}

function edit()
{
window.open("edit_notice.php","_blank");
}


function direct()
{
var mvalue=document.getElementById('Editme').value;
//load mvalue in Proper Primary Key Input Box (Preferably on Last Key)
document.getElementById('Slno').value=mvalue;

var a=document.getElementById('Slno').value ;//Primary Key
if ( isNumber(a))
{
myform.action="notice_Form.php?tag=2&ptype=0";
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
myform.Slno.focus();
}

function redirect(i)
{
myform.action="Form_notice.php?tag=2&ptype=1&mtype="+i;
myform.submit();
}


function validate()
{
var a=myform.Slno.value ;// Primary Key
if ( NumericValid('Slno',1,'NonNegative')==true   && StringValid('Link_file',1,1) && StringValid('Link_description',1,0))
{
document.getElementById('SaveData').value=1;
document.getElementById('Save').disabled=true;
document.getElementById('back1').disabled=true;
myform.action="Notice_Form.php";
myform.submit();
}
else
{
if (NumericValid('Slno',1,'NonNegative')==false)
{
alert('Non Numeric Value in Slno');
document.getElementById('Slno').focus();
}
else if (StringValid('Link_file',1,1)==false)//0-Simple Validation
{
alert('Check Link_file');
document.getElementById('Link_file').focus();
}
else if (StringValid('Link_description',1,1)==false)//0-Simple Validation
{
alert('Check Link_description');
document.getElementById('Link_description').focus();
}
else if (StringValid('Active',0,1)==false)//0-Simple Validation
{
alert('Check Active');
document.getElementById('Active').focus();
}
else if (StringValid('Isnew',0,1)==false)//0-Simple Validation
{
alert('Check Isnew');
document.getElementById('Isnew').focus();
}
else 
alert('Enter Correct Data');
}
}//End Validate




function home()
{
document.getElementById('Save').disabled=true;
document.getElementById('back1').disabled=true;
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
var Box=['Slno','Link_file','Link_description','Active','Isnew'];
var data;
var mBox=['Save'];
var bType=[40];
for(var i=0;i<Box.length;i++)
{
var obj=Box[i];
document.getElementById(obj).value="";
}
window.location="notice_Form.php?tag=0";
}

function ConstructDataString()
{
var data="Type=1";
//In Case of Check Box Use Following
//if(document.getElementById('CheckBoxId').checked==true)
//data=data+"&CheckBoxId=1";

var Obj=['Slno','Link_file','Link_description','Active','Isnew'];
for(var i=0;i<Obj.length;i++)
{
var box=Obj[i];
data=data+"&"+box+"="+document.getElementById(box).value;
}
return(data);
}
//END JAVA
</script>

<link href="table.css" rel="stylesheet"/>



</head>
<body>
<?php
//Start FORMPHPBODY
require_once 'utility.class.php';
require_once 'class.notice.php';
//require_once './class/class.sentence.php';

//Start Function/Method Guide

//$val=$objNotice->FetchColumn($table, $field, $condition, $default);
//Read Single Field from Table depending on condition and Return Default if not Available

//$Trow=$objNotice->FetchSingleRecord($table, $fielldlist, $conditiion);
//Read Field Data for FieldList(Pass as array) from Table depending on condition and Return as One Dimensional Array with Fieldname as Index for respective field eg. $Trow['Empcode']

//$Trow=$objNotice->FetchMultipleRecords($table, $fielldlist, $conditiion);
//Read Field Data for FieldList(Pass as array) from Table depending on condition and Return as two Dimensional Array with numeric index as Row Number and Fieldname index as column; eg $Trow[0]['Empcode']; for First Row

//$Trow=$objNotice->FetchRecords($sql);
//Read Multiple Row Data based on SQL Statement($sql) and Return as two Dimensional Array with numeric index as Row Number and Column number respectively; eg $Trow[0][0]; for First Row, First Column and so on


//Data Grid on SQL Statement and ValueList
//$headlist=array("Code","Name");
//$align=array(1,2,2);//1-Left Align,2-Center Align,3-Right Align
//$sql="Select Code,Name from Table";
//$objNotice->genDataGrid($title,$headlist,$align, $sql,95);
//$objNotice->genDataGridOnValueList($title,$headlist, $align, $ValueList, $width,$records);

//$objNotice->DefaultOptDetail = "-Select-"; //Common parameter
//$objNotice->DefaultOptRequired = 1; //Common parameter
//$objNotice->CountRecords($Table, $condition) //DBManager
//$objNotice->ExecuteBatchData($Table, $FldList, $ValueList, $Packet) //DBManager
//Following function return the code to generate the specific HTML element

//$objNotice->returnCheckBox($id, $val,  $function)  //DBManager

//$objNotice->returnInputBox($id, $val, $size, $maxlength, $function)

//$objNotice->returnButton($id, $val, $pix,$function)

//$objNotice->returnHiddenBox($id, $val)

//$objNotice->returnSelectBox($id, $query, $val, $pix, $function)

//$objNotice->returnDatePicker($Fld, $level)

//$objNotice->JoinUpdate($DstTable, $SrcTable, $DstField, $SrcFld, $cond)
//$objNotice->genSelectBoxByValueArray($id, $ValueList, $val, $pix, $bcol, $fcol, $font, $function);
//Generate a Select Box with ID as $id with the Parameter supplied in Two dimensional array $ValueList;Eg $ValueList[0][0] and $ValueList[0][1] will be reflected as ( <Option value=$ValueList[0][0]>$ValueList[0][1] )and So on

//CheckBox($id, $val, $bcol, $fcol, $font, $function, $mandatory)

//$objNotice->genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
//Generate a Select Box with ID as $id with $query Return value as ValueList

//TdText($align, $font, $text, $width, $rspan, $cspan)

//genInputBox($id, $val, $size, $maxlength, $bcol, $fcol, $font, $function, $mandatory);
//genButton($id, $val, $pix, $bcol, $fcol, $font, $function)
//CSS Button
//Type-0(pink),1(green),2(grey),3(red); $colortag-0(black)
//genCSSButton($id, $val,$width,$colortag,$font,$type,$function)

//TextHeader($msg,$width,$align,$bcol,$fcol,$font)

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

$objNotice=new Notice();

if (isset($_GET['tag']))
$_tag=$_GET['tag'];
else
$_tag=0;

if (isset($_SESSION['myArea']))
$Area=$_SESSION['myArea'];
else
$Area=0;

//if ($objUtility->checkArea($_SESSION['myArea'], 12)==false) //e.g 12 for Eroll Certificate
//header( 'Location: Mainmenu.php?unauth=1');

if (!is_numeric($_tag))
$_tag=0;

if ($_tag>2)
$_tag=0;

if (isset($_GET['mtype']))
$mtype=$_GET['mtype'];
else
$mtype=0;

if (!is_numeric($mtype))
$mtype=0;

if (isset($_POST['SaveData'])) //If Post data is to be Saved
$save = $_POST['SaveData'];
else
$save = 0;

$present_date=date('d/m/Y');
$mvalue=array();

if ($_tag==0 && $save==0) //Initial Page Loading
{
$_SESSION['update']=0;
$_SESSION['msg']="";
$mvalue=InitArray();
$_SESSION['mvalue']=$mvalue;
//$mvalue[0]=$objNotice->MaxSlno();
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
//$mvalue[0]=$objNotice->MaxSlno();
}//tag=1 [Return from Action form]

if ($_tag==2)//Post Back 
{
$_SESSION['msg']="";
if (isset($_GET['ptype']))
$ptype=$_GET['ptype'];
else
$ptype=0;

//Post Back on Select Box Change,Hence reserve the value
if ($ptype==1)
{
// CAll MaxNumber Function Here if require and Load in $mvalue
if (isset($_POST['Slno']))
$mvalue[0]=$_POST['Slno'];
else
$mvalue[0]=0;

if (isset($_POST['Link_file']))
$mvalue[1]=$_POST['Link_file'];
else
$mvalue[1]=0;

if (isset($_POST['Link_description']))
$mvalue[2]=$_POST['Link_description'];
else
$mvalue[2]=0;

if (isset($_POST['Active']))
$mvalue[3]=$_POST['Active'];
else
$mvalue[3]=0;

if (isset($_POST['Isnew']))
$mvalue[4]=$_POST['Isnew'];
else
$mvalue[4]=0;

if (isset($_POST['Editme']))
$mvalue[5]=$_POST['Editme'];
else
$mvalue[5]=0;

} //ptype=1

if (isset($_POST['Slno']))
$objNotice->setSlno($_POST['Slno']);//Push Primary Key Data to Class
if ($objNotice->EditRecord()) //i.e Data Available
{ 
if ($ptype==0) //Post Back on Edit Button Click
{
$mvalue[0]=$objNotice->getSlno();
$mvalue[1]=$objNotice->getLink_file();
$mvalue[2]=$objNotice->getLink_description();
$mvalue[3]=0;
$mvalue[4]=0;

if($objNotice->getActive()=="Y")
$mvalue[3]=1;
if($objNotice->getIsnew()=="Y")    
$mvalue[4]=1;
    
$mvalue[5]=0;//last Select Box for Editing
} //ptype=0
$_SESSION['update']=1;
} 
else //data not available for edit
{
$_SESSION['update']=0;
} //EditRecord()
} //tag==2

if (isset($_SESSION['msg']))
$returnmessage=$_SESSION['msg'];
else
$returnmessage="";

$mvalue=VerifyArray($mvalue);

//Start of FormDesign
//Header Line
$objNotice->TextHeader("Entry/Edit Form for Notice",80,2,$HeadColor,$fcol,3);

echo "<div align=center id=".chr(34)."DivMsg".chr(34)."><font face=arial size=2 color=red>".$returnmessage."</font></div>";

echo "<form name=myform action=Form_Notice.php method=post>";
echo "<table class=".chr(34)."myTable myTable-rounded".chr(34)." align=".chr(34)."center".Chr(34)."  width=80%>";
$i=0;
//ROW-1
echo "<thead>";
echo "<tr>";
$objNotice->bcol=$BodyColor;//Set Back Color Table Cell
$objNotice->TdText(3, 2,"Notice Serial", 0, 0, 0);
$objNotice->bcol="white";//Set Back Color for Html Box
$function=" readonly";

$objNotice->font=14;

//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objNotice->TdInputBox(1,$bcol,"Slno",$mvalue[0],8,0,$function,1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objNotice->genInputBox("Slno",$mvalue[0],8,0,$bcol, $fcol, $font,$function,1);
//$objNotice->genCheckBox("Check1", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

echo "</tr>";
echo "</thead>";
//ROW-2
echo "<tbody>";
echo "<tr>";
$objNotice->bcol=$BodyColor;//Set Back Color Table Cell
$objNotice->TdText(3, 2,"Link File Name", 0, 0, 0);
$objNotice->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
$objNotice->TdInputBox(1,$bcol,"Link_file",$mvalue[1],75,100,$function,1);

//Input Box and Check Box Surronded by <TD>
//echo "<td>";
//$objNotice->genInputBox("Link_file",$mvalue[1],50,100,$bcol, $fcol, $font,$function,1);
//$objNotice->genCheckBox("Check2", true, $bcol, $fcol, $font, "", 0);
//echo "<font face=arial size=1 color=grey>AutoConvert</font>";
//echo "</td>";
//Input Box and Check Box Surronded by </TD>

echo "</tr>";
//ROW-3
echo "<tr>";
$objNotice->bcol=$BodyColor;//Set Back Color Table Cell
$objNotice->TdText(3, 2,"Link Description", 0, 0, 0);
$objNotice->bcol="white";//Set Back Color for Html Box
$function="";
$row=3;
$col=70;
$objNotice->TdTextArea(1,$bcol,"Link_description",$mvalue[2],$row,$col,$function,1);
echo "</tr>";
//ROW-4
echo "<tr>";
$objNotice->bcol=$BodyColor;//Set Back Color Table Cell
$objNotice->TdText(3, 2,"Active", 0, 0, 0);
$objNotice->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
//$objNotice->TdInputBox(1,$bcol,"Active",$mvalue[3],1,1,$function,0);

//Input Box and Check Box Surronded by <TD>
echo "<td>";
$objNotice->CheckBoxWithValue("Active", "Y", $mvalue[3], "");
echo "</td>";
//Input Box and Check Box Surronded by </TD>

echo "</tr>";
//ROW-5
echo "<tr>";
$objNotice->bcol=$BodyColor;//Set Back Color Table Cell
$objNotice->TdText(3, 2,"Is New", 0, 0, 0);
$objNotice->bcol="white";//Set Back Color for Html Box
$function=" onchange=direct1()";
//TdInputBox(1,$bcol,$id,$val,$size,$maxlength,$function,$mandatory)
//$objNotice->TdInputBox(1,$bcol,"Isnew",$mvalue[4],1,1,$function,0);

echo "<td>";
$objNotice->CheckBoxWithValue("Isnew", "Y", $mvalue[4], "");
echo "</td>";

echo "</tr>";
echo "<tr>";
echo "<td align=right bgcolor=".$FootColor.">";
if ($_SESSION['update']==1)
{
echo"<font size=1 face=arial color=#CC3333>Updation Mode";
$cap="Update Notice";
}
else
{
echo"<font size=1 face=arial color=#6666FF>New Entry Mode";
$cap="Save Notice";
}
echo "</td>";
echo "<td align=left colspan=1 bgcolor=".$FootColor.">";
$objNotice->genHiddenBox("SaveData",0);
$objNotice->bcol="white";//Set Back Color for Html Box
//$genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
//$objNotice->genButton("Save", $cap,100 ,"#CCFF66","black", $font," onclick=validate()");
$objNotice->genCSSButton("Save", $cap,100 ,0,12,0," onclick=validate()");
//$objNotice->genButton("back1","Menu",100 , "#FFFF66","black", $font," onclick=home()");
$objNotice->genCSSButton("back1","Generate Notice",100 ,2,12,2," onclick=gen()");
$objNotice->genCSSButton("back2","Activate/Deactivate",0 ,2,12,2," onclick=edit()");

$objNotice->genHiddenBox("XML",0);
echo "</td></tr>";
echo "<tr><td align=right bgcolor=".$BodyColor."><font color=red size=2 face=arial>";
echo "</td>";
echo "<td colspan=1 align=left bgcolor=".$BodyColor.">";
$function=" onchange=LoadTextBox()";
$query="Select Slno,Link_description from Notice where 1=1 order by slno desc";
//$objNotice->genSelectBox($id, $query, $val, $pix, $bcol, $fcol, $font, $function);
$objNotice->genSelectBox("Editme", $query,$mvalue[5],"400", $bcol, $fcol, $font, $function);
echo "</td></tr><tr>";
echo "<td  align=left bgcolor=".$BottomColor.">";
echo "<td colspan=1 align=left bgcolor=".$BottomColor.">";
//genButton($id, $val, $pix, $bcol, $fcol, $font, $function);
$objNotice->genButton("edit1","Edit",100 ,"#CCFFFF","black", $font," onclick=direct()");
$objNotice->genButton("res1","Reset",100 , "#CCFFFF","black", $font," onclick=res()");
echo "</td></tr>";
echo "</tbody></table></form>";
//Generate data Grid

$objNotice->DivStart("DivNotice", 2);
-
$objNotice->DivEnd();


if($mtype==0)
echo $objUtility->focus("Slno");

if($mtype==1)//Postback from Slno
echo $objUtility->focus("Link_file");

if (isset($_SESSION['mvalue']))
unset($_SESSION['mvalue']);
if (isset($_SESSION['msg']))
unset($_SESSION['msg']);

//This function will Initialise Array
function InitArray()
{
$temp=array();
$objNotice=new Notice();
// Call $objNotice->MaxSlno() Function Here if required and Load in $mvalue[0]
$temp[0]=$objNotice->MaxSlno();//Slno
$temp[1]="./pdf/";//Link_file
$temp[2]="";//Link_description
$temp[3]="1";//Active
$temp[4]="0";//Isnew
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
//$objNotice->LockTable("notice");
$rvalue=array();
//Required for Edit and Insert in same Form

if ($_SESSION['update']==1)
{
if (isset($_POST['Slno'])) //If Last Pk Field is available
$_Slno=$_POST['Slno'];
else
$_Slno=0;
}

if ($_SESSION['update']==0)
{
$_Slno=$objNotice->maxSlno();
$objNotice->CommonSet("Uploaded_on", date('d/m/Y'), "DATE", 1, 10);
}


//Push Slno
$mvalue[0]=$_Slno;

$objNotice->setSlno($mvalue[0]);
$rvalue[0]=$mvalue[0];


//Push Link_file
$mvalue[1]="";
if (isset($_POST['Link_file'])) //If HTML Field is POST Availbale
$mvalue[1]=trim($_POST['Link_file']);
else { 
if (isset($_GET['Link_file'])) //If HTML Field is GET Availbale
$mvalue[1]=trim($_GET['Link_file']);
}

$objNotice->setLink_file($mvalue[1]);
$rvalue[1]=$mvalue[1];

//Push Link_description
$mvalue[2]="";
if (isset($_POST['Link_description'])) //If HTML Field is POST Availbale
$mvalue[2]=trim($_POST['Link_description']);
else { 
if (isset($_GET['Link_description'])) //If HTML Field is GET Availbale
$mvalue[2]=trim($_GET['Link_description']);
}

$objNotice->setLink_description($mvalue[2]);
$rvalue[2]=$mvalue[2];

//Push Active
$mvalue[3]="N";
if (isset($_POST['Active'])) //If HTML Field is POST Availbale
$mvalue[3]="Y";


$objNotice->setActive($mvalue[3]);

$rvalue[3]=$mvalue[3];

//Push Isnew
$mvalue[4]="N";
if (isset($_POST['Isnew'])) //If HTML Field is POST Availbale
$mvalue[4]="Y";


$objNotice->setIsnew($mvalue[4]);
$rvalue[4]=$mvalue[4];



$Er="";
$returnmsg="";

if ($_SESSION['update']==0)
{
$result=$objNotice->SaveRecord();
$mmode="Data Entered Successfully";
$returnmsg=$mmode;
}
else
{
$result=$objNotice->UpdateRecord();
if($objNotice->rowCommitted>0)
$mmode="Data Updated Successfully";
else
$mmode="Zero Row Updated";
$returnmsg=$mmode;
}//$_SESSION['update']==0
if ($result)
{
$sql=$objNotice->returnSql;
$objUtility->CreateLogFile("Notice",$sql,1,"D");
$mvalue = InitArray();
//if(isset($rvalue[0]))
//$mvalue[0]=$rvalue[0]; //reinitialise mvalue with prev value
$_SESSION['update']=0;
}
else //Fails
{
$Er= $objNotice->Error();
$Er.=$objNotice->ValidationErrorList;
$returnmsg=$Er;
$objUtility->saveErrorLog("Error",$Er);
if($objNotice->colUpdated>0)
$mmode="Transaction Fails,Contact Administrator";
else
$mmode="Nothing to Update";
//echo $objNotice->Error();
}//$result
$_SESSION['mvalue'] = $mvalue;
$_SESSION['msg'] = $returnmsg;
//$objNotice->UnlockTable(0,"notice");
//header( 'Location: Form_notice.php?tag=1');
//If Java Script Message is Required Uncommenet following
$msg=$mmode;
echo $objUtility->AlertNRedirect($msg, "Notice_Form.php?tag=1");
}//$save=1
?>
</body>
</html>
