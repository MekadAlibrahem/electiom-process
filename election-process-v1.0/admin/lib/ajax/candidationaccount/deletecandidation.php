<?php
//  كود حذف حساب مرشح  
// جلب البيانات المطلوبة 
    $id = $_REQUEST["id"];
    
    //  الاتصال بقاعدة البيانات
    include("../../../../lib/Php/connectdb.php");
    //  استعلام حذف مرشح
    $delet = "DELETE  FROM `candidates` WHERE `CandidateID` = '$id' ";
    $query_delete = mysqli_query($conn,$delet);
    if($query_delete){
        // الاستعلام صحيح 
        if(mysqli_affected_rows($conn)>0){
            //  يوجد حقل متأثر بالاستعلام  
            //  عرض رسالة حالة التنفيذ 
            echo '<div class="alert alert-success" role="alert"> 
            تم حذف البيانات بنجاح
            </div>';
            echo '<div class="alert alert-info" role="alert"> 
            يجب تغير نوع السحاب السابق الى نوع اخر غير المرشح إذا لم يكن مشارك في عملية انتخابية ثانية
            </div>';

        }else{
            //  لم يجد نتيجة 
            //  حذف الحساب لم يتم  
            //  عرض رسالة حالة التنفيذ
            echo '<div class="alert alert-info" role="alert"> 
            لم يتم الحذف إن البيانات المدخلة غير مسجلة سابقا
            </div>';
        }
    }else{
        // يوجد خطأ في الاستعلام  
        //  عرض رسالة خطأ   
        //  دالة تعيد رسالة الخطأ في الاستعلام عن طريق معرف الاتصال بقاعدة البيانات 
        $ERRORQUERY = mysqli_error($conn);
        echo '<div class="alert alert-danger" role="alert"> 
        '.$ERRORQUERY.'
        </div>';
    }

?>