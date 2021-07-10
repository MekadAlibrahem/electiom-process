<?php
//  كود تعديل تاريخ الولادة للمستخدم  
//  جلب القيم 
    $id     = $_REQUEST['id'];
    $bdate  = $_REQUEST['bdate'];
    //  التأكد ان القيم غير فارغة  
    if(empty($id)){
        echo '<div class="alert alert-danger" role="alert"> يجب ادخال الرقم الوطني اولا </div>';
    }else if(empty($bdate)){
        echo '<div class="alert alert-danger" role="alert"> يجب ادخال تاريخ الميلاد اولا </div>';
    }else{
        //  الاتصال بقاعدة البيانات  
        include("../../../../lib/Php/connectdb.php");
        // يجب التاكد من ان المستحدم مسجل سابقا  
        //  استعلام بحث عن مستخدم 
        $sql = "SELECT * FROM `users` WHERE `NationalNumber` = $id ";
        $reult = mysqli_query($conn,$sql);
        if(mysqli_num_rows($reult)>0){
            //  وجد المستحدم المطلوب  
            //  استعلام تعجيل تاريخ الولادة 
            $update =  "UPDATE `users` SET `BirthDate` = '$bdate' WHERE `nationalnumber` = '$id' ";
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