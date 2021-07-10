<?php 
     include("../../../lib/Php/connectdb.php");
    $cityid = $_REQUEST['id'];
    $select_town = "SELECT * FROM  `residentialarea` WHERE  `CityID` = '$cityid'"; 
    $query_town = mysqli_query($conn,$select_town);
    if($query_town){
        if(mysqli_num_rows($query_town)>0){
            while($row = mysqli_fetch_array($query_town)){
                echo "<option value='". $row['ResidentionAreaID']."' >".$row['ResidentionAreaName']."</option>";
            }
        }else{
            echo "<option  >.....</option>";
        }
    }else{
        echo "<option >ERROR IN YOUR QUERY</option>";
    }
    mysqli_close($conn);
?>
