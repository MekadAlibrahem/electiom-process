<?php
//  كود تعديل نوع العمليية الانتخابية التابعة لها الدائرة الانتخلبية 
//  جلب البيانات  
$id     = $_REQUEST['id'];
$type   = $_REQUEST["type"];
if($id<1 || empty($type)){
    // القيم فارغة  
    echo '<div class="alert alert-danger" role="alert">
    يجب إدخال رقم المنطقة الانتخابية و نوع الانتخابات الجديد اولا
   </div>';
}else{
    //  القيم غير فارغة 
    //   الاتصال بقاعدة البيانات 
    include("../../../../lib/Php/connectdb.php");
    //  استعلام التعديل  نوع العملية الانتخابية 
    $retype = "UPDATE `electionareas` SET `IDTypeProcess` = '$type' WHERE `ElectionAreaID` = '$id'";
    $query_retype = mysqli_query($conn,$retype);
    if($query_retype){
        // الاستعلام صحيح   
        if(mysqli_affected_rows($conn)>0){
                //  تم تعيدل نوع 
                //  عرض رسالة توضيحة 
                echo '<div class="alert alert-success" role="alert"> 
                تم تعديل نوع انتخابات الدائرة الانتخابية بنجاح
                </div>' ;
        }else{
            // لم يتم التعديل  : القيمة مسجلة مسبقا 
            echo '<div class="alert alert-info" role="alert">
           إن هذه النوع معدلة بالفعل
            </div>';
        }
    }else{
        // Query rename : ERROR
        // لم ينفذ الاستعلام => يوجد خطأ
        // جلب رسالة الخطأ
        $ERROR_QUERY = mysqli_error($conn);
        echo '<div class="alert alert-danger" role="alert">
        '.$ERROR_QUERY.' 
        </div>';
    }
}


?>