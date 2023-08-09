<?php@ Language=VBScript ?>
<?php Response.buffer = true ?>
<!-- #Include file="connection.asp"-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Nalbari- District</title>

	<script language="JavaScript" type="text/javascript"> 
//--------------- LOCALIZEABLE GLOBALS ---------------
var d=new Date();
var monthname=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
//Ensure correct for language. English is "January 1, 2004"
var TODAY = monthname[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
//---------------   END LOCALIZEABLE   ---------------
</script>

    
</head>
<body>
  <div align="center">

<img src="notice.jpg" alt="" width="580" height="85"  /></p>
    
    </div>
        
         
       
	  

<?php
dim rs
dim i
dim tag
dim bcol
session.lcid=2057
i=1


tag=1

set rs=cn.execute("select link_description,link_file,isnew from notice where active='Y' order by slno desc")
?>


<table align=center border=0 cellpadding=2 cellspacing=0 style=border-collapse: collapse; width=90?>
<form name=myform method=POST >

<tr>
<td  align=LEFT COLSPAN=2 ><A HREF="../menu.asp" style='text-decoration: none'>HOME</a></td>
</tr>
<?php 

if tag=1 then
bcol="#CCFFCC"
tag=2
else
bcol="#FFFFCC"
tag=1
end if
?>
<tr>
<td  align=Center height=30 bgcolor=<?php=bcol?>><font face=arial size=3 color=black><?php=i?></font></td>
<td  align=left bgcolor=<?php=bcol?>><a href=<?php=rs.fields(1)?> style='text-decoration: none' target=_blank><font face=arial size=3 color=black><?php=rs.fields(0)?></font></a>
<?phpif rs.fields(2)="Y" then ?>
<img border="0" src="new.gif" width="20" height="13">
<?phpend if?>
</td>
</tr>
<?php
i=i+1
rs.movenext
wend
rs.close
set cn=nothing
?>
</table>
 
         
          <p align="right">  </p>
   
    
    <div class="clear"></div>
    <div id="spacer"> </div>

<div id="copyright" align=center> The website has been designed and hosted  by National Informatics Centre <br />
Content of the website is provided and  updated by District Administration, Nalbari (Assam).

 <br>
<br>

      </div>

    <div id="footer">
      
	  <div id="footerline"></div>
    </div>
	
  </div>
</body>
</html>
