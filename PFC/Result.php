<html>
    <head>
        <title>Entry Form for sex</title>
    </head>
    <script language=javascript>
        <!--
    function direct()
        {
            var i;
            i = 0;
        }

        function direct1()
        {
            var i;
            i = 0;
        }
        function setMe()
        {
            myform.Code.focus();
        }

        function redirect(i)
        {
        }


        function back()
        {
            var cnf = confirm('Did you Printed Acknowledgement ?');
            if (cnf == true)
                window.location = "Pet_Entry.php?tag=0";
        }

        function home()
        {
            window.location = "Mainmenu.php?tag=1";
        }


        function ack()
        {
            window.open('AcknowledgementBK.php', '_blank');
        }

        //END JAVA
    </script>
    <body>
        <?php
//Start FORMBODY
        session_start();
        require_once 'header.php';
        if (!isset($_SESSION['Applicant']))
            $_SESSION['Applicant'] = "Applicant";

        if (isset($_SESSION['Recpno1']) || isset($_SESSION['Recpno2'])) {
            if (strlen($_SESSION['Recpno1']) < 1 && strlen($_SESSION['Recpno2']) < 1)
                header('Location: Pet_Entry.php?tag=0');
        } else
            header('Location: Pet_Entry.php?tag=0');


//Start of FormDesign
        ?>
        <table border=1 cellpadding=4 cellspacing=0 align=center style=border-collapse: collapse; width=80%>
               <form name=myform action=""  method=POST >
                <tr><td colspan=3 align=Center bgcolor=#ccffcc><font color="#9900FF" size="4">&nbsp;&nbsp;
                        Petition of Shri <b><?php echo $_SESSION['Applicant']; ?></b>

                        &nbsp;for <b><?php echo $_SESSION['certtype']; ?></b> is Registered Successfully</font></td></tr>
<?php $i = 0; ?>

                <?php
                if (strlen($_SESSION['Recpno2']) > 1) {
                    ?>
                    <tr>
                        <td align=right bgcolor=#FFFFCC><font color=blue size=3 face=arial>ARTPS No</font></td>
                        <td align=left bgcolor=#FFFFCC>
                            <font color=blue size=3 face=arial><b><?php echo $_SESSION['Recpno2']; ?></b></font>
                        </td>
                        <td align=left bgcolor=#FFFFCC>
                            <font color=black size=2 face=arial>    
                            <a href="Ack.php?id=<?php echo $_SESSION['Recpno2']; ?>" target="_blank">View Acknowledgement</a>    
                        </td>
                    </tr>
    <?php
} else {
    ?>
                    <tr>
                        <td align=right bgcolor=#FFFFCC><font color=blue size=3 face=arial>Petition No</font></td>
                        <td align=left bgcolor=#FFFFCC colspan="2">
                            <font color=blue size=3 face=arial><b><?php echo $_SESSION['Recpno1']; ?></b></font>
                        </td>
                    </tr>

    <?php
}
$_SESSION['Recpno1'] = "";
$_SESSION['Recpno2'] = "";
$_SESSION['Applicant'] = "";
?>
                <tr>
                    <td align=right bgcolor=#FFFFCC >
                        <input type=button value="Another Petition"  name=back1 onclick=back()  style="font-family:arial;font-weight:bold; font-size: 14px ; background-color:#FF9966;color:black;width:180px">
                    </td>
                    <td colspan="2" bgcolor=#FFFFCC align="left">
                        <input type=button value="Acknowledgement "  name=back1 onclick=ack()  style="font-family:arial;font-weight:bold; font-size: 14px ; background-color:red;color:black;width:180px">
                    </td></tr>
        </table>
    </form>
</body>
</html>
