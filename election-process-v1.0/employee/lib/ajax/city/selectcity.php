<?php
    $id = $_REQUEST["id"];
    if($id>0){
        include("../../../../../lib/Php/connectdb.php");
        $select_city ="SELECT `CityName` FROM `city` WHERE `CityID` = '$id'";
        $query_city = mysqli_query($conn,$select_city);
        if($query_city){
            if(mysqli_num_rows($query_city)>0){
                while($row = mysqli_fetch_array($query_city)){
                    echo '
                    <tr>
                        
                    
                            <td >
                            <input type="text"   class ="form-control" name="namecity"  value="'.$row["CityName"].'" />
                            </td>
                        
                            <td class = "td-small" >
                                : اسم المحافظة   
                            </td>
                    

                    </tr>
                    ';
                }
            }else{
                echo '
                <tr>
                    
                   
                        <td >
                        <input type="text"   class ="form-control" name="namecity" />
                        </td>
                    
                        <td class = "td-small" >
                            : اسم المحافظة   
                        </td>
                   

                </tr>
                '; 
            }
        }else{
            //Query ERROR
        }
    }
?>
