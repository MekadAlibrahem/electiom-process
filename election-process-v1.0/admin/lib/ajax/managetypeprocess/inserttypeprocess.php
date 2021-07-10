<?php 
/** كود إضافة نوع جديد */
//  جلب البيانات ( الرقم و النوع)
//  ملاحظة ممكن الرقم فارغ لان الترقيم تلقائي في قاعدة البيانات 
$id         = $_REQUEST["id"];
$type       = $_REQUEST["type"];
//  التحقق من ان النوع غير فارغ 
if(empty($type)){
    echo '<div class="alert alert-danger" role="alert">
    يجب إدخال نوع العملية الانتخابية 
    </div>';
}else{
    //  الاتصال بقاعدة البيانات
    include("../../../../lib/Php/connectdb.php");
    //  التحقق من ان الرقم غير فارغ 
    if($id  != null){
        //  الرقم غير فارغ 
         /**  
         * قبل إدخال نوع جديد يجب التاكد من ان الرقم المدخل غير مستخدم سابقا 
         */
        // استدعاء ملف يتضمن دالة البحث 
        include("selecttype.php");
        //  استدعاء دالة البحث  
        $re = select_type($id);
        if($re == true){
            //  الرقم مستخدم لنوع اخر 
            //  عرض رسالة بذلك 
            echo '<div class="alert alert-danger"      role="alert">
             إن الرقم المدخل مستخدم سابقا 
             </div>'; 
        }else{
            //  استعلام إضافة نوع جديد مع رقم محدد
            $insert_type = "INSERT INTO `typeprocess`(`IDTypeProcess`, `Type`) VALUES ($id,'$type')";
            $query_insert = mysqli_query($conn,$insert_type);
        }
    }else{
        //  الرقم فارغ 
        //  استعلام إضافة نوع جديد مع رقم غير محدد( ترقيم تلقائي )
        $insert_type = "INSERT INTO `typeprocess`(`IDTypeProcess`, `Type`) VALUES (null,'$type')";
        $query_insert = mysqli_query($conn,$insert_type);
    }
    if($query_insert){
        //  الاستعلام صحيح
            if(mysqli_affected_rows($conn)>0){
                //  يوجد حقل متأثر بالاستعلام  => تم الإضافة بنجاح 
                //  عرض رسالة تتوضح نتيجة التنفيذ 
                echo '<div class="alert alert-success" role="alert">
                 تم الإضافة  بنجاح
                  </div>' ;
            }else{
                //  لم تتم الإضافة  
                //  عرض رسالة  
                echo '<div class="alert alert-danger"      role="alert">
                لم يتم إضافة النوع يجب التأكد من صحة البيانات المدخلة
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
    //  إغلاق اتصال قاعدة البيانات
    mysqli_close($conn);
}
?>