<!-- 205   --> 
<?php
//  كود يعيد المرشحين و عدد الاصوات لكل مرشح مرتبين من الاعلى 
//  جلب القيم المطلوبة ( رقم الدائرة الانتخابية و العملية الانتخابية )
$area       = $_REQUEST["id"];
$process    = $_REQUEST["process"];
if(empty($area) ){

}else if(empty($process)){

}else{
    include("../../../../lib/Php/connectdb.php");
    $number = get_number($process);
    
    /**
     * الناجحين يجب ان يكون نصفهم من العمال و الفلاحين  
     * لذلك تم تقسيم  عدد المقاعد على 2 
     * اذا كان عدد المقاعد = 1 وبتالي يجب أخذ مرشح وحيد فقط
     */
    $count  = get_count($area);
    $get_type = "SELECT `IDTypeProcess` FROM `electionprocess` WHERE `IDProcess` = '$process'";
$query_get_type = mysqli_query($conn,$get_type);
if($query_get_type){
    // query get type true 
    if(mysqli_num_rows($query_get_type)>0){
        // find process
        while($row = mysqli_fetch_array($query_get_type)){
            if($row["IDTypeProcess"] == 1 ){
                 //  كود عرض نتيجة استفتاء
                $get_result3 = "SELECT COUNT(`NationalNumber`) AS 'count' FROM `results` WHERE `IDProcess` = '$process' AND `Status` = '1' ";
                $query_get_result3 = mysqli_query($conn,$get_result3);
                if($query_get_result3){
                        // query get result 3 true 
                        if(mysqli_num_rows($query_get_result3)>0){
                            while ($row = mysqli_fetch_array($query_get_result3)) {
                                $percent = ($row["count"] / $number) * 100 ;
                                $percent2 = 100 -  $percent ;
                                $no_option = $number -  $row["count"] ; 
                                echo '
                                    <div class="col-lg-3 col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                    <div class="caption">
                                    <h3> الخيار نعم </h3>';
                                    echo '<p class="alert alert-info" >  نسبة الاصوات % '.$percent.'<br>
                                    عدد الاصوات : '.$row["count"].'  </p>';
                                    echo '
                                    </div>
                                    </div>
                                    </div>
                                    ';
                                    echo '
                                    <div class="col-lg-3 col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                    <div class="caption">
                                    <h3> الخيار لا </h3>';
                                    echo '<p class="alert alert-info" >  نسبة الاصوات % '.$percent2.'<br>
                                    عدد الاصوات : '. $no_option.'  </p>';
                                    echo '
                                    </div>
                                    </div>
                                    </div>
                                    ';

                            }
                        }else{

                        }
                }else{
                    //  ERROR GET RESULT 3 query 
                }

            }else{
                //  كور عرض نتيجة باقي انواع الانتخابات
                $count1 = $count / 2 ;
                $count2 = $count - $count1 ;
                
                if($count > 1){
                    $get_result  = "SELECT `results`.`CandidateID` , COUNT(*)AS 'count' , `candidates`.`FName` ,`candidates`.`currentwork` , `candidates`.`scientificlevel`, `candidates`.`NationalNumber` FROM `results` INNER JOIN `candidates` ON `candidates`.`CandidateID` = `results`.`CandidateID` WHERE `results`.CandidateID IN(SELECT `CandidateID` FROM `candidates` INNER JOIN `users` ON `candidates`.`NationalNumber` = `users`.`NationalNumber` WHERE `candidates`.`IDProcess` = '$process' AND `candidates`.`ElectionAreaID` = '$area' AND `users`.`jobID` IN (SELECT `jobID` FROM `users` WHERE `jobID` = '2' OR `jobID` = '4') ) GROUP by `CandidateID` ORDER BY COUNT(*) ASC  " ;
                    $query_get_result = mysqli_query($conn,$get_result);
                    if($query_get_result){
                        if(mysqli_num_rows($query_get_result)>0){
                            // find result  
            
                            $num = 1 ;
                            echo'<div><p> مرشحين عن العمال و الفلاحين </p>';
                            while($row = mysqli_fetch_array($query_get_result)){
                                $percent = ($row["count"] / $number) * 100 ;
                                if($num<= ($count1)){
            
                                    echo '
                                    <div class="col-lg-3 col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                    <div class="caption">
                                    <h3>'.$row["FName"].'</h3>';
                                    $date = get_date($row["NationalNumber"]);
                                    echo '<p> المواليد : '.$date.'</p> ';
                                    echo '<p> المستوى الدراسي : '.$row["scientificlevel"].' </p>';
                                    echo '<p> العمل الحالي : '.$row["currentwork"].' </p>' ;
                                
                                    echo '<p class="alert alert-info" >  نسبة الاصوات % '.$percent.'<br>
                                    عدد الاصوات : '.$row["count"].'  </p>';
                                    echo '<p class="alert alert-success" > ناجح  </p>';
                                    echo '
                                    </div>
                                    </div>
                                    </div>
                                    ';
                                    
                                }else{
                                    echo '
                                
                                    <div class="col-lg-3 col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                    <div class="caption">
                                    <h3>'.$row["FName"].'</h3>';
                                    $date = get_date($row["NationalNumber"]);
                                    echo '<p> المواليد : '.$date.'</p> ';
                                    echo '<p> المستوى الدراسي : '.$row["scientificlevel"].' </p>';
                                    echo '<p> العمل الحالي : '.$row["currentwork"].' </p>' ;
                                    echo '<p class="alert alert-info" >  نسبة الاصوات % '.$percent.'<br>
                                    عدد الاصوات : '.$row["count"].'  </p>';
                                    echo '
                                    </div>
                                    </div>
                                    </div>
                                    ';
                                }
                                $num = $num + 1 ;
                                
                            }
                            echo "</div>";
            
                        }else{
                            //  not found any result  
                            echo '<div > <p> مرشحين عن العمال و الفلاحين </p> لا يوجد </div>';
                        }
                    }else{
                        //  query :ERROR 
                    }
                    // إعادة باقي الناجحين من باقي الفئات
                    $get_result1  = "SELECT `results`.`CandidateID` , COUNT(*)AS 'count' , `candidates`.`FName` ,`candidates`.`currentwork` , `candidates`.`scientificlevel`, `candidates`.`NationalNumber` FROM `results` INNER JOIN `candidates` ON `candidates`.`CandidateID` = `results`.`CandidateID` WHERE `results`.CandidateID IN(SELECT `CandidateID` FROM `candidates` INNER JOIN `users` ON `candidates`.`NationalNumber` = `users`.`NationalNumber` WHERE `candidates`.`IDProcess` = '$process' AND `candidates`.`ElectionAreaID` = '$area' AND `users`.`jobID` NOT IN (SELECT `jobID` FROM `users` WHERE `jobID` = '2' OR `jobID` = '4') ) GROUP by `CandidateID` ORDER BY COUNT(*) ASC " ;
                    $query_get_result1 = mysqli_query($conn,$get_result1);
                    if($query_get_result1){
                        if(mysqli_num_rows($query_get_result1)>0){
                            // find result  
                        
                            
                            $num = 1 ;
                            echo'<div > <p> مرشحين عن باقي الفئات </p> ';
                            while($row = mysqli_fetch_array($query_get_result1)){
                                if($num<= ($count2)){
                                    echo '
                                    <div class="col-lg-3 col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                    <div class="caption">
                                    <h3>'.$row["FName"].'</h3>';
                                    $date = get_date($row["NationalNumber"]);
                                    echo '<p> المواليد : '.$date.'</p> ';
                                    echo '<p> المستوى الدراسي : '.$row["scientificlevel"].' </p>';
                                    echo '<p> العمل الحالي : '.$row["currentwork"].' </p>' ;
                                    echo '<p class="alert alert-info" >  نسبة الاصوات % '.$percent.'<br>
                                    عدد الاصوات : '.$row["count"].'  </p>';
                                    echo '<p class="alert alert-success" > ناجح  </p>';
                                    echo '
                                    </div>
                                    </div>
                                    </div>
                                    ';
                                    
                                }else{
                                    echo '
                                
                                    <div class="col-lg-3 col-sm-6 col-md-4">
                                    <div class="thumbnail">
                                    <div class="caption">
                                    <h3>'.$row["FName"].'</h3>';
                                    $date = get_date($row["NationalNumber"]);
                                    echo '<p> المواليد : '.$date.'</p> ';
                                    echo '<p> المستوى الدراسي : '.$row["scientificlevel"].' </p>';
                                    echo '<p> العمل الحالي : '.$row["currentwork"].' </p>' ;
                                    echo '<p class="alert alert-info" >  نسبة الاصوات % '.$percent.'<br>
                                    عدد الاصوات : '.$row["count"].'  </p>';
                                    echo '
                                    </div>
                                    </div>
                                    </div>
                                    ';
                                }
                                $num = $num + 1 ;
                                
                            }
                            echo "</div>";
            
                        }else{
                            echo '<div > <p> مرشحين عن باقي الفئات </p> لا يوجد </div>';
                            //  not found any result  
                        }
                    }else{
                        //  query :ERROR 
                    }
                }else{
                    $get_result1  = "SELECT `results`.`CandidateID` , COUNT(*)AS 'count' , `candidates`.`FName` ,`candidates`.`currentwork` , `candidates`.`scientificlevel`, `candidates`.`NationalNumber` FROM `results` INNER JOIN `candidates` ON `candidates`.`CandidateID` = `results`.`CandidateID` WHERE `results`.CandidateID IN(SELECT `CandidateID` FROM `candidates`  WHERE `candidates`.`IDProcess` = '$process' AND `candidates`.`ElectionAreaID` = '$area') GROUP by `CandidateID` ORDER BY COUNT(*) ASC " ;
                $query_get_result1 = mysqli_query($conn,$get_result1);
                if($query_get_result1){
                    if(mysqli_num_rows($query_get_result1)>0){
                        // find result  
                       
                        
                        $num = 1 ;
                        echo'<div class="will"> ';
                        while($row = mysqli_fetch_array($query_get_result1)){
                            $percent = ($row["count"] / $number) * 100 ;
                            if($num<= ($count2)){
                                echo '
                                <div class="col-lg-3 col-sm-6 col-md-4">
                                <div class="thumbnail">
                                <div class="caption">
                                <h3>'.$row["FName"].'</h3>';
                                $date = get_date($row["NationalNumber"]);
                                echo '<p> المواليد : '.$date.'</p> ';
                                echo '<p> المستوى الدراسي : '.$row["scientificlevel"].' </p>';
                                echo '<p> العمل الحالي : '.$row["currentwork"].' </p>' ;
                                echo '<p class="alert alert-info" >  عدد الاصوات  '.$row["count"].'  </p>';
                                echo '<p class="alert alert-success" > ناجح  </p>';
                                echo '
                                </div>
                                </div>
                                </div>
                                ';
                                
                            }else{
                                echo '
                            
                                <div class="col-lg-3 col-sm-6 col-md-4">
                                <div class="thumbnail">
                                <div class="caption">
                                <h3>'.$row["FName"].'</h3>';
                                $date = get_date($row["NationalNumber"]);
                                echo '<p> المواليد : '.$date.'</p> ';
                                echo '<p> المستوى الدراسي : '.$row["scientificlevel"].' </p>';
                                echo '<p> العمل الحالي : '.$row["currentwork"].' </p>' ;
                                echo '<p class="alert alert-info" >  عدد الاصوات  '.$row["count"].'  </p>';
                                echo '
                                </div>
                                </div>
                                </div>
                                ';
                            }
                            $num = $num + 1 ;
                            
                        }
                        echo "</div>";
            
                    }else{
                        //  not found any result  
                    }
                }else{
                    //  query :ERROR 
                }
                    
                }
            }
        }
    }else{
        // not found any process
    }
}else{
// query get type error 
}
    
    
    
    
}
function get_date($id){
    include("../../../../lib/Php/connectdb.php");
    $date = 0 ;
    $select_date = "SELECT `BirthDate` FROM `users` WHERE `NationalNumber` = '$id'";
    $query = mysqli_query($conn,$select_date);
    if($query){
        if(mysqli_num_rows($query)>0){
            while($row = mysqli_fetch_array($query)){
                $date =  $row["BirthDate"];
            }
        }else{
            $date = 0 ;
        }
    }else{
        $date =  0 ;
    }
    mysqli_close($conn);
    return $date ;
}
/** 
 * دالة تعيد عدد المقاعد الانتخابية المتاحة لدائرة الانتخابية 
 * @param int $area : رقم الدائرة الانتخابية 
 * @return int $count : عدد المقاعد الانتخابية المتاحة 
 * @return int  -1 : في حال يوجد خطأ
 *  
 */
function get_count($area){
    include("../../../../lib/Php/connectdb.php");
    $count = 0 ; 
    $get_count  = "SELECT `Count` FROM `electionareas` WHERE `ElectionAreaID` = '$area'";
    $query_get_count = mysqli_query($conn,$get_count);
    if($query_get_count){
        if(mysqli_num_rows($query_get_count)>0){
            while($row = mysqli_fetch_array($query_get_count)){
                $count = $row["Count"];
                return $count ;
            }
        }else{
            //  لم يجد الدائرة الانتخابية المطلوبة
            return -2 ;
        }

    }else{
        // ERROR QUERY 
        return -1 ;
    }
}
/**
 * دالة تعيد عدد الناخبين لعملية انتخابية 
 * @param int $process :  رقم العملية الانتخابية
 * @return int $number : عدد الناخبين
 */
function get_number($process){
    
    include("../../../../lib/Php/connectdb.php");
    $get_number = "SELECT COUNT(`NationalNumber`) AS 'count' FROM `electionstatus` WHERE `IDProcess` = '$process' ";
    $query_number = mysqli_query($conn,$get_number);
    if($query_number && mysqli_num_rows($query_number)>0){
       while($row =  mysqli_fetch_array($query_number)){
        return $row["count"];
        }
    }else{
        return 0 ;
    }

}

?>