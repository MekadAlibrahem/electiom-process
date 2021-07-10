<?php
     $GLOBALS["RESULT"] = "";
    //   دالة  إضافة مدينة 
    /* 
     تتم إضافة مدينة اما إدخال الرقم و الاسم او الاسم فقط  
     */
     function insert($id =null , $name){
        //   الاتصال بقاعدة البيانات 
        include("../../../../lib/Php/connectdb.php");
        //   التحقق ان الاسم غير فارغ 
         if(empty($name)){
             $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  يجب ادخال قيمة لاسم المحافظة  اولا </div>';
         }else{
            //   النحقق ان الرقم غير فارغ 
             if($id != null){
                //   الاستعلام لإضافة مدينة عن طريق الاسم و الرقم  
                 $sql = "SELECT * FROM `city` WHERE `CityID` = $id  or `CityName` = '$name' " ;
                 $query = mysqli_query($conn,$sql);
                 if(mysqli_num_rows($query) == 0 ){
                     $insert = "INSERT INTO `city`(`CityID`, `CityName`) VALUES ('$id','$name')"  ;
                     $queryinsert = mysqli_query($conn,$insert);
                     if(mysqli_affected_rows($conn)>0){
                         $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> تمت الإضافة بنجاح  </div>';
                     }else{
                         $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  لم يتم الادخال بنجاح </div>';
                     }
                 }else{
                     $GLOBALS["RESULT"] = '<div class="alert alert-info" role="alert">  لم تتم عملية الادخال رقم المحافظة  او اسم المحافظة مسجل بالفعل  </div>';
                 } 
             }else{
                //    الرقم فارغ  
                //  الاستعلام الخاص بإضافة  مدينة عن طريق الاسم فقط 
                 $sql = "SELECT * FROM `city` WHERE `CityName` = '$name' " ;
                 $query = mysqli_query($conn,$sql);
                 if(mysqli_num_rows($query) == 0 ){
                     $insert = "INSERT INTO `city`(`CityID`, `CityName`) VALUES (null,'$name')"  ;
                     $queryinsert = mysqli_query($conn,$insert);
                     if(mysqli_affected_rows($conn)>0){
                         $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> تمت الإضافة بنجاح  </div>';
                     }else{
                         $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  لم يتم الادخال بنجاح </div>';
                     }
                 }else{
                     $GLOBALS["RESULT"] = '<div class="alert alert-info" role="alert">  لم تتم عملية الادخال رقم المحافظة او اسم المحافظة مسجل بالفعل  </div>';
                 } 
             }
         }
         mysqli_close($conn);
     }

     /////////////////////

//  دالة تعديل اسم مدينة
    function edit($id , $name ){
        //  الاتصال بقاعدة البيانات 
        include("../../../../lib/Php/connectdb.php");
        //  التحقق من ان الرقم غير فارغ 
        if(empty($id)){
            $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  يجب ادخال قيمة لرقم المحافظة </div>';
        }else if(empty($name)){
            //  التحقق ان الاسم غير فارغ 
            $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  يجب ادخال قيمة لاسم المحافظة </div>';
        }else{
            //  التحقق ان المدينة المطلوبة مسجلة سابقا 
            $sql = "SELECT * FROM `city` WHERE `CityID` = $id " ;
            $query = mysqli_query($conn,$sql);
            if(mysqli_num_rows($query)>0){
                //  وجد المدينة المطلوبة  
                //  استعلام التعديل 
                    $update = "UPDATE `city` SET `CityName`='$name' WHERE `CityID` = $id ";
                    $query2 = mysqli_query($conn,$update);
                    if(mysqli_affected_rows($conn)>0){
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح  </div>';
                    }else{
                        $GLOBALS["RESULT"] = '<div class="alert alert-info" role="alert"> هذه القيمة مسجلة بالفعل </div>';
                    }
            }else{
                    $sql2 = "SELECT * FROM `city` WHERE `CityName` = '$name'";
                    $query3 = mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($query3)>0){
                        $update = "UPDATE `city` SET `CityID`= $id WHERE `CityName` = '$name' ";
                        $query2 = mysqli_query($conn,$update);
                        if(mysqli_affected_rows($conn)>0){
                            $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح  </div>';
                        }else{
                            $GLOBALS["RESULT"] = '<div class="alert alert-info" role="alert">  هذه  القيمة مسجلة بالفعل</div>';
                        }
                    }else{
                        $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  إن  المحافظة المطلوبة  مسجلة  </div>';   
                    }
            }
        }
        mysqli_close($conn);
    }


    //-------------------------------------------------------
  


    //--2- دالة حذف محافظة 
    function delet($id,$name){
        include("../../../../lib/Php/connectdb.php");
            if(!empty($id)){
                $sql = "SELECT * FROM `city` WHERE `CityID` = $id " ;
                $query = mysqli_query($conn,$sql);
                if(mysqli_num_rows($query)>0){
                    $delet = "DELETE  FROM `city` WHERE `CityID` =$id ";
                    $query2 = mysqli_query($conn,$delet);
                    if(mysqli_affected_rows($conn)>0){
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert">  تم حذف البيانات بنجاح  </div>';
                    }else{
                        $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert"> لم تتم العملية بنجاح</div>';
                    }
                }else if (empty($name)){
                    $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  إن  المحافظة  غير مسجلة  </div>';
                }
            
            }else if(!empty($name)){
                $sql2 = "SELECT * FROM `city` WHERE `CityName` = '$name'";
                $query3 = mysqli_query($conn,$sql2);
                if(mysqli_num_rows($query3)>0){
                    $delet2 = "DELETE  FROM `city` WHERE `CityName` = '$name' ";
                    $query2 = mysqli_query($conn,$delet2);
                    if(mysqli_affected_rows($conn)>0){
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert">  تم حذف البيانات بنجاح  </div>';
                    }else{
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> لم تتم العملية بنجاح</div>';
                    }
                }else{
                    $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  إن  المحافظة  غير مسجلة  </div>';   
                }
                
            }
            
        
        mysqli_close($conn);
    }

?>