<?php
session_start();
$userid = $_SESSION["NationalNumber"]  ;
include("../../lib/Php/methods.php");

if($userid > 0 ){
  //  دالة تختبر الرقم الوطني لمرشح  لكي لا تسمح له بالدخول الى خذه الصفحة الا اذا كان حسابه مفعل
  testuserID($userid , 1);
}else{
  testuserID();
} 
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>id adress page</title>

    <link rel="stylesheet" href="../lib/Bootstrap/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/css/employee.css">
    <link rel="stylesheet" href="lib/css/editpage.css">
</head>
<body >
<!--  تصميم البار العلوي من الصفحة  -->
    <ul class="nav nav-tabs">
       
        <li>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                   السجل المدني
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a  href="homepage.php">إضافة سجل</a></li>
                    <li><a  href="userupdatepage.php">تعديل سجل</a></li>
                    <li><a  href="idadresspage.php"> القيد المدني</a></li>
                    <li><a  href="jobpage.php"> حالات العمل  </a></li>
                </ul>
            </div>
        </li>
        <li>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  سجل المحافظات
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a  href="citypage.php">  إدارة المحافظات  </a></li>
                    <li><a  href="townpage.php"> إدارة البلدات  </a></li>
                   
                </ul>
            </div>
        </li>
        <li>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  الانتخاب
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a  href="../normaluser/homepage.php">  الانتخاب </a></li>
                    <li><a  href="../normaluser/result.php"> نتائج الانتخاب   </a></li>
                   
                </ul>
            </div>
        </li>
        <li>
        <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                 تسجيل الخروج 
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a  href="../index.php">   تسجيل الخروج  </a></li>
                </ul>
            </div>
        </li>
    </ul>
        <?php
        //  استدعاء ملف الذي يحوي الدوال الخاصة بهذه الصفحة 
            include("lib/php/editidadress.php");
            //  برمجة زر إضافة 
            if(isset($_POST['insert'])){
                $id = $_POST['numadress'];
                $name = $_POST['name'];
                //  استدعاء دالة الاضافة 
                insert($id,$name);
            }
            //  برمجة زر تعديل
            if(isset($_POST['edit'])){
                $id = $_POST['numadress'];
                $name = $_POST['name'];
                //  استعدعاء دالة النعديل
                edit($id,$name);
            }
            //  برمجة زر  الحذف 
            if(isset($_POST["delete"])){
                $id = $_POST['numadress'];
                $name = $_POST['name'];
                if(!empty($id) || !empty($name)){
                    ?>
                    <!--  برمجة رسالة تظهر لتأكدي الحذف اولا  -->
                        <script >
                            result = confirm("هل انت متاكد من حذف القيد المحدد ");
                            if(result == true){
                                <?php 
                                //  استدعاء دالة الحذف
                                    delet($id,$name);
                                ?>
                            }
                        </script>
                    <?php
                }else{
                    $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  يجب إدخال قيمة لرقم القيد او مكان القيد  </div>';
                }
            }
        ?>
        <!--  تصميم نموذج الإدخال  -->
    <div class="panel panel-primary">
        <div class="panel-heading"> إدارة القيد المدني  </div>
        <div class="panel-body">
            <form action="idadresspage.php" method="POST" accept-charset="utf-8">
            <table>
                <tr>
                    
                <td class= >
                        <input type="number" class ="form-control" name="numadress" oninput="auto_select_ID(this.value);" min="1"  /> 
                    </td>
                    <td class="td-small">
                        : رقم القيد   
                    </td>
                    
                    
                </tr>
                <tbody  id="select_result">
                    <tr>
                        
                    
                        <td class=>
                            <input type="text"   class ="form-control" name="name" />
                        </td>
                        <td class = "td-small">
                            : مكان القيد  
                        </td>

                    </tr>
                </tbody>
                <tr>
                    <td colspan="2"  id="button">
                        
                        <button type="sumit" class="btn btn-danger" name="delete" >
                                    حذف
                        </button>
                        <button type="sumit "  class="btn btn-primary" name="edit"  >
                                    تعديل
                        </button>
                        <button type="submit "  class="btn btn-primary"  name="insert" >
                                    إدخال
                        </button>
                    </td>
                </tr>
                </table>
                <div id="resultinsert" >
                   <?php  echo $GLOBALS["RESULT"]; ?>
                </div>
           
        </div>
        <div>  </div>
        </form>
    </div>


  
   
    
   
   
    <script src="../lib/JQuery/jquery-3.5.1.min.js"></script>
    <script src="../lib/Bootstrap/bootstrap-3.4.1-dist/js/bootstrap.js"></script>
    <!--  استدعاء ملف  ajax  -->
    <script src="lib/ajax/ajax.js"></script>
    
    
</body>
</html>