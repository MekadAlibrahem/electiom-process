<?php
/*** كود لحذف منطقة  */
//    جلب قيم المتغيرات من الطلب
$area    = $_REQUEST["area"];

$town    = $_REQUEST["town"];

/**
 * يجب التحقق ان المنطقة غير مسجلة سابقا لتجنب تكرار تسجيل البيانات
 * إذا كان المنطقة غير مسجلة يمكن تسجيلها 
 */
// الاتصال بقاعدة البيانات
include("../../../../lib/Php/connectdb.php");
// الاستعلام الخاص بالتحقق من أن المنطقة  مسجلة
$select_town = "SELECT * FROM `electionareadatils` WHERE `ElectionAreaID`= '$area' AND  `ResidentionAreaID` = '$town' ";
$query_select = mysqli_query($conn,$select_town);
if($query_select){
    // query true
    if(mysqli_num_rows($query_select)>0){
        // المنطقة مسجلة  
        $delete_town = "DELETE FROM `electionareadatils` WHERE  `ElectionAreaID`= '$area' AND  `ResidentionAreaID` = '$town'";
        $query_delete = mysqli_query($conn,$delete_town);
        if($query_delete){
            // الاستعلام صحيح  
            if(mysqli_affected_rows($conn)>0){
                //تم الحذف
                echo '<div class="alert alert-success" role="alert">
                تم الحذف بنجاح
                </div>' ;
            }else{
                //لم يتم الحذف  
                $ERROR = mysqli_error($conn);
                echo '<div class="alert alert-danger" role="alert">'.$ERROR.'
                </div>';
            }
        }else{
            // الاستعلام خاطئ 
            $ERROR = mysqli_error($conn);
            echo '<div class="alert alert-danger" role="alert">'.$ERROR.'
            </div>';
        }

        
    }else{
        // لا يوجد نتيجة للاستعلام => المنطقة غير مسجلة
        echo '<div class="alert alert-info" role="alert">
               إن هذه المنطقة غير مسجلة 
                </div>' ;

    }
}else{
    //query select town false 

    $ERROR = mysqli_error($conn);
    echo '<div class="alert alert-danger" role="alert">'.$ERROR.'
    </div>';
}


//



?>