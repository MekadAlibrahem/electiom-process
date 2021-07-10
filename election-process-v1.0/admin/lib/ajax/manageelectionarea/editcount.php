<?php
//  كود تعديل عدد المقاعدة الانتخابية المخصصة للدائرة الانتخابية 
//  جلب البيانات المطلوبة 
$id      = $_REQUEST['id'];
$count   = $_REQUEST["count"];
if($id<1 || empty($count)){
    // القيم فارغة 
    echo '<div class="alert alert-danger" role="alert">
    يجب إدخال رقم المنطقة الانتخابية و الاسم الجديد اولا
   </div>';
}else{
    //  القيم غير فارغة  
    //  الاتصال بقاعدة البيانات 
    include("../../../../lib/Php/connectdb.php");
    $recount = "UPDATE `electionareas` SET `Count` = '$count' WHERE `ElectionAreaID` = '$id'";
    $query_recount = mysqli_query($conn,$recount);
    if($query_recount){
        //الاستعلام صحيح 
        if(mysqli_affected_rows($conn)>0){
                // تم التعديل  
                //  عرض رسالة توضح نجاح التعديل  
                echo '<div class="alert alert-success" role="alert"> 
                تم تعديل عدد مقاعد  الدائرة الانتخابية بنجاح
                </div>' ;
        }else{
            // لم يتم التعديل => القيمة معدلة سابقا 
            //  عرض رسالة توضيحية 
            echo '<div class="alert alert-info" role="alert">
           إن هذه القيمة مسجلة بالفعل
            </div>';
        }
    }else{
        // Query recount : ERROR
        // لم ينفذ الاستعلام => يوجد خطأ
        // جلب رسالة الخطأ
        $ERROR_QUERY = mysqli_error($conn);
        echo '<div class="alert alert-danger" role="alert">
        '.$ERROR_QUERY.' 
        </div>';
    }
}


?>