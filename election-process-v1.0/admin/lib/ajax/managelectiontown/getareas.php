<?php
/** كود  يعيد المناطق التابعة لدائرة انتخابية  و المحافظة التابعة لها  */
//  جلب البيانات 
$area  = $_REQUEST["area"];
//  الاتصال بقاعدة البينات 
include("../../../../lib/Php/connectdb.php");
//  استعلام يعيد معلومات المناطق الانتخابية التابعة لدائرة انتخابية ما 
$get_town = "SELECT * FROM  `residentialarea` WHERE `ResidentionAreaID`IN(SELECT `ResidentionAreaID` FROM `electionareadatils` WHERE `ElectionAreaID` = '$area') ";
$query_get_towns = mysqli_query($conn,$get_town);
if($query_get_towns){
    // الاستعلام صحيح
    if(mysqli_num_rows($query_get_towns)>0){
        // وجد نتيجة 
        // 
        while($row = mysqli_fetch_array($query_get_towns)){
            $town = $row["ResidentionAreaID"];
            $townName = $row["ResidentionAreaName"];
            //  استعلام يعيد اسم المحافظة التابعة لها كل منطقة 
        $get_city  = "SELECT * FROM `city` WHERE `CityID` = (SELECT `CityID`  FROM  `residentialarea` WHERE `ResidentionAreaID` = '$town')";
        $query_get_city  = mysqli_query($conn,$get_city);
        if($query_get_city){
            // استعلاو اعادة محافظة صحيح
            
            while($col = mysqli_fetch_array($query_get_city)){
                //  عرض النتيجة 
                $city = $col["CityName"];
                echo '
                    <tr>
                        <td>
                            '.$townName.'
                        </td>
                        <td>
                            '.$city.'
                        </td>

                    </tr>
                
                ';
            }
        }else{
            // خطأ في الاستعلام 
            $ERROR = mysqli_error($conn);
            echo '<div class="alert alert-danger" role="alert">'.$ERROR.'
            </div>';

        }
        }
    }else{
        // لم يجد اي منطقة تابعة لهذه الدائرة الانتخابية 
        echo '<div class="alert alert-info" role="alert">
              لا يوجد أي منطقة تابعة لهذه الدائرة الانتخابية
                </div>' ;

    }
}else{
    // يوجد خطأ في استعلام يعيد الدوائر الانتخابية 
    $ERROR = mysqli_error($conn);
    echo '<div class="alert alert-danger" role="alert">'.$ERROR.'
    </div>';

}

?>