<?php
    $SERVER = "localhost" ;
    $USER   = "root" ;
    $PASS   = "" ;
    $DB     = "testweb1";
    $conn = mysqli_connect($SERVER ,$USER,$PASS,$DB)
        or die("ERORR2: NOT CONNECT WITH DB");
    if($conn){
        mysqli_set_charset($conn,"utf8");
    }
?>
