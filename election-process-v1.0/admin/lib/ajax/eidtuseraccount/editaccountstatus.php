<?php
// جلب القيم من طلب ajax 
$id         = $_REQUEST["id"];
$status     = $_REQUEST["status"];
// التأكد من ان القيم غير فارغة

if(empty($id)){
    echo '<div class="alert alert-danger" role="alert"> يجب ادخال الرقم الوطني اولا 
    </div>';

}else if($status != 1 && $status != 0 ){
    echo '<div class="alert alert-danger" role="alert"> يجب اختيار حالة حساب اولا 
    </div>';
}else{
    // الاتصال بقاعدة البيانات
    include("../../../../lib/Php/connectdb.php");
    // التحقق من صحة الرقم الوطني
    $select_account = "SELECT * FROM `useraccount` WHERE `NationalNumber` = '$id'";
    $query_select = mysqli_query($conn,$select_account);
    if($query_select){
        // تم تنفيذ الاستعلام عن صحة الرقم الوطني
            if(mysqli_num_rows($query_select)>0){ 
                // الرقم الوطني صحيح 
                // القيام بالتعديل
                $edit_type_account = "UPDATE `useraccount` SET `AccountStatus`='$status' WHERE  `NationalNumber` = '$id'";
                $query_edit = mysqli_query($conn,$edit_type_account);
                if($query_edit){
                    // تم تنفيذ الاستعلام
                        if(mysqli_affected_rows($conn)>0){
                            // يوجد حقل متأثر بالتعديل  => تم التعديل بنجاح
                            echo '<div class="alert alert-success" role="alert"> تم تعديل  بنجاح </div>' ;
                            
                        }else{
                            // لم يتأثر أي حقل بالتعديل => القيمة الجديدة = القيمة القديمة
                            echo '<div class="alert alert-info" role="alert">
                            إن هذه القيمة مسجلة بالفعل
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
            }else{
                // الرقم الوطني خاطئ
                echo '<div class="alert alert-danger" role="alert">
                إن الحساب المطلوب غير مسجل او الرقم الوطني غير صحيح
                </div>';
            }
    }else{
        // لم يتم تنفيذ الاستعلام عن الرقم الوطني 
        // جلب رسالة الخطأ
        $ERROR_QUERY = mysqli_error($conn);
            echo '<div class="alert alert-danger" role="alert">
            '.$ERROR_QUERY.' 
            </div>';
    }
    // اغلاق الاتصال بقاعدة البيانات بعد الانتهاء من الاستعلام 
    mysqli_close($conn);
}




?>