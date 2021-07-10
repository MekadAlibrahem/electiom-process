<?php
//  كود تعديل اسم دائرة انتخابية 
//  جلب بيانت المطلوبة  
$id     = $_REQUEST['id'];
$name   = $_REQUEST["name"];
//  التحقق من ان القيم غير فارغة  
if($id<1 || empty($name)){
    // القيم فارغة 
    echo '<div class="alert alert-danger" role="alert">
    يجب إدخال رقم المنطقة الانتخابية و الاسم الجديد اولا
   </div>';
}else{
    //  القيم غير فارغة  
    //  الاتصال بقاعدة البيانات 
    include("../../../../lib/Php/connectdb.php");
    //  استعلام تعديل تسم دائرة انتخابية 
    $rename = "UPDATE `electionareas` SET `ElectionAreaName` = '$name' WHERE `ElectionAreaID` = '$id'";
    $query_rename = mysqli_query($conn,$rename);
    if($query_rename){
        //الاستعلام صحيح 
        if(mysqli_affected_rows($conn)>0){
                // يوجد حقل متأثر بالاستعلام  
                //  تم تعديل الاسم 
                //  عرض رسالة توضح نتيجة التنفيذ 
                echo '<div class="alert alert-success" role="alert"> 
                تم تعديل اسم الدائرة الانتخابية بنجاح
                </div>' ;
        }else{
            // لم يتم التعديل : اما هذا الاسم معدل بالفعل او الدائرة الانتخابية غير مسجلة 
            //  عرض رسالة توضيحية 
            echo '<div class="alert alert-info" role="alert">
           إن هذه الاسم معدلة بالفعل
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