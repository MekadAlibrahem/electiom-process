<?php
// كود تعديل   اسم العملية الانتخابية 
//  جلب اليانات المطلوبة 
$id      = $_REQUEST["id"];
$pname   = $_REQUEST["pname"];
//  التحقق من ان القيم غير فارغة  
if(empty($id)){
    echo '<div class="alert alert-danger" role="alert"> يجب إدخال رقم العملية الانخابية اولا 
    </div>';
}else if(empty($pname)){
    echo '<div class="alert alert-danger" role="alert">يجب إدخال اسم للعملية الانتخابية
    </div>';
}else{
    // جميع القيم صحيحة وغير فارغة 
    //  التصال بقاعدة البايانات  
    include("../../../../lib/Php/connectdb.php");
    //  استدعاء ملف يحوي دالة البحث عن دائرة انتخابية 
    include("selectelectionprocess.php");
    //الدالة التالية تعيد صح في حال وجد العملية الانتخابية و خطأ في حال لم يجدها
    $re = select_id($id);
    if($re == true){
        // وجد العملية الانتخابية
        // الاستعلام الخاص بتعديل اسم العملية الانتخابية
        $edit_name = "UPDATE `electionprocess` SET `nameP` ='$pname' WHERE `IDProcess` = '$id' " ;
        $query_edit_name = mysqli_query($conn,$edit_name);
        if($query_edit_name){
            // TRUE QUERY
            if(mysqli_affected_rows($conn)>0){
                // يوجد حقل تأثر بالتعديل => تم التعديل بنجاح
                echo '<div class="alert alert-success" role="alert"> تم تعديل  بنجاح </div>' ;
                            
            }else{
                //لم يتأثر أي حقل => القيم الدخلة = القيمة القديمة
                echo '<div class="alert alert-info" role="alert">
               لم يتم التعديل ! هذا الاسم مسجل بالفعل 
                </div>';
            }
        }else{
            // ERROR IN QUERY
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