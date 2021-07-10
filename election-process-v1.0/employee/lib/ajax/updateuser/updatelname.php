<?php
//  كود  تعديل لقب المستخدم  ( اسم العائلة )
//  جلب القيم المطلوبة 
    $id     = $_REQUEST['id'];
    $lname  = $_REQUEST['lname'];
    //  التحقق من ان القيم غير فارغة  
    if(empty($id)){
        echo '<div class="alert alert-danger" role="alert"> يجب ادخال الرقم الوطني اولا </div>';
    }else if(empty($lname)){
        echo '<div class="alert alert-danger" role="alert"> يجب ادخال اسم العائلة اولا </div>';
    }else{
        //  القينم غير فارغة 
        //  الاتصال بقاعدة البيانات 
        include("../../../../lib/Php/connectdb.php");
        //  التحقق من ان المستخدمة مسجل سابقا  
        //  الاستعلام 
        $sql = "SELECT * FROM `users` WHERE `NationalNumber` = $id ";
        $reult = mysqli_query($conn,$sql);
        if(mysqli_num_rows($reult)>0){
            //  المستخدم مسجل 
            //  استعلام تعديل لقب المستخدم 
            $update =  "UPDATE `users` SET `lname` = '$lname' WHERE `nationalnumber` = '$id' ";
            $query = mysqli_query($conn,$update);
            if($query){
                echo '<div class="alert alert-success" role="alert"> تم تعديل الاسم بنجاح </div>' ;
                mysqli_close($conn);
            }else{
                $ERROR = mysqli_error($conn);
                echo '<div class="alert alert-danger" role="alert">'.$ERROR.' </div>' ;
            }
        }else{
            echo '<div class="alert alert-danger" role="alert"> الرقم الوطني غير مسجل </div>' ;
        }

        
    }
?>