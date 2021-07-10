<?php
     $GLOBALS["RESULT"] = "";
     function insert($id =null , $name){
        include("../../../../lib/Php/connectdb.php");
         if(empty($name)){
             $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  يجب ادخال قيمة لاسم حالة العمل اولا </div>';
         }else{
             if($id != null){
                 $sql = "SELECT * FROM `job` WHERE `jobID` = $id  or `jobName` = '$name' " ;
                 $query = mysqli_query($conn,$sql);
                 if(mysqli_num_rows($query) == 0 ){
                     $insert = "INSERT INTO `job`(`jobID`, `jobName`) VALUES ('$id','$name')"  ;
                     $queryinsert = mysqli_query($conn,$insert);
                     if(mysqli_affected_rows($conn)>0){
                         $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> تمت الإضافة بنجاح  </div>';
                     }else{
                         $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  لم يتم الادخال بنجاح </div>';
                     }
                 }else{
                     $GLOBALS["RESULT"] = '<div class="alert alert-info" role="alert">  لم تتم عملية الادخال رقم حالات العمل او اسم حالة العمل مسجل بالفعل  </div>';
                 } 
             }else{
                 $sql = "SELECT * FROM `job` WHERE `jobName` = '$name' " ;
                 $query = mysqli_query($conn,$sql);
                 if(mysqli_num_rows($query) == 0 ){
                     $insert = "INSERT INTO `job`(`jobID`, `jobName`) VALUES (null,'$name')"  ;
                     $queryinsert = mysqli_query($conn,$insert);
                     if(mysqli_affected_rows($conn)>0){
                         $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> تمت الإضافة بنجاح  </div>';
                     }else{
                         $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  لم يتم الادخال بنجاح </div>';
                     }
                 }else{
                     $GLOBALS["RESULT"] = '<div class="alert alert-info" role="alert">  لم تتم عملية الادخال رقم حالات العمل او اسم حالة العمل مسجل بالفعل  </div>';
                 } 
             }
         }
         mysqli_close($conn);
     }

     /////////////////////


    function edit($id , $name ){
        include("../../../../lib/Php/connectdb.php");
        if(empty($id)){
            $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  يجب ادخال قيمة لرقم حالة العمل </div>';
        }else if(empty($name)){
            $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  يجب ادخال قيمة لاسم حالة العمل </div>';
        }else{
            $sql = "SELECT * FROM `job` WHERE `jobID` = $id " ;
            $query = mysqli_query($conn,$sql);
            if(mysqli_num_rows($query)>0){
                    $update = "UPDATE `job` SET `jobName`='$name' WHERE `jobID` = $id ";
                    $query2 = mysqli_query($conn,$update);
                    if(mysqli_affected_rows($conn)>0){
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح  </div>';
                    }else{
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> لم تتم العملية بنجاح</div>';
                    }
            }else{
                    $sql2 = "SELECT * FROM `job` WHERE `jobName` = '$name'";
                    $query3 = mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($query3)>0){
                        $update = "UPDATE `job` SET `jobID`= $id WHERE `jobName` = '$name' ";
                        $query2 = mysqli_query($conn,$update);
                        if(mysqli_affected_rows($conn)>0){
                            $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert">  تم تعديل البيانات بنجاح  </div>';
                        }else{
                            $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> لم تتم العملية بنجاح</div>';
                        }
                    }else{
                        $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  إن  حالة العمل المطلوبة  مسجلة  </div>';   
                    }
            }
        }
        mysqli_close($conn);
    }


    //-------------------------------------------------------
    function delet($id,$name){
        include("../../../../lib/Php/connectdb.php");
            if(!empty($id)){
                $sql = "SELECT * FROM `job` WHERE `jobID` = $id " ;
                $query = mysqli_query($conn,$sql);
                if(mysqli_num_rows($query)>0){
                    $delet = "DELETE  FROM `job` WHERE `jobID` =$id ";
                    $query2 = mysqli_query($conn,$delet);
                    if(mysqli_affected_rows($conn)>0){
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert">  تم حذف البيانات بنجاح  </div>';
                    }else{
                        $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert"> لم تتم العملية بنجاح</div>';
                    }
                }else if (empty($name)){
                    $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  إن  حالة العمل  غير مسجلة  </div>';
                }
            
            }else if(!empty($name)){
                $sql2 = "SELECT * FROM `job` WHERE `jobName` = '$name'";
                $query3 = mysqli_query($conn,$sql2);
                if(mysqli_num_rows($query3)>0){
                    $delet2 = "DELETE  FROM `job` WHERE `jobName` = '$name' ";
                    $query2 = mysqli_query($conn,$delet2);
                    if(mysqli_affected_rows($conn)>0){
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert">  تم حذف البيانات بنجاح  </div>';
                    }else{
                        $GLOBALS["RESULT"] = '<div class="alert alert-success" role="alert"> لم تتم العملية بنجاح</div>';
                    }
                }else{
                    $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  إن  حالة العمل  غير مسجلة  </div>';   
                }
                
            }
            
        
        mysqli_close($conn);
    }

?>