<?php
//  كود يعيد اسم القيد عن طرق الرقم 
//  جلب قم القيد من الطلب  
    $id = $_REQUEST["id"];
    //   الاتصال بقاعدة البيانات 
    include("../../../lib/Php/connectdb.php");
    //  استعلام يعيد اسم القيد عن طريق الرقم 
    $select_id = "SELECT `AdressName` FROM `idadress` WHERE  `ID` = '$id'  ";
    $query = mysqli_query($conn,$select_id);
    if($query){
        //  الاستعلام صحيح
        if(mysqli_num_rows($query)>0){ 
            //  يوجد حقول متأثرة بالاستعلام  وبالتالي وجد القيد المطلوب 
            //  عرض نتيجة الاستعلام  
            while($row = mysqli_fetch_array($query)){

                echo '
                    <tr>
                        <td class=>
                            <input type="text"   class ="form-control" name="name"  value="'.$row["AdressName"].'" />
                        </td>
                        <td class = "td-small">
                            : مكان القيد  
                        </td>
                    </tr>
                ';
            }
        }else{
            //  لم يجد القيد المطلوب 
            //  عرض قيمة فارغة 
            echo '
                    <tr>
                        <td class=>
                            <input type="text"   class ="form-control" name="name"  />
                        </td>
                        <td class = "td-small">
                            : مكان القيد  
                        </td>
                    </tr>
                ';
        }
        
       
    }

?>