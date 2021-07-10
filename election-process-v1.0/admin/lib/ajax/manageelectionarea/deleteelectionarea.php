<?php
// كود حذف دائرة انتخابية 
//  جلب رقم الدائرة الانتخابية  
$id = $_REQUEST["id"];
if($id<1){
    //  التحقق من ان القيمة غير فارغة 
    echo '<div class="alert alert-danger" role="alert">
     يجب إدخال رقم المنطقة الانتخابية اولا
    </div>';
}else{
    //  القيمة فارغة  
    //  الاتصال باعدة البيانات  
    include("../../../../lib/Php/connectdb.php");
    $delet_election_area = "DELETE FROM `electionareas` WHERE `ElectionAreaID` = '$id'";
    $query_delete = mysqli_query($conn,$delet_election_area);
    if($query_delete){
        //الاستعلام صحيح
        if(mysqli_affected_rows($conn)>0){
            // يوجد حقل تأثر بالاستعلام و بالتالي تم الحذف 
            //  عرض رسالة تةضح نجاح الحذف 
            echo '<div class="alert alert-success" role="alert"> 
            تم حذف الدائرة الانتخابية بنجاح
            </div>' ;
                                
        }else{
            // لم يتم حذف اي منطقة  
            //  المنطقة غير مسجلة او الرقم خاطئ  
            //  عرض رسالة توضح  الخطأ 
            echo '<div class="alert alert-info" role="alert">
                لم يتم الحذف رما الرقم خاطأ او الدائرة الانتخابية غير مسجلة سابقا
                </div>';

        }
    }else{
        // لم ينفذ الاستعلام => يوجد خطأ
        // جلب رسالة الخطأ
        $ERROR_QUERY = mysqli_error($conn);
        echo '<div class="alert alert-danger" role="alert">
        '.$ERROR_QUERY.' 
        </div>';
    }
}

?>