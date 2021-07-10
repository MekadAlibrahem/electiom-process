<?php
session_start();
$userid = $_SESSION["NationalNumber"]  ;
include("../../lib/Php/methods.php");

if($userid > 0 ){
  //  دالة تختبر الرقم الوطني لمرشح  لكي لا تسمح له بالدخول الى خذه الصفحة الا اذا كان حسابه مفعل
  testuserID($userid , 2);
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
    <title>  ادارة المحافظات </title>

    <link rel="stylesheet" href="../lib/Bootstrap/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/css/employee.css">
    <link rel="stylesheet" href="lib/css/editpage.css">
</head>
<body>
<!--  التصمميم الخاص ب البار العلوية من الصفحة  و الروابط للتنقل بين الصفحات  -->
    <ul class="nav nav-tabs">
       
        <li>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                   السجل المدني
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a  href="homepage.php">اضافة سجل</a></li>
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
                    <li><a  href="citypage.php">  ادارة المحافظات  </a></li>
                    <li><a  href="townpage.php"> ادارة البلدات  </a></li>
                   
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
        
    
<!-- ------------------------------------------------------------------------------------- -->
        <?php
        //  استدعاء ملف الدوال الخاص بالصفحة 
            include("lib/php/editcity.php");
            //  زر إضافة مدينة 
                        if(isset($_POST['insert'])){
                            $id = $_POST['cityid'];
                            $name = $_POST['namecity'];
                            //  دالة الإضافة 
                            insert($id,$name);
                        }
                        //  زر تعديل تسم مدينة 
                        if(isset($_POST['edit'])){
                            $id = $_POST['cityid'];
                            $name = $_POST['namecity'];
                            //  دالة التعديل 
                            edit($id,$name);
                        }
                        //  زر حذف مدينة 
                        if(isset($_POST["delete"])){
                            $id = $_POST['cityid'];
                            $name = $_POST['namecity'];
                            if(!empty($id) || !empty($name)){
                                ?>
                                    <script >
                                    //  عرض رسالة تأكد للحف اولا  
                                        result = confirm("هل انت متاكد من حذف المحافظة  إن حذف محافظة ما سيؤدي الى حذف جميع المناطق التابعة لها ");
                                        if(result == true){
                                            <?php 
                                            //  دالة الحذف
                                                delet($id,$name);
                                            ?>
                                        }
                                    </script>
                                <?php
                            }else{
                                $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  يجب إدخال قيمة لرقم المحافظة  او اسم المحافظة   </div>';
                            }
                        }
        ?>
<div class="panel panel-primary">
        <div class="panel-heading"> إدارة المحافظات    </div>
        <div class="panel-body">
        <!--   نموذج إدخال و عرض المدينة  -->
            <form action="citypage.php" method="POST">
            <table>
                <tr>
                    
                <td class= >
                        <input type="number" class ="form-control" name="cityid" min="1" oninput="selectcity(this.value);"/>
                    </td>
                    <td class="td-small">
                        : رقم المحافظة    
                    </td>
                    
                    
                </tr>
                <tbody id="cityname">
                <tr>
                    
                   
                        <td >
                            <input type="text"   class ="form-control" name="namecity" />
                        </td>
                    
                        <td class = "td-small" >
                            : اسم المحافظة   
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


<!-- ------------------------------------------------------------------------------------ -->

    
    <br>
   
    
   
   
    <script src="../lib/JQuery/jquery-3.5.1.min.js"></script>
    <script src="../lib/Bootstrap/bootstrap-3.4.1-dist/js/bootstrap.js"></script>
    <!--  استدعاء ملف الاجاكس -->
    <script src="lib/ajax/city/city.js"></script>
    
    
</body>
</html>