
<?php

    
//   جلب  رقم المرشح و نص  البرنامج الانتخابي 
    $CandidateID = $_REQUEST["id"];
    $content     =$_REQUEST["text"]; 
//      الاتصال بقاعدة البيانات 
include("../../../../lib/Php/connectdb.php");
//         الاستعلام الخاص بإضاة برنامجة جديد
        $sql = "INSERT INTO `electionprograms`(`IDProgram`, `CandidateID`, `Content`) VALUES (null ,'$CandidateID','$content')" ;
        $query = mysqli_query($conn , $sql);
        if($query){
                //  بعد إضافة البرنامج الجديد يجب ان يتم إظهاره على  الوجهة  
                //  الاستعلام الخاص بإعادة البرنامج المدخل 
                $sql2 ="SELECT * FROM `electionprograms` WHERE IDProgram =(SELECT MAX(IDProgram) FROM `electionprograms` WHERE CandidateID = '$CandidateID' ) " ;
                $query2 = mysqli_query($conn,$sql2);
                if($query2){
                        //  الستعلام عن عدد البرامج الانتخابية  و بالتالي نعيد ترتيب البرنامج الاخير 
                        $sql3 = "SELECT COUNT(`IDProgram`) FROM `electionprograms` WHERE `CandidateID` = '$CandidateID'";
                        $query3 = mysqli_query($conn,$sql3);
                        if($query3){
                                while ($c = mysqli_fetch_array($query3)){
                                        $count = $c['0'];
                                }
                        }
                        if(mysqli_num_rows($query2)>0){
                               
                                while($row = mysqli_fetch_array($query2)){
                                        
                                        $num          = $row["IDProgram"];
                                        $program      = $row["Content"];
                                        $btnupnaem    = "btnup".$num ;
                                        $textname     = "text".$num ;
                                        $btndelname   = "btndel".$num ;
                                }
                                //  طباعة محتوى البرنامج الانتخابي 
                        
                                echo '
                                        <div class="col-sm-12 col-md-6">
                                        <div class="thumbnail">
                                        <div class="caption">
                                        <h3> البرنامج الانتخابي رقم'.$count.'  </h3>
                                        <p>
                                        <textarea name="" id="'. $textname.'" cols="10" rows="10"> ' .$program.' </textarea>
                                        </p>
                                        <p>
                                         <button type="submit" class = "btn btn-primary" role="button" onclick="Edit('.$num.',document.getElementById(\''.$textname.'\').value);" >
                                            <span class="glyphicon glyphicon-edit" aria-hidden="true">
                                         </button> 
                                         <button type="submit" class = "btn btn-danger" role="button" onclick="delet('.$num.') "> 
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true">
                                         </button>
                                        </p>
                                        </div>
                                        </div>
                                        </div>
                                ';
                        }
                }
        }else{
                echo "REORR IN YOUR QUERY";
        }
        mysqli_close($conn);
        
        
?>
