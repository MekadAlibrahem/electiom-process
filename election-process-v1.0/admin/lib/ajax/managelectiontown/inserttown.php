<?php
/** كود إضافة منطقة لدائرة انتخابية  */
//    جلب قيم المتغيرات من الطلب
$area    = $_REQUEST["area"];

$town    = $_REQUEST["town"];
/**
 * خطوات تسجيل منظقة ضمن دائرة انتخابية  
 * 1- يجب التحقق ان المنطقة المطلوبة غير مسجلة لاي دائرة انتخابية تابعة لنفس نوع العملية الانتخابية  
 * 2- في حال تحقق الشرط الاول يتم تسجيل الدائرة الانتخابية  مع تحديد الدائرة الانتخابية التابعة لها و اسم المنطقة  
 * 
 */
// الاتصال بقاعدة البيانات
include("../../../../lib/Php/connectdb.php");
/**
 * يوجد ثلاث استعلامات فرعية 
 * 1- يجلب نوع العملية الانتخابية  من رقم الدائرة الانتخابية المحددة  
 * 2-  يتم جلب جميع الدوائر الانتخابية التابعة  لنوع العملية الانتخابية المعاد سابقا 
 * يتم التحقق ان المنطقة المطلوبة غير مسجلة سابقا لاي دائرة انتخابية تابعة لنفس  نوع الانتخابات 
 */
$select_town = "SELECT * FROM `electionareadatils`  WHERE `ElectionAreaID` IN (SELECT `ElectionAreaID` FROM `electionareas` WHERE `IDTypeProcess` = (SELECT `IDTypeProcess` FROM `electionareas` WHERE `ElectionAreaID` = '$area' ) )  AND  `ResidentionAreaID` = '$town' ";
$query_select = mysqli_query($conn,$select_town);
if($query_select){
    // query true
    if(mysqli_num_rows($query_select)>0){
        // المنطقة مسجلة بالفعل 
        echo '<div class="alert alert-info" role="alert">
                إن هذه المنطقة مسجلة بالفعل ربما تكون مسجلة ضمن دائرة انتخابية ثانية 
                </div>' ;
    }else{
        // لا يوجد نتيجة للاستعلام => المنطقة غير مسجلة
        // الاستعلام الخاص بتسجيل المنطقة
        $set_town = "INSERT INTO `electionareadatils`(`id`, `ElectionAreaID`, `ResidentionAreaID`) VALUES (null,'$area','$town')";
        $query_set_town = mysqli_query($conn,$set_town);
        if($query_set_town){
            // query : true
            if(mysqli_affected_rows($conn)>0){
                // تم تسجيل المنطقة بنجاح
                echo '<div class="alert alert-success" role="alert">
                تم الإضافة بنجاح
                </div>' ;              
            }else{
                // insert false
                $ERROR = mysqli_error($conn);
                echo '<div class="alert alert-danger" role="alert">'.$ERROR.'
                </div>';
            }
        }else{
            // query set town : ERROR
            $ERROR = mysqli_error($conn);
            echo '<div class="alert alert-danger" role="alert">'.$ERROR.'
            </div>';
        }
    }
}else{
    //query select town false 

    $ERROR = mysqli_error($conn);
    echo '<div class="alert alert-danger" role="alert">'.$ERROR.'
    </div>';
}


//


?>