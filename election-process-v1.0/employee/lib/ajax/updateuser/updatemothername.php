<?php
//  كود تعديل اسم الام للمستخدم   
//  جلب لقيم المطلوبة 
    $id     = $_REQUEST['id'];
    $mname  = $_REQUEST['mname'];
    //  التحقق من ان القيم غير فارغة  
    if(empty($id)){
        echo '<div class="alert alert-danger" role="alert"> يجب ادخال الرقم الوطني اولا </div>';
    }else if(empty($mname)){
        echo '<div class="alert alert-danger" role="alert"> يجب ادخال اسم الام اولا </div>';
    }else{
        //  القيم غير فارغة 
        //  الاتصال بقاعدة البيانات 
        include("../../../../lib/Php/connectdb.php");
        //  استعلام التحقق من ان المستخدم مسجل سابقا 
        $sql = "SELECT * FROM `users` WHERE `NationalNumber` = $id ";
        $reult = mysqli_query($conn,$sql);
        if(mysqli_num_rows($reult)>0){
            //  المستخدم مسجل 
            //  استعلام تعديل 
            $update =  "UPDATE `users` SET `MotherName` = '$mname' WHERE `nationalnumber` = '$id' ";
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