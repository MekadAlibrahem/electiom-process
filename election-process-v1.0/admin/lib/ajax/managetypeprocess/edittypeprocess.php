<?php
/** كود  تعديل نوع الانتخاب  */
//  جلب البيانات المطلوبة ( رقم و النوع الجديد )
$id         = $_REQUEST["id"];
$type       = $_REQUEST["type"];
//  التحقق من ان القيم غير فارغة 
if(empty($type)){
    echo '<div class="alert alert-danger" role="alert">
    يجب إدخال نوع العملية الانتخابية 
    </div>';
}else if(empty($id)){
    echo '<div class="alert alert-danger"      role="alert">
    يجب إدخال رقم نوع العملية المطلوبة اولا
    </div>'; 
}else{
    //  القيم غير فارغة
     /**  قبل تعديل نوع يجب التأكد ان هذا النوع مسجل سابقا  */
    // استدعاء ملف يتضمن دالة البحث 
    include("selecttype.php");
    //  استدعاء دالة البحث عن نوع انتخابات 
    $re = select_type($id);
    if($re == true){
        //  النوع مسجل
        //  الاتصال بقاعدة البيانات 
        include("../../../../lib/Php/connectdb.php");
        //  الاستعلام تعديل نوع عملية انتخابية 
        $eidt_type = "UPDATE `typeprocess` SET `type` ='$type' WHERE `IDTypeProcess` = '$id'  ";
        $query_edit = mysqli_query($conn,$eidt_type);
        if($query_edit){
                // الاستعلام صحيح
                if(mysqli_affected_rows($conn)>0){
                    //يوجد حقل متأثر من الاستعلام 
                    //  تم التعديل 
                    //  عرض رسالة توضح نجاح التعديل 
                    echo '<div class="alert alert-success" role="alert"> تم تعديل  بنجاح </div>' ;
                
                }else{
                    // لا يوجد اي حقل متأثر بالتعديل و بالتالي القيمة الجديدة نفس  القديمة 
                    // عرض رسالة 
                    echo '<div class="alert alert-info"      role="alert">
                    إن هذه القيمة مسجلة بالفعل 
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
        // لم يجد النوع المحدد
        //  عرض رسالة الخطأ
        echo '<div class="alert alert-danger"      role="alert">
        إن الرقم المدخل غير مسجل يجب التأكد من صحة الرقم 
        </div>'; 
    }
}
    
        //-------------------
        

                   
         


?>