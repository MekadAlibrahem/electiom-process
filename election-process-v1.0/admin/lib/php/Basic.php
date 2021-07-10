<?php
// متغير لتخزين رسالة الخطأ في حال حدوثه
$GLOBALS["ERRORELECTIONPROCES"] = "" ;
//  دالة تعيد العمليات الانتخابية المتاحة للمرشحين  
function select_election_process(){
    //الاتصال بقاعدة البيانات
    include("../../../lib/Php/connectdb.php");
    //الاستعلام عن العمليات الانتخابية  
    /*
            ملاحظة : تم إضافة الشرط التاريخ لمنع اضافة اي مرشح لعملية انتخابية 
            الا في التاريخ المخصص لهذه العملية ببداية و نهاية فترة الترشح 
            بحث يتم مقارنة تاريخ بداية ونهاية الترشح مع تاريخ الحالي لانشاء الحساب  او تعديل بياناته 
    */
        $select_election_process = "SELECT * FROM `electionprocess` WHERE DATE(`EndDateCandidature`)> DATE(CURDATE()) AND DATE(`StartDateCandidature`) < DATE(CURDATE())  ";
        $election_process = mysqli_query($conn,$select_election_process);
        if($election_process){
                // تم تنفيذ الاستعلام 
                if(mysqli_num_rows($election_process)>0){
                    //  وجد عمليات انتخابية متاحة 
                    // عرض النتيجة
                    while($row = mysqli_fetch_array($election_process)){
                        echo "<option value = '".$row['IDProcess']."' >";
                        echo  $row['nameP'];
                        echo " </option>";
                    }
                }else{

                    // لم يجد اي نتيجة =>جميع العمليات الانتخابية المسجلةانتهت تاريخها 
                    $GLOBALS["ERRORELECTIONPROCES"]  = '<div class="alert alert-info" role="alert">
                     لا يوجد اي عملية انتخابية متاحة حاليا او العملية المطلوبة غير مسجلة 
                    </div>';
                }
        }else{
            //   يوجد خطأ في الاستعلام و جلب رسالة الخطأ
            $ERROR_QUERY = mysqli_error($conn);
            $GLOBALS["ERRORELECTIONPROCES"]  = '<div class="alert alert-danger" role="alert">
            '.$ERROR_QUERY.' 
            </div>';
        }
        // إنهاء الاتصال بقاعدة البيانات 
    mysqli_close($conn);
}
//   دالة نعيد انواع الحسابات من قاعدة البيانات 
function selecttypeaccount(){
    include("../../../lib/Php/connectdb.php");
    $select_type_account  = "SELECT * FROM `typeaccount`  ORDER BY `typeaccount`.`TypeAccountID` DESC";
    $type_account  = mysqli_query($conn,$select_type_account);
    if($type_account){
            // تم تنفيذ الاستعلام 
            while($row = mysqli_fetch_array($type_account)){
                echo "<option value = '".$row['TypeAccountID']."' >";
                echo  $row['type'];
                echo " </option>";
            }
    }else{

        // لم يتم التنفيذ خطأ بلاستعلام 

    }
    mysqli_close($conn);
}
// دالة تعيد انواع العمليات الانتخابية 
function get_type_process(){
    include("../../../lib/Php/connectdb.php");
    $select_type_process = "SELECT * FROM  `typeprocess` ";
    $query_tepy_process = mysqli_query($conn,$select_type_process);
    if($query_tepy_process){
        //  الاستعلام صحيح 
        if(mysqli_num_rows($query_tepy_process)>0){
            // وجد نتيجة
            echo "<option value = '0' selected>";
                echo 'اختر نوع الانتخابات';
                echo " </option>";
            while($row = mysqli_fetch_array($query_tepy_process)){
                echo "<option value = '".$row['IDTypeProcess']."' >";
                echo  $row['Type'];
                echo " </option>";
            } 

            
        }else{
            // لم يجد اي نتيجة 
            echo "<option value = '0' >";
            echo   "  لا يوجد أي نوع عملية انتخابية" ;
            echo " </option>";
        }
        
    }else{
        // خطأ في الاستعلام عن انواع العمليات الانتخابية

    }
    mysqli_close($conn);
}

// دالة تعيد اسماء المحافظات
function get_city(){
    //  الاتصال بقاعدة البيانات 
    include("../../../lib/Php/connectdb.php");
    //  استعلام يعيد معلومات عن المحافظات المسجلة
    $get_city = "SELECT * FROM `city`";
    $query_get_city = mysqli_query($conn,$get_city);
    //  الاستعلام صحيح
    if($query_get_city){
        //  وجد نتيجة 
        if(mysqli_num_rows($query_get_city)>0){
            //  عرض النتيجة 
            echo "<option value = '0' >";
            echo   " اختر محافظة  " ;
            echo " </option>";
            while($row = mysqli_fetch_array($query_get_city)){
                echo "<option value = '".$row['CityID']."' >";
                echo  $row['CityName'];
                echo " </option>";
            }
        }else{
            //  لم يجد نتيجة 
            //  عرض رسالة مناسبة 
            echo "<option value = '0' >";
            echo   "  لا يوجد أي محافظة  " ;
            echo " </option>";
        }
    }else{

    }
}
// دالة تعيد اسماء المناطق الانتخابية
function get_election_area(){
    //  الاتصال بقاعدة البيانات 
    include("../../../lib/Php/connectdb.php");
    //  استعلام يعيد المناطق الانتخابية 
    $get_city = "SELECT * FROM `electionareas`";
    $query_get_city = mysqli_query($conn,$get_city);
    if($query_get_city){
        //  الاستعلام صحيح
        if(mysqli_num_rows($query_get_city)>0){
            //  وجد نتيجة 
            //  عرض النتيجة 
            echo "<option value = '0' >";
            echo   " اختر دائرة انتخابية  " ;
            echo " </option>";
            while($row = mysqli_fetch_array($query_get_city)){
                echo "<option value = '".$row['ElectionAreaID']."' >";
                echo  $row['ElectionAreaName'];
                echo " </option>";
            }
        }else{
            //  لم يجد اي نتيجة 
            //  عرض رسالة مناسبة 
            echo "<option value = '0' >";
            echo   "  لا يوجد أي دائرة انتخابية " ;
            echo " </option>";
        }
    }else{

    }
}






?>