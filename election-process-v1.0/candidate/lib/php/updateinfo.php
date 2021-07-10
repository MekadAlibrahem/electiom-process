<?php
    //  دالة تعديل عمل المرشح الحالي  عن طريق الرقم الوطني للمرشح  
    function updatework($id , $newwork){
        //  التأكد ان القيمة المدخلة غير فارغة 
        if(!empty($newwork)){
            //  الاتصال بقاعدة البيانات 
            include("../../../../lib/Php/connectdb.php");
            // استعلام للتعديل على قيمة العمل الحالي 
            $sql =  "UPDATE  candidates set currentwork  = '$newwork'  WHERE NationalNumber='$id'";
            $query = mysqli_query($conn,$sql);
            if($query){
                // إذا تم تنفيذ الاستعلام بشكل صحيح
                if(mysqli_affected_rows($conn)>0){
                    //  يوجد حقول تأثرت بلاستعلام و بالتالي تم التعديل بنجاح 
                    $updateworkre = "<div class='alert alert-success' role='alert'> تم تعديل البيانات  </div>" ;
                    mysqli_close($conn);
                    return $updateworkre ;
                }else{
                    //  لم يتم التعديل 
                    $updateworkre = "<div class='alert alert-danger' role='alert'>  لم يتم التعديل </div>" ;
                    mysqli_close($conn);
                    return $updateworkre ;
                }
                    
            }else{
                ///  يوجد خطأ في الاستعلام 
                $ERROR_QUERY = mysqli_error($conn);
                $updateworkre = "<div class='alert alert-danger' role='alert'>'.$ERROR_QUERY.' </div>" ;
                mysqli_close($conn);
                return $updateworkre ;
            }
        }else{
            //  إذا كانت القيمة فارغة 
            $updateworkre = "<div class='alert alert-danger' role='alert'>  هذا الحقل مطلوب </div>" ;
            return $updateworkre ;
        }
    }
//  دالة تعيد العمل الحالي  
    function selectwork($id){
        include("../../../../lib/Php/connectdb.php");
        $sql = "SELECT currentwork FROM `candidates` WHERE NationalNumber='$id' ";
        $queryinfo = mysqli_query($conn,$sql);
        if(mysqli_num_rows($queryinfo)==1){
            while($row = mysqli_fetch_array($queryinfo)){
                $work           = $row['currentwork'];
               
            }
            mysqli_close($conn);
            return $work ;
        }
    }
    //  دالة تعديل العمل القديم للمرشح 
    function updateoldwork($id , $oldwork){
        if(!empty($oldwork)){
            $conn = mysqli_connect("localhost","root","" ,"testweb1");
            mysqli_set_charset($conn,"utf8");
            $sql =  "update  candidates set Previousworks   = '$oldwork'  WHERE NationalNumber='$id'";
            $query = mysqli_query($conn,$sql);
            if($query){
                    $updateoldworkre = "<div class='alert alert-success' role='alert'> تم تعديل البيانات  </div>" ;
                    mysqli_close($conn);
                    return $updateoldworkre ;
            }else{
                $updateoldworkre = "<div class='alert alert-danger' role='alert'>  لم يتم التعديل </div>" ;
                mysqli_close($conn);
                return $updateoldworkre ;
            }
        }else{
            $updateoldworkre = "<div class='alert alert-danger' role='alert'>  هذا الحقل مطلوب </div>" ;
            return $updateoldworkre ;
        }
    }
//  دالة تعيد العمل القديم للمرشح 
    function selectoldwork($id){
        $conn = mysqli_connect("localhost","root","" ,"testweb1");
        mysqli_set_charset($conn,"utf8");
        $sql = "SELECT Previousworks  FROM `candidates` WHERE NationalNumber='$id' ";
        $queryinfo = mysqli_query($conn,$sql);
        if(mysqli_num_rows($queryinfo)==1){
            while($row = mysqli_fetch_array($queryinfo)){
                $oldwork           = $row['Previousworks'];
               
            }
            mysqli_close($conn);
            return $oldwork ;
        }
    }
    //  دالة تعديل الشهادة العلمية الخاصة بالمرشح 
    function updatecart($id , $cart){
        if(!empty($cart)){
            $conn = mysqli_connect("localhost","root","" ,"testweb1");
            mysqli_set_charset($conn,"utf8");
            $sql =  "update  candidates set scientificlevel   = '$cart'  WHERE NationalNumber='$id'";
            $query = mysqli_query($conn,$sql);
            if($query){
                    $updatcartre = "<div class='alert alert-success' role='alert'> تم تعديل البيانات  </div>" ;
                    mysqli_close($conn);
                    return $updatcartre ;
            }else{
                $updatcartre = "<div class='alert alert-danger' role='alert'>  لم يتم التعديل </div>" ;
                mysqli_close($conn);
                return $updatcartre ;
            }
        }else{
            $updatcartre = "<div class='alert alert-danger' role='alert'>  هذا الحقل مطلوب </div>" ;
            return $updatcartre ;
        }
    }
//  دالة تعديل الشهادة العلمية الخاصة بالمرشح 
    function selectcart($id){
        $conn = mysqli_connect("localhost","root","" ,"testweb1");
        mysqli_set_charset($conn,"utf8");
        $sql = "SELECT scientificlevel FROM `candidates` WHERE NationalNumber='$id' ";
        $queryinfo = mysqli_query($conn,$sql);
        if(mysqli_num_rows($queryinfo)==1){
            while($row = mysqli_fetch_array($queryinfo)){
                $cart           = $row['scientificlevel'];
               
            }
            mysqli_close($conn);
            return $cart ;
        }
    }
    //  دالة تعديل العلومات عن مرشح 
    function updateotherinfo($id , $otherinfo){
        if(!empty($otherinfo)){
            $conn = mysqli_connect("localhost","root","" ,"testweb1");
            mysqli_set_charset($conn,"utf8");
            $sql =  "update  candidates set information   = '$otherinfo'  WHERE NationalNumber='$id'";
            $query = mysqli_query($conn,$sql);
            if($query){
                    $updateinfore = "<div class='alert alert-success' role='alert'> تم تعديل البيانات  </div>" ;
                    mysqli_close($conn);
                    return $updateinfore ;
            }else{
                $updateinfore = "<div class='alert alert-danger' role='alert'>  لم يتم التعديل </div>" ;
                mysqli_close($conn);
                return $updateinfore ;
            }
        }else{
            $updateinfore = "<div class='alert alert-danger' role='alert'>  هذا الحقل مطلوب </div>" ;
            return $updateinfore ;
        }
    }
//  دالة تعيد المعلومات عن المرشح 
    function selectotherinfo($id){
        $conn = mysqli_connect("localhost","root","" ,"testweb1");
        mysqli_set_charset($conn,"utf8");
        $sql = "SELECT information FROM `candidates` WHERE NationalNumber='$id' ";
        $queryinfo = mysqli_query($conn,$sql);
        if(mysqli_num_rows($queryinfo)==1){
            while($row = mysqli_fetch_array($queryinfo)){
                $otherinfo           = $row['information'];
               
            }
            mysqli_close($conn);
            return $otherinfo ;
        }
    }

?>