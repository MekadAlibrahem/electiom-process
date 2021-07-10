<?php
//  استدعاء ملف الدوال 
include("../../php/Basic.php");
// function return type process and selected type to election area
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
// end function get type
//---------------------------
//  جلب البيانات المطلوبة 
$id = $_REQUEST["id"];
if($id >0 ){
    //  الرقم غير فارغ 
    $name = "";
    //  التصال بقاعدة البيانات 
    include("../../../../lib/Php/connectdb.php");
    //  استعلام يعيد معلومات الدائرة الانتخابية  
    $get_name = "SELECT * FROM  `electionareas` WHERE `ElectionAreaID` = '$id'";
    $query_get_name = mysqli_query($conn,$get_name);
    if($query_get_name){
        //استعلام جلب المعلومات صحيح 
        if(mysqli_num_rows($query_get_name)>0){
            // وجد دائرة الانتخابية المطلوبة 
            while($row = mysqli_fetch_array($query_get_name)){
                //  تخزين المعلومات في متغيرات  
                $name  = $row["ElectionAreaName"];
                $type = $row["IDTypeProcess"];
                $count =$row["Count"];
            }
            //  عرض النتيجة 
                    echo'
                    <tr>
                    <td id="rename" >

                    </td  >
                    <td class="td-small">
                        <button type="button" class="btn btn-primary" onclick="editName();" > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>
                    </td>
                    <td>
                            <input type="text" name="" id="name" class="form-control" value="'.$name.'">
                            
                    </td>
                    <td class="td-small">
                        : اسم الدائرة الانتخابية
                    </td>
                </tr>
                <tr>
                    <td id="retype" >

                    </td  >
                    <td class="td-small">
                        <button type="button" class="btn btn-primary" onclick="edittype();" > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>
                    </td>
                    <td>
                            <select id="type" class="form-control" >';
                                get_type($type);
                        echo '</select>
                        
                    </td>
                    <td class="td-small">
                        : نوع الانتخابات  
                    </td>
                </tr>
                <tr>
                    <td id="recount" >

                    </td>
                    <td class="td-small">
                        <button type="button" class="btn btn-primary" onclick="editacount();" > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>
                    </td>
                    <td>
                            <input type="number" name="" id="count"  min="0" class="form-control" value="'.$count.'">
                        
                    </td>
                    <td class="td-small">
                    : عدد المقاعد  
                    </td>
                </tr>
                    
                    
                    ';
                
        }else{
            //لم يجد الدائرة الانتخابية  المطلوبة 
            //  عرض رسالة فارغة 
            echo '
            <tr>
            <td id="rename" >

            </td  >
            <td class="td-small">
                <button type="button" class="btn btn-primary" onclick="editName();" > 
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                </button>
            </td>
            <td>
                    <input type="text" name="" id="name" class="form-control" >
                    
            </td>
            <td class="td-small">
                : اسم الدائرة الانتخابية
            </td>
        </tr>
        <tr>
            <td id="retype" >

            </td  >
            <td class="td-small">
                <button type="button" class="btn btn-primary" onclick="edittype();" > 
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                </button>
            </td>
            <td>
                    <select id="type" class="form-control" >';
                    get_type_process(0);
                echo '</select>
                
            </td>
            <td class="td-small">
                : نوع الانتخابات  
            </td>
        </tr>
        <tr>
            <td id="recount" >

            </td>
            <td class="td-small">
                <button type="button" class="btn btn-primary" onclick="editacount();" > 
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                </button>
            </td>
            <td>
                    <input type="number" name="" id="count"  min="0" class="form-control" >
                
            </td>
            <td class="td-small">
               : عدد المقاعد  
            </td>
        </tr>
            
            
            ';
        }
    }else{
        // خطأ في استعلام جلب بيانات الدائرة الانتخابية  
    }
}else{
    echo '
    <tr>
    <td id="rename" >

    </td  >
    <td class="td-small">
        <button type="button" class="btn btn-primary" onclick="editName();" > 
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
        </button>
    </td>
    <td>
            <input type="text" name="" id="name" class="form-control" >
            
    </td>
    <td class="td-small">
        : اسم الدائرة الانتخابية
    </td>
</tr>
<tr>
    <td id="retype" >

    </td  >
    <td class="td-small">
        <button type="button" class="btn btn-primary" onclick="edittype();" > 
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
        </button>
    </td>
    <td>
            <select id="type" class="form-control" >';
            get_type_process();
        echo '</select>
        
    </td>
    <td class="td-small">
        : نوع الانتخابات  
    </td>
</tr>
<tr>
    <td id="recount" >

    </td>
    <td class="td-small">
        <button type="button" class="btn btn-primary" onclick="editacount();" > 
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
        </button>
    </td>
    <td>
            <input type="number" name="" id="count"  min="0" class="form-control" >
        
    </td>
    <td class="td-small">
       : عدد المقاعد  
    </td>
</tr>
    
    
    ';
}

?>