<?php
/** كود يعيد جميع المناطق التابعة لمحافظة ما  */
//  جلب البيانات  ( رقم المحافظة )
$city  = $_REQUEST["city"];
//  التحقق ان القيمة غير فارغة 
if(!empty($city)){
    //  الاتصال بقاعدة البيانات 
    include("../../../../lib/Php/connectdb.php");
    //  استعلام يعيد المناطق التباعة لمحافظة ما  
    $get_towns = "SELECT * FROM `residentialarea` WHERE `CityID` = '$city'";
    $query_get_towns = mysqli_query($conn,$get_towns);
    if($query_get_towns){
        //  الاستعلام صحيح
            if(mysqli_num_rows($query_get_towns)>0){
                //  وجد نتيجة 
                while($row = mysqli_fetch_array($query_get_towns)){
                    //  عرض النتيجة 
                    echo '
                        <option value="'. $row["ResidentionAreaID"].'" >
                        '. $row["ResidentionAreaName"].' 
                        </option>
                    ';
                }
            }else{
                // لم يجد اي منطقة 
                echo '
                        <option value="0" >
                       لا يوجد اي منطقة تابعة لهذه المحافظة 
                        </option>
                    ';
            }
    }else{
        // الاستعلام خاطئ
        $ERRORQUERY = mysqli_error($conn);
        echo '
        <option value="0" >
       '.$ERRORQUERY.'
        </option>
    '; 
    }
}

?>