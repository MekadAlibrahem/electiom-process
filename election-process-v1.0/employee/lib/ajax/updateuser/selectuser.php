<!-- <script src="../ajax.js"> </script> -->
<?php

include("../../php/start.php");
// دالة تعيد طبيعة العمل حسب الرقم الوطني  
function selectuserjob($job){
    //   الاتصال بقاعدة البيانات 
    include("../../../../../lib/Php/connectdb.php");
    //  
    $select_job = "SELECT * FROM `job` " ;
    $query_job  = mysqli_query($conn,$select_job);
    if(mysqli_num_rows($query_job)>0){
        echo '<select  name="job" id="jobid" > ';
        while($row = mysqli_fetch_array($query_job)){
            
            if($job == $row["jobID"]){
                echo "<option value='".$row['jobID']."' selected >".$row['jobName']."</option>";
            }else{
                echo "<option value='".$row['jobID']."' >".$row['jobName']."</option>";
            }
        
        }
        echo " </select>";
    }
    mysqli_close($conn);
}

//----------------------------------------------------------------
// دالة تعيد المحافظات و المنطاق و البلدات التابعة لكل منها
function selectusertown($town){
    include("../../../../../lib/Php/connectdb.php");
        $select_town = "SELECT `CityID` FROM `residentialarea` WHERE `ResidentionAreaID` = '$town'" ;
        $query_select_town = mysqli_query($conn,$select_town);
        if($query_select_town){
            if(mysqli_num_rows($query_select_town)>0){
                while($row = mysqli_fetch_array($query_select_town)){
                    $city =   $row["CityID"];
                }
                $sql1 = "SELECT * FROM  `residentialarea` ";
                $query1 = mysqli_query($conn,$sql1);
                if($query1){
                    // QYERY1  TRUE
                    echo "<select name='town' id='selecttown' >";
                    while($row = mysqli_fetch_array($query1)){
                        if($town == $row["ResidentionAreaID"] ){
                            echo "<option value ='".$row["ResidentionAreaID"]."' selected>".$row["ResidentionAreaName"]."</option>";
                        }else{
                            echo "<option value ='".$row["ResidentionAreaID"]."' >".$row["ResidentionAreaName"]."</option>";
                        }
                        
                    }
                    echo "</select>" ;
                    $select_city = "SELECT * FROM `city` ";
                    $query_city  = mysqli_query($conn,$select_city);
                    if(mysqli_num_rows($query_city)>0){
                        
                        echo '<select name="city"   onchange="autoselecttown(this.value);">' ;
                        echo '<option value = "0" selected >اختر محافظة</option>';
                        while($row = mysqli_fetch_array($query_city)){
                            if($city == $row["CityID"]){
                                echo '<option value = "'. $row["CityID"].'" selected >'.$row["CityName"].'</option>';
                            }
                            echo '<option value = "'. $row["CityID"].'"  >'.$row["CityName"].'</option>';
                            
                        }
                        echo '</select>' ;
                    }
                }else{
                    // Query1  ERROR
                }
               
                
            }else{

            }
        }else{

        }
    
}


?>
<?php
$id = $_REQUEST["id"];
if($id>0){
    include("../../../../../lib/Php/connectdb.php");
    $select_user = "SELECT * FROM `users` WHERE `NationalNumber` = '$id'";
    $query_select = mysqli_query($conn,$select_user);
    if($query_select){
        if(mysqli_num_rows($query_select)>0){
            while($row = mysqli_fetch_array($query_select)){
                echo '
                <tr>
                <td id="RUFN"></td>
                <td class="td-small" > 
                    <button type="button" class="btn btn-primary" onclick="updatefname();" > 
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                    </button>    
                
                </td>
                <td> <input type="text" name="fname" class="form-control" id="fnameid" value="'.$row["FName"].'" /></td>
                <td class="td-small" > : الاسم </td>
                </tr>
                <tr>
                <td id="RULN"></td>
                <td class="td-small" > 
                    <button type="button" class="btn btn-primary" onclick="updatelname();"> 
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                    </button>    
                
                </td>
                <td><input type="text" name="lname" id="lnameid" class="form-control" value="'.$row["LName"].'"/>  </td>
                <td class="td-small" > : الكنية  </td>
                </tr>
                <tr>
                <td id="RUFAN"> </td>
                <td class="td-small" > 
                    <button type="button" class="btn btn-primary" onclick="updatefathername();"> 
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                    </button>    
                
                </td>
                <td><input type="text" name="fathername" id="fathernameid" class="form-control" value="'.$row["FatherName"].'" />  </td>
                <td class="td-small" > : اسم الاب </td>
                </tr>
                <tr>
                <td id="RUMN"  ></td>
                <td class="td-small" > 
                    <button type="button" class="btn btn-primary" onclick="updatemothername();"> 
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                    </button>    
                
                </td>
                <td><input type="text" name="mothername" id="mothernameid" class="form-control"  value="'.$row["MotherName"].'" /> </td>
                <td class="td-small" > : اسم الام </td>
                </tr>
            
                <tr>
                <td id="RUBD" ></td>
                <td class="td-small" > 
                    <button type="button" class="btn btn-primary" onclick="updatebirthdate()" > 
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                    </button>    
                
                </td>
                <td><input type="Date" name="birthdate" id="birthdateid" class="form-control" value="'.$row["BirthDate"].'" /> </td>
                <td class="td-small" > : تاريخ الميلاد  </td>
                </tr>
                <tr>
                <td id="RUA" ></td>
                <td class="td-small" > 
                    <button type="button" class="btn btn-primary" onclick="updateadress();"> 
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                    </button>    
                
                </td>
                <td><input type="text" name="adress" id="adressid" class="form-control" value="'.$row["Adress"].'" />  </td>
                <td class="td-small" > : عنوان السكن </td>
                </tr>
                <tr>
                <td id="RUID" ></td>
                <td class="td-small" > 
                    <button type="button" class="btn btn-primary" onclick="updateidadress()"; > 
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                    </button>    
                
                </td>
                <td>
                    <input type="number" name="idadress" id="adressnumber" class="form-control" value="'.$row["ID"].'"/>
                </td>
                <td class="td-small" > : رقم القيد </td>
                </tr>
                <tr>

                
                <td id="RUG"></td>
                <td class="td=small" ></td>
                <td>';
                if($row["gender"]==1){
                    echo '
                    <input type="radio" name="gender"   onclick="updategender(1);" class="option" value="male" checked >  ذكر <br>
                    <input type="radio" name="gender"   onclick="updategender(0);" class="option" value="fmale" >  انثى 
                    ';
                }else{
                    echo '
                    <input type="radio" name="gender"   onclick="updategender(1);" class="option" value="male"   >  ذكر <br>
                    <input type="radio" name="gender"   onclick="updategender(0);" class="option" value="fmale" checked >  انثى 
                    ';
                }
                echo '    
                </td>
                <td class="td-small" > : الجنس </td>
                </tr>
                <tr>
                <td id="RUJ" ></td>
                <td class="td-small" > 
                    <button type="button" class="btn btn-primary" onclick="updatejob();"> 
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                    </button>    
                
                </td>
                <td>'; ?> <?php
                selectuserjob($row["jobID"]);
                     
                echo '</td>
                <td class="td-small" > :  حالة العمل  </td>
                </tr>
                <tr>
                <td id="RUT" ></td>
                <td class="td-small" > 
                    <button type="button" class="btn btn-primary" onclick="updatetown();"> 
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                    </button>    
                
                </td>
                <td>'?> <?php
                selectusertown($row["ResidentionAreaID"]);
                   
                    echo '
                </td>
                <td class="td-small" > :  منطقة السكن  </td>
                </tr>
                    <td id="RUIMG"></td>
                    <td class="td-small" > 
                    <button type="submit" class="btn btn-primary" name="updateimage" > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>    
                    
                    </td>
                    <td>
                        <input type="file" name="pic"  id="userimge" class="form-control" />
                    </td>
                    <td class="td-small" > :  الصورة الشخصية </td>
                </tr>
                '; 
                
                    
                
            }
        }else{
            echo '
            <tr>
                    <td id="RUFN"></td>
                    <td class="td-small" > 
                        <button type="button" class="btn btn-primary" onclick="updatefname();" > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>    
                    
                    </td>
                    <td> <input type="text" name="fname" class="form-control" id="fnameid" /></td>
                    <td class="td-small" > : الاسم </td>
                </tr>
                <tr>
                    <td id="RULN"></td>
                    <td class="td-small" > 
                        <button type="button" class="btn btn-primary" onclick="updatelname();"> 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>    
                    
                    </td>
                    <td><input type="text" name="lname" id="lnameid" class="form-control" />  </td>
                    <td class="td-small" > : الكنية  </td>
                </tr>
                <tr>
                    <td id="RUFAN"> </td>
                    <td class="td-small" > 
                        <button type="button" class="btn btn-primary" onclick="updatefathername();"> 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>    
                    
                    </td>
                    <td><input type="text" name="fathername" id="fathernameid" class="form-control" />  </td>
                    <td class="td-small" > : اسم الاب </td>
                </tr>
                <tr>
                    <td id="RUMN"  ></td>
                    <td class="td-small" > 
                        <button type="button" class="btn btn-primary" onclick="updatemothername();"> 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>    
                    
                    </td>
                    <td><input type="text" name="mothername" id="mothernameid" class="form-control" /> </td>
                    <td class="td-small" > : اسم الام </td>
                </tr>
            
                <tr>
                    <td id="RUBD" ></td>
                    <td class="td-small" > 
                        <button type="button" class="btn btn-primary" onclick="updatebirthdate()" > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>    
                    
                    </td>
                    <td><input type="Date" name="birthdate" id="barthdateid" class="form-control" /> </td>
                    <td class="td-small" > : تاريخ الميلاد  </td>
                </tr>
                <tr>
                    <td id="RUA" ></td>
                    <td class="td-small" > 
                        <button type="button" class="btn btn-primary" onclick="updateadress();"> 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>    
                    
                    </td>
                    <td><input type="text" name="adress" id="adressid" class="form-control" />  </td>
                    <td class="td-small" > : عنوان السكن </td>
                </tr>
                <tr>
                    <td id="RUID" ></td>
                    <td class="td-small" > 
                        <button type="button" class="btn btn-primary" onclick="updateidadress()"; > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>    
                    
                    </td>
                    <td>
                        <input type="number" name="idadress" id="adressnumber" class="form-control">
                    </td>
                    <td class="td-small" > : رقم القيد </td>
                </tr>
                <tr>
                    
                    <td id="RUG"></td>
                    <td class="td=small" ></td>
                    <td>
                        <input type="radio" name="gender"   onclick="updategender(1);" class="option" value="male"  >  ذكر <br>
                        <input type="radio" name="gender"   onclick="updategender(0);" class="option" value="fmale" >  انثى 
                    </td>
                    <td class="td-small" > : الجنس </td>
                </tr>
                <tr>
                    <td id="RUJ" ></td>
                    <td class="td-small" > 
                        <button type="button" class="btn btn-primary" onclick="updatejob();"> 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>    
                    
                    </td>
                    <td> ';?> <?php
                        selectjob();
                        echo ' 
                    </td>
                    <td class="td-small" > :  حالة العمل  </td>
                </tr>
                <tr>
                    <td id="RUT" ></td>
                    <td class="td-small" > 
                        <button type="button" class="btn btn-primary" onclick="updatetown();"> 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>    
                    
                    </td>
                    <td>';?> <?php
                            selectcity();
                        echo '
                    </td>
                    <td class="td-small" > :  منطقة السكن  </td>
                </tr>
                    <td id="RUIMG"></td>
                    <td class="td-small" > 
                    <button type="submit" class="btn btn-primary" name="updateimage" > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>    
                    
                    </td>
                    <td>
                        <input type="file" name="pic" id="userimge" class="form-control" />
                    </td>
                    <td class="td-small" > :  الصورة الشخصية </td>
                </tr>
            ';
        }
    }
}




?>
