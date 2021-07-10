<?php
/**  كود لتسجيل عملية الاقتارع  */
//  جلب البيانات المطلوبة ( رقم الوطني للناخب - رقم المرشح -  و رقم العملية الانتخابية )
$vets = $_REQUEST["vets"];
$id  = $_REQUEST["id"];
$idprocess = $_REQUEST["process"];
$area =  $_REQUEST["area"];

$result = null ; 
include("../../../../lib/Php/connectdb.php");
if($id>0 && $idprocess > 0  && $area > 0 ){
    //  التأكد من ان القيم غير فارغة 
    //  استدعاء ملف الدوال الخاصة بالقيام بتسجيل عملية الاقتراع 
   include("election.php");
//    select type process 
$get_type = "SELECT `IDTypeProcess` FROM `electionprocess` WHERE `IDProcess` = '$idprocess'";
$query_get_type = mysqli_query($conn,$get_type);
if($query_get_type){
    // query get type true 
    if(mysqli_num_rows($query_get_type)>0){
        // find process
        while($row = mysqli_fetch_array($query_get_type)){
            if($row["IDTypeProcess"] == 1 ){
                 //  استدعاء دالة تسجيل عملية الاقتارع 
                $result  = set_election($id,null,$vets,$idprocess,$area);

            }else{
                 //  استدعاء دالة تسجيل عملية الاقتارع 
                $result  = set_election($id,$vets,null,$idprocess,$area);
            }
        }
    }else{
        // not found any process
    }
}else{
// query get type error 
}
   

//     عرض نتيجة التنفيذ  
   switch ($result) {
       
       case 1:
          echo 
          '<div class="alert alert-success" role="alert"> 
          تمت العملية بنجاح 
            </div>'   ;
           break;
        case 403:
            echo '<div class="alert alert-danger" role="alert"> 
           يوجد خطأ في تعديل حالة الانتخاب 
        </div>';
          
            break;
        case 404:
            echo '<div class="alert alert-danger" role="alert"> 
            يوجد خطأ في تسجيل الاصوات 
            </div>';
        case 402:
            echo '<div class="alert alert-danger" role="alert"> 
             غير مسموح لك بالانتخاب  , لقد تم الانتخاب سابقا
            </div>';
            break;
        case 405:
            echo '<div class="alert alert-danger" role="alert"> 
                غير مسموح لك بالانتخاب  ,  الدائرة الانتخابية خاطئة 
            </div>';
            break;
        case 401:
            echo '<div class="alert alert-danger" role="alert"> 
           إن هذه العملية الانتخابية غير متاحة للاقتراع حاليا  
            </div>';
            break;
        case 406:
            echo '<div class="alert alert-danger" role="alert"> 
            غير مسموح لك بالانتخاب العمر اقل من 18 عام 
            </div>';
            break;
        case 407:
            echo '<div class="alert alert-danger" role="alert"> 
            غير مسموح لك بالانتخاب في هذا العملية الانتخابية (حالة العمل غير مسموح لها  بالانتخاب )
            </div>';
            break;
       
       default:
       echo '<div class="alert alert-danger" role="alert"> 
      يوجد خطأ في العملية 
       </div>';
           break;
   }
}else{
}



?>