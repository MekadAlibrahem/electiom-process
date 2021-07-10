<?php
 $id = $_REQUEST["id"];
// function return type account to user by national number

function get_type_account($idType){
    include("../../../../lib/Php/connectdb.php");
    $get_type = "SELECT * FROM `typeaccount`  ORDER BY `typeaccount`.`TypeAccountID` DESC ";
    $query_get_type = mysqli_query($conn,$get_type);
    if($query_get_type){
            if(mysqli_num_rows($query_get_type)>0){
                while($row = mysqli_fetch_array($query_get_type)){
                    if($row['TypeAccountID']== $idType){
                        echo "<option value = '".$row['TypeAccountID']."' selected >";
                        echo  $row['type'];
                        echo " </option>" ;
                    }else{
                        echo "<option value = '".$row['TypeAccountID']."' >";
                        echo  $row['type'];
                        echo " </option>";
                    }
                }
            }
    }else{

    }

}
    // return user account by national number 
   
    if($id>0){
        include("../../../../lib/Php/connectdb.php");
        $select_account = "SELECT * From `useraccount` WHERE `NationalNumber` = '$id'";
        $query_select_account = mysqli_query($conn,$select_account);
        if($query_select_account){
            //true query
            if(mysqli_num_rows($query_select_account)>0){
                // find result 
                while($row = mysqli_fetch_array($query_select_account)){
                    // print result 
                    echo '
                    <tr>
                    <td id="REAT" >

                    </td>
                    <td class="td-small">
                        <button type="button" class="btn btn-primary" onclick="edittypeaccount();" > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>
                    </td>
                    <td>
                            <select id="type" class="form-control" >';
                                get_type_account($row["TypeAccountID"]);
                            echo '
                            </select>
                        
                    </td>
                    <td class="td-small">
                        :  نوع الحساب 
                    </td>
                </tr>
                <tr>
                    <td id="REAS">
                        
                    </td  >
                    <td class="td-small">
                        <button type="button" class="btn btn-primary" onclick="editaccountstatus();" > 
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                        </button>
                    </td>
                    <td>';
                    if($row["AccountStatus"] ==1 ){
                        echo  '<input type="radio"  name="status"  value="1" checked>      مفعل 
                             <br><input type="radio"  name="status"  value="0"  > غير مفعل';
                    }else{
                        echo  '<input type="radio"  name="status"  value="1" >      مفعل 
                        <br> <input type="radio"  name="status"  value="0" checked > غير مفعل';
                    }
                        echo '
                    </td>
                    <td class="td-small">
                        : حالة الحساب 
                    </td>
                </tr>
                    ';
                }
            }else{
                // not found National Number
                echo '
                <tr>
                <td id="REAT" >

                </td>
                <td class="td-small">
                    <button type="button" class="btn btn-primary" onclick="edittypeaccount();" > 
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                    </button>
                </td>
                <td>
                        <select id="type" class="form-control" >';
                            get_type_account(-1);
                        echo '
                        </select>
                    
                </td>
                <td class="td-small">
                    :  نوع الحساب 
                </td>
            </tr>
            <tr>
                <td id="REAS">
                    
                </td  >
                <td class="td-small">
                    <button type="button" class="btn btn-primary" onclick="editaccountstatus();" > 
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                    </button>
                </td>
                <td>
                
                    <input type="radio"  name="status"  value="1" >      مفعل 
               
                    <input type="radio"  name="status"  value="0" checked > غير مفعل
                
                   
                </td>
                <td class="td-small">
                    : حالة الحساب 
                </td>
            </tr>
                ';
            }
        }else{
                //false query 

        }
    }else{
        
    }

?>