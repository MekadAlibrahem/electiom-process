
<?php
//  كود تسجيل مرشح 
 /* 
    خطوات تسجيل حساب مرشح 
  1-  يجب إحضار الاسم الكامل للمرشح عن طريق رقمه الوطني في جدول المستخدمين 
  2- يجب إحضار الدائرة الانتخابية للمرشح عن طريق العملية الانتخابية ثم نوع العملية الانتخابية ثم الدائرة الانتخابية الخاصة به حسب المنطقة التابع لها
  3-التأكد ان هذا المرشح غير مسجل سابقا لنفس العملية الانتخابية 
  4- إدخال بانات المرشح 
  5- تغير نوع حسابه الى مرشح و تفعيل الحساب فيح حال كان غير مفعل 
       ملاحظات : إن الدائرة الانتخابية تتم تسجيلها تلقائيا ولا يمكن تعديلها 
       
    */
    //  جلب البيانات المطلوبة 
    $id = $_REQUEST["id"];
    $electionprocess = $_REQUEST["electionprocess"];
    $fullName = " ";
    $electionarea = 0 ;
    $idtypeprocess = 0 ;
    if($id != null){
        //  الرقم غير فارغ 
        //  الاتصال بقاعدة البيانات 
        include("../../../../lib/Php/connectdb.php");
            // 1- جلب الاسم الكامل للمرشح
            //  استعلام يعيد اسم المرشح 
            $select_full_name  = "SELECT `FName` , `FatherName` , `LName` FROM `users` WHERE `NationalNumber` = '$id' ";
            $query_full_name = mysqli_query($conn,$select_full_name);
            if($query_full_name){
                // الاستعلام صحيح
                if(mysqli_num_rows($query_full_name)>0){
                    //  وجد نتيجة  
                    while($row = mysqli_fetch_array($query_full_name)){
                        // تخزين النتيجة في متغير 
                        $fname = $row["FName"];
                        $fathername = $row["FatherName"];
                        $lname = $row["LName"];
                    }
                    $fullName = $fname." ".$fathername." ".$lname ;
                    // 2- جلب الدائرة الانتخابية الخاصة بالمرشح
                    //  استعلام يعيد الدائرة الانتخابية للمرشح 
                   $select_info =  "SELECT `electionareadatils`.`ElectionAreaID` FROM `electionareadatils` INNER JOIN `electionareas` on `electionareas`.`ElectionAreaID` = `electionareadatils`.`ElectionAreaID` WHERE `IDTypeProcess` = (SELECT `IDTypeProcess` FROM `electionprocess` WHERE `IDProcess` = '$electionprocess') AND `ResidentionAreaID` IN (SELECT `ResidentionAreaID` FROM `users` WHERE `users`.`NationalNumber` = '$id' ) " ;
                    $query_info = mysqli_query($conn,$select_info);
                    if($query_info){
                        // الاستعلام صحيح 
                        if(mysqli_num_rows($query_info)>0){
                            // وجد الدائرة الانتخابية 
                            while($row = mysqli_fetch_array($query_info)){
                                //  تخزين النتيجة في متغير 
                                $electionarea  = $row["ElectionAreaID"];
                            }
                            // 3- التحقق من ان المرشح غير مسجل سابقا لنفس العملية
                            $select_candiation = "SELECT * FROM `candidates` WHERE `NationalNumber` = '$id' AND `IDProcess` = '$electionprocess'";
                            $query_candidation = mysqli_query($conn,$select_candiation);
                            if($query_candidation){
                                if(mysqli_num_rows($query_candidation)==0){
                                    // لم يجد نتجية متطابقا => المرشح غير مسجل سابقا 
                                    // 4- تسجيل بيانات المرشح الجديدة
                                    $insert_info="INSERT INTO `candidates`(`CandidateID`,`NationalNumber`,`FName`,`ElectionAreaID`,`IDProcess`) VALUES (null,'$id','$fullName','$electionarea','$electionprocess')";
                                    $query_insert = mysqli_query($conn,$insert_info);
                                    if($query_insert){
                                        //الاستعلام صحيح 
                                        
                                        if(mysqli_affected_rows($conn)>0){
                                            //  يوجد نتيجة 
                                            //  تم إضافة المرشح 
                                            //  عرض نتيجة حالة التنفيذ 
                                            echo '<div class="alert alert-success" role="alert"> 
                                            تم إدخال بيانات المرشح بنجاح 
                                            </div>';
                                            // 5- تغير نوع الحساب الى نوع رشح و تفعيله ايضا 
                                            //  استعلام تعديل نوع حساب المستخدم الى مرشح  
                                            $update_type_account = "UPDATE `useraccount` SET `TypeAccountID`='3',`AccountStatus`= '1' WHERE `NationalNumber`='$id' ";
                                            $query_edit_type_account = mysqli_query($conn,$update_type_account);
                                            if($query_edit_type_account){
                                                //  الاستعلام صحيح
                                                if(mysqli_affected_rows($conn)>0){
                                                    //  يوجد حقل متأثر بلاستعلام  
                                                    // تم التعديل  
                                                    //  عرض رسالة حالة التنفيذ 
                                                    echo '<div class="alert alert-success" role="alert"> 
                                                        تم تعديل نوع حساب الى مرشح وتم تفعيل حسابه
                                                    </div>';
                                                }else{
                                                    //  لم يتم تعديل نوع حساب  
                                                    //  عرض رسالة حالة التنفيذ 
                                                    echo '<div class="alert alert-info" role="alert"> 
                                                    لم يتم تعديل بيانات نوع الحساب ربما مسجلة بالفعل 
                                                    </div>';
                                                }
                                            }else{
                                                //  يوجد خطأ 
                                                //  عرض رسالة خطأ
                                                $ERRORQUERY = mysqli_error($conn);
                                                echo '<div class="alert alert-danger" role="alert"> 
                                                    '.$ERRORQUERY.'
                                                    </div>';
                                            }
                                        }else{
                                            //  لا يوجد حقل متأثر باستعلام غضافة مرشح 
                                            //  لم يتم إضافة المرشح 
                                            echo '<div class="alert alert-info" role="alert"> 
                                                   لم يتم إضافة المرشح  
                                                    </div>';
                                            
                                        }
                                    }else{
                                        // يوجد خطأ في استعلام تسجيل مرشح 
                                        //  عرض رسالة خطأ
                                        $ERRORQUERY = mysqli_error($conn);
                                        echo '<div class="alert alert-danger" role="alert"> 
                                        '.$ERRORQUERY.'
                                        </div>';
                                    }
                                }else{
                                    //  وجد نتيجة عن استعلام البحث عن هذا المرشح بنفس العملية الانتخابية 
                                    //  المرشح مسجل مسبقا 
                                    echo '<div class="alert alert-info" role="alert"> 
                                            إن هذا المرشح مسجل لهذه العملية الانتخابية بالفعل 
                                            </div>';
                                }
                            }else{
                                // خطأ في استعلام البحث عن مرشح 
                                $ERRORQUERY = mysqli_error($conn);
                                        echo '<div class="alert alert-danger" role="alert"> 
                                        '.$ERRORQUERY.'
                                        </div>';
                            }
                            
                        }else{
                            // لم يجد الدائرة الانتخابية 
                            echo '<div class="alert alert-danger" role="alert"> 
                            خطأ ! في جلب المعلومات  عن الدائرة الانتخابية التابع لها المرشح 
                            </div>';
                        }

                    }else{
                            //خطأ في استعلام الذي يعيد الدائرة الانتخابية 
                            $ERRORQUERY = mysqli_error($conn);
                            echo '<div class="alert alert-danger" role="alert"> 
                                '.$ERRORQUERY.'
                                </div>';
                    }
                    
                }else{
                    //     لم يجد اسم المرشح المطلوب في جدول المستخدمين 
                    echo '<div class="alert alert-danger" role="alert">  
                    خطأ ! في جلب اسم المرشح ، يرجى التأكد من الرقم الوطني او هذا الرقم الوطني غير مسجل
                    </div>';
                }
            }else{
                //خطأ في الاستعلام جلب بيانات المرشح 
                $ERRORQUERY = mysqli_error($conn);
                echo '<div class="alert alert-danger" role="alert"> 
                    '.$ERRORQUERY.'
                    </div>';   
            }
            
            

        mysqli_close($conn);
    }else{
        // الرقم الوطني فارغ 
        echo '<div class="alert alert-danger" role="alert"> يجب إدخال رقم الوطني للمرشح اولا 
        </div>';
    }
    
?>

