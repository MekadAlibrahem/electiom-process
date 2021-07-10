<?php 
/**
 * دالة تختبر حساب المستخدم 
 * @param int userid = 0 : الرقم الوطني للمستخدم 
 * @param int type   = 0 :  نوع الحساب الذي سيتم اختباره 
 * @return int  0 :  true account 
 * @return ? false  got to sign-in page 
 */
function testuserID($userid =0 , $type=0){
    if($userid == 0 || $type==0){
        header("location: ../sign-in.php ");
    }else{
    include("C:/xampp/htdocs/Mekadv2.0/lib/Php/connectdb.php");
    $test = "SELECT `TypeAccountID` , `AccountStatus` FROM `useraccount`  WHERE `NationalNumber` = '$userid' " ;
    $query = mysqli_query($conn,$test);
    if($query){
            // query : true
            if(mysqli_num_rows($query)>0){
                // found account 
                while($row = mysqli_fetch_array($query)){
                    $id = $row["TypeAccountID"] ;
                    $status = $row["AccountStatus"];
                }
                mysqli_close($conn);
                if($status == 1){
                    // type account true
                    return 0;
                }else{
                    // type account false 
                    mysqli_close($conn);
                    header("location: ../sign-in.php ");
                }
            }else{
                // not found any result  :  national number false 
            }
    }else{
        // query :ERROR
    }
    mysqli_close($conn);
    }
}

?>