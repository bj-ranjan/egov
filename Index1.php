<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>e-Governance System, Developed by NIC, Nalbari</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
 
<frameset rows="85%,15%" frameborder="NO" border="1" framespacing="0">
  <frame src="IndexPage.php" name="mainFrame">
  <frameset cols="80%,20%" frameborder="No" border="1" framespacing="0">
  <frameset cols="30%,70%" frameborder="No" border="1" framespacing="0">
   <frame src="left.php" name="leftbottomFrame" scrolling="No" >
  <frame src="footer.php" name="bottomFrame" scrolling="NO" noresize>
 </frameset>
 <frame src="right.php" name="rightbottomFrame" scrolling="yes" >
</frameset>
</frameset>
<noframes>
<body>
<?php
 session_start();
 $_SESSION['error']=true;
 $_SESSION['firstlogin']="Y";
 $_SESSION['district']="Nalbari";
 ?>    
</body></noframes>
</html>
