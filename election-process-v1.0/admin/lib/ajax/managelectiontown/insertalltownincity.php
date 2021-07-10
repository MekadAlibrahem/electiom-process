<?php
/** كود إضافة منطقة لدائرة انتخابية  */
//    جلب قيم المتغيرات من الطلب
$area    = $_REQUEST["area"];

$city    = $_REQUEST["city"];

// الاتصال بقاعدة البيانات
include("../../../../lib/Php/connectdb.php");
$error_result = " " ;
$get_all_town = "SELECT `ResidentionAreaID` FROM `residentialarea` WHERE `CityID` = '$city'";
$query_all_town = mysqli_query($conn,$get_all_town);
if($query_all_town){
    // true query 
    if(mysqli_num_rows($query_all_town)>0){
        // find towns in this city 
        $count_error = 0 ; 
        while($row = mysqli_fetch_array($query_all_town)){
            $insert  = insert_town($row["ResidentionAreaID"],$area,$conn);
            switch ($insert) {
                case 200:
                    
                    break;
                case 400:
                    $count_error  = $count_error +  1; 
                    $error_result  +=  '  '.$row["ResidentionAreaID"].' , ' ; 
                    break;
                
                default:
                    $count_error  = $count_error +  1; 
                    $error_result  +=  '  '.$row["ResidentionAreaID"].' , ' ; 
                    break;
            }
            

        }
        echo '<div class="alert alert-success" role="alert">
                تم الإضافة بنجاح
                </div>' ;
                if($count_error > 0){
                    echo '<div class="alert alert-danger" role="alert"> town number ['.$error_result.'] not insert
                    </div>';
                }   
            
    }else{
        //  not found any town in this city 
        echo '<div class="alert alert-info" role="alert">
                إن هذه المحافظة لا تحتوي على اي منطقة
                </div>' ;
    }
}else{
    // error query all town 
    $ERROR = mysqli_error($conn);
    echo '<div class="alert alert-danger" role="alert">'.$ERROR.'
    </div>';
}




/**
 * @function insert town in election area 
 * @param int $town : number town 
 * @param int $area : number election area id 
 * @param mysqli_connected  
 * @not return 
 */
function insert_town($town ,$area, $conn){
    /**
 * خطوات تسجيل منظقة ضمن دائرة انتخابية  
 * 1- يجب التحقق ان المنطقة المطلوبة غير مسجلة لاي دائرة انتخابية تابعة لنفس نوع العملية الانتخابية  
 * 2- في حال تحقق الشرط الاول يتم تسجيل الدائرة الانتخابية  مع تحديد الدائرة الانتخابية التابعة لها و اسم المنطقة  
 * 
 */
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
        return 200 ;
    }else{
        // لا يوجد نتيجة للاستعلام => المنطقة غير مسجلة
        // الاستعلام الخاص بتسجيل المنطقة
        $set_town = "INSERT INTO `electionareadatils`(`id`, `ElectionAreaID`, `ResidentionAreaID`) VALUES (null,'$area','$town')";
        $query_set_town = mysqli_query($conn,$set_town);
        if($query_set_town){
            // query : true
            if(mysqli_affected_rows($conn)>0){
                // تم تسجيل المنطقة بنجاح
                return 200 ;            
            }else{
                // insert false
                return 401 ;
            }
        }else{
            // query set town : ERROR
            return 400 ;
        }
    }
}else{
    //query select town false 

    return 404 ;
}
}


//


?>