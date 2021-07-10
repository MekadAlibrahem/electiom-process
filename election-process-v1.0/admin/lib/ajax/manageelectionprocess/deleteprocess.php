<?php

$id      = $_REQUEST["id"];

if(empty($id)){
    echo '<div class="alert alert-danger" role="alert"> يجب إدخال رقم العملية الانخابية اولا 
    </div>';

}else{
    // جميع القيم صحيحة وغير فارغة 
    //   الاتصال بقاعدة البيانات 
    include("../../../../lib/Php/connectdb.php");
    //  استدعاء ملف للبحث عن دائرة انتخابية 
    include("selectelectionprocess.php");
    //الدالة التالية تعيد صح في حال وجد العملية الانتخابية و خطأ في حال لم يجدها
    $re = select_id($id);
    if($re == true){
        // وجد العملية الانتخابية
        // الاستعلام الخاص بحذف اسم العملية الانتخابية
        $edit_name = "DELETE FROM `electionprocess` WHERE `IDProcess` = '$id' " ;
        $query_edit_name = mysqli_query($conn,$edit_name);
        if($query_edit_name){
            // TRUE QUERY
            if(mysqli_affected_rows($conn)>0){
                // يوجد حقل تأثر بلاستعلام => تم الحذف القيمة بنجاح
                echo '<div class="alert alert-success" role="alert"> تم الحذف  بنجاح </div>' ;
                            
            }else{
                //لم يتأثر أي حقل => القيكة المدخلة = القيمة القديمة
                echo '<div class="alert alert-info" role="alert">
                يوجد خطأ ما لم يتم الحذف
                </div>';
            }
        }else{
            // يوجد خطأ في صيغة الاستعلام
            $ERROR = mysqli_error($conn);
            echo '<div class="alert alert-danger" role="alert">'.$ERROR.'
            </div>';
        }
    }else{
        //  لم يجد العملية الانتخابية => العملية الانتخابية المطلوبة غير مسجلة او الرقم المدخل غير صحيح
        echo '<div class="alert alert-danger" role="alert">
        إن العملية الانتخابية المطلوبة غير مسجلة او الرقم المدخل غير صحيح 
         </div>';
    }

}


?>
