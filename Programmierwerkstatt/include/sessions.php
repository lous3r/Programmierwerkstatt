<?php
/*
 Session only works when browser is open
 */


session_start();

//Failed Message
function Message(){
    if (isset($_SESSION["ErrorMessage"])){
        //alert is bootstrap danger will add red color, avoiding quotation by adding \
        $Output="<div class=\"alert alert-danger\">" ;
        $Output.=htmlentities($_SESSION["ErrorMessage"]); //to show something so that html doesnt break
        $Output.="</div>";
        $_SESSION["ErrorMessage"]=null; // when the user reachs for the first time, it will have null value
        return $Output;
    }
}

//Successed Message
function SuccessMessage(){
    if (isset($_SESSION["SuccessMessage"])){
        //alert is bootstrap success wil add green color, avoiding quotation by adding \
        $Output="<div class=\"alert alert-success\">" ;
        $Output.=htmlentities($_SESSION["SuccessMessage"]); //to show something so that html doesnt break
        $Output.="</div>";
        $_SESSION["SuccessMessage"]=null; // when the user reachs for the first time, it will have null value
        return $Output;
    }
}


?>