<?php
//  دالة تعيد العمليات الانتخابية المتاحة للانتخاب
/**
 * يتم عرض جميع العمليات الانتخابية التي انتهى تاريخ الترشح لها ( يتم عرض بيانات المرشحين و البراج الانتخابية فقط  
 * التصويت لعملية انتخابية يتم بين تاريخ بداية الانتخاب و تاريخ نهاية الانتخاب  )
 */
function get_process(){
    //  الاتصال بقاعدة البيانات 
    include("../../../../lib/Php/connectdb.php");
    //  استعلام يعيد العمليات الانتخابية التي تجاوزت تاريخ نهاية الترشح  
    $select_process = "SELECT * FROM `electionprocess` WHERE DATE(`EndDate`)> DATE(CURDATE()) AND DATE(`EndDateCandidature`) < DATE(CURDATE())  " ;
    $query_process = mysqli_query($conn,$select_process);
    if($query_process){
        //  الاستعلام صحيح 
        echo "<option value='0'  > اختر عملية انتخابية  </option> ";
        if(mysqli_num_rows($query_process)>0){
            // وجد نتيجة  
            //  عرض النتيجة ( العمليات الانتخابية المتاحة )
            while($row = mysqli_fetch_array($query_process)){
                echo "<option value=".$row['IDProcess']."> ".$row['nameP']." </option> ";
            }
        }else{
            //  لم يجد اي عملية انتخابية متاحة حاليا 
            echo "<option value='0'  > لا يوجد عمليات انتخابية متاحة حاليا   </option> ";
        }
    }else{
        //  يوجد خطأ في الاستعلام 
    }
    //  إغلاق الاتصال بقاعدة البيانات 
    mysqli_close($conn);
}
/**
 * دالة تعيد العمليات الانتخابية التي انتهت 
 *  لا يوجد وسطاء  
 * @return  int  : idprocess
 */
function get_process_end(){
    //  الاتصال بقاعدة البيانات 
    include("C:/xampp/htdocs/Mekadv2.0/lib/Php/connectdb.php");
        //  استعلام يعيد العمليات الانتخابية التي انتهت فترة الانتخاب بها  
        $select_process = "SELECT * FROM `electionprocess` WHERE DATE(`EndDate`)< DATE(CURDATE()) " ;
        $query_process = mysqli_query($conn,$select_process);
        if($query_process){
            //  الاستعلام صحيح
            echo "<option value='0'  > اختر عملية انتخابية  </option> ";
            if(mysqli_num_rows($query_process)>0){
                // وجد نتيجة  
                //  عرض النتيجة ( العمليات الانتخابية المتاحة )
                while($row = mysqli_fetch_array($query_process)){
                    echo "<option value=".$row['IDProcess']."> ".$row['nameP']." </option> ";
                }
            }else{
                //  لم يجد اي عملية انتخابية متاحة حاليا 
                echo "<option value='0'  > لا يوجد عمليات انتخابية متاحة حاليا   </option> ";
            }
        }else{
            //الاستعلام خاطئ 
        }
}

/**
 * دالة تعيد الحساب الى الصفحة الاساسية له ( ناخب - مدير - موظف - الصفحة الاساسية للموقع)
 * @param int  $id : الرقم الوطني 
 */
function gotohomepage($id = 0){
    if($id == 0 ){
        echo ' <script type="text/javascript">
                location.href = "../index.php";
                </script>';
    }else{
        include("../../../../lib/Php/connectdb.php");
        $get_type = "SELECT `TypeAccountID` , `AccountStatus` FROM `useraccount` WHERE `NationalNumber` = '$id'  " ;
        $query = mysqli_query($conn,$get_type);
        if($query){
            if(mysqli_num_rows($query)>0){
                // find result 
                $type = 0 ; 
                $status = 0 ; 
                while($row = mysqli_fetch_array($query)){
                    $type  = $row["TypeAccountID"];
                    $status = $row["AccountStatus"]; 
                }
                if($status == 1 ){
                    switch ($type) {
                        case 1:
                           echo ' <script type="text/javascript">location.href = "../admin/HomePage.php";</script>';
                            
                            break;
                        case 2:
                            echo ' <script type="text/javascript">
                            location.href = "../employee/homepage.php";
                            </script>';
                           
                            break;
                        case 3:
                            echo ' <script type="text/javascript">
                            location.href = "../candidate/HomePage.php";
                            </script>';
                            
                            break;
                        case 4:
                            echo ' <script type="text/javascript">
                            location.href = "homepage.php";
                            </script>';
                            
                            break; 
                    
                    default:
                        echo ' <script type="text/javascript">
                        location.href = "../index.php";
                        </script>';
                        
                        break;
                    }
                }
                
            }else{
                // not found any result 
                echo ' <script type="text/javascript">
                location.href = "../index.php";
                </script>';
                
            }

        }else{
            echo ' <script type="text/javascript">
                        location.href = "../index.php";
                        </script>';
           
        }
        mysqli_close($conn);
    }
}
/**
 * دالة تختبر حساب المستخدم 
 * @param int userid = 0 : الرقم الوطني للمستخدم 
 * @param int type   = 0 :  نوع الحساب الذي سيتم اختباره 
 * @return int  0 :  true account 
 * @return ? false  got to sign-in page 
 */
function testuserID($userid =0 , $type=0){
    if($userid == 0 || $type==0){
        header("location: ../sign-in.php ");
    }else{
        include("../../../../lib/Php/connectdb.php");
    $test = "SELECT `TypeAccountID` , `AccountStatus` FROM `useraccount`  WHERE `NationalNumber` = '$userid' " ;
    $query = mysqli_query($conn,$test);
    if($query){
            // query : true
            if(mysqli_num_rows($query)>0){
                // found account 
                while($row = mysqli_fetch_array($query)){
                    $id = $row["TypeAccountID"] ;
                    $status = $row["AccountStatus"];
                }
                mysqli_close($conn);
                if($status == 1){
                    // type account true
                    return 0;
                }else{
                    // type account false 
                    mysqli_close($conn);
                    header("location: ../sign-in.php ");
                }
            }else{
                // not found any result  :  national number false 
            }
    }else{
        // query :ERROR
    }
    mysqli_close($conn);
    }
}

?>