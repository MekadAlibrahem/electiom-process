<?php 
    //  متغيرات تحوي قيمة رسالة الخطأ لكل حقل إدخال حيث تظهر حسب نوع الخطأ
    $GLOBALS['nationalnumbererror']       = "";
    $GLOBALS['lnameerror']                = "";
    $GLOBALS['fnameerror']                = "";
    $GLOBALS['fathernameerror']           = "";
    $GLOBALS['mothernameerror']           = "";
    $GLOBALS['birthdateerror']            = "";
    $GLOBALS['adresserror']               = "";
    $GLOBALS['gendererorr']               = "";
    $GLOBALS['joberror']                  = "";
    $GLOBALS['townerror']                 = "";
    $GLOBALS['statuserror']               = "";
    $GLOBALS['IDerorr']                   = "";
    $GLOBALS['resultquery ']              = "";
    $GLOBALS["imgusererror"]              = "";
    // ----------------------------------------------------------------

    //------------------------------------------------------------
    // دالة تعيد حالات العمل من قاعدة البيانات وتضيفها الى الجدول
   function selectjob(){ 
    //     الاتصال بقاعدة البيانات
    include("../../../../lib/Php/connectdb.php");
    //  استعلام يعيد جميع حالات العمل  
    $select_job = "SELECT * FROM `job` " ;
    $query_job  = mysqli_query($conn,$select_job);
    if(mysqli_num_rows($query_job)>0){
        //  وجد نتيجة 
        echo '<select  name="job" id="jobid" > ';
        while($row = mysqli_fetch_array($query_job)){
            //  عرض البيانات 
          echo "<option value='".$row['jobID']."' >".$row['jobName']."</option>";
        }
        echo " </select>";
    }
    mysqli_close($conn);
   }

   //----------------------------------------------------------------
   // دالة تعيد المحافظات و المنطاق و البلدات التابعة لكل منها
   function selectcity(){
     //     الاتصال بقاعدة البيانات  
     include("../../../../lib/Php/connectdb.php");
    $select_city = "SELECT * FROM `city` ";
    $query_city  = mysqli_query($conn,$select_city);
    if(mysqli_num_rows($query_city)>0){
        echo "<select name='town' id='selecttown' >";
        echo "<option value = '0' >.........</option>";
        echo "</select>" ;
        /*  الدالة autoselecttown    تعيد المناطق التابعة لكل محافظة عن طريق طلب  ajax  
             حيث يتم استدعاء الدالة تلقائيا في كل مرة يتم بها تغير المحافظة   */
        echo "<select name='city'  onchange='autoselecttown(this.value);'>" ;
        echo "<option value = '0' selected >اختر مدينة</option>";
        while($row = mysqli_fetch_array($query_city)){
            echo "<option value = '". $row['CityID']."' >".$row['CityName']."</option>";
            
        }
        echo "</select>" ;
        
    }
   }

   /*
               خطوات تسجيل الحساب 
               1-   تأكد من صحة القيم و انها غير فارغة     function testvalus()return:boolean ;
               2- تسجيل حساب مواطن : function insertuser() return : string => result insert query   
               ----------------------------------------------------------------
               function insertuser():   
                        بعد تسجيل الحساب يجب ايضا تسجيل حساب مستخدم في جدول حسابات المستخدمين useraccount  >
                        بقيم افتراضية رقم الوطني و حساب غير مفعل و نوع الحساب مستخدم عادي (ناخب) 
                        function insertuseracount();

                        يتم تعديل بيانات حساب المستخدم من قبل مدير الموقع 

        
   */
//--------------------------------------------------------------------


//  دالة لتسجيل حساب مستخدم بقيم اولية
function insertuseracount($nationalnumber , $typeaccountid = 4 , $accuntstatus = 0 , $id = null){
    // كلمة مرور اولية تبقى فارغة 
    // حالة حساب اولية رقم 4 لانها رقم الحساب العادي
    // رقم الاخير هو رقم الحساب نضع قيمة فارغة لانه مفتاح اساسي وسوف يأخذ ترقيم تلقائي
     //     الاتصال بقاعدة البيانات
     include("../../../../lib/Php/connectdb.php");
        $insert_account = "INSERT INTO `useraccount`(`NationalNumber`, `TypeAccountID`, `AccountStatus`, `idacount`) VALUES ('$nationalnumber','$typeaccountid','$accuntstatus',NULL )" ;
        $query_account = mysqli_query($conn,$insert_account);
        if(mysqli_affected_rows($conn)>0){
                mysqli_close($conn);
                return true;
        }else{
            echo mysqli_errno($conn);
            mysqli_close($conn);
            
            return false ;
        }

   
    
}


//--------------------------------------------------------------------------------------------------------
// دالة تسجيل حساب مواطن 
    function insertuser($nationalnumber , $fname , $lname ,$fathername , $mothername, $birthdate ,$adress,$idadress ,$gender ,$job, $town, $imageuser){
        // التحقق من عدم وجود قيم فارغة
        $resulttestvalues = testvalues($nationalnumber , $fname , $lname ,$fathername , $mothername, $birthdate ,$adress,$idadress ,$gender ,$job, $town,$imageuser);
        if($resulttestvalues){
             //     الاتصال بقاعدة البيانات
             include("../../../../lib/Php/connectdb.php");
            if($gender == "male"){
                $gender = 1 ;
            }else{
                $gender = 0 ;
            }
            // تسجيل المستخدم
            $insert_user = "INSERT INTO `users`(`NationalNumber`, `FName`, `FatherName`, `LName`, `MotherName`,    `Adress`, `gender`, `ID`, `jobID`, `ResidentionAreaID`, `BirthDate`) VALUES ('$nationalnumber','$fname','$fathername','$lname','$mothername','$adress','$gender','$idadress','$job','$town','$birthdate')" ;
            $query_insert = mysqli_query($conn,$insert_user);
            if($query_insert){
                
                
                //  save images 
                $newimg = '../../../faceapi/images/'.$nationalnumber.'.jpg';
                $resultsaveimages = move_uploaded_file($imageuser,$newimg);
                if($resultsaveimages){
                    echo "<p> تم حفظ الصورة  </p>";

                }else{
                    echo "</p> لم يتم حفظ الصورة </p>";
                }
                // اضافة  المستخدم الى جدول حسابات المستخدمين 
                $res = insertuseracount($nationalnumber,4,0,null);
                if($res == true){
                    mysqli_close($conn);
                    return  '<div class="alert alert-success" role="alert"> تم تسجيل المستخدم بنجاح  </div>' ;
                }else{
                    mysqli_close($conn);
                    return '<div class="alert alert-danger" role="alert">  تم إضافة السجل السابق لكن يوجد خطأ في تسجيله في حسابات المستخدمين  </div>';
                }
               
            }else{
                // رسالة خطأ في حال لم يتم تسجيل المستخدم
                $ERORR = mysqli_error($conn);
                mysqli_close($conn);
                return '<div class="alert alert-danger" role="alert">'.$ERORR.'  </div>';
                
            }
        
        }else{
            // 
            mysqli_close($conn);
        }
    }

//-----------------------------------------------------------------------------------------
// دالة لفحص القيم المدخلة اذا كانت فارغة 
    function testvalues($nationalnumber , $fname , $lname ,$fathername , $mothername, $birthdate ,$adress,$idadress ,$gender ,$job, $town, $imageuser){
        $EMPTY_ERROR =  '<p class="alert alert-danger" role="alert"> هذا الحقل مطلوب </p>';
        $result = true ;
        if(empty($nationalnumber)){
            $GLOBALS['nationalnumbererror']     = $EMPTY_ERROR ;
            $result = false ;
        } 
        if(empty($fname)){
            $GLOBALS['fnameerror']              = $EMPTY_ERROR ;
            $result = false ;
        }
        if(empty($lname)){
            $GLOBALS['lnameerror']              = $EMPTY_ERROR ;
            $result = false ;
        }
        if(empty($fathername)){
            $GLOBALS['fathernameerror']         = $EMPTY_ERROR ;
            $result = false ;
        }
        if(empty($mothername)){
            $GLOBALS['mothernameerror']         = $EMPTY_ERROR ;
            $result = false ;
        }
        if(empty($birthdate)){
            $GLOBALS['birthdateerror']          = $EMPTY_ERROR ;
            $result = false ;
        }
        if(empty($adress)){
            $GLOBALS['adresserror']             = $EMPTY_ERROR ;
            $result = false ;
        }
        if(empty($idadress)){
            $GLOBALS['IDerorr']                 = $EMPTY_ERROR ;
            $result = false ;
        }
        if(empty($gender)){
            $GLOBALS['gendererorr']             = $EMPTY_ERROR ;
            $result = false ;
        }
        if(empty($job)){
            $GLOBALS['joberror']                = $EMPTY_ERROR ;
            $result = false ;
        }
        if(empty($town)){
            $GLOBALS['townerror']               = $EMPTY_ERROR ;
            $result = false ;
        }
        
        if(empty($imageuser)){
            $GLOBALS["imgusererror"]            = $EMPTY_ERROR ;
            $result = false ;
        }
        return $result ;
    }
/**
 * دالة تعيد قائمة منسدلة تحوي على بيانات القيد المدني المسجلة بقاعدة البيانات 
 * @param int id = 0 : القيد المدني لمستخدم 
 * 
 */
function get_IDadress($idadress){
    
    //  كود يعيد اسم القيد عن طرق الرقم 
    //   الاتصال بقاعدة البيانات 
    include("C://xampp/htdocs/Mekadv2.0/lib/Php/connectdb.php");
    //  استعلام يعيد اسم القيد عن طريق الرقم 
    $select_id = "SELECT `AdressName` FROM `idadress`  ";
    $query = mysqli_query($conn,$select_id);
    if($query){
        //  الاستعلام صحيح
        if(mysqli_num_rows($query)>0){ 
            //  يوجد حقول متأثرة بالاستعلام  وبالتالي وجد القيد المطلوب 
            //  عرض نتيجة الاستعلام  
            echo '
                <select id="idadress" class="form-control" >

                <option value="0" >
                اختر قيد مدني 
                </option>
            ';
            while($row = mysqli_fetch_array($query)){
                if($row["ID"] == $idadress){
                    echo '
                    <option value="'.$row["ID"].'" selected >
                    '.$row["ID"].' : '.$row["AdressName"].'
                    </option>
                    ';
                }else{
                    echo '
                    <option value="'.$row["ID"].'">
                    '.$row["ID"].' : '.$row["AdressName"].'
                    </option>
                    ';
                }
              
            }
        }else{
            //  لم يجد القيد المطلوب 
            //  عرض قيمة فارغة 

        
        }
        
    
    }
}
?>
