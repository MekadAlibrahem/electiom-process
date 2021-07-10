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
    <title>  حالات العمل  </title>

    <link rel="stylesheet" href="../lib/Bootstrap/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/css/employee.css">
    <link rel="stylesheet" href="lib/css/editpage.css">
</head>
<body>
<!--   تصميم البار العلوي للصفحة  -->
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
        //  استدعاء ملف دوال المستخدمة 
            include("lib/php/edittypejob.php");
            //  برمجة زر الإضافة 
                        if(isset($_POST['insert'])){
                            $id = $_POST['jobid'];
                            $name = $_POST["namejob"];
                            //  استدعاء دالة إضافة عمل جديد 
                            insert($id,$name);
                        }
                        //  برمجة زر التعديل على اسم العمل 
                        if(isset($_POST['edit'])){
                            $id = $_POST['jobid'];
                            $name = $_POST['namejob'];
                            //  استدعاء دالة التعديل  
                            edit($id,$name);
                        }
                        //  برمجة زر الحذف 
                        if(isset($_POST["delete"])){
                            $id = $_POST['jobid'];
                            $name = $_POST['namejob'];
                            if(!empty($id) || !empty($name)){
                                ?>
                                    <script >
                                        result = confirm("هل انت متاكد من حذف حالة العمل ");
                                        if(result){
                                            <?php
                                            //  استدعاء دالة الحذف   
                                                delet($id,$name);
                                            ?>
                                        }
                                    </script>
                                <?php
                            }else{
                                $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  يجب إدخال قيمة لرقم حالة العمل او اسم حالة العمل  </div>';
                            }
                        }
        ?>
        <!--  المنموذج الخاص ببيانات حالات العمل   -->
<div class="panel panel-primary">
        <div class="panel-heading"> إدارة حالات العمل   </div>
        <div class="panel-body">
            <form action="jobpage.php" method="POST" accept-charset="utf-8">
            <table>
                <tr>
                    <!--  
                        عند تغير قيمة حقل رقم العمل يتم استدعاء دالة تعديد اسم حالة العمل تلقائيا  عبر طلب اجاكس  
                     -->
                <td class= >
                        <input type="number" class ="form-control" name="jobid" min="1"  oninput=" auto_select_job(this.value);"/>
                    </td>
                    <td class="td-small">
                        : رقم حالة العمل   
                    </td>
                    
                    
                </tr>
                <tbody id="select_job">
                    <tr>
                        
                        
                        <td class=>
                            <input type="text"   class ="form-control" name="namejob" />
                        </td>
                        <td class = "td-small">
                            : اسم حالة العمل  
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

   
    
   
   
    <script src="../lib/JQuery/jquery-3.5.1.min.js"></script>
    <script src="../lib/Bootstrap/bootstrap-3.4.1-dist/js/bootstrap.js"></script>
    <script src="lib/ajax/ajax.js"></script>
    
    
</body>
</html>