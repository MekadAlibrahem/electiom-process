<?php
//     كود تعديل جنس المستخدم 
//  جلب القيم المطلوبة 
    $id      = $_REQUEST['id'] ;
    $gender  = intval($_REQUEST['gender']);
    //  التحقق من ان القيم غير فارغة 
    if(empty($id)){
        echo '<div class="alert alert-danger" role="alert"> يجب ادخال الرقم الوطني اولا </div>';
    }else{
        //  القيم غير فارغة 
        //  الاتصال بقاعدة البيانات 
        include("../../../../lib/Php/connectdb.php");
        //  التحقق من ان المستخدم مسجل سباقا 
        // استعلام البحث عن مستخدم 
        $sql = "SELECT * FROM `users` WHERE `NationalNumber` = $id ";
        $reuslt = mysqli_query($conn,$sql);
        if(mysqli_num_rows($reuslt)>0){
            //  السمتخدم موجدود 
            //  استعلام تعديل اسم  المستخدم 
                $update =  "UPDATE `users` SET `gender` = '$gender' WHERE `NationalNumber` = '$id' ";
                $query = mysqli_query($conn,$update);
                if(mysqli_affected_rows($conn)>0){
                    echo '<div class="alert alert-success" role="alert"> تم تعديل  بنجاح </div>' ;
                    mysqli_close($conn);
                }else{
                    echo '<div class="alert alert-info" role="alert"> تم تعديل هذا القيمة سابقا </div>' ;
                    mysqli_close($conn);
                }
        }else{
            echo '<div class="alert alert-danger" role="alert"> الرقم الوطني غير مسجل </div>' ;
            mysqli_close($conn);
        }

        
    }
?>