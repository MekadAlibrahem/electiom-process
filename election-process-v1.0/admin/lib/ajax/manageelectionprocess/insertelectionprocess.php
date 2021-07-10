<?php
/***  كود اضافة عملية انتخابية  */
//  جلب القيم من الطلب 
    $id          = $_REQUEST["id"];
    $pname       = $_REQUEST["pname"];
    $type        = $_REQUEST["type"];
    $startdate   = $_REQUEST["startdate"];
    $enddate     = $_REQUEST["enddate"];
    $SCdate      = $_REQUEST["SCdate"];
    $ECdate      = $_REQUEST["ECdate"];
    // التأكد من صحة القيم المدخلة
    
    if( empty($pname) || empty($type) || empty($startdate) ||empty($enddate) || empty($SCdate) ||empty($ECdate) ){
        // يوجد حقل فارغ لذلك يجب ارسال رسالة خطأ لكي يتم إدخال جميع الحقول
        echo '<p class="alert alert-danger" role="alert">  يجب إدخال قيم محددة لحقول البيانات </p>';
    }else{
        // لا يوجد حقول فارغة 
        // الاتصال بقاعدة البيانات
        include("../../../../lib/Php/connectdb.php");
        if($id=null){
            // إذا كان رقم العملية الانتخابية فارغ فإن القاعدة تسجل رقم تلقائيا 
            // يمكن تسجيل العملية 
            $isnert_election_process ="INSERT INTO `electionprocess`(`IDProcess`, `nameP`, `IDTypeProcess`, `StartDate`, `EndDate`, `StartDateCandidature`, `EndDateCandidature`) VALUES (null,'$pname','$type','$startdate','$enddate','$SCdate','$ECdate')" ;
            $query_insert = mysqli_query($conn,$isnert_election_process);
            if($query_insert){
                // تم تنفيذ الاستعلام بنجاح 
                if(mysqli_affected_rows($conn)>0){
                    // يوجد حقل تأثر بلاستعلام =>تم إدخال البيانات بنجاح
                    echo '<div class="alert alert-success" role="alert"> تم الإضافة  بنجاح </div>' ;
                            
                }else{
                    // لا يوجد اي حقل تأثر بالأستعلام => لم بتم تسجيل البيانات 
                    
                    echo '<p class="alert alert-danger" role="alert">   لم يتم تسجيل البيانات </p>';
                }
            }else{
                // لم يتم تنفيذ الاستعلام
                $ERROR  = mysqli_error($conn) ;
                echo '<p class="alert alert-danger" role="alert">  
                '.$ERROR.'   </p>';
            }
        }else{
            // رقم العملية غير فارغ => يجب التأكد من أ، القم المدخل غير مستخدم سابقا
            $select_id = "SELECT `IDProcess` FROM `electionprocess` WHERE `IDProcess` = '$id' ";
            $query_id = mysqli_query($conn,$select_id);
            if($query_id){
                // تم تنفيذ الاستعلام عن رقم العملية الانتخابية
                    if(mysqli_num_rows($query_id)>0){
                        // يوجد حقل تأثر => رقم العملية الانتخابية مسجل سابقا لا يمكن استخدام هذا الرقم 
                        echo '<p class="alert alert-danger" role="alert">   إن رقم العملية المدخل مستخدم سابقا يمكنك ترك حقل رقم العملية الانتخابية فارغ لنجاح عملية الادخال   </p>';
                    }else{
                        // لم يجد اي عملية مسجلة بنفس الرقم => يمكن تسجيل البيانات 
                        $isnert_election_process ="INSERT INTO `electionprocess`(`IDProcess`, `nameP`, `IDTypeProcess`, `StartDate`, `EndDate`, `StartDateCandidature`, `EndDateCandidature`) VALUES ('$id','$pname','$type','$startdate','$enddate','$SCdate','$ECdate')" ;
                        $query_insert = mysqli_query($conn,$isnert_election_process);
                        if($query_insert){
                            // تم تنفيذ الاستعلام بنجاح 
                            if(mysqli_affected_rows($conn)>0){
                                // يوجد حقل تأثر بلاستعلام =>تم إدخال البيانات بنجاح
                                echo '<div class="alert alert-success" role="alert"> تم الإضافة  بنجاح </div>' ;
                            
                            }else{
                                // لا يوجد اي حقل تأثر بالأستعلام => لم بتم تسجيل البيانات 
                                
                                echo '<p class="alert alert-danger" role="alert">   لم يتم تسجيل البيانات </p>';
                            }
                        }else{
                            // لم يتم تنفيذ الاستعلام
                            $ERROR  = mysqli_error($conn) ;
                            echo '<p class="alert alert-danger" role="alert">  
                            '.$ERROR.'   </p>';
                        }
                    }
            }else{
                // لم يتم تنفيذ الاستعلام
                $ERROR  = mysqli_error($conn) ;
                echo '<p class="alert alert-danger" role="alert">  
                '.$ERROR.'   </p>';

            }

        }
        mysqli_close($conn);
        
    }
    
?>