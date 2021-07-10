<?php
//    كود تعديل عمل المستخدم 
//  جلب القيم 
    $id      = $_REQUEST['id'];
    $job  = intval($_REQUEST['job']);
    //  التحقق من ان القيم غير فارغة 
    if(empty($id)){
        echo '<div class="alert alert-danger" role="alert"> يجب ادخال الرقم الوطني اولا </div>';
    }else if(empty($job)){
        echo '<div class="alert alert-danger" role="alert"> يجب اختيار قيمة اولا   </div>';
    }else{
        //  القيم غير فارغة 
        //  الاتصال بقاعدة البيانات 
        include("../../../../lib/Php/connectdb.php");
        //  استعلام التحقق من ان المستخدم مسجل سابقا  
        $sql = "SELECT * FROM `users` WHERE `NationalNumber` = $id ";
        $reuslt = mysqli_query($conn,$sql);
        if(mysqli_num_rows($reuslt)>0){
            //  المستخددم موجود  
            //  استعلام تعديل عمل المستخدم  
                $update =  "UPDATE `users` SET `jobID` = '$job' WHERE `NationalNumber` = '$id' ";
                $query = mysqli_query($conn,$update);
                if(mysqli_affected_rows($conn)>0){
                    echo '<div class="alert alert-success" role="alert"> تم تعديل  بنجاح </div>' ;
                    mysqli_close($conn);
                }else{
                    
                    echo '<div class="alert alert-info" role="alert"> تم اختيار هذه القيمة سابقا </div>' ;
                    mysqli_close($conn);
                }
        }else{
            echo '<div class="alert alert-danger" role="alert"> الرقم الوطني غير مسجل </div>' ;
            mysqli_close($conn);
        }

        
    }
?>