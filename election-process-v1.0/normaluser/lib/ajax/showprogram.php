<?php
/**
 * كود لعرض البرامج الانتخابية لمرشح ما 
 */
// جلب البيانات ( رقم المرشح )
$id = $_REQUEST["id"];
if($id>0){
    //  القيمة غير  فارغة 
    //  الاتصال بقاعدة البيانات 
    include("../../../../lib/Php/connectdb.php");
    //  استعلام يعيد البرنانمج الانتخابي لمرشح 
    $get_programs = "SELECT `Content` FROM `electionprograms` WHERE `CandidateID` = '$id'";
    $queery_get_programs = mysqli_query($conn,$get_programs);
    if($queery_get_programs){
        // الاستعلام صحيح
            if(mysqli_num_rows($queery_get_programs)>0){
                //وجد نتيجة 
                
                while($row = mysqli_fetch_array($queery_get_programs)){
                    //  عرض النتيجة 
                    echo '<div class="well" >'.$row["Content"].'</div>';
                }

            }else{
                // لم يجد اي برنامج انتخابي
                //  عرض رسالة 
                echo '<div class="well" > لا يوجد اي برنامج انتخابي  </div>';
            }
    }else{
            //  يوجد خطأ في الاستعلام 
            $ERRORQUERY = mysqli_error($conn);
            echo '<div class="alert alert-danger" role="alert">'.$ERRORQUERY.'</div> ';
    }
}else{
    // id = 0  or empty 
}
?>