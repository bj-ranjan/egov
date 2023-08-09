<?php

class Sentence {

    public function _construct($i) { //for PHP6
        
    }

    private function inStr($str, $find) {
        $temp = strlen($find);
        $mindex = 0;
        $found = -1;
        $lnth = strlen($str) - $temp;

        while (($mindex <= $lnth) && ($found == -1)) {
            if (substr($str, $mindex, $temp) == $find) {
                $found = $mindex;
            }
            $mindex++;
        } //end while
        return($found);
    }

//end function

    Public Function SentenceCase($t) {

        $t = $t . " ";

        $newtxt = "";
        $myrow = array();

        $myrow = explode(" ", $t);

        for ($i = 0; $i < count($myrow); $i++) {
            $newr = $this->Gcase($myrow[$i]);
//echo $i.".".$myrow[$i]." ".$newr."<br>";
            $newtxt = $newtxt . $newr . " ";
        }
        $newtxt = str_replace(" Of ", " of ", $newtxt);
        
        $newtxt=trim($newtxt);
        return($newtxt);
    }

//end SentenceCase

    private function Gcase($txt) {

        $j = strlen($txt);
        $k = "";
        for ($i = 0; $i < $j; $i++) {
            $mord = substr($txt, $i, 1);
            if ($i == 0) {
                if (ord($mord) > 96 && ord($mord) < 123)
                    $k = $k . chr(ord($mord) - 32);
                else
                    $k = $k . $mord;
            }
            else { //ok
                if (ord($mord) > 64 && ord($mord) < 91) {
                    if (substr($txt, $i - 1, 1) == ".") {
                        if (is_numeric($mord))
                            $prev = $mord;
                        else
                            $prev = $mord;
                    }
                    else {
                        if (ord($mord) > 64 && ord($mord) < 91)
                            $prev = chr(ord($mord) + 32);
                        else
                            $prev = $mord;
                    }
                    $k = $k . $prev;
                }
                else {
                    if (substr($txt, $i - 1, 1) == ".") {
                        if (is_numeric($mord))
                            $prev = $mord;
                        else {
                            if (ord($mord) > 96 && ord($mord) < 123)
                                $prev = chr(ord($mord) - 32);
                            else
                                $prev = $mord;
                        }
                    } else
                        $prev = $mord;
                    $k = $k . $prev;
                } //ok
            } //ok
        } //for loop
        return($k);
    }

    public function Encrypt($a) {
//St$art ch$ar$acter 33 to 255
        $j = strlen($a);
        $i = 0;
        $k = "";
        $ii = 1;
        while ($i < $j) {
            if (ord(substr($a, $i, 1)) > 31 && ord(substr($a, $i, 1)) < 124) { // 31 to 131 is Keyboard Character
                if ((ord(substr($a, $i, 1)) + $ii) < 124) { // {
                    //if ((ord(substr($a, $i, 1)) + $ii) == 39) // Single Quote    
                    //$k = $k . substr($a, $i, 1);
                    //else
                    $k = $k . chr(ord(substr($a, $i, 1)) + $ii);
                } else
                    $k = $k . substr($a, $i, 1);
            } else
                $k = $k . substr($a, $i, 1);
            $i = $i + 1;
            $ii++;
//echo $k."<br>";
        }
        $k = str_replace("'", "[}", $k);
        $k = str_replace(";", "%a", $k);
        $k = str_replace("-", "b:", $k);
        $retval = chr(61 + $j) . $k . chr(100 + $j); //First Level Encryption
        $retval = $this->Lencrypt($retval);  //Second Level Encryption
        return($retval);
    }

    private function Lencrypt($t) {
        $mvar = array();
        $mvar[0] = "$";
        $mvar[1] = "a";
        $mvar[2] = "#";
        $mvar[3] = "s";
        $mvar[4] = "a";
        $mvar[5] = "x";
        $mvar[6] = "b";
        $mvar[7] = "a";
        $mvar[8] = "b";
        $mvar[9] = "s";

        $temp = "";
        for ($i = 0; $i < strlen($t); $i++) {
            $a = ord(substr($t, $i, 1));
            $temp.=$a;
        }//for

        $tmp = "";
        for ($i = 0; $i < strlen($temp); $i++) {
            $a = substr($temp, $i, 1);
            if (isset($mvar[$a]))
                $tmp.=$mvar[$a];
            else
                $tmp.="#";
        }//for

        $mlen = strlen($tmp);
        if ($mlen > 45)
            $tmp = substr($tmp, 0, 45);  //Take only 45 character if more
        if ($mlen < 45) {
            for ($i = 0; $i < (45 - $mlen); $i++) //append 'a' if less than 45
                $tmp.="a";
        }
        return($tmp);
    }

    public function focus($a) {
        $temp = "<Script language=javascript>\n";
        $temp = $temp . "myform." . $a . ".focus();\n";
        $temp = $temp . "</script>";
        return($temp);
    }

    public function SimpleEncrypt($ColData, $type = 'C') {
        if ($type == "C")
            return($this->EncryptText($ColData));
        else
            return($this->EncryptNumber($ColData));
    }

    public function SimpleDecrypt($ColData, $type = 'C') {
        if ($type == "C")
            return($this->DecryptText($ColData));
        else
            return($this->DecryptNumber($ColData));
    }

    private function EncryptText($a) {
//St$art ch$ar$acter 33 to 255
        $j = strlen($a);
        $i = 0;
        $sub = "";
        $ii = 1;
        $ordarr = array(33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 58, 59, 60, 61, 62, 63, 64, 91, 92, 93, 94, 95, 96, 123, 124, 125, 126, 127);
        while ($i < $j) {
            $num = rand(66, 80);
            $rnd = chr($num);

            if (ord(substr($a, $i, 1)) > 31 && ord(substr($a, $i, 1)) < 126) { // 31 to 131 is Keyboard Character
                $ord = ord(substr($a, $i, 1));
                if (($ord + $ii) < 126 && in_array(($ord + $ii), $ordarr) === false) {
                    $sub = $sub . $rnd . chr(ord(substr($a, $i, 1)) + $ii);
                } else
                    $sub = $sub . "A" . substr($a, $i, 1);
            } else
                $sub = $sub . "A" . substr($a, $i, 1);
            $i = $i + 1;
            $ii++;
//echo $k."<br>";
        }
        if(strlen($sub)>0)
        $sub = "C#" . $sub;
        return($sub);
    }

    public function EncryptNumber($a) {
//St$art ch$ar$acter 33 to 255

        $j = strlen($a);
        $i = 0;
        $sub = "";
        $ii = 1;
        while ($i < $j) {
            //$rnd = rand(2, 9);
            $rnd=9;
            if (ord(substr($a, $i, 1)) > 47 && ord(substr($a, $i, 1)) < 58) { // 0-9
                if ((ord(substr($a, $i, 1)) + $ii) < 58) { // {
                    $sub = $sub . $rnd . chr(ord(substr($a, $i, 1)) + $ii);
                } else
                    $sub = $sub . "1" . substr($a, $i, 1);
            } else
                $sub = $sub . "1" . substr($a, $i, 1);
            $i = $i + 1;
            $ii++;
//echo $k."<br>";
        }
        $sub = $this->PreFix($sub);
         return($sub);
    }

    private function PreFix($str)
    {
    return("961".$str."169");    
     }
    
    private function PreFix1($str)
    {
        $temp="";
        $num=array(2,5,9);
        $used=array('N','N','N');
       
        for($i=0;$i<=2;$i++)
        {
         $a=rand(0,2);   
        if($used[$a]=="N")
        {
        $temp.=$num[$a];
        $used[$a]='Y' ;       
        }
        else
        {
        $temp.=$num[$i];    
        $used[$i]='Y' ; 
        }
        }
        $reverse=$temp[2].$temp[1].$temp[0];
        if(strlen($str)>0)
        $str=$temp.$str.$reverse;
        return($str);
    }
    
    private function DecryptNumber($a) {
//St$art ch$ar$acter 33 to 255
        $a=trim($a);
        
        //echo $a." length ".strlen($a)."<BR>";
        //echo "<br>Origin:".$a."= Next";
        //echo "strlen".strlen($a)."  ";
        $a = substr($a, 3, strlen($a) - 6);
        //echo $a." ";
        $j = strlen($a);
        $i = 0;
        $sub = "";
        $ii = 1;
        $pos = 0;
        while ($pos < $j) {
            $tag = substr($a, $pos, 1);
            $ch = substr($a, $pos + 1, 1);
            if ($tag != "1") {
                $ch = chr(ord($ch) - $ii);
            }
            $sub.=$ch;
            $ii++;
            $pos = $pos + 2;
        }
        //echo "Final ".$sub."<br>";
        return($sub);
    }

    private function DecryptText($a) {
        $a = substr($a, 2, strlen($a) - 2);
        $j = strlen($a);
        $i = 0;
        $sub = "";
        $ii = 1;
        $pos = 0;
        while ($pos < $j) {
            $tag = substr($a, $pos, 1);
            $ch = substr($a, $pos + 1, 1);
            if ($tag != "A") {
                $ch = chr(ord($ch) - $ii);
            }
            if ($ch == "!")   //replace ! as Single Quote
                $ch = "'";
            $sub.=$ch;
            $ii++;
            $pos = $pos + 2;
        }
        return($sub);
    }

}

//End Class
?>
