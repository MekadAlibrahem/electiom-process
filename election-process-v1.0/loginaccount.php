<?php


$id = $_REQUEST["id"];
function login($idnumber){  
    //     الاتصال بقاعدة البيانات 
        include("C:/xampp/htdocs/Mekadv2.0/lib/Php/connectdb.php");
        //  استعلام يعيد  معلومات عن حساب هذا المستخدم عن طريق الرقم الوطني
        $query = "SELECT * FROM useraccount WHERE NationalNumber='$idnumber'" ;
        $result = mysqli_query($conn,$query);
        
        if(mysqli_num_rows($result)==1){
            // تخزين نتيجة الاستعلام في مصفوفة
            while($row = mysqli_fetch_array($result)){
            $NationalNumber = $row["NationalNumber"];
            $pass = $row["password"];
            $type = $row["TypeAccountID"] ;
            $acountStatus =$row["AccountStatus"];
            return $info = array($NationalNumber,$pass,$type,$acountStatus);     
            }
        }else{
            //  اذا كان الحساب غير موجود يعيد قيمة سالبة : يوحد خطأ في الرقم الوطني 
                return  $info = array(-1,-1,-1,-1);
        }
    }
$info = login($id);
        $NationalNumber =   $info[0];
        $pass           =   $info[1];
        $type           =   $info[2];
        $acountStatus   =   $info[3];
        
        switch ($acountStatus) {
            case 1:
                switch ($type){
                    case 1:
                        header("location: Http://localhost/Mekadv2.0/admin/HomePage.php");
                        // 
                        // <script >
                        // location.href = "Http://localhost/Mekadv2.0/admin/HomePage.php" ;
                        // </script>'
                        // 
                        break;
                    case 2:
                        header("location: Http://localhost/Mekadv2.0/employee/homepage.php");
                        // echo '
                        // <script >
                        // location.href = "Http://localhost/Mekadv2.0/employee/homepage.php" ;
                        // </script>';
                        
                        
                        break;
                    case 3:
                        
                        header("location: Http://localhost/Mekadv2.0/candidate/HomePage.php");
                        break;
                    case 4:
                        header("location: Http://localhost/Mekadv2.0/normaluser/homepage.php");
                        break; 
                
                default:
                ?>
                <script >
                        // location.href = "Http://localhost/Mekadv2.0/index.php" ;
                        </script>
                        <?php
                    header("location: Http://localhost/Mekadv2.0/index.php");
                    break;
                }
                break;
            case 0:
                echo "<script>alert('  حسابك غير مفعل   ');  </script>" ;
                break;
            case -1:
                echo "<script>alert('   الحساب غير موجود  ربما الرقم الوطني خاطئ  ');  </script>" ;
                break;
            default:
                echo "<script>alert(' يوجد خطأ في الرقم الوطني  ');  </script>" ;
                break;
        }


?>