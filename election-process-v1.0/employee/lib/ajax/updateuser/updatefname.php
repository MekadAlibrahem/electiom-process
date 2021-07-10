<?php
//  كود تعديل اسم المستخدم 
//  جلب القيم 
    $id     = $_REQUEST['id'];
    $fname  = $_REQUEST['fname'];
    //  التاكد ان القيم غير فارغة 
    if(empty($id)){
        echo '<div class="alert alert-danger" role="alert"> يجب ادخال الرقم الوطني اولا </div>';
    }else if(empty($fname)){
        echo '<div class="alert alert-danger" role="alert"> يجب ادخال الاسم اولا </div>';
    }else{
        //  الاتصال بقاعدة البيانات 
        include("../../../../lib/Php/connectdb.php");
        //  التاكد من ان المستخدم مسجل سابقا 
        //  استعلام التحقق من ان المستحدم مسجل  
        $sql = "SELECT * FROM `users` WHERE `NationalNumber` = $id ";
        $reult = mysqli_query($conn,$sql);
        if(mysqli_num_rows($reult)>0){
            //  المستخدم مسجل سابقا  
            //  استعلام تعديل اسم المستخدم 
            $update =  "UPDATE `users` SET `fname` = '$fname' WHERE `nationalnumber` = '$id' ";
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