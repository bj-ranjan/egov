<?php
class iss {

    private $unival = array();
    private $ival = array();
    private $EngChar=array();
    private $Vowel=array();
     private $mVowel=array();
    public $Message="";
    public function iss() {
//header("Content-Type: text/html; charset=utf-8");
//header("Content-Type: text/html; charset=x-iscii-as");
//
$this->mVowel["অ"]="A" ; //8
$this->mVowel["আ"]="AA" ; //10
$this->mVowel["ই"]="I" ; //12
$this->mVowel["ঈ"]="EE" ; //36
$this->mVowel["উ"]="U" ; //14
$this->mVowel["ঊ"]="UU" ; //40
$this->mVowel["ঋ"]="RI";  
$this->mVowel["এ"]="E" ; //38
$this->mVowel["ঐ"]="OI" ; //46
$this->mVowel["ও"]="O" ; //2 
$this->mVowel["ঔ"]="OU" ; //34       


//echo "class instantiated<br>";
$this->Vowel["ো"]="O" ; //1
$this->Vowel["ও"]="O" ; //2 
$this->Vowel["অ"]="A" ; //8
$this->Vowel["া"]="A" ; //9
$this->Vowel["আ"]="A" ; //10
$this->Vowel["ি"]="I" ; //11
$this->Vowel["ই"]="I" ; //12
$this->Vowel["ু"]="U" ; //13
$this->Vowel["উ"]="U" ; //14
$this->Vowel["ৌ"]="OU" ; //33
$this->Vowel["ঔ"]="OU" ; //34
$this->Vowel["ী"]="I" ; //35
$this->Vowel["ঈ"]="I" ; //36
$this->Vowel["ে"]="E" ; //37
$this->Vowel["এ"]="E" ; //38
$this->Vowel["ূ"]="RI" ; //39
$this->Vowel["ঊ"]="U" ; //40
$this->Vowel["ৈ"]="OI" ; //45
$this->Vowel["ঐ"]="OI" ; //46
$this->Vowel["ং"]="ANG" ; //47
$this->Vowel["১"]="1" ; //53
$this->Vowel["২"]="2" ; //54
$this->Vowel["৩"]="3" ; //55
$this->Vowel["৪"]="4" ; //56
$this->Vowel["৫"]="5" ; //57
$this->Vowel["৬"]="6" ; //58
$this->Vowel["৭"]="7" ; //59
$this->Vowel["৮"]="8" ; //60
$this->Vowel["৯"]="9" ; //61
$this->Vowel["০"]="0" ; //62
$this->Vowel["্"]="";       //Link Character     
$this->Vowel["ৃ"]="RI";  
$this->Vowel["ঋ"]="RI";  
        
//$this->EngChar[" ়"]       =""; 
$this->EngChar["ো"]="O" ; //1
$this->EngChar["ও"]="O" ; //2 
$this->EngChar["ৱ"]="W" ; // wabba
$this->EngChar["ৰ"]="R" ; //4
$this->EngChar["ম"]="M" ; //5
$this->EngChar["ণ"]="N" ; //6
//$this->EngChar["্"]="U" ; //7
$this->EngChar["অ"]="A" ; //8
$this->EngChar["া"]="A" ; //9
$this->EngChar["আ"]="A" ; //10
$this->EngChar["ি"]="I" ; //11
$this->EngChar["ই"]="I" ; //12
$this->EngChar["ু"]="U" ; //13
$this->EngChar["উ"]="U" ; //14
$this->EngChar["প"]="P" ; //15
$this->EngChar["ফ"]="PH" ; //16
$this->EngChar["গ"]="G" ; //17
$this->EngChar["ঘ"]="GH" ; //18
$this->EngChar["ৰ"]="R" ; //19
$this->EngChar["চ"] ="CH"   ; 
$this->EngChar["র"]="R" ;
$this->EngChar["ক"]="K" ; //21
$this->EngChar["খ"]="KH" ; //22
$this->EngChar["ত"]="T" ; //23
//
$this->EngChar["ৎ"]="T" ; //khandata
$this->EngChar["থ"]="TH" ; //24
$this->EngChar["ঠ"]="TH" ;//madhuna tha
$this->EngChar["স"]="S" ; //25
$this->EngChar["ছ"]="CH"; //dutiya sa
$this->EngChar["শ"]="SH" ; //26
$this->EngChar["ল"]="L" ; //27
$this->EngChar["্"]=""; 
$this->EngChar["দ"]="D" ; //29
$this->EngChar["ধ"]="DH" ; //30
$this->EngChar["ঢ"]="DH" ; //30 madhuna dha
$this->EngChar["জ"]="J" ; //31
$this->EngChar["ঝ"]="JH" ; //31
$this->EngChar["ৌ"]="OU" ; //33
$this->EngChar["ঔ"]="OU" ; //34
$this->EngChar["ী"]="I" ; //35
$this->EngChar["ঈ"]="I" ; //36
$this->EngChar["ে"]="E" ; //37
$this->EngChar["এ"]="E" ; //38
$this->EngChar["ূ"]="U" ; //39
$this->EngChar["ৃ"]="RI";
$this->EngChar["ঊ"]="U" ; //40
$this->EngChar["হ"]="H" ; //41
$this->EngChar["ঙ"]="NG" ; //42
$this->EngChar["ন"]="N" ; //43
$this->EngChar["্ৰ"]="R" ; //44
$this->EngChar["ৈ"]="OI" ; //45
$this->EngChar["ঐ"]="OI" ; //46
$this->EngChar["ং"]="ANG" ; //47
$this->EngChar["ঁ"]="N" ; //48
$this->EngChar["ব"]="B" ; //49
$this->EngChar["ভ"]="BH" ; //50
$this->EngChar["ট"]="T" ; //51
$this->EngChar["য়"]="Y";  //Iya
$this->EngChar["ড"]="D";
$this->EngChar["ঞ"]="YA";
$this->EngChar["ষ"]="SH"; //Madhuna SA
$this->EngChar["ঋ"]="RI"; //RIKAR
$this->EngChar["১"]="1" ; //53
$this->EngChar["২"]="2" ; //54
$this->EngChar["৩"]="3" ; //55
$this->EngChar["৪"]="4" ; //56
$this->EngChar["৫"]="5" ; //57
$this->EngChar["৬"]="6" ; //58
$this->EngChar["৭"]="7" ; //59
$this->EngChar["৮"]="8" ; //60
$this->EngChar["৯"]="9" ; //61
$this->EngChar["০"]="0" ; //62
$this->EngChar["জ্ঞ"]="JNA" ; //jna
$this->EngChar["ত্র"]="TRA" ; // tra
$this->EngChar["ক্ষ"]="KSH" ; // khya
$this->EngChar["শ্র"]="SHR" ; // shri
$this->EngChar["য"] ="Y"  ;     
        
        
        $this->unival[48] = "০";
        $this->unival[49] = "১";
        $this->unival[50] = "২";
        $this->unival[51] = "৩";
        $this->unival[52] = "৪";
        $this->unival[53] = "৫";
        $this->unival[54] = "৬";
        $this->unival[55] = "৭";
        $this->unival[56] = "৮";
        $this->unival[57] = "৯";

//Alphabet
        $this->unival[160] = "";//CHANDRA BINDU
        $this->unival[161] = "ঁ"; //CHANDRA BINDU
        $this->unival[162] = "ং"; //UNASWAR
        $this->unival[163] = "ঃ";
        $this->unival[164] = "অ";
        $this->unival[165] = "আ";
        $this->unival[166] = "ই";
        $this->unival[167] = "ঈ";
        $this->unival[168] = "উ";
        $this->unival[169] = "ঊ";
        $this->unival[170] = "ঋ";
        $this->unival[172] = "এ";
        $this->unival[173] = "ঐ";
        $this->unival[176] = "ও";
        $this->unival[177] = "ঔ";

        $this->unival[179] = "ক";
        $this->unival[180] = "খ";
        $this->unival[181] = "গ";
        $this->unival[182] = "ঘ";
        $this->unival[183] = "ঙ";
        $this->unival[184] = "চ";
        $this->unival[185] = "ছ";
        $this->unival[186] = "জ";
        $this->unival[187] = "ঝ";
        $this->unival[188] = "ঞ";
        $this->unival[189] = "ট";
        $this->unival[190] = "ঠ";
        $this->unival[191] = "ড";
        $this->unival[192] = "ঢ";
        $this->unival[193] = "ণ";
        $this->unival[194] = "ত";
        $this->unival[195] = "থ";
        $this->unival[196] = "দ";
        $this->unival[197] = "ধ";
        $this->unival[198] = "ন";

        $this->unival[200] = "প";
        $this->unival[201] = "ফ";
        $this->unival[202] = "ব";
        $this->unival[203] = "ভ";
        $this->unival[204] = "ম";
        $this->unival[205] = "য়";
        $this->unival[206] = "য";
        $this->unival[207] = "ৰ";

        $this->unival[209] = "ল";
        $this->unival[212] = "ৱ";
        $this->unival[213] = "শ";
        $this->unival[214] = "ষ";
        $this->unival[215] = "স";
        $this->unival[216] = "হ";

        $this->unival[218] = "া";
        $this->unival[219] = "ি";
        $this->unival[220] = "ী";
        $this->unival[221] = "ু";
        $this->unival[222] = "ূ";
        $this->unival[223] = "ৃ";
        $this->unival[225] = "ে";
        $this->unival[226] = "ৈ";
        $this->unival[229] = "ো";
        $this->unival[230] = "ৌ";
        $this->unival[232] = "্"; //LINK
        $this->unival[233] = "়"; //DARERA STOP

        $this->unival[124] = "।"; //Dari


        $this->ival["ঁ"] = "¡";
        $this->ival["ং"] = "¢";
        $this->ival["অ"] = "¤";
        $this->ival["আ"] = "¥";
        $this->ival["ই"] = "¦";
        $this->ival["ঈ"] = "§";
        $this->ival["উ"] = "¨";
        $this->ival["ঊ"] = "©";
        $this->ival["ঋ"] = "ª";
        $this->ival["এ"] = "¬";
        $this->ival["ঐ"] = "­";
        $this->ival["ও"] = "°";
        $this->ival["ঔ"] = "±";
        $this->ival["ক"] = "³";
        $this->ival["খ"] = "´";
        $this->ival["গ"] = "µ";
        $this->ival["ঘ"] = "¶";
        $this->ival["ঙ"] = "·";
        $this->ival["চ"] = "¸";
        $this->ival["ছ"] = "¹";
        $this->ival["জ"] = "º";
        $this->ival["ঝ"] = "»";
        $this->ival["ঞ"] = "¼";
        $this->ival["ট"] = "½";
        $this->ival["ঠ"] = "¾";
        $this->ival["ড"] = "¿";
        $this->ival["ঢ"] = "À";
        $this->ival["ণ"] = "Á";
        $this->ival["ত"] = "Â";
        $this->ival["থ"] = "Ã";
        $this->ival["দ"] = "Ä";
        $this->ival["ধ"] = "Å";
        $this->ival["ন"] = "Æ";
        $this->ival["প"] = "È";
        $this->ival["ফ"] = "É";
        $this->ival["ব"] = "Ê";
        $this->ival["ভ"] = "Ë";
        $this->ival["ম"] = "Ì";
        $this->ival["য়"] = "Í ";
        $this->ival["য"] = "Î";
        $this->ival["ৰ"] = "Ï";
        $this->ival["ল"] = "Ñ";
        $this->ival["ৱ"] = "Ô";
        $this->ival["শ"] = "Õ";
        $this->ival["ষ"] = "Ö";
        $this->ival["স"] = "×";
        $this->ival["হ"] = "Ø";
        $this->ival["া"] = "Ú";
        $this->ival["ি"] = "Û";
        $this->ival["ী"] = "Ü";
        $this->ival["ু"] = "Ý";
        $this->ival["ূ"] = "Þ";
        $this->ival["ৃ"] = "ß";
        $this->ival["ে"] = "á";
        $this->ival["ৈ"] = "â";
        $this->ival["ো"] = "å";
        $this->ival["ৌ"] = "æ";
        $this->ival["্"] = "è";
        $this->ival["়"] = "é";
        $this->ival["ঃ"] = "£";
    }

//end constructor

    public function uni($str) {
//header("Content-Type: text/html; charset=x-iscii-as");
//$off=2;
        $off = 1;
        $val = "";
//Numeric
        //$str=str_replace("¡","×èÊ£",$str);
        //echo $str;
        $marr = $this->unival;
        //echo $str." changed as <br>";
        $srow = explode(" ", $str);
        for ($ind = 0; $ind < count($srow); $ind++) {
            $i = 0;
            $str = $srow[$ind];
            while ($i < strlen($str)) {
                $dd = trim(substr($str, $i, $off));
//$oval=$this->uniord($dd);
                $oval = ord($dd);
//echo $oval.".";
//echo $dd." as-";
                if (isset($marr[$oval])) {
                    $val.=$marr[$oval];
                    //echo "found ".$dd."=".$marr[$oval]."<br>";
                }
                else
                {
                 if($this->isIscii($dd)==false)
                 {
                    $val.=$dd;
                  //echo "Nofound ".$dd."<br>";
                  }
                  }
                $i = $i + $off;
//echo $val."<br>";
            }//while loop
            $val.=" ";
        }//for loop
        return($val);
    }

//end uniconverter
    
 public function UniToEnglish($string)   
 {
 $str="";
 $srow=explode(" ",$string)    ;
 for($i=0;$i<count($srow);$i++)
 {
 $str.=$this->Eng($srow[$i])." ";    
 }
 $str=trim($str);
 return($str);
 }
    
 
 private function Eng($str) {
    $val = "";
    $str=trim($str);
    $dd="";
    $prev="ঐ";
    $prev1="ঐ";

           $i=0;
           $counter=0;
          // echo $str."<br>";
            while ($i < strlen($str)) {
                
                $incr = 3;
                $dd = trim(substr($str, $i, 3));
//echo "dd ".$dd." ";
                if ($this->isUnicode($dd) == false) {
                    $incr = 1;
                    $dd = trim(substr($str, $i, 1));
                    //echo " Not Unicode ";
                }
//else
    //echo " Unicode ";
                
                $ichar = "";
                
                 //echo "preveous:".$prev."<br>";;
                 if (isset($this->EngChar[$dd])) {
                    $counter++;
                    $ichar =$this->EngChar[$dd]; 
                   
                    //if($dd=="ৈ")
                    //echo  $dd."=Counter".$counter."<bR>";
                    if($dd=="ৈ" && $counter<=4) //Aikar
                    $ichar ="AI";  //Instead of OI    
                    
                   // echo $ichar." ".$prev." ".isset($this->Vowel[$prev])."<br>";
                    
                    if($ichar=="ANG" && isset($this->Vowel[$prev])==true)  //Unaswar should not be after vowel
                    $ichar="NG";
                    //echo $ichar."<br>";
                    
                    if($ichar=="ANG" && $prev=="ন")  //1 No, 2 No etc instead of 1NANG, 2 nang
                    $ichar="O. ";                    
                               
                    //echo $ichar." ".ord($ichar)."=".$val."<br>";
                    
                    //echo  "Eng char-".$ichar."<br>";
                    if(isset($this->Vowel[$prev])==false && $this->isUnicode($prev))
                    {
                     //echo  $prev." not vowel "."<br>";
                     if(isset($this->Vowel[$dd])==false ||  isset($this->mVowel[$dd])==true)  //Akar Ikar but not A AA 
                     {
                     //echo  "counter ".$counter."<br>";
                     if($counter>1){
                      //echo  $incr." is 3 "."<br>";     
                     $ichar="A".$ichar;
                     }
                     }
                    }
                    $val.=$ichar;
                
                    //echo  "Eng char after ".$ichar."<br>";
                   //echo "Total ". $val."<br>";
                }
                else
                {
                    $val.=$dd;
                    ///echo "<br>Else ".$dd."=".$val."<br>";
                    
                }
                //Handle Situation  like Pankaj mriganka
                
                if($prev1=="ঙ")  //unga
                {
                //echo "Entered " .strlen($val)."<br>"  ;
                //echo "prev ".$prev1. "  prev1 ".$prev."  ".$dd."<br>";
                if($prev=="্") {
                if($dd=="গ")   // $dd=="ক")     //next is Ga 
                {
                $val=substr($val,0,strlen($val)-2)."G" ;
                //echo (strlen($val)-1)." ".$val;
                }
                
                if($dd=="ক")   // $dd=="ক")     //next is r Ka
                {
                //echo "Normal val ".$val."<br>";    
                $val=substr($val,0,strlen($val)-2)."K" ;
                //echo "substrl val ".$val."<br>";    
                 }
                }
                } //unga
                
                if($prev=="ং")  //unaswar   ANG should be replace as AN if followed by Ka or Ga
                {
                if($dd=="গ")        //next is Ga 
                $val=substr($val,0,strlen($val)-2)."G" ;    
                if($dd=="ক")        //next is Ga 
                $val=substr($val,0,strlen($val)-2)."K" ; 
                } //end //unaswar
                
                
                if($prev1=="স" || $prev1=="শ")  //sh or s
                {
                if($prev=="্") {   
                if($dd=="ব")     //bA
                $val=substr($val,0,strlen($val)-1)."W" ;    
                }
                }
                
                //taluba sa
                if($prev1=="শ")
                {
                if($prev=="্") {   
                if($dd=="চ")     //bA
                $val=substr($val,0,strlen($val)-3)."CH" ;    
                }    
                }
                
                //Daibindura and dhaibindura
                //
                if($dd=="়")   
                {
                 if($prev=="ড")
                 $val=substr($val,0,strlen($val)-4)."R" ;     
                 if($prev=="ঢ")
                 $val=substr($val,0,strlen($val)-5)."R" ;     
                }
                
                //Aikar
                   //Niya J and Niya Cha
                if($prev1=="ঞ")  //Niya
                {
                //echo "Entered " .strlen($val)."<br>"  ;
                //echo "prev ".$prev1. "  prev1 ".$prev."  ".$dd."<br>";
                if($prev=="্") {   //Link
                if($dd=="জ")   // $dd=="ক")     //next is JA
                {
                $val=substr($val,0,strlen($val)-3)."NJ" ;
                //echo (strlen($val)-1)." ".$val;
                }
                
                if($dd=="চ")   // $dd=="ক")     //next is Cha
                {
                //echo "Normal val ".$val."<br>";    
                $val=substr($val,0,strlen($val)-4)."NCH" ;
                //echo "substrl val ".$val."<br>";    
                 }
                }
                } //unga
                
                
               //echo "<br>Prev-1".$prev1."  Prev-".$prev."  Curent-".$dd."<br>"; 
                
                //End situation
                $i = $i + $incr;
                if($i < strlen($str))
                {
                 $prev1=$prev;
                 $prev=$dd;
                }
            }//while loop
            
        //echo $prev." ".$dd."<br>";
           //Waba and Akar at the last , replace with A rather WA 
          if($prev=="ৱ" && $dd=="া")  
          $val=substr($val,0,strlen($val)-2)."A" ;  
              
        //A at the End
         if(isset($this->Vowel[$prev1])==false && isset($this->Vowel[$dd])==false)
            {   
            if($prev=="্") {   
               $val.="A";
            }
            }
            $val=trim($val);
                return($val);
    
 }
    
    
    public function iscii($str) {
        $val = "";
        $uarr = array();

        $uarr['০'] = 48;
        $uarr['১'] = 49;
        $uarr['২'] = 50;
        $uarr['৩'] = 51;
        $uarr['৪'] = 52;
        $uarr['৫'] = 53;
        $uarr['৬'] = 54;
        $uarr['৭'] = 55;
        $uarr['৮'] = 56;
        $uarr['৯'] = 57;

        $uarr["ঁ"] = 161;
        $uarr["ং"] = 162;
        $uarr["ঃ"] = 163;
        $uarr["অ"] = 164;
        $uarr["আ"] = 165;
        $uarr["ই"] = 166;
        $uarr["ঈ"] = 167;
        $uarr["উ"] = 168;
        $uarr["ঊ"] = 169;
        $uarr["ঋ"] = 170;
        $uarr["এ"] = 172;
        $uarr["ঐ"] = 173;
        $uarr["ও"] = 176;
        $uarr["ঔ"] = 177;

        $uarr["ক"] = 179;
        $uarr["খ"] = 180;
        $uarr["গ"] = 181;
        $uarr["ঘ"] = 182;
        $uarr["ঙ"] = 183;
        $uarr["চ"] = 184;
        $uarr["ছ"] = 185;
        $uarr["জ"] = 186;
        $uarr["ঝ"] = 187;
        $uarr["ঞ"] = 188;
        $uarr["ট"] = 189;
        $uarr["ঠ"] = 190;
        $uarr["ড"] = 191;
        $uarr["ঢ"] = 192;
        $uarr["ণ"] = 193;
        $uarr["ত"] = 194;
        $uarr["থ"] = 195;
        $uarr["দ"] = 196;
        $uarr["ধ"] = 197;
        $uarr["ন"] = 198;

        $uarr["প"] = 200;
        $uarr["ফ"] = 201;
        $uarr["ব"] = 202;
        $uarr["ভ"] = 203;
        $uarr["ম"] = 204;
        $uarr["য়"] = 205;
        $uarr["য"] = 206;
        $uarr["ৰ"] = 207;
        $uarr["র"] = 207;

        $uarr["ল"] = 209;
        $uarr["ৱ"] = 212;
        $uarr["শ"] = 213;
        $uarr["ষ"] = 214;
        $uarr["স"] = 215;
        $uarr["হ"] = 216;

        $uarr["া"] = 218;
        $uarr["ি"] = 219;
        $uarr["ী"] = 220;
        $uarr["ু"] = 221;
        $uarr["ূ"] = 222;
        $uarr["ৃ"] = 223;
        $uarr["ে"] = 225;
        $uarr["ৈ"] = 226;
        $uarr["ো"] = 229;
        $uarr["ৌ"] = 230;
        $uarr["্"] = 232;
        $uarr["়"] = 233;

        $uarr["।"] = 124;  //Dari

        $srow = explode(" ", $str);

        for ($ind = 0; $ind < count($srow); $ind++) {
            $i = 0;
            $str = $srow[$ind];
            while ($i < strlen($str)) {
                $incr = 3;
                $dd = trim(substr($str, $i, 3));

                if ($this->isUnicode($dd) == false) {
                    $incr = 1;
                    $dd = trim(substr($str, $i, 1));
                }

                $ichar = "";
                if (isset($uarr[$dd])) {
                    $flag = $uarr[$dd];
                    $ichar = chr($flag);
                    $val.=$ichar;
                }
                else
                    $val.=$dd;
                $i = $i + $incr;
            }//while loop
            $val.=" ";
        }//for loop
        return($val);
    }

//end iscii

    public function isIscii($str) {
        $val=0; 
        $str=trim($str);
        $res=false;
        //$this->Message=$str." Converted as ".$val."<br>";
        $msg="";
        for($i=0;$i<strlen($str);$i++)
        {
        $val = ord(substr($str, $i, 1));
        $msg=$msg.$val."-";
        if ($val > 126 && $val < 256)
        {
        $res=true;   
        $i=strlen($str);
        //$this->Message=$str." Converted as ".$val."<br>";
        }
        }//for loop  
        $this->Message=$str." Converted as ".$msg."<br>";
        return($res);
    }

	public function isUnicodeCharExist($mystring) {
        $t = false;
        if (strlen($mystring) != strlen(utf8_decode($mystring)))
            $t = true;
        else
            $t = false;
        return($t);
    }

    public function isUnicode($mystring) {
        $t = true;
        $token = array();
        $j = 0;
        $start = 0;
        $mystring = $mystring . " ";
        for ($i = 0; $i < strlen($mystring); $i++) {
            if (substr($mystring, $i, 1) == " ") {
                $length = $i - $start;
                $token[$j] = substr($mystring, $start, $length);
                $start = $i + 1;
                if (strlen($token[$j]) != (3 * strlen(utf8_decode($token[$j]))))
                    $t = false;
                $j++;
            }
        }
        return($t);
    }

    private function isVowel($a)
    {
    if($a=="A" || $a=="E" || $a=="I" || $a=="O" || $a=="U" )
        return(true);
    else 
        return(false);
    }
    
}

//END CLASS



