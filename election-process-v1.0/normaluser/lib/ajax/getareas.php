<?php
/** كود يعيد الدوائر الانتخابية لعملية انتخابية محددة   */
//  جلب البيانات ( رقم العملية الانتخابية المحددة )
$id = $_REQUEST["id"];
if($id>0){
    //  الرقم غير فارغ 
    //  الاتصال بقاعدة البيانات 
    include("../../../../lib/Php/connectdb.php");
    /** قبل عرض دوائر انتخابية يجب إعادة نوع العملية الانتخابية لانه الدوائر الانتخابية مقسمة حسب نوع الانتخابات 
     * 
     */
    //  استعلام يعيد نوع العملية الانتخابية 
    $get_type = "SELECT `IDTypeProcess` FROM `electionprocess` WHERE `IDProcess` = '$id' ";
    $query_get_type  = mysqli_query($conn,$get_type);
    if($query_get_type){
        //  استعلام صحيح 
        if(mysqli_num_rows($query_get_type)>0){
            // وجد نتيجة 
            $type = 0;
            while($row = mysqli_fetch_array($query_get_type)){
                //  تخزين النتيجة ( نوع العملية الانتخابية ) في متغير 
                $type  = $row['IDTypeProcess'];
            }
            //  استعلام يعيد دوائر الانتخابية حسب نوع الانتخابات 
            $get_area = "SELECT * FROM `electionareas` WHERE `IDTypeProcess` = '$type' ";
            $query_get_area = mysqli_query($conn,$get_area);
            if($query_get_area){
                // الاستعلام صحيح
                if(mysqli_num_rows($query_get_area)>0){
                    //  وجد دوائر انتخابية 
                    //  عرض النتيجة 
                    echo '<select name="areaID" id="area" class="form-control" onchange="get_candidates(this.value);" >';
                    echo"<option value='0'  > اختر دائرة انتخابية  </option> " ;
                    while($row = mysqli_fetch_array($query_get_area)){
                        echo "<option value='".$row['ElectionAreaID']."'>".$row['ElectionAreaName']."</option>";
                    }
                    echo '</select>';
                }else{
                    //لم يجد اي دائرة انتخابية 
                    echo"<option value='0'  > لا يوجد اي دائرة انتخابية متاحة لهذه العملية   </option> " ;
                }
            }else{
                //الاستعلام خطأ
                $ERRORQUERY  = mysqli_error($conn);
                echo"<option value='0'  > ".$ERRORQUERY."  </option> " ;
            }

        }else{
            //لم يجد نوع العملية الانتخابية 
        }
    
    }else{
        //  خطأ في الاستعلام 


    }   
    //  إغلاق الاتصال 
    mysqli_close($conn);
}


?>