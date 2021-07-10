<?php
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
      function chooseaccount($typeaccount, $status){
          
        switch ($status) {
            case 1:
                switch ($typeaccount) {
                    case 1:
                        header("location: admin/HomePage.php");
                        break;
                    case 2:
                        header("location: employee/homepage.php");
                        break;
                    case 3:
                        header("location: candidate/HomePage.php");
                        break;
                    case 4:
                        header("location: normaluser/homepage.php");
                        break; 
                
                default:
                    header("location: index.php");
                    break;
                }
               //<script>alert('  حسابك غير مفعل   ');  </script>
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
                
      }

  
?>
