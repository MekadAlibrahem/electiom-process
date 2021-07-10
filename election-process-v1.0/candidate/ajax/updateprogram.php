<?php
    include_once "../../lib/Php/connectdb.php" ;
    $idprogram       = $_REQUEST['id'];
    $text            = $_REQUEST['text'];
    $sql = "UPDATE `electionprograms` SET `Content` = '$text' WHERE `IDProgram` = '$idprogram' ";
    $query = mysqli_query($conn ,$sql);
    if($query){
            echo "<script> alert(' update program ') ;  <script>"  ;
    }else{
            echo "<script> alert('".mysqli_error($conn)."')   ;  </script>" ;
    }


?>