<?php
function Redirect_to($New_Location){
        header ("Location:".$New_Location);
        exit;
}

function Login_Attempt($Username,$Password){
        $ConnectingDB;
        $Query="SELECT * From user WHERE username='$Username' AND password='$Password'";
        $Execute=mysql_query($Query);
        if($admin=mysql_fetch_assoc($Execute)){
                return $admin;
        }else{
                return null;
        }
}
?>