<?php 
//  كود يعيد قائمة باسماء مرشحين لعملية انتخابية محددة 

$process  =  $_REQUEST["process"];
 //الاتصال بقاعدة البيانات
 include("../../../../lib/Php/connectdb.php");
 //الاستعلام عن العمليات الانتخابية  
 
     $get_candidates = "SELECT * FROM `candidates` WHERE `IDProcess` = '$process' ORDER BY `ElectionAreaID` ASC ";
     $candidates = mysqli_query($conn,$get_candidates);
     
     if($candidates){
             // تم تنفيذ الاستعلام 
             
             if(mysqli_num_rows($candidates)>0){
                 //  وجد عمليات انتخابية متاحة 
                 // عرض النتيجة
                 echo '
                    <tr>
                        <td>
                                 حذف 
                        </td>
                        <td>
                              الدائرة الانتخابية 
                        </td>
                        <td>
                              اسم المرشح 
                               
                        </td>
                        <td>
                                
                                الرقم الوطني
                        </td>
                    </tr>
                    
                    ';
                 while($row = mysqli_fetch_array($candidates)){
                    $candidatid = $row["CandidateID"];
                    $nationalnumber = $row["NationalNumber"];
                    $electionareaid = $row["ElectionAreaID"] ;
                    $electionareaname = get_election_area($electionareaid,$conn);
                    echo '
                    <tr >
                        <td>
                            ';
                            if(check_date_process_candidates($process,$conn)){
                                echo '
                                <button type="button" class="btn btn-danger" role="button" onclick="delete_candidat_account('.$candidatid.','.$electionareaid.');" >
                                <span class="glyphicon glyphicon-trash" aria-hidden="true">
                            </button>
                                ';
                            }else{
                                echo ' <p>  لا يمكن الحذف   </p>' ;
                            } 
                                
                            echo '
                        </td>
                        <td>
                            '.$electionareaname.'
                        </td>
                        <td>

                            '.$row["FName"].'
                                
                        </td>
                        <td>

                        '.$nationalnumber.'
                           
                        </td>
                    </tr>
                    
                    ';
                    
                 }
             }else{

                 // لم يجد اي نتيجة =>جميع العمليات الانتخابية المسجلةانتهت تاريخها 
                 $ERROR  = '<div class="alert alert-info" role="alert">
                  لا يوجد اي مرشح مسجل بهذه العملية الانتخابية 
                 </div>';
                echo $ERROR ;
             }
     }else{
         //   يوجد خطأ في الاستعلام و جلب رسالة الخطأ
         $ERROR_QUERY = mysqli_error($conn);
        echo $ERROR_QUERY ;
     }
     // إنهاء الاتصال بقاعدة البيانات 
    
 mysqli_close($conn);


function get_election_area($electionareaid,$conn){
    
    $get_Election_Area = "SELECT `ElectionAreaName` FROM `electionareas` WHERE `ElectionAreaID` = '$electionareaid'  ";
    $query  = mysqli_query($conn, $get_Election_Area);
    if($query){
        if(mysqli_num_rows($query)>0){
            while ($row = mysqli_fetch_array($query)) {
                return $row["ElectionAreaName"];
            }
        }
    }
    return " ------  " ;             
}
function check_date_process_candidates($process,$conn){
    $check_date = "SELECT * FROM `electionprocess` WHERE DATE(`EndDateCandidature`)> DATE(CURDATE()) AND DATE(`StartDateCandidature`) < DATE(CURDATE())   AND `IDProcess` = '$process' ";
        $query_check_date = mysqli_query($conn,$check_date);
        if($query_check_date){
                // تم تنفيذ الاستعلام 
                if(mysqli_num_rows($query_check_date)>0){
                    //  وجد عمليات انتخابية متاحة 
                        return true ; 
                }else{

                   return false;
                   
                }
        }else{
                return false ;
        }
}

?>