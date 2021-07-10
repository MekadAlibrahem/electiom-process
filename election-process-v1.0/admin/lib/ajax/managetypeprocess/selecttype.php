<?php
    //  دالة تعيد صح اذا كانت النوع موجود و خطأ في حال لم تجده 
function select_type($id){
    //  الاتصال بقاعدة البيانات
    include("../../../../lib/Php/connectdb.php");
    // استعلام يعيد نوع عملية انتخابية 
    $select_type = "SELECT * FROM `typeprocess` WHERE `IDTypeProcess` = '$id' ";
    $query_type = mysqli_query($conn,$select_type);
    if($query_type){
        //  الاستعلام صحيح 
        if(mysqli_num_rows($query_type)>0){
            //  وجد قيمة 
            
            return true ;
        }else{
            //  لم يجد قيمة 
            return false ;
        }
    }else{
        //  يوجد خطأ في الاستعلام 
        return false ;
    }
}

?>