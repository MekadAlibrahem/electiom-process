<?php
//  دالة تعيد اسماء لمحافظات  
    function selectcity(){
        //  الاتصال بقاعجة البيانات 
        include("../../../../lib/Php/connectdb.php");
        //  استعلام يعيد المعلومات عن كل محافظة مسجلة 
        $select_city = "SELECT * FROM `city` " ;
        $query_city = mysqli_query($conn,$select_city);
        if(mysqli_num_rows($query_city)>0){
            //  وجد نتيجة 
            echo "<option  value='0' >  
            اختر محافظة 
            </option>";
            while($row = mysqli_fetch_array($query_city)){
                //  عرض نتيجة الاستعلام  
                echo "<option value='".$row['CityID']."' >" ;
                echo $row['CityName'];
                echo"</option>" ;
            }
            
        }else{
            //  لم يجد اي محافظة مسجلة 
            echo "<option  value='0' >  
            لا يوجد اي محافظة مسجلة 
            </option>";
        }
        //  اغلاق الاتصال بقاعدة البيانات 
        mysqli_close($conn);
    }
//  دالة غير مستخدمة في صفحة townpage.php
    function selecteelectionareas(){
        include("../../../../lib/Php/connectdb.php");
        $select = "SELECT * FROM `electionareas` " ;
        $query = mysqli_query($conn,$select);
        if(mysqli_num_rows($query)>0){
            
            while($row = mysqli_fetch_array($query)){
                echo "<option value='".$row['ElectionAreaID']."' >" ;
                echo $row['ElectionAreaName'];
                echo"</option>" ;
            }
           
        }
        mysqli_close($conn);
    }
//---------------------------------------------------------

$GLOBALS["RESULT"]    = "" ;
$GLOBALS["ERRORNAME"] = "" ;
$GLOBALS["ERRORCITY"] = "" ;
// دالة التحقق من القيم المدخلة 
function testvalues($name,$city){
    $result = true ;
    if(empty($name)){
        $GLOBALS["ERRORNAME"] = '<div class="alert alert-danger" role="alert">  هذا الحقل مطلوب    </div> ';
        $result = false ;
    }
    if(empty($city)){
        $GLOBALS["ERRORCITY"] = '<div class="alert alert-danger" role="alert">  هذا الحقل مطلوب    </div> ';
        $result = false ;
    }

    return $result ;
}

// -----------------------------------------------------------
//  دالة تسجيل منطقة جديدة 
    function insert($id =null , $name ,$city ){
        //  استدعاء دالة تحقق من القيم المدخلة 
        $result = testvalues($name,$city);
        //  القيم المدخلة صحيحية 
        if($result == true){
            //  الاتصال بقعدة البيانات 
            include("../../../../lib/Php/connectdb.php");
            if($id != null){
                // الرقم لمدخل غير فارغ 
                /*
                قبل إضافة منطقة جديدة يجب التأكد ان المنطقة غير مسجلة سابقا 
                 */
                //  استعلام يعيد المعلومات عن منطقة عن طريق الرقم 
                $sql = "SELECT * FROM `residentialarea` WHERE `ResidentionAreaID` = $id  OR `ResidentionAreaName` = '$name' AND `CityID` = '$city' " ;
                $query = mysqli_query($conn,$sql);
                if(mysqli_num_rows($query) == 0 ){
                    //  لم يجد نتيجة و بالتالي المنطقة غير مسجلة سابقا 
                    //  استعلام إضافة منطقة جديدة 
                    $insert = "INSERT INTO `residentialarea`(`ResidentionAreaID`, `ResidentionAreaName`,`CityID`) VALUES ('$id','$name','$city')" ;
                    $queryinsert = mysqli_query($conn,$insert);
                    if(mysqli_affected_rows($conn)>0){
                        
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> تمت الإضافة بنجاح  </div>';
                    }else{
                        $MYSQLI_ERROR = mysqli_error($conn);
                        $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert"> 
                         '.$MYSQLI_ERROR.' 
                         </div>';
                    }
                }else{
                    $GLOBALS["RESULT"] = '<div class="alert alert-info" role="alert">  إن رقم هذه المنطقة مستخدم سابقا او هذا المنطقة مسجلة بالفعل  </div>';
                } 
            }else{
                //  رقم المنطقة فارغ 
                //  الترقيم تلقائي في قاعدة البيانات و بالتالي يمكن إضافة منطقة جديدة دون تحديد الرقم 
                //  استعلام عن المنطقة عن طريق اسم المنطقو و المحافظة 
                $sql2 = "SELECT * FROM `residentialarea` WHERE   `ResidentionAreaName`  = '$name'  and `CityID` = '$city'" ;
                $query2 = mysqli_query($conn,$sql2);
                if(mysqli_num_rows($query2) == 0 ){
                    //  لم يجد نتيجة و بالتالي المنطقة غير مسجلة سابقا  
                    //  استعلام يضيف منطقة جديدة 
                    $insert = "INSERT INTO `residentialarea`(`ResidentionAreaID`, `ResidentionAreaName`,`CityID`) VALUES (null,'$name','$city')"  ;
                    $queryinsert = mysqli_query($conn,$insert);
                    if(mysqli_affected_rows($conn)>0){
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> تمت الإضافة بنجاح  </div>';
                    }else{
                        $MYSQLI_ERROR = mysqli_error($conn);
                        $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert"> 
                         '.$MYSQLI_ERROR.' 
                         </div>';
                    }
                }else{
                    $GLOBALS["RESULT"] = '<div class="alert alert-info" role="alert">  لم تتم عملية الادخال إن هذه المنطقة مسجلة بالفعل  </div>';
                }
            }
            mysqli_close($conn);
        }else{
           
        }

        
    }
    
    
    // ----------------------------------------------------------------
//  دالة حذف منطقة 
//  يمكن حذف منطقة اما عن طريق الرقم  او عن طريق اسم المنطقة و اسم المحافظة التابعة لها 
    function delet($id = null , $name ,$city){
        // الاتصال بقاعدة البيانات 
        include("../../../../lib/Php/connectdb.php");
        //  التحقق ان الرقم الكدخل غير فارغ 
        if($id != null){
            // الرقم غير فارغ 
            /*  
            قبل حذف اي منطقة يجب التاكد انها مسجلة سابقا  
            الخطوة الاولى البحث عن المنطقة عبر رقمها 
            في حال كان الرقم المدخل خاطئ لكن المنطقة مسجلة برقم ثاني يجب البحث عن طريق الاسم و المحافظة التابعة لها 
             */
            //  استعلام يبحث عن منطقة عبر الرقم الخص بها 
            $sql = "SELECT * FROM `residentialarea` WHERE `ResidentionAreaID` = $id  " ;
            $query = mysqli_query($conn,$sql);
            if(mysqli_num_rows($query)== 0 ){
                //   لم يجد رقم المنطقة المحددة  عبر الرقم  
                //  الخطوة الثانية  
                //  اختبار القيم المدخلة 
                $result = testvalues($name , $city);
                if($result == true){
                    //  القيم المدخلة صحيحة 
                    //  استعلام البحث عن منطقة عبر الاسم و المحافظة التابعا لها 
                    $sql2 = "SELECT * FROM `residentialarea` WHERE  `ResidentionAreaName` = '$name' AND `CityID` = '$city' " ;
                    $query2 = mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($query2) == 0 ){
                        // المنطقة المحددة غير مسجلة
                        $GLOBALS["RESULT"] = '<div class="alert alert-info" role="alert">  إن المنطقة المحددة غير مسجلة سابقاً </div>';
                    }else{
                        // وجد منطقة المحددة
                        //  ستعلام حذف المنطقة 
                        $del = "DELETE  FROM `residentialarea` WHERE  `ResidentionAreaName` = '$name' AND `CityID` = '$city' ";
                        $query_del = mysqli_query($conn,$del);
                        if(mysqli_affected_rows($conn) > 0){
                            //
                            $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> تم حذف المنطقة بنجاح    </div>';

                        }else{
                            $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">     لم تتم العملية بنجاح </div>';
                        }
                    }
                }else{
                    $GLOBALS["RESULT"] = '<div class="alert alert-warning" role="alert">   إن رقم المنطقة المدخل غير موجود ! يجب إدخال رقم صحيح او إدخال اسم المنطقة و المحافظة التابعة لها </div>';
                    
                    //  قيم الاسم و المدينة فارغة
                }    
            }else{
                //  وجد قيمة  في البحث عن طريق الرقم 
                //  استعلام حذف منطقة عن طريق الرقم
                $del = "DELETE  FROM `residentialarea` WHERE  `ResidentionAreaID` = $id ";
                $query_del = mysqli_query($conn,$del);
                if(mysqli_affected_rows($conn) > 0){
                    $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> تم حذف المنطقة بنجاح    </div>';

                }else{
                    $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">     لم تتم العملية بنجاح </div>';
                }
            }
        }else{

            /** رقم المنطقة فارغ يجب الحذف عن طريق اسم المنطقة و المحافظة التابعة لها  */
            //  اختبار القيم المدخلة 
            $result = testvalues($name , $city);
            if($result == true){
                //  البحث عن المنطقة المطلوبة 
                $sql2 = "SELECT * FROM `residentialarea` WHERE  `ResidentionAreaName` = '$name' AND `CityID` = '$city' " ;
                $query2 = mysqli_query($conn,$sql2);
                
                if(mysqli_num_rows($query2) == 0 ){
                    // المنطقة المحددة غير موجودة 
                    $GLOBALS["RESULT"] = '<div class="alert alert-info" role="alert">  إن المنطقة المحددة غير مسجلة سابقاً </div>';
                }else{
                    // وجد منطقة المحددة
                    //  ستعلام حذف منطقة عن طريق لاسم و المحافظة 
                    $del = "DELETE  FROM `residentialarea` WHERE  `ResidentionAreaName` = '$name' AND `CityID` = '$city' ";
                    $query_del = mysqli_query($conn,$del);
                    if(mysqli_affected_rows($conn) > 0){
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> تم حذف المنطقة بنجاح    </div>';

                    }else{
                        $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">     لم تتم العملية بنجاح </div>';
                    }
                }
                
               
            }else{
                $GLOBALS["RESULT"] = '<div class="alert alert-warning" role="alert">  يجب إدخال رقم المنطقة او اسم المنطقة و المحافظة التابعة لها اولا </div>';
                
                //  قيم الاسم و المدينة فارغة
            }    
        }
        mysqli_close($conn);
        
    }
    
?>