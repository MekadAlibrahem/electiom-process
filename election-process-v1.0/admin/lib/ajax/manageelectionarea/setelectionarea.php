<?php
//  كود إضافة دائرة انتخابية 
//  جلب البيانات المطلوبة 
$id         = $_REQUEST["id"];
$name       = $_REQUEST["name"];
$type       = $_REQUEST["type"];
$count      = $_REQUEST["count"];
// التحقق من صحة القيم المدخلة 
if($id<0){
    echo '<div class="alert alert-danger" role="alert"> 
      يجب إدخال رقم الدائرة الانتخابية اولا
    </div>';
}else if(empty($name)){
   
    echo '<div class="alert alert-danger" role="alert"> 
        يجب إدخال اسم الدائرة الانتخابية اولا
    </div>';
}else if($count == null){
   
}else{
    //  القيم صحيحة وغير فارغة  
    //  اتصال بقاعدة البيانات  
    include("../../../../lib/Php/connectdb.php");
    //  استعلام إضافة ددائرة انتخابية  
            $insert_electionArea = "INSERT INTO `electionareas`(`ElectionAreaID`, `ElectionAreaName`,`IDTypeProcess`, `Count`) VALUES ('$id','$name','$type','$count')";
            $query_insert_electionArea = mysqli_query($conn,$insert_electionArea);
            if($query_insert_electionArea){
                // الاستعلام صحيح  
                if(mysqli_affected_rows($conn)>0){
                    // يوجد حقل متأثر بلاستعلام و بالتالي تم إضافة دائئرة انتخابية 
                    //  عرض رسالة نتيجة تنفيذ 
                    echo '<div class="alert alert-success" role="alert"> 
                   تم إضافة الدائرة الانتخابية بنجاح
                    </div>';
                    // 2-  اضافة بيانات  الدائرة الانتخابية الى جدول تفاصيل الدوائر الانتخابية  
                    //  استعلام إضافة تفاصيل الدائرة الانتخابية  
                    $insert_info = "INSERT INTO `electionareadatils`(`id`, `ElectionAreaID`) VALUES (null,'$id')";
                    $query_insert_info = mysqli_query($conn,$insert_info);
                    if($query_insert_info){
                        //تم تنفيذ الاستعلام بنجاح  

                        if(mysqli_affected_rows($conn)>0){
                            // يوجد حقل متأثر بالاستعلام  و بالتالي تم الغضافة 
                            //  عرض رسالة توضح حالة التنفيذ 
                            echo '<div class="alert alert-success" role="alert"> 
                           تم إضافة تفاصيل الدائرة الانتخابية بنجاح
                            </div>';
                        }else{
                            //لم يتم الإضافة 
                            //  عرض رسالة توضيح  
                            echo '<div class="alert alert-info" role="alert"> 
                            لم يتم إضافة تفاصيل الدائرة الانتخابية
                            </div>';
                        }
                    }else{
                        // خطأ في استعلام اضافة تفاصيل دائرة انتخابية 
                        //  عرض رسالة خطأ 
                        $ERRORQUERY = mysqli_error($conn);
                        echo '<div class="alert alert-danger" role="alert"> 
                        '.$ERRORQUERY.'
                        </div>';
                    }
                }else{
                    // لم يتم إضافة دائرة انتخابية  => يوجد دائرة انتخابية مسجلة سابقا بنفس الرقم 
                    //  عرض رسالة توضيح 
                    echo '<div class="alert alert-info" role="alert"> 
                      لم يتم إضافة الدائرة الانتخابيةربما يوجد دائرة انتخابية مسجلة مسبقا بنفس الرقم  
                    </div>';
                }
            }else{
                // خطـأ في استعلام إضافة دائرة انتخابية  
                //  عرض رسالة الخطأ  
                $ERRORQUERY = mysqli_error($conn);
                echo '<div class="alert alert-danger" role="alert"> 
                '.$ERRORQUERY.'
                </div>';
            }
            //  اغلاق الاتصال بقاعدة البيانات 
    mysqli_close($conn);
}


?>