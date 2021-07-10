<?php
/**  كود حذف نوع عملية انتخابية  */
//  جلب البيانات  ( رقم نوع العملية الانتخابية ) 
$id         = $_REQUEST["id"];
//  التحقق من ان القيم غير فارغة 
if(empty($id)){
    echo '<div class="alert alert-danger"      role="alert">
    يجب إدخال رقم نوع العملية المطلوبة اولا
    </div>'; 
}else{
    /**  قبل حذف نوع يجب التأكد ان هذا النوع مسجل سابقا  */
    // استدعاء ملف يتضمن دالة البحث 
    include("selecttype.php");
    //  استدعاء دالة تحديد النوع 
    $re = select_type($id);
    if($re == true){
        //  النوع مسجل سابقا 
        // الاتصال بقاعدة البيانات 
        include("../../../../lib/Php/connectdb.php");
        //  استعلام لحذف نوع انتخابيات 
        $eidt_type = "DELETE FROM `typeprocess`  WHERE `IDTypeProcess` = '$id'  ";
        $query_edit = mysqli_query($conn,$eidt_type);
        if($query_edit){
                // الاستعلام صحيح
                if(mysqli_affected_rows($conn)>0){
                    // يوجد حقل متأثر  => تم حذف 
                    //  عرض رسالة توضح حالة التنفيذ 
                    echo '<div class="alert alert-success" role="alert"> تم الحذف   بنجاح </div>' ;
                
                }else{
                    // لم يتم الحذف
                    echo '<div class="alert alert-info"      role="alert">
                        لم يتم الحذف 
                    </div>'; 
                }
        }else{
            //  الاستعلام خاطئ 
            //  عرض رسالة الخطأ
            $ERROR = mysqli_error($conn);
            echo '<div class="alert alert-danger"      role="alert">
            '.$ERROR.'
            </div>'; 
        }
        mysqli_close($conn);
    }else{
        // لم يجد النوع المطلوب 
        echo '<div class="alert alert-danger"      role="alert">
        إن الرقم المدخل غير مسجل يجب التأكد من صحة الرقم 
        </div>'; 
    }
}
    
        //-------------------
        

                   
         


?>