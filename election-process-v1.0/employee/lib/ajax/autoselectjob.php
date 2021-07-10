<?php
//  كود يعيد اسم حالة العمل 
//  جلب القيم  
    $id = $_REQUEST["id"];
    //  الاتصال بقاعدة البيانات 
     include("../../../lib/Php/connectdb.php");
         //  استعلام يعيد اسم حجالة العمل 
    $select_id = "SELECT `jobName` FROM `job` WHERE `jobID` = '$id' ";
    $query = mysqli_query($conn,$select_id);
    if($query){
        if(mysqli_num_rows($query)>0){
            //  وجد قيمة 
            while($row = mysqli_fetch_array($query)){
                //  عرض النتيجة 
                echo '
                    <tr>
                        <td class=>
                            <input type="text"   class ="form-control" name="namejob"  value="'.$row["jobName"].'" />
                        </td>
                        <td class = "td-small">
                            : اسم حالة العمل
                        </td>
                    </tr>
                ';
            }
        }else{
            //  لم يجد قيمة  
            //  عرض نتيجة فارغة 
            echo '
                    <tr>
                        <td class=>
                            <input type="text"   class ="form-control" name="namejob"  />
                        </td>
                        <td class = "td-small">
                            : اسم حالة العمل 
                        </td>
                    </tr>
                ';
        }
        
       
    }

?>