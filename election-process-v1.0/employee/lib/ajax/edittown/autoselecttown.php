<?php
/**  كود لطلب جاكس يعيد معلومات  المنطقة تلقائا عند ادخال رقمها  */
$GLOBALS['ERRORCITY'] = " " ;
$GLOBALS['ERRORNAME'] = " " ;
//  دالة تعيد اسماء لمحافظات  
function selectcity($city){
    //  الاتصال بقاعجة البيانات 
    include("../../../../../lib/Php/connectdb.php");
    //  استعلام يعيد المعلومات عن كل محافظة مسجلة 
    $select_city = "SELECT * FROM `city` " ;
    $query_city = mysqli_query($conn,$select_city);
    if(mysqli_num_rows($query_city)>0){
        //  وجد نتيجة 
        echo "<option  value='0' >  
        اختر محافظة 
        </option>";
        while($row = mysqli_fetch_array($query_city)){
            //  عرض نتيجة الاستعلام  
            if($row["CityID"] == $city){
                echo "<option value='".$row['CityID']."' selected >" ;
                echo $row['CityName'];
                echo"</option>" ;
            }else{
                echo "<option value='".$row['CityID']."' >" ;
                echo $row['CityName'];
                echo"</option>" ;
            }
           
        }
        
    }else{
        //  لم يجد اي محافظة مسجلة 
        echo "<option  value='0' >  
        لا يوجد اي محافظة مسجلة 
        </option>";
    }
    //  اغلاق الاتصال بقاعدة البيانات 
    mysqli_close($conn);
}
//  جلب رقم المنطقة من طلب اجاكس
    $id = $_REQUEST['id'];
    //  لتحقق ان الرقم غير فارغ 
    if(!empty($id)){
        //  الرقم غير فراغ و اكبر من 0 
        //  الاتصال بقاعدة البياتات 
        include("../../../../../lib/Php/connectdb.php");
        //  استعلام يعيد معلومات عن منطقة  اعن طريق الرقم
        $select = "SELECT * FROM  `residentialarea` WHERE `ResidentionAreaID`  = $id ";
        $query = mysqli_query($conn,$select);
        if($query){
            if(mysqli_num_rows($query)>0){
                //   و جد المنطقة المطلوبة  
                while($row = mysqli_fetch_array($query)){
                    echo'
                    <tr>
                        
                    <td id="RENT" > '; ?>
                        <?php echo $GLOBALS['ERRORNAME'] ; ?><?php echo '
                        </td>
                        <td class="td-small" >
                        <!-- زر يقوم بارسال طلب اجاكس لتعديل اسم المنطقة  -->
                            <button type="button" class="btn btn-primary" onclick="editname();" > 
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                            </button>
                        </td>
                            
                        
                        <td >
                            <input type="text"  value="'.$row["ResidentionAreaName"].'"  id="town" class ="form-control" name="nametown" />
                        </td>
                        <td class = "td-small">
                            : اسم المنطقة   
                        </td>

                    </tr>
                    <tr>
                        <td id="REC" >';?> <?php echo $GLOBALS['ERRORCITY'] ; ?><?php echo ' </td>
                        <td class="td-small" >
                        <!--  زر يقوم بارسال طلب اجاكس لتعديل اسم المحافظة التي تحتوي المنطقة المحددة  -->
                            <button type="button" class="btn btn-primary" onclick="editcity();" > 
                                <span class="glyphicon glyphicon-edit"  aria-hidden="true"></span> 
                            </button>
                        </td>
                        <td>
                        <!--  عرض اسماء المحافظات المسجلة  -->
                            <select  name="city" id="cityID"  class="form-control"  >   ';?> 
                                <?php  selectcity($row["CityID"]);  ?><?php echo '
                            </select>
                        </td>
                        <td>
                            :  المحافطة
                        </td>
                    </tr>
                    ';
                }
                
               
            }else{
                echo'
                <tr>
                    
                <td id="RENT" > '; ?>
                    <?php echo $GLOBALS['ERRORNAME'] ; ?><?php echo '
                    </td>
                    <td class="td-small" >
                    <!-- زر يقوم بارسال طلب اجاكس لتعديل اسم المنطقة  -->
                        <button type="button" class="btn btn-primary" onclick="editname();" > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>
                    </td>
                        
                    
                    <td >
                        <input type="text"  value=""  id="town" class ="form-control" name="nametown" />
                    </td>
                    <td class = "td-small">
                        : اسم المنطقة   
                    </td>

                </tr>
                <tr>
                    <td id="REC" >';?> <?php echo $GLOBALS['ERRORCITY'] ; ?><?php echo ' </td>
                    <td class="td-small" >
                    <!--  زر يقوم بارسال طلب اجاكس لتعديل اسم المحافظة التي تحتوي المنطقة المحددة  -->
                        <button type="button" class="btn btn-primary" onclick="editcity();" > 
                            <span class="glyphicon glyphicon-edit"  aria-hidden="true"></span> 
                        </button>
                    </td>
                    <td>
                    <!--  عرض اسماء المحافظات المسجلة  -->
                        <select  name="city" id="cityID"  class="form-control"  >   ';?> 
                            <?php  selectcity(0);  ?><?php echo '
                        </select>
                    </td>
                    <td>
                        :  المحافطة
                    </td>
                </tr>
                ';
            }
        }
    }
   


?>