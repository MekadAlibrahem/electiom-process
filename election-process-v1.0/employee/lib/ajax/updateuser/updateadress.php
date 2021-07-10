<?php
//  كود لتعديل العنوان للمستخدم 
//  جلب القيم المطلوبة 
    $id     = $_REQUEST['id'];
    $adress  = $_REQUEST['adress'];
    //  التحقق ان الرقم غير فارغ 
    if(empty($id)){
        echo '<div class="alert alert-danger" role="alert"> يجب ادخال الرقم الوطني اولا </div>';
    }else if(empty($adress)){
        //  التحقق ان العنوان غيير فارغ 
        echo '<div class="alert alert-danger" role="alert"> يجب ادخال عنوان السكن اولا </div>';
    }else{
        //  الاتصال بقاعدة البيانات 
        include("../../../../lib/Php/connectdb.php");
        /** 
         * قبل تعديل البيانات يجب التأكد ان  المستخدم مسجل سابقا 
         */
        //  استعلام يعيد بيانات المستخدم 
        $sql = "SELECT * FROM `users` WHERE `NationalNumber` = $id ";
        $reult = mysqli_query($conn,$sql);
        if(mysqli_num_rows($reult)>0){
            //  المستخدم موجدود 
            //  استعلام تعديل عنوان مستخدم 
            $update =  "UPDATE `users` SET `Adress` = '$adress' WHERE `nationalnumber` = '$id' ";
            $query = mysqli_query($conn,$update);
            if(mysqli_affected_rows($conn)>0){
                //  
                echo '<div class="alert alert-success" role="alert"> تم تعديل الاسم بنجاح </div>' ;
                mysqli_close($conn);
            }else{
                
                echo '<div class="alert alert-info" role="alert"> القيمة مسجلة بالفعل </div>' ;
                mysqli_close($conn);
            }
        }else{
            echo '<div class="alert alert-danger" role="alert"> الرقم الوطني غير مسجل </div>' ;
            mysqli_close($conn);
        }

        
    }
?>