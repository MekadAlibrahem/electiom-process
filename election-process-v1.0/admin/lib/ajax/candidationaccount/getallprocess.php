<?php
//  استعلام يعيد العمليات الانتخابية المسجلة حسب نوع العملية 
$type  =  $_REQUEST["type"];
 //الاتصال بقاعدة البيانات
 include("../../../../lib/Php/connectdb.php");
 //الاستعلام عن العمليات الانتخابية  
 
     $select_election_process = "SELECT * FROM `electionprocess` WHERE `IDTypeProcess`='$type'  ";
     $election_process = mysqli_query($conn,$select_election_process);
     echo '
     <select id="electionallprocess" class="form-control" onchange="get_cand(this.value);"  >
     <option value="0"> اختر عملية انتخابية  </option>
     ';
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
                 $ERROR  = '<div class="alert alert-info" role="alert">
                  لا يوجد اي عملية انتخابية متاحة حاليا او العملية المطلوبة غير مسجلة 
                 </div>';
                 echo '<option value="0"> '.$ERROR.' </option>';
             }
     }else{
         //   يوجد خطأ في الاستعلام و جلب رسالة الخطأ
         $ERROR_QUERY = mysqli_error($conn);
         echo '<option value="0"> '.$ERROR_QUERY.' </option>';
     }
     // إنهاء الاتصال بقاعدة البيانات 
     echo '</select >';
 mysqli_close($conn);



?>