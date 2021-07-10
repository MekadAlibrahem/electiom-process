<?php
/** كود يعيد المرشحين لدائرة انتخابية ما  */
//  جلب البيانات ( رقم الدائرة الانتخابية و العملية الانتخابية )
    $id = $_REQUEST["id"];
    $process = $_REQUEST["p"];
    if($id>0){
        //  القيمة غير فارغة 
        //  الاتصال بقاعدة البيانات 
        include("../../../../lib/Php/connectdb.php");
        /**
         * يجب التحقق من نوع العملية الانتخابية لان الاستفتاء لا يجب عرض مرشحين بل عرض خياري التصويت ( نعم و لاء)
         */
        $get_type_process = "SELECT `IDTypeProcess` FROM `electionprocess` WHERE `IDProcess` = '$process'";
        $query_get_type_process = mysqli_query($conn,$get_type_process);
        if($query_get_type_process){
            // query get type process : true
            if(mysqli_num_rows($query_get_type_process)>0){
                // find  process 
                while($row = mysqli_fetch_array($query_get_type_process)){
                    if($row['IDTypeProcess'] == 1){
                            //  استفتاء و باالتالي تختلف طريقة العرض 
                            echo ' 
                                <div class="well">
                                <div class="row">
                                
                               <form > 
                                    <span class="input-group-addon">
                                    <input type="radio" id="radiovets" name="radiovets" value="1" >
                                    نعم 
                                    </span> 
                               
                                    <span class="input-group-addon">
                                    <input type="radio" id="radiovets"  name="radiovets" value="0">
                                    لا 
                                    </span> 
                                
                              </form>
                            </div><!-- /.row -->
                                
                                </div>
                                ';
                    }else{
                        //  ليست استفتاء و بالتالي يجب عرض المرشحين 
                         // استعلام يعيد المرشحين االتابيعين للدائرة الانتخابية و العملية الانتخابية المحددة 
            $get_canditions = "SELECT * FROM `candidates` WHERE `IDProcess` =  '$process'  AND `ElectionAreaID` = '$id'";
            $query = mysqli_query($conn,$get_canditions);
            if($query){
                // الاستعلام صحيح
                
                if(mysqli_num_rows($query)>0){
                //     وجد نتيجة 
                
                    while($row = mysqli_fetch_array($query)){
                        /** عرض نتيجة الاستعلام ( عرض المرشحين ) ) 
                         * يتم عرض كل مرشح في قسم ( بطاقة تحتوي معلومات اساسية عن المرشح ( الاسم و العمل و المواليد و الشهادة العلمية ))
                         * ويتم إضافة زر في نهاية معلومات المرشح بحيث يقوم بغرسال طلب اجاكس لعرض البرنامج الانتخابي للمرشح 
                         * يتم عرض البرنامج الانخابي برسالة تظهر فوق الصفحة 
                         */
                        echo '
                        <div class="col-lg-3 col-sm-6 col-md-4">
                        <div class="thumbnail">
                        <div class="caption">
                        <h3>'.$row["FName"].'<input type="checkbox" name="candidationname" id="candidationid" value="'.$row["CandidateID"].'" > </h3>';
                        $date = get_date($row["NationalNumber"]);
                        echo '<p> المواليد : '.$date.'</p> ';
                        echo '<p> المستوى الدراسي : '.$row["scientificlevel"].' </p>';
                        echo '<p> العمل الحالي : '.$row["currentwork"].' </p>' ;
                        echo '<p> معلومات  : '.$row["information"].'  </p>';
                        echo '<p> <button type="button" class="btn btn-primary" role="button"  onclick="show_programs('.$row["CandidateID"].');" > عرض البرنامج الانتخابي </button> </p> 
                        </div>
                        </div>
                        </div>';
                        //
                       
                        //
                        
                    }
                
            }else{
                //  لم يجد اي مرشح في هذه الداشرة الانتخابية 
                echo '<div class="alert alert-info" role="alert"> لا يوجد مرشحين متاحين في هذه الدائرة الانتخابية  حاليا </div> ';
            }
        }else{
            //الاستعلام خطأ 
            $ERRORQUERY = mysqli_error($conn);
            echo '<div class="alert alert-danger" role="alert">'.$ERRORQUERY.'</div> ';
        }
                    }
                }
            }else{
                // not found any process
                $ERRORQUERY = mysqli_error($conn);
                echo '<div class="alert alert-danger" role="alert">'.$ERRORQUERY.'</div> ';
            } 
        }else{
            // query type process: error
            $ERRORQUERY = mysqli_error($conn);
            echo '<div class="alert alert-danger" role="alert">'.$ERRORQUERY.'</div> ';
        }      

       
    }else{
        echo " -------------------  ";
    }


    

    
   function get_date($id){
    include("../../../../lib/Php/connectdb.php");
       $date = 0 ;
       $select_date = "SELECT `BirthDate` FROM `users` WHERE `NationalNumber` = '$id'";
       $query = mysqli_query($conn,$select_date);
       if($query){
           if(mysqli_num_rows($query)>0){
               while($row = mysqli_fetch_array($query)){
                   $date =  $row["BirthDate"];
               }
           }else{
               $date = 0 ;
           }
       }else{
           $date =  0 ;
       }
       mysqli_close($conn);
       return $date ;
   }
?>