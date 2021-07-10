<?php

//  كود يعيد معلومات عملية انتخابية 
$id = $_REQUEST["id"];

    //الاتصال بقاعدة البيانات
    include("../../../../lib/Php/connectdb.php");
    //الاستعلام عن العمليات الانتخابية  
   
        $select_election_process = "SELECT * FROM `electionprocess` WHERE `IDProcess` = '$id'";
        $election_process = mysqli_query($conn,$select_election_process);
        if($election_process){
                // تم تنفيذ الاستعلام 
                if(mysqli_num_rows($election_process)>0){
                    //  وجد عمليات انتخابية متاحة 
                    // عرض النتيجة
                    while($row = mysqli_fetch_array($election_process)){
                        $name = $row["nameP"];
                        $type = $row["IDTypeProcess"];
                        $startdate = $row["StartDate"];
                        $enddate = $row["EndDate"];
                        $canstartdate = $row["StartDateCandidature"];
                        $canenddate = $row["EndDateCandidature"];
                       echo '
                       <tr>
                       <td id="REPN" >

                       </td  >
                       <td class="td-small">
                       <!--  زر يقومبارسال طلب اجاكس لتعديل اسم العملية الانتخابية  -->
                           <button type="button"  class="btn btn-primary" onclick="edit_process_name();" > 
                               <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                           </button>
                       </td>
                       <td>
                               <input type="text" value="'.$name.'" class="form-control"   id="pname" />
                             
                       </td>
                       <td class="td-small">
                            : اسم العملية الانتخابية
                       </td>
                   </tr>
                   <tr>
                       <td id="RETP" >

                       </td >
                       <td class="td-small">
                       <!--  زر يقوم بارسال طلب اجاكس لتعديل نوع عملية انتخابية  -->
                           <button type="button" class="btn btn-primary" onclick="edit_process_type();" > 
                               <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                           </button>
                       </td>
                       <td>
                               <select id="type" class="form-control" >
                                     
                               '; 
                                       //  دالة تعيد انوع العمليات الانتخابية 
                                       get_type($row["TypeProcessID"]);  
                                       echo '
                               </select>
                             
                       </td>
                       <td class="td-small">
                           : نوع العملية الانتخابية
                       </td>
                   </tr>
                   <tr>
                       <td id="RESD" >

                       </td  >
                       <td class="td-small">
                       <!--  زر يقوم بارسال طلب اجاكس لتعديل تاريخ بداية عملية انتخابية  -->
                           <button type="button" class="btn btn-primary" onclick="edit_process_start();" > 
                               <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                           </button>
                       </td>
                       <td>
                               <input type="date" class="form-control" value="'.$startdate.'"  id="startdate" />
                             
                       </td>
                       <td class="td-small">
                            : تاريخ بداية الانتخاب
                       </td>
                   </tr>
                   <tr>
                       <td id="REED" >

                       </td  >
                       <td class="td-small">
                       <!--  زر يقوم بارسال طلب اجاكس لتعديل تاريخ نهاية عملية انتخابية   -->
                           <button type="button" class="btn btn-primary" onclick="edit_process_end();" > 
                               <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                           </button>
                       </td>
                       <td>
                               <input type="date" class="form-control" value="'.$enddate.'"  id="enddate" />
                             
                       </td>
                       <td class="td-small">
                            : تاريخ نهاية الانتخاب
                       </td>
                   </tr>
                   <tr>
                       <td id="RESDC" >

                       </td  >
                       <td class="td-small">
                       <!--  زر يقوم بارسال طلب اجاكس لتعديل تاريخ بداية الترشح لعملية انتخابية   -->
                           <button type="button" class="btn btn-primary" onclick="edit_start_candidation();" > 
                               <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                           </button>
                       </td>
                       <td>
                               <input type="date" class="form-control" value="'.$canstartdate.'"  id="SCdate" />
                             
                       </td>
                       <td class="td-small">
                           : تاريخ بداية الترشح
                       </td>
                   </tr>
              
                   <tr>
                       <td id="REEDC" >

                       </td  >
                       <td class="td-small">
                       <!--  زر يقوم بارسال طلب اجاكس لتعديل تاريخ نهاية الترشح لعملية انتخابية  -->
                           <button type="button" class="btn btn-primary" onclick="edit_end_candidation();" > 
                               <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                           </button>
                       </td>
                       <td>
                               <input type="date" class="form-control" value="'.$canenddate.'"  id="ECdate" />
                             
                       </td>
                       <td class="td-small">
                           : تاريخ نهاية الترشح
                       </td>
                   </tr>
                       
                       
                       ';
                    }
                }else{

                    echo '<tr>
                    <td id="REPN" >

                    </td  >
                    <td class="td-small">
                    <!--  زر يقومبارسال طلب اجاكس لتعديل اسم العملية الانتخابية  -->
                        <button type="button" class="btn btn-primary" onclick="edit_process_name();" > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>
                    </td>
                    <td>
                            <input type="text" class="form-control"   id="pname" />
                          
                    </td>
                    <td class="td-small">
                         : اسم العملية الانتخابية
                    </td>
                </tr>
                <tr>
                    <td id="RETP" >

                    </td >
                    <td class="td-small">
                    <!--  زر يقوم بارسال طلب اجاكس لتعديل نوع عملية انتخابية  -->
                        <button type="button" class="btn btn-primary" onclick="edit_process_type();" > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>
                    </td>
                    <td>
                            <select id="type" class="form-control" >
                                   '; 
                                    //  دالة تعيد انوع العمليات الانتخابية 
                                    get_type(0);  
                                echo '
                            </select>
                          
                    </td>
                    <td class="td-small">
                        : نوع العملية الانتخابية
                    </td>
                </tr>
                <tr>
                    <td id="RESD" >

                    </td  >
                    <td class="td-small">
                    <!--  زر يقوم بارسال طلب اجاكس لتعديل تاريخ بداية عملية انتخابية  -->
                        <button type="button" class="btn btn-primary" onclick="edit_process_start();" > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>
                    </td>
                    <td>
                            <input type="date" class="form-control"   id="startdate" />
                          
                    </td>
                    <td class="td-small">
                         : تاريخ بداية الانتخاب
                    </td>
                </tr>
                <tr>
                    <td id="REED" >

                    </td  >
                    <td class="td-small">
                    <!--  زر يقوم بارسال طلب اجاكس لتعديل تاريخ نهاية عملية انتخابية   -->
                        <button type="button" class="btn btn-primary" onclick="edit_process_end();" > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>
                    </td>
                    <td>
                            <input type="date" class="form-control"   id="enddate" />
                          
                    </td>
                    <td class="td-small">
                         : تاريخ نهاية الانتخاب
                    </td>
                </tr>
                <tr>
                    <td id="RESDC" >

                    </td  >
                    <td class="td-small">
                    <!--  زر يقوم بارسال طلب اجاكس لتعديل تاريخ بداية الترشح لعملية انتخابية   -->
                        <button type="button" class="btn btn-primary" onclick="edit_start_candidation();" > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>
                    </td>
                    <td>
                            <input type="date" class="form-control"   id="SCdate" />
                          
                    </td>
                    <td class="td-small">
                        : تاريخ بداية الترشح
                    </td>
                </tr>
           
                <tr>
                    <td id="REEDC" >

                    </td  >
                    <td class="td-small">
                    <!--  زر يقوم بارسال طلب اجاكس لتعديل تاريخ نهاية الترشح لعملية انتخابية  -->
                        <button type="button" class="btn btn-primary" onclick="edit_end_candidation();" > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>
                    </td>
                    <td>
                            <input type="date" class="form-control"   id="ECdate" />
                          
                    </td>
                    <td class="td-small">
                        : تاريخ نهاية الترشح
                    </td>
                </tr>';
                }
        }else{
            
        }
        // إنهاء الاتصال بقاعدة البيانات 
    mysqli_close($conn);



    function get_type($type){
        include("../../../../lib/Php/connectdb.php");
        
        $get_type = "SELECT * FROM `typeprocess`";
        $query_get_type = mysqli_query($conn,$get_type);
        if($query_get_type){
                if(mysqli_num_rows($query_get_type)>0){
                    while($row = mysqli_fetch_array($query_get_type)){
                        if($row['IDTypeProcess']== $type){
                            echo "<option value = '".$row['IDTypeProcess']."' selected >";
                            echo  $row['Type'];
                            echo " </option>" ;
                        }else{
                            echo "<option value = '".$row['IDTypeProcess']."' >";
                            echo  $row['Type'];
                            echo " </option>";
                        }
                    }
                }
        }else{
    
        }
        mysqli_close($conn);
    }
    ?>