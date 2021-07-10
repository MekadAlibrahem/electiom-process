<?php
/** كود يعيد جميع انواع العمليات الانتخابية المسجلة */
//  الاتصال بقاعدة البيانات 
include("../../../../lib/Php/connectdb.php");
//     استعلام يعيد جميع الانواع مرتبة تبعا لرقم النوع  
   $select_type = "SELECT * FROM `typeprocess`ORDER BY `typeprocess`.`IDTypeProcess` ASC";
   $query_select =mysqli_query($conn,$select_type);
   if($query_select){
    //     الاصتعلام صحيح
        if(mysqli_num_rows($query_select)>0){
            //  يوجد انواع مسجلة
            while($row =mysqli_fetch_array($query_select)){
                //  عرض النتيجة 
                echo "<tr>";
                echo "<td class='result' >".$row['Type']." </td>";
                echo "<td class='result' >".$row['IDTypeProcess']." </td>";
                echo "</tr>";
            }

        }else{
            //لم يجد اي نتيجة 
            //  عرض قيمة فارغة 
            echo "<tr>";
            echo "<td class='result'  colspan='2'>
            لا يوجد اي نوع مسجل حاليا
             </td>";
            echo "</tr>";

        }
   }else{
       // الاستعلام خاطئ 
    //     عرض رسالة خطأ
       $ERROR  =mysqli_error($conn);
    echo "<tr>";
    echo "<td class='result'  colspan='2'>
        ".$ERROR."
     </td>";
    echo "</tr>";
   } 
//     اغلاق الاتصال بقاعدة البيانات 
   mysqli_close($conn);

?>