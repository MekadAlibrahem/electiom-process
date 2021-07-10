<?php



$id  = $_REQUEST["id"];
$im = $_REQUEST["pic"];
$im = realpath($im);
echo $im ; 
// $oldimage = 'C:/xampp/htdocs/Mekadv2.0/faceapi/images/'.$id.'.jpg';
// if(file_exists($oldimage)){
//     unlink($oldimage);
//     $resultsaveimages = move_uploaded_file($im,'C:/xampp/htdocs/Mekadv2.0/faceapi/images/'.$id.'.jpg');
//     echo ($resultsaveimages==true)? "true" : "false" ;
// }else{
//     $resultsaveimages = move_uploaded_file($im,'C:/xampp/htdocs/Mekadv2.0/faceapi/images/'.$id.'.jpg');
//     echo ($resultsaveimages==true)? "true" : "false" ;
    
// }

?>