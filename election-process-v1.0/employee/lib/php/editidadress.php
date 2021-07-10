<?php
//  متغير عام يتخزن به نتيجة التنفيذ و رسائل الخطأ
    $GLOBALS["RESULT"] = "";
    //  دالة إضافة قيد مدني  يجب إضافة الاسم على الاقل او الاسم و الرقم  
    function insert($id =null , $name){
        //  الاتصال بقاعدة البيانات 
        include("../../../lib/Php/connectdb.php");
        //  التحقق أن الاسمغي فارغ 
        if(empty($name)){
            $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  يجب ادخال قيمة لمكان القيد </div>';
        }else{
            //  التحقق من قيمة الرقم  إذا كان غير فارغ 
            if($id != null){
                /*
                ملاحظة قبل تسجيل قيد جديد يجب التأكد ان الرقم المدخل او الاسم المدخل غير مسجل سابقا
                */
                // الاستعلام يعيد اسم القيد او الرقم المدخل للتاكد انه غير مسجل سابقا
                $sql = "SELECT * FROM `idadress` WHERE `ID` = $id  or `AdressName` = '$name' " ;
                $query = mysqli_query($conn,$sql);
                if(mysqli_num_rows($query) == 0 ){
                    //  لا يوجد حقول تأثرت بلاستعلام و بالتالي القيد المطلوب غير مسجل سابقا و الرقم غير مستخدم لقيد ثاني 
                    //  الاستعلام الخاص بإضافة قيد جديد
                    $insert = "INSERT INTO `idadress`(`ID`, `AdressName`) VALUES ('$id','$name')"  ;
                    $queryinsert = mysqli_query($conn,$insert);
                    if(mysqli_affected_rows($conn)>0){
                        //  يوجد حقول تأثرت بلاضافة  و بالتالي تم الاضافة بنجاح 
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> تمت الإضافة بنجاح  </div>';
                    }else{
                        //  لم تتم الإضافة القيد الجديد
                        $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  لم يتم الادخال بنجاح </div>';
                    }
                }else{
                    //  يوجد قيد او الرقم المدخل مسجل سابقا و بالتالي لا يمكن إدخاله من جديد
                    $GLOBALS["RESULT"] = '<div class="alert alert-info" role="alert">  لم تتم عملية الادخال رقم القيد او مكان القيد مسجل بالفعل  </div>';
                } 
            }else{
                //  الررقم id   فارغ  
                //  استعلام يعيد القيد عبر الاسم للتاكد ان القيد المدخل غير مسجل سابقا 
                $sql = "SELECT * FROM `idadress` WHERE `AdressName` = '$name' " ;
                $query = mysqli_query($conn,$sql);

                if(mysqli_num_rows($query) == 0 ){
                    //  لم يجد القيد المطلوب و بالتالي غير مسجل سابقا 
                    //  الاستعلام الخاص بإضافة قيد جديد
                    $insert = "INSERT INTO `idadress`(`ID`, `AdressName`) VALUES (null,'$name')"  ;
                    
                    $queryinsert = mysqli_query($conn,$insert);
                    if(mysqli_affected_rows($conn)>0){
                        //  يوجد حقول متأثرة بلاستعلام  و بالتالي تم الإضافة بنجاح 
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> تمت الإضافة بنجاح  </div>';
                    }else{
                        //  لم تتم إضافة القيد المطلوب 
                        $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  لم يتم الادخال بنجاح </div>';
                    }
                }else{
                    //  وجد المدينة مسجلة سابقا و بالتالي لا يمكن إضافة القيد مرة ثانية 
                    $GLOBALS["RESULT"] = '<div class="alert alert-info" role="alert">  لم تتم عملية الادخال إن مكان القيد مسجل بالفعل  </div>';
                } 
            }
        }
        //  إغلاق الاتصال بقاعدة البيانات 
        mysqli_close($conn);
    }
/////////////////////
//  دالة التعديل  على قيد مسجل سابقا 

    function edit($id , $name ){
        //  الاتصال بقاعدة البيانات 
        include("C:/xampp/htdocs/Mekadv2.0/lib/Php/connectdb.php");
        if(empty($id)){
            //  التأكد ان رقم  القيد غير فارغ 
            $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  يجب ادخال قيمة لرقم القيد </div>';
        }else if(empty($name)){
            //  التأكد ان الاسم غير فارغ 
            $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  يجب ادخال قيمة لمكان القيد </div>';
        }else{
            // القيم المدخلة غير فارغة 
            /* قبل التعديل على قيد  يجب التأكد ان القيد مسجل اولا   */
            //  استعلام يعيد القيد المطلوب عن طريق  الرقم و بالتالي التاكد من ان القيد مسجل سابقا او لاء  

            $sql = "SELECT * FROM `idadress` WHERE `ID` = $id " ;
            $query = mysqli_query($conn,$sql);
            if(mysqli_num_rows($query)>0){
            //  يوجد حقول متأثرة  و بالتالي القيد مسجل سابقا
            //  الاستعلام الخاص بالتعديل على اسم القيد 
                $update = "UPDATE `idadress` SET `AdressName`='$name' WHERE `ID` = $id ";
                    $query2 = mysqli_query($conn,$update);
                    if(mysqli_affected_rows($conn)>0){
                        //  يوجد حقول متأثرة بالاستعلام و بالتالي تم التعديل 
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح  </div>';
                    }else{
                        //  لا يوجد اي حقل تأثر بالاستعلام و بالتالي لم يتم التعديل  
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> لم تتم العملية بنجاح</div>';
                    }
            }else{
                //  لا يوجد حقول متأثرة الاستعلام و بالتالي لم يجد القيد المطلوب  ( القيدالمطلوب غير مسجل سابقا)
                $GLOBALS["RESULT"] = '<div class="alert alert-info" role="alert">  لم يتم التعديل إن القيد المطلوب غير مسجل سابقا </div>';
            }
            
        }
        mysqli_close($conn);
    }
    //-------------------------------------------------------
    // برمجة دالة حذف قيد 
    //  بما ان الاسم القيد فريد فيمكن الحذف إما عن طريق الاسم او الرقم 
    function delet($id,$name){
        //  الاستعال بقاعدة البيانات 
        include("C:/xampp/htdocs/Mekadv2.0/lib/Php/connectdb.php");
        //  التأكد ان الرقم غير فارغ 
            if(!empty($id)){
                // التاكد من ان القيد مسجل سابقا 
                //  استعلام يعيد القيد المطلوب 
                $sql = "SELECT * FROM `idadress` WHERE `ID` = $id " ;
                $query = mysqli_query($conn,$sql);
                if(mysqli_num_rows($query)>0){
                    //  وجد حقل متأثر بالاستعلام و بالتالي وجد القيد المطلوب 
                    //  استعلام الحذف قيد عن طريق رقم القيد 
                    $delet = "DELETE  FROM `idadress` WHERE `ID` =$id ";
                    $query2 = mysqli_query($conn,$delet);
                    if(mysqli_affected_rows($conn)>0){
                        //  يوججد حقل متأثر باستعلام الحذف و بالتالي تم حذف القيد 
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert">  تم حذف البيانات بنجاح  </div>';
                    }else{
                        //  لا يوجد اي حقل متأثر باستعلام الحذف و بالتالي لم يتم حذف القيد
                        $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert"> لم تتم العملية بنجاح</div>';
                    }
                     
                }else{
                    //    لم يجد القيد المطلوب 
                    $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  إن  القيد المدني  غير موجود  </div>';
                }
             // إذا كان رقم القيد فارغ يمكن الحذف عن طريق اسم القيد  
                    //  التاكد من ان اسم القيد غير فارغ
            }else if(!empty($name)){
                //  الاسم غير فارغ 
                //  استعلام البحث عن قيد المطلوب  
                $sql2 = "SELECT * FROM `idadress` WHERE `AdressName` = '$name'";
                $query3 = mysqli_query($conn,$sql2);
                if(mysqli_num_rows($query3)>0){
                    //  وجد القيد المطلوب  
                    //  استعلام حذف قيد عن طريق اسم القيد 
                    $delet2 = "DELETE  FROM `idadress` WHERE `AdressName` = '$name' ";
                    $query2 = mysqli_query($conn,$delet2);
                    if(mysqli_affected_rows($conn)>0){
                        //  تم الحذف بنجاح 
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert">  تم حذف البيانات بنجاح  </div>';
                    }else{
                        //  لم يتم حذف القيد 
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> لم تتم العملية بنجاح</div>';
                    }
                }else{
                    //  لم يجد القيد المطلوب  
                    $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  إن  القيد المدني  غير موجود  </div>';   
                }
                
            }
            
        
        mysqli_close($conn);
    }
?>

    
