<?php
//  كود البحث عن عملية انتخابية عن طريق الاسم  
/**
 *  قبل القيام باي تعديل يجب التاكد من ان العملية الانتخابية مسجلة سابقا  
 */
    function select_id($id){
        //  الاتصال بقاعدة البيانات 

        include("../../../../lib/Php/connectdb.php");
        //  استعلام البحث عن دائرة انتخابية 
        $select_id = "SELECT * FROM `electionprocess` WHERE `IDProcess` = '$id'";
        $queru_select_id = mysqli_query($conn,$select_id);
        if($queru_select_id){
            //  الاستعلام صحيح 
                if(mysqli_num_rows($queru_select_id)>0){
                    //  وجد الدائرة الانتخابية 
                    return true ;

                }else{
                    //  لم يجد الدائرة الانتخابية 
                    return false ;
                }
        }else{
            //  يوجد خطأ في الاستعلام  
            return false ; 
            
        }
        mysqli_close($conn);
    }
    
?>