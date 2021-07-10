<?php
    $id  = intval($_REQUEST["id"]);
    $str = $_REQUEST["work"];
    $connect = mysqli_connect("localhost","root","","testweb1");
    mysqli_set_charset($connect,"utf8");
    $sql =  "update  candidates set currentwork  = '$str'  WHERE NationalNumber='$id'";
    $query = mysqli_query($connect,$sql);

?>