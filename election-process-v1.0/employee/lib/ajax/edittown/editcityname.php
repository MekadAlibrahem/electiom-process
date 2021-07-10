<?php

/** طود تعديل اسم المحافظة لمنطقى ما عن طريق الرقم لخاص بها  */
//  جلب القيم من طلب الاجاكس 
$id         = $_REQUEST["id"];
$city       = $_REQUEST["city"]; 

// 1- التأكد من عدم وجود قيم فارغة 
if(empty($id)){
     echo  '<div class="alert alert-danger" role="alert"> يجب إدخال رقم المنطقة اولاً    </div> ';
}else if(empty($city)){
    echo '<div class="alert alert-danger" role="alert"> يجب إدخال الاسم الجديد للمحافظة  </div> ';
}else{
    //  الاتصال بقاعدة البيانات 
    include("../../../../../lib/Php/connectdb.php");
    // التأكد من وجود المنطقة المحددة 
    //  استعلام البحث عن منطقة عن طريق رقم 
    $sql    = "SELECT * FROM `residentialarea` WHERE `ResidentionAreaID` = $id " ;
    $query  = mysqli_query($conn,$sql);
    if(mysqli_num_rows($query) >0 ){
        //  المنطقة موجودة 
        //  استعلام تعديل المحافظة لمنطقة ما 
        $edit   = "UPDATE  `residentialarea`  SET `CityID` = '$city' WHERE `ResidentionAreaID` = $id  " ;
        $query2  = mysqli_query($conn,$edit);
        if(mysqli_affected_rows($conn)>0){
            echo '<div class="alert alert-success" role="alert"> تم تعديل  بنجاح   </div> ';
        }else{
            echo '<div class="alert alert-info" role="alert">  إن هذه القيمة مسجلة بالفعل </div> ';
        }
    }else{
        echo '<div class="alert alert-danger" role="alert">   إن رقم المنطقة غير مسجل يجب إدخال رقم صحيح  </div> ';
    }
}







?>