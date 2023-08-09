//LAST Update on 6-mar-2018

//Common Java Script
function isChecked(id)
{
    return(document.getElementById(id).checked);
}

function getVal(id)
{
    return(document.getElementById(id).value);
}

function setVal(id, val)
{
    document.getElementById(id).value = val;
}

function EnuObj(obj)
{
    document.getElementById(obj).disabled = false;
}

function DisObj(obj)
{
    document.getElementById(obj).disabled = true;
}


function getMultipleSelectedValueSeparatedByComma(Obj, startindex)
{
    var selObj = document.getElementById(Obj);
    var i;
    var str = "";
    var count = 0;
    for (i = startindex; i < selObj.options.length; i++) {
        if (selObj.options[i].selected) {
            var a = selObj.options[i].value;
            if (count > 0)
                str = str + ",";
            str = str + "'" + a + "'";
            count = count + 1;
        }
    }
    return(str);
}



function OpenPopup(url, ht, wt, left, top) {
    popupWindow = window.open(
            url, "popUpWindow", "height=" + ht + ",width=" + wt + ",left=" + left + ",top=" + top + ",resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=no")
}



//
function JSONParsedStringOnParent(URL, data, Obj, Index, bType, But)
{
    var ajaxRequest;  // The variable that makes Ajax possible!
    try
    {
// Opera 8.0+, Firefox, Safari
        ajaxRequest = new XMLHttpRequest();
    } catch (e)
    {
// Internet Explorer Browsers
        try
        {
            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e)
        {
            try {
                ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e)
            {
// Something went wrong
                alert("Your browser broke!");
                return false;
            }
        }
    }

    ajaxRequest.onreadystatechange = function () {
        if (ajaxRequest.readyState == 4) {
            var text = ajaxRequest.responseText;
            var JsonParsed = JSON.parse(text);

//Clear Old Value
//alert('clearing');
            for (var i = 0; i < Obj.length; i++)
            {
                var mbox = Obj[i];
                var myobj = window.opener.document.getElementById(mbox);

//alert(mbox);

                if (bType[i] == 0 || bType[i] == 1)
                    myobj.value = "";

//if(bType[i]==2)
//myobj.checked=false;

                if (bType[i] == 3)
                    myobj.innerHTML = "";
//if(bType[i]==4)
//myobj.disabled=false;
            }
            window.opener.document.getElementById(But).value = "Save Data";

//Load New Value
//alert(Obj.length);
            for (var i = 0; i < Obj.length; i++)
            {
//alert(i);
                var mbox = Obj[i];
                var myobj = window.opener.document.getElementById(mbox);
//alert(myobj.value);
                var mvalue = JsonParsed[Index][mbox];
//alert(mbox);
                if (bType[i] == 0)
                {
                    myobj.value = mvalue;
//alert(mvalue);
                }

                if (bType[i] == 1)
                    myobj.selectedIndex = mvalue;

                if (bType[i] == 2)
                {
                    if (mvalue == "1" || mvalue == "t" || mvalue == "Y")
                        myobj.checked = true;
                    else
                        myobj.checked = false;
                }

                if (bType[i] == 3)
                    myobj.innerHTML = mvalue;

                if (bType[i] == 4) //enable/disable
                {
                    if (mvalue == "1")
                        myobj.disabled = false;
                    else
                        myobj.disabled = true;
                }


                if (bType[i] == 40) //enable/disable with value assign
                {
                    var mylength = parseInt(mvalue.length) - 2;
//alert(mylength);
                    if (mvalue.substr(0, 1) == "1")
                        myobj.disabled = false;
                    else
                        myobj.disabled = true;

                    myobj.value = mvalue.substr(2, mylength);
                }


                if (bType[i] == 42) //enable/disable with check uncheck
                {
                    var mylength = parseInt(mvalue.length) - 2;
//alert(mylength);
                    if (mvalue.substr(0, 1) == "1")
                        myobj.disabled = false;
                    else
                        myobj.disabled = true;

                    var ch = mvalue.substr(2, mylength);
                    if (ch == "1" || ch == "Y" || ch == "t")
                        myobj.checked = true;
                    else
                        myobj.checked = false;
                }

//myobj.value=JsonParsed[Index][mbox];
            }
            if (JsonParsed[Index]['Found'] > 0)
                window.opener.document.getElementById(But).value = "Update Data";

            var msg = JsonParsed[0]['AlertMessage'];
            if (msg != "")
                alert(msg);

        } //readydyState == 4)
    } //end function

    ajaxRequest.open("POST", URL, true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxRequest.send(data);
}//end JSOn Value



function JSONParsedString(URL, data, Obj, Index, bType, But)
{
    var ajaxRequest;  // The variable that makes Ajax possible!
    try
    {
// Opera 8.0+, Firefox, Safari
        ajaxRequest = new XMLHttpRequest();
    } catch (e)
    {
// Internet Explorer Browsers
        try
        {
            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e)
        {
            try {
                ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e)
            {
// Something went wrong
                alert("Your browser broke!");
                return false;
            }
        }
    }

    ajaxRequest.onreadystatechange = function () {
        if (ajaxRequest.readyState == 4) {
            var text = ajaxRequest.responseText;
            var JsonParsed = JSON.parse(text);

//Clear Old Value
//alert('clearing');
            for (var i = 0; i < Obj.length; i++)
            {
                var mbox = Obj[i];
                var myobj = document.getElementById(mbox);

//alert(mbox);

                if (bType[i] == 0 || bType[i] == 1)
                    myobj.value = "";

//if(bType[i]==2)
//myobj.checked=false;

                if (bType[i] == 3)
                    myobj.innerHTML = "";

//if(bType[i]==4)
//myobj.disabled=false;
            }


            document.getElementById(But).value = "Save Data";

            for (var i = 0; i < Obj.length; i++)
            {

                var mbox = Obj[i];
                var myobj = document.getElementById(mbox);
//alert(mbox);
                var mvalue = JsonParsed[Index][mbox];
//alert(mbox);
                if (bType[i] == 0)
                {

                    myobj.value = mvalue;
                }

                if (bType[i] == 1)
                    myobj.selectedIndex = mvalue;

                if (bType[i] == 2)
                {
                    if (mvalue == "1" || mvalue == "t" || mvalue == "Y")
                        myobj.checked = true;
                    else
                        myobj.checked = false;
                }

                if (bType[i] == 3)
                    myobj.innerHTML = mvalue;

                if (bType[i] == 4) //enable/disable
                {
                    if (mvalue == "1")
                        myobj.disabled = false;
                    else
                        myobj.disabled = true;
                }


                if (bType[i] == 50)  //value and cursor position
                {
                    var ind = mvalue.indexOf("#", 0);
                    //alert(ind);
                    var temp = mvalue.substr(0, ind);//
                    myobj.value = temp;
                    //Set Cursor Position
                    mylength = parseInt(temp.length);
                    var ind1 = temp.substr(ind + 1, mylength - (ind + 1));//
                    myobj.setSelectionRange(ind1, ind1);
                }

                if (bType[i] == 40) //enable/disable with value assign
                {
                    var mylength = parseInt(mvalue.length) - 2;
//alert(mylength);
                    if (mvalue.substr(0, 1) == "1")
                        myobj.disabled = false;
                    else
                        myobj.disabled = true;

                    myobj.value = mvalue.substr(2, mylength);
                }


                if (bType[i] == 42) //enable/disable with check uncheck
                {
                    var mylength = parseInt(mvalue.length) - 2;
//alert(mylength);
                    if (mvalue.substr(0, 1) == "1")
                        myobj.disabled = false;
                    else
                        myobj.disabled = true;

                    var ch = mvalue.substr(2, mylength);
                    if (ch == "1" || ch == "Y" || ch == "t")
                        myobj.checked = true;
                    else
                        myobj.checked = false;
                }

//myobj.value=JsonParsed[Index][mbox];
            }
            if (JsonParsed[Index]['Found'] > 0)
                document.getElementById(But).value = "Update Data";

            var msg = JsonParsed[0]['AlertMessage'];
            if (msg != "")
                alert(msg);

        } //readydyState == 4)
    } //end function

    ajaxRequest.open("POST", URL, true);
    ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxRequest.send(data);
}//end JSOn Value

function EnableDisable(butarray, tag)
{
    for (var i = 0; i < butarray.length; i++)
    {
        var obj = butarray[i];
        if (tag == 0)
            document.getElementById(obj).disabled = true;
        else
            document.getElementById(obj).disabled = false;
    }
}


function checkMobile(b, tag)
{
    var found;
    var str1;
    var str2;
    var dash;
    found = false;
    var str = document.getElementById(b).value;
    var mylength = str.length;

    if (tag == 0 && mylength == 0)
        found = true;
    else
    {
        if (mylength == 10)
        {
            if (isNumber(str))
                found = true;
        } //mylength=10
    } //tag==0 && mylength==0
    return(found);
}


function Length(b)
{
    var str = document.getElementById(b).value;
    var mylength = str.length;
    return(mylength);
}

function RemoveAllSpace(a)
{
    var newstr = "";
    var str = document.getElementById(a).value;
    for (var i = 0; i < str.length; i++)
    {
        k = parseInt(str.charCodeAt(i));
        if (k == 32)
            newstr = newstr;
        else
            newstr = newstr + str.substr(i, 1);
    } //for loop
    document.getElementById(a).value = newstr;
}//removeSpace

function isdate(dt, tag)
{
//var dt=myform.Est_On.value;
    var ln = parseInt(dt.length);
    var dd;
    var mm;
    var yyyy;
    var leapday;
    var tt = true;
    var i = dt.indexOf("/");
    dd = dt.substr(0, i);
    var j = dt.indexOf("/", (i + 1));
    mm = dt.substr((i + 1), (j - i - 1));
    yyyy = dt.substr((j + 1), (ln - j - 1));
    if (parseInt(yyyy) < 100)
        yyyy = yyyy + 2000;
    if (isNaN(yyyy) == false)
    {
        var t = parseInt(yyyy % 4);
        if (t == 0)
            leapday = 29;
        else
            leapday = 28;
    }
    if ((tag == 0) && ln == 0)  //for null field No check
        tt = true;
    else
    {
        if (isNaN(dd) == false && isNaN(mm) == false && isNaN(yyyy) == false)
        {
            dd = Number(dd);
            mm = Number(mm);
            yyyy = Number(yyyy);
            if ((mm > 0) && (mm < 13) && (dd > 0) && (dd < 32))
            {
                if ((mm == 4) || (mm == 6) || (mm == 9) || (mm == 11)) //30st day
                {
                    if (dd > 30)
                    {
//alert('Invalid Date '+dt+'(DD Part out of range)');
                        tt = false;
                    }
                } // mm==4
                if (mm == 2)
                {
                    if (dd > leapday)
                    {
//alert('Invalid Date '+dt+'(DD Part)');
                        tt = false;
                    }
                } //mm==2
            } else //mm>0 && dd>0
            {
//alert('Invalid Date '+dt+'(Month out of range)');
                tt = false;
            }
        } else  // Non numeric figure appears
        {
//alert('Invalid date '+dt);
            tt = false;
        }
    }// not null
    return(tt);
} //End date validation


//date comaprison
function CompareDateById(date1, date2)
{
    var dt1 = document.getElementById(date1).value;
    var dt2 = document.getElementById(date2).value;
    var res = CompareDate(dt1, dt2);
    return(res);
}

function CompareDate(dt1, dt2)
{
    var ln;
    var i;
    var j;
    var dd1;
    var mm1;
    var yyyy1;

    var dd2;
    var mm2;
    var yyyy2;
    var tag;
    var date1;
    var date2;

    ln = parseInt(dt1.length);
    i = dt1.indexOf("/");
    dd1 = Number(dt1.substr(0, i));
    j = dt1.indexOf("/", (i + 1));
    mm1 = Number(dt1.substr((i + 1), (j - i - 1)));
    yyyy1 = Number(dt1.substr((j + 1), (ln - j - 1)));
    if (parseInt(yyyy1) < 100)
        yyyy1 = yyyy1 + 2000;

    dd1 = dd1 + 100;
    mm1 = mm1 + 100;

    date1 = yyyy1 + "-" + mm1 + "-" + dd1;

    ln = parseInt(dt2.length);
    i = dt2.indexOf("/");
    dd2 = Number(dt2.substr(0, i));
    j = dt2.indexOf("/", (i + 1));
    mm2 = Number(dt2.substr((i + 1), (j - i - 1)));
    yyyy2 = Number(dt2.substr((j + 1), (ln - j - 1)));
    if (parseInt(yyyy2) < 100)
        yyyy2 = yyyy2 + 2000;

    dd2 = dd2 + 100;
    mm2 = mm2 + 100;

    date2 = yyyy2 + "-" + mm2 + "-" + dd2;

    if (date1 > date2)
        return(1);
    if (date1 == date2)
        return(0);
    if (date1 < date2)
        return(-1);
}//End date Comparison


//change color on focus to Box(a)
function ChangeColor(el, i)
{
    if (i == 1) // on focus
    {
        document.getElementById(el).style.backgroundColor = '#FFCCFF';
//document.getElementById(el).style.fontWeight = 'bold';
    }
    if (i == 2) //on lostfocus
    {
        document.getElementById(el).style.backgroundColor = 'white';
//document.getElementById(el).style.fontWeight = 'normal';
        var temp = document.getElementById(el).value;
        trimBlank(temp, el);
      document.getElementById('DivError').innerHTML="";
    }
}//changeColor on Focus


function validateString(str)
{
    var j = ValidateString(str);
    return(j);
}

function validatestring(str)
{
    var j = ValidateString(str);
    return(j);
}


function ValidateString(str)
{
    var str_index = str.indexOf("'");
    var str_select = str.indexOf("select");
    var str_insert = str.indexOf("insert");
    var str_delete = str.indexOf("delete");
    var str_dash = str.indexOf("--");
    var str_vbscript = str.indexOf("vbscript");
    var str_javascript = str.indexOf("javascript");
    var str_ampersond = str.indexOf("&");
    var str_lessthan = str.indexOf("<");
    var str_greaterthan = str.indexOf(">");
    var str_semicolon = str.indexOf(";");

    if (str_index == -1 && str_select == -1 && str_insert == -1 && str_delete == -1 && str_dash == -1 && str_vbscript == -1 && str_javascript == -1 && str_ampersond == -1 && str_lessthan == -1 && str_greaterthan == -1 && str_semicolon == -1)
        return(true);
    else
        return(false);
}
function SimpleValidate(str, i)
{
    if (i == 0)
        var str_index = -1;
    else
        var str_index = str.indexOf("'");
    var str_dash = str.indexOf("--");
    var str_semicolon = str.indexOf(";");

    if (str_index == -1 && str_dash == -1 && str_semicolon == -1)
        return(true);
    else
        return(false);
}

function notNull(str)
{
    var k = 0;
    var found = false;
    var mylength = str.length;
    for (var i = 0; i < str.length; i++)
    {
        k = parseInt(str.charCodeAt(i));
        if (k != 32)
            found = true;
    }
    return(found);
}



function isNumber(ad)
{
    if (isNaN(ad) == false && notNull(ad))
        return(true);
    else
        return(false);
}



function checkName(ibox)
{
    var str = document.getElementById(ibox).value;
    var k = 0;
    var found = true;
    var mylength = str.length;
    var newstr = "";
    for (var i = 0; i < str.length; i++)
    {
        k = parseInt(str.charCodeAt(i));
//Allow Alphabet, stop and Blank
        if ((k >= 97 && k <= 122) || (k >= 65 && k <= 90) || (k == 32) || (k == 46 && i > 0))
        {
            newstr = newstr + str.substr(i, 1);
        } else
        {
            alert('Invalid Character String [' + str + ']');
            found = false;
            i = mylength + 1;
        }
    }
    return(found);
}


function trimBlank(str, a)
{

    var newstr = "";
    var prev = 0;
    for (var i = 0; i < str.length; i++)
    {
        k = parseInt(str.charCodeAt(i));
        if (k == 32 && prev == 0)
        {
            newstr = newstr;
        } else
        {
            newstr = newstr + str.substr(i, 1);
        }
        if (k == 32)
            prev = 0;
        else
            prev = 1;
    }
    document.getElementById(a).value = newstr;
}//trimBlank


function RemoveSpace(a)
{
    var newstr = "";
    var str = document.getElementById(a).value;
    for (var i = 0; i < str.length; i++)
    {
        k = parseInt(str.charCodeAt(i));
        if (k == 32)
            newstr = newstr;
        else
            newstr = newstr + str.substr(i, 1);
    } //for loop
    document.getElementById(a).value = newstr;
}//trimBlank


function nonZero(ad)
{
    if (isNumber(ad))
    {
        if (parseInt(ad) > 0)
            return(true);
        else
            return(false);
    } else
        return(false);
}


function nonNegative(ad)
{
    if (isNumber(ad))
    {
        if (parseInt(ad) >= 0)
            return(true);
        else
            return(false);
    } else
        return(false);
}



function StringValid(a, tag, mtype,obj)
{
    var ok = false;
    var b = document.getElementById(a).value;
    if (tag == 1) //donot allow null
    {
        if (mtype == 0)//Allow Single Quote
        {
            if (SimpleValidate(b, 0) && notNull(b))
                ok = true;
        }//mtype==0

        if (mtype == 1)
        {
            if (SimpleValidate(b, 1) && notNull(b))
                ok = true;
        }//mtype==1

        if (mtype == 2)
        {
            if (ValidateString(b) && notNull(b))
                ok = true;
        }//mtype==1
    }//tag==1

    if (tag == 0) //allow null
    {
        if (mtype < 2)
        {
            if (SimpleValidate(b, mtype))
                ok = true;
        }//mtype==0

        if (mtype == 2)
        {
            if (ValidateString(b))
                ok = true;
        }//mtype==1
    }//tag==0
 if(ok==false &&  arguments[3] !=null && arguments[3]!= "")
 {
        alert('Check '+obj);
     document.getElementById(a).focus();   
    }

    return(ok);
}//StringValid


function DateValid(a, tag,obj)
{
    var ok = false;
    var b = document.getElementById(a).value;
    if (tag == 1) //donot allow null
    {
        if (isdate(b, 1))
            ok = true;
    }//tag==1
    if (tag == 0) //allow null
    {
        if (isdate(b, 0))
            ok = true;
    }//tag==0
    
    if(ok==false &&  arguments[2] !=null && arguments[2]!= "")
    {
        alert('Check '+obj);
       document.getElementById(a).focus();   
    }
    return(ok);
}//DateValid

function NumericValid(a, tag, type,obj)
{
    var ok = false;
    var b = document.getElementById(a).value;
    if (isNumber(b) == true)
    {
        var c = parseInt(b);
        if (type == "Any")
            ok = true;
        if (type == "Positive" && c > 0)
            ok = true;
        if (type == "Negative" && c < 0)
            ok = true;
        if (type == "NonNegative" && c >= 0)
            ok = true;
        if (type == "Zero" && c == 0)
            ok = true;
    }//isNumber(b)==true

    if ((tag == 1 && ok == true) || (tag == 0 && notNull(b) == false))
        ok = true;
    if(ok==false &&  arguments[3] !=null && arguments[3]!= "")
    {
        alert('Check '+obj);
          document.getElementById(a).focus();
    }
    return(ok);
}//NumericValid


function SelectBoxIndex(a)
{
    var b = document.getElementById(a).selectedIndex;
    return(b);
}//SelectionValidate

function ListSelected(a,obj)
{
var ok=false;    
var i=SelectBoxIndex(a);
if(i>0)
ok=true;    
if(ok==false &&  arguments[1] !=null && arguments[1]!= "")   
alert('Select '+obj);    
return(ok);
}

function AjaxFunctionOnParentForm(URL, data, Obj, Type)
{
    var ajaxRequest;  // The variable that makes Ajax possible!
    var method = "POST";
    try
    {
// Opera 8.0+, Firefox, Safari
        ajaxRequest = new XMLHttpRequest();
    } catch (e)
    {
// Internet Explorer Browsers
        try
        {
            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e)
        {
            try {
                ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e)
            {
// Something went wrong
                alert("Your browser broke!");
                return false;
            }
        }
    }

    ajaxRequest.onreadystatechange = function () {
        if (ajaxRequest.readyState == 4) {
            var ajaxDisplay = window.opener.document.getElementById(Obj);
            if (Type == "TEXT")
            {
                var temp = ajaxRequest.responseText;
                var ind = temp.indexOf("[", 0); // Search Position index of  & as first occurence
                var ind1 = temp.indexOf("]", 0);
                var mylength = parseInt(temp.length);
                if (ind1 == -1)
                    ind1 = mylength;
                var temp = temp.substr(ind + 1, ind1 - (ind + 1));// 
                ajaxDisplay.value = temp;
            }//type==text
            if (Type == "iTEXT")
                ajaxDisplay.selectedIndex = ajaxRequest.responseText;
            if (Type == "HTML")
                ajaxDisplay.innerHTML = ajaxRequest.responseText;
            if (Type == "MSGHTML" || Type == "MSGTEXT")
            {
                var temp = ajaxRequest.responseText;
                var mylength = parseInt(temp.length);
                var ind = temp.indexOf("[", 0); // Search Position index of  & as first occurence
                var ind1 = temp.indexOf("&", 0); // Search Position index of  & as next occurence
                var msg = temp.substr(ind + 1, (ind1 - (ind + 1)));// Separate Message Part
                var tvalue = temp.substr(ind1 + 1, mylength - ind1);
                if (Type == "MSGHTML")
                    ajaxDisplay.innerHTML = tvalue;
                if (Type == "MSGTEXT")
                    ajaxDisplay.value = tvalue;
                ln = parseInt(msg.length);
                if (ln > 0)
                    alert(msg);
            }//Type=="MSGHTML" || Type="MSGTEXT"
        } //readydyState == 4)
    } //end function
    if (method == "GET")
    {
        ajaxRequest.open("GET", URL + "?" + data, true);
        ajaxRequest.send(null);
    }
    if (method == "POST")
    {
        ajaxRequest.open("POST", URL, true);
        ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajaxRequest.send(data);
    }
}//end my AJAX function    





//AJAX FUNCTION
function MyAjaxFunction(method, URL, data, Obj, Type)
{
    var ajaxRequest;  // The variable that makes Ajax possible!
    try
    {
// Opera 8.0+, Firefox, Safari
        ajaxRequest = new XMLHttpRequest();
    } catch (e)
    {
// Internet Explorer Browsers
        try
        {
            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e)
        {
            try {
                ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e)
            {
// Something went wrong
                alert("Your browser broke!");
                return false;
            }
        }
    }

    ajaxRequest.onreadystatechange = function () {
        if (ajaxRequest.readyState == 4) {
            var ajaxDisplay = document.getElementById(Obj);
            if (Type == "TEXT")
            {
                var temp = ajaxRequest.responseText;
                var ind = temp.indexOf("[", 0); // Search Position index of  & as first occurence
                var ind1 = temp.indexOf("]", 0);
                var mylength = parseInt(temp.length);
                if (ind1 == -1)
                    ind1 = mylength;
                var temp = temp.substr(ind + 1, ind1 - (ind + 1));// 
                ajaxDisplay.value = temp;
            }//type==text

            if (Type == "pTEXT")
            {
                var temp = ajaxRequest.responseText;
                var ind = temp.indexOf("[", 0); // Search Position index of  [ as first occurence
                var ind1 = temp.indexOf("]", 0);
                var mylength = parseInt(temp.length);
                if (ind1 == -1)
                    ind1 = mylength;
                var temp = temp.substr(ind + 1, ind1 - (ind + 1));// 
                //alert(temp);
                //find Index Position of Cursor
                var ind = temp.indexOf("#", 0);
                if(ind>0)
                ajaxDisplay.value = temp.substr(0, ind);//
                else
                ajaxDisplay.value = temp;
                
                mylength = parseInt(temp.length);
                ind1 = temp.substr(ind + 1, mylength - (ind + 1));//
                ajaxDisplay.setSelectionRange(ind1, ind1);
            }//pTEXT

            if (Type == "iTEXT")
                ajaxDisplay.selectedIndex = ajaxRequest.responseText;
            if (Type == "HTML")
                ajaxDisplay.innerHTML = ajaxRequest.responseText;
            if (Type == "MSGHTML" || Type == "MSGTEXT")
            {
                var temp = ajaxRequest.responseText;
                var mylength = parseInt(temp.length);
                var ind = temp.indexOf("[", 0); // Search Position index of  & as first occurence
                var ind1 = temp.indexOf("&", 0); // Search Position index of  & as next occurence
                var msg = temp.substr(ind + 1, (ind1 - (ind + 1)));// Separate Message Part
                var tvalue = temp.substr(ind1 + 1, mylength - ind1);
                if (Type == "MSGHTML")
                    ajaxDisplay.innerHTML = tvalue;
                if (Type == "MSGTEXT")
                    ajaxDisplay.value = tvalue;
                var ln = parseInt(msg.length);
                if (ln > 0)
                    alert(msg);
            }//Type=="MSGHTML" || Type="MSGTEXT"
        } //readydyState == 4)
    } //end function
    if (method == "GET")
    {
        ajaxRequest.open("GET", URL + "?" + data, true);
        ajaxRequest.send(null);
    }
    if (method == "POST")
    {
        ajaxRequest.open("POST", URL, true);
        ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajaxRequest.send(data);
    }
}//end my AJAX function

function ParseXmlString(xmlString, Tag_id, nodeIndex, inputBox_id)
{
    if (window.DOMParser)
    {
        parser = new DOMParser();
        xmlDoc = parser.parseFromString(xmlString, "text/xml");
    } else // Internet Explorer
    {
        xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
        xmlDoc.async = false;
        xmlDoc.loadXML(xmlString);
    }
    var mval = xmlDoc.getElementsByTagName(Tag_id)[nodeIndex].childNodes[0].nodeValue;
    document.getElementById(inputBox_id).value = mval;
} //end ParseXML String


function setFocus(a)
{
    document.getElementById(a).focus();
}


//JQUERY RELATED
function Push_Item_to_box(obj,JsonArray)
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


function Parse_String(Obj, bType, Str, Type)
            {
                var JsonParsed = Str;

                for (var i = 0; i < Obj.length; i++)
                {
                    var mbox = Obj[i];
                    var myobj = document.getElementById(mbox);
                    if (arguments[3] == null || arguments[3] == "")
                    {
                        var mvalue = JsonParsed[mbox];
                        var msg = JsonParsed['AlertMessage'];
                    } else
                    {
                        var mvalue = JsonParsed[0][mbox];
                        var msg = JsonParsed[0]['AlertMessage'];
                    }
                    if (bType[i] == 0 || bType[i]==null)
                        myobj.value = mvalue;

                    if (bType[i] == 1)
                        myobj.selectedIndex = mvalue;

                    if (bType[i] == 2)
                    {
                        if (mvalue == "1" || mvalue == "t" || mvalue == "Y")
                            myobj.checked = true;
                        else
                            myobj.checked = false;
                    }

                    if (bType[i] == 3)
                        myobj.innerHTML = mvalue;

                    if (bType[i] == 4) //enable/disable
                    {
                        if (mvalue == "1")
                            myobj.disabled = false;
                        else
                            myobj.disabled = true;
                    }

                    if (bType[i] == 40) //enable/disable with value assign
                    {
                        var mylength = parseInt(mvalue.length) - 2;
                        //alert(mylength);
                        if (mvalue.substr(0, 1) == "1")
                            myobj.disabled = false;
                        else
                            myobj.disabled = true;

                        myobj.value = mvalue.substr(2, mylength);
                    }

                    if (bType[i] == 42) //enable/disable with check uncheck
                    {
                        var mylength = parseInt(mvalue.length) - 2;
                        //alert(mylength);
                        if (mvalue.substr(0, 1) == "1")
                            myobj.disabled = false;
                        else
                            myobj.disabled = true;

                        var ch = mvalue.substr(2, mylength);
                        if (ch == "1" || ch == "Y" || ch == "t")
                            myobj.checked = true;
                        else
                            myobj.checked = false;
                    }
                }

                if (msg != "")
                    alert(msg);

            }//end ParseString



function Manage_Ajax_String(Str, Obj, Type)
{
            var ajaxDisplay = document.getElementById(Obj);
            if (Type == "TEXT")
            {
                var temp = Str;
                var ind = temp.indexOf("[", 0); // Search Position index of  & as first occurence
                var ind1 = temp.indexOf("]", 0);
                var mylength = parseInt(temp.length);
                if (ind1 == -1)
                    ind1 = mylength;
                var temp = temp.substr(ind + 1, ind1 - (ind + 1));// 
                ajaxDisplay.value = temp;
            }//type==text

            if (Type == "pTEXT")
            {
                var temp = Str;
                var ind = temp.indexOf("[", 0); // Search Position index of  [ as first occurence
                var ind1 = temp.indexOf("]", 0);
                var mylength = parseInt(temp.length);
                if (ind1 == -1)
                    ind1 = mylength;
                var temp = temp.substr(ind + 1, ind1 - (ind + 1));// 
                //alert(temp);
                //find Index Position of Cursor
                var ind = temp.indexOf("#", 0);
                if(ind>0)
                ajaxDisplay.value = temp.substr(0, ind);//
                else
                ajaxDisplay.value = temp;
                
                mylength = parseInt(temp.length);
                ind1 = temp.substr(ind + 1, mylength - (ind + 1));//
                ajaxDisplay.setSelectionRange(ind1, ind1);
            }//pTEXT

            if (Type == "iTEXT")
                ajaxDisplay.selectedIndex = Str;
            if (Type == "HTML")
                ajaxDisplay.innerHTML =Str;
            
            if (Type == "MSGHTML" || Type == "MSGTEXT")
            {
                var temp = Str;
                var mylength = parseInt(temp.length);
                var ind = temp.indexOf("[", 0); // Search Position index of  & as first occurence
                var ind1 = temp.indexOf("&", 0); // Search Position index of  & as next occurence
                var msg = temp.substr(ind + 1, (ind1 - (ind + 1)));// Separate Message Part
                var tvalue = temp.substr(ind1 + 1, mylength - ind1);
                if (Type == "MSGHTML")
                    ajaxDisplay.innerHTML = tvalue;
                if (Type == "MSGTEXT")
                    ajaxDisplay.value = tvalue;
                var ln = parseInt(msg.length);
                if (ln > 0)
                    alert(msg);
            }//Type=="MSGHTML" || Type="MSGTEXT"
    
}//end my AJAX function

