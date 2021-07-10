<?php
//  كود تعديل القيد للمستخدم  جلب القيم المطلوبة 
    $id     = $_REQUEST['id'];
    $idadress  = $_REQUEST['idadress'];
    //  التحقق من ان القيم غير فارغة 
    if(empty($id)){
        echo '<div class="alert alert-danger" role="alert"> يجب ادخال الرقم الوطني اولا </div>';
    }else if(empty($idadress)){
        echo '<div class="alert alert-danger" role="alert"> يجب ادخال رقم القيد اولا </div>';
    }else{
        //  القيم غير فارغة 
        //  التصال بقاعدة البيانات    
        include("../../../../lib/Php/connectdb.php");
        //  استعلام البحث عن مستخدم للتاكد من ان المستخدم المطلوب مسجل سابقا 
        $sql = "SELECT * FROM `users` WHERE `NationalNumber` = $id ";
        $reuslt = mysqli_query($conn,$sql);
        if(mysqli_num_rows($reuslt)>0){
            //  المستخدم موجود 
            /** 
             * رقم القيد يتم إدخاله ك رقم وليس اختيار من قائمة و بالتالي يمكن ادخال رقم خاطئ لذلك يجب التاكد من ان الرقم القيد مسجل سابقا 
             */
            //  استعلام للتحقق من ان رقم القيج صحيح 
            $sql2 = "SELECT * FROM `idadress` WHERE `ID`= '$idadress'" ;
            $reuslt2 = mysqli_query($conn,$sql2);
            if(mysqli_num_rows($reuslt2)>0){
                //  رقم القيد مسجل سابقا 
                //  استعلام لتعديل رقم القيد للمستخدم 
                $update =  "UPDATE `users` SET `ID` = '$idadress' WHERE `nationalnumber` = '$id' ";
                $query = mysqli_query($conn,$update);
                if(mysqli_affected_rows($conn)>0){
                    echo '<div class="alert alert-success" role="alert"> تم تعديل الاسم بنجاح </div>' ;
                    mysqli_close($conn);
                }else{
                    echo '<div class="alert alert-info" role="alert"> القيمة مسجلة بالفعل </div>' ;
                    mysqli_close($conn);
                }
            }else{
                echo '<div class="alert alert-danger" role="alert"> رقم القيد المدني غير مسجل </div>' ;
                mysqli_close($conn);
            }
            
        }else{
            echo '<div class="alert alert-danger" role="alert"> الرقم الوطني غير مسجل </div>' ;
            mysqli_close($conn);
        }

        
    }
?>