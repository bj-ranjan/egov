<?php

class Style {

    private $Align = array('justify', 'left', 'center', 'right');

    public function DivStartLandingPage($type = 'M') {
        $size = "";
        if ($type == "M")
            $size = "_medium";
        if ($type == "S")
            $size = "_half";
        echo " '<div class=landing-page" . $size . "'><div class='form-appointment'><div class='wpcf7' id='wpcf7-f560-p590-o1'>";
    }

    public function DivEndLandingPage() {
        echo " </div></div></div>";
    }

    public function DivStartForm($name = 'myform') {
        echo "<form action='' method='post' class='wpcf7-form'  name='" . $name . "' >";
    }

    public function EndForm($name = 'myform') {
        echo "</form>";
    }

    public function DivColumn() {
        echo "<div style='width: 90%; text-align: left;'>";
    }

    public function DivSubColumn($align = 1) {
        echo "<div style='width: 48%; float:";
        if ($align == 1)
            echo "left;'>";
        else
            echo "right;'>";
    }

    public function DivGroup() {
        echo "<div class='group'>";
    }

    public function DivEnd() {
        echo "</div>";
    }

    public function DivButton($id, $caption, $function, $align = 2) {
        $align = "'" . $this->Align . "'";
        echo "<div style=text-align:" . $align . "; padding-top: 2em; border-top: 1px solid rgb(153, 202, 129); margin-top: 1em;'>";
        echo "<input type='submit' value='" . $caption . "'  class='wpcf7-form-control wpcf7-submit' " . $function . ">";
        echo "</div>";
    }

    public function DivSpanInput($id, $label = '', $value = '', $size = 20, $maxlength = 50, $placeholder = '', $fun = '') {
        $fun = " onfocus=ChangeColor('" . $id . "', 1)  onblur=ChangeColor('" . $id . "',2)";

        echo "<span class='wpcf7-form-control-wrap" . $id . "'>" . $label . "<input type='text' name='" . $id . "'  id='" . $id . "'  value=" . chr(34) . $value . chr(34) . "  size='" . $size . "' maxlength='" . $maxlength . "'  class='wpcf7-form-control wpcf7-text wpcf7-validates-as-required' aria-required='true' placeholder='" . $placeholder . "'" . $fun . "></span><br>";
    }

}

//End Class