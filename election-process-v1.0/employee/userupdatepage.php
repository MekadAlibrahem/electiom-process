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
    <title>Document</title>

    <link rel="stylesheet" href="../lib/Bootstrap/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/css/employee.css">
    <style>
       
    </style>
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

    <?php
    //  استدعاء ملف الدوال 
            include("lib/php/start.php");
        ?>
        <!-- 
                            تصميم النموذج الخاص بإدخال البيانات 
                            لكل بيان يوجد  حقل إدخال وبجانبه زر لتعديل  
                            التعديلات تتم عن طريق طلب اجاكس يتم استدعاءه عن طريق الضغط على الزر 

         -->
    <div class="content">
        <form action="userupdatepage.php" method="POST" enctype="multipart/form-data" class="" accept-charset="utf-8">
            <table>
                <tr>
                    <td colspan="2">
                    <div class="alert alert-warning" role="alert">  يجب اضافة الرقم الوطني قبل القيام باي تعديل </div>
                    </td>
                    
                    <td><input type="number" name="nationalnumber" class="form-control" id="number" min="1" oninput="select_user(this.value);" /> </td>
                    <td class="td-small" >  : الرقم الوطني </td>
                </tr>
                <tbody id="selectuser" >
                    <tr>
                        <td id="RUFN"></td>
                        <td class="td-small" > 
                            <button type="button" class="btn btn-primary" onclick='updatefname();' > 
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                            </button>    
                        
                        </td>
                        <td> <input type="text" name="fname" class="form-control" id="fnameid" /></td>
                        <td class="td-small" > : الاسم </td>
                    </tr>
                    <tr>
                        <td id="RULN"></td>
                        <td class="td-small" > 
                            <button type="button" class="btn btn-primary" onclick="updatelname();"> 
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                            </button>    
                        
                        </td>
                        <td><input type="text" name="lname" id="lnameid" class="form-control" />  </td>
                        <td class="td-small" > : الكنية  </td>
                    </tr>
                    <tr>
                        <td id="RUFAN"> </td>
                        <td class="td-small" > 
                            <button type="button" class="btn btn-primary" onclick="updatefathername();"> 
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                            </button>    
                        
                        </td>
                        <td><input type="text" name="fathername" id="fathernameid" class="form-control" />  </td>
                        <td class="td-small" > : اسم الاب </td>
                    </tr>
                    <tr>
                        <td id="RUMN"  ></td>
                        <td class="td-small" > 
                            <button type="button" class="btn btn-primary" onclick="updatemothername();"> 
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                            </button>    
                        
                        </td>
                        <td><input type="text" name="mothername" id="mothernameid" class="form-control" /> </td>
                        <td class="td-small" > : اسم الام </td>
                    </tr>
                
                    <tr>
                        <td id="RUBD" ></td>
                        <td class="td-small" > 
                            <button type="button" class="btn btn-primary" onclick="updatebirthdate()" > 
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                            </button>    
                        
                        </td>
                        <td><input type="Date" name="birthdate" id="birthdateid" class="form-control" /> </td>
                        <td class="td-small" > : تاريخ الميلاد  </td>
                    </tr>
                    <tr>
                        <td id="RUA" ></td>
                        <td class="td-small" > 
                            <button type="button" class="btn btn-primary" onclick="updateadress();"> 
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                            </button>    
                        
                        </td>
                        <td><input type="text" name="adress" id="adressid" class="form-control" />  </td>
                        <td class="td-small" > : عنوان السكن </td>
                    </tr>
                    <tr>
                        <td id="RUID" ></td>
                        <td class="td-small" > 
                            <button type="button" class="btn btn-primary" onclick="updateidadress()"; > 
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                            </button>    
                        
                        </td>
                        <td>
                            <input type="number" name="idadress" id="adressnumber" class="form-control">
                        </td>
                        <td class="td-small" > : رقم القيد </td>
                    </tr>
                    <tr>
                        
                        <td id="RUG"></td>
                        <td class="td=small" ></td>
                        <td>
                        <!--  يتم التعديل تلقائيا عند الاختيار  -->
                            <input type="radio" name="gender"   onclick="updategender(1);" class="option" value="male"  >  ذكر <br>
                            <input type="radio" name="gender"   onclick="updategender(0);" class="option" value="fmale" >  انثى 
                        </td>
                        <td class="td-small" > : الجنس </td>
                    </tr>
                    <tr>
                        <td id="RUJ" ></td>
                        <td class="td-small" > 
                            <button type="button" class="btn btn-primary" onclick="updatejob();"> 
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                            </button>    
                        
                        </td>
                        <td> <?php
                        //  دالة تعيد حالات العمل المسجلة 
                            selectjob();
                            ?> 
                        </td>
                        <td class="td-small" > :  حالة العمل  </td>
                    </tr>
                    <tr>
                        <td id="RUT" ></td>
                        <td class="td-small" > 
                            <button type="button" class="btn btn-primary" onclick="updatetown();"> 
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                            </button>    
                        
                        </td>
                        <td> <?php
                        //  دالة تعيد المحافظات المسجلة  
                                selectcity();
                            ?> 
                        </td>
                        <td class="td-small" > :  منطقة السكن  </td>
                    </tr>
                    <tr>

                        <td id="RUIMG"></td>
                        <td class="td-small" > 
                            <button type="submit" class="btn btn-primary" name="updateimage" > 
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                            </button>    
                        
                        </td>
                        <td>
                            <input type="file" name="pic" id="userimge"  class="form-control" />
                        </td>
                        <td class="td-small" > :  الصورة الشخصية </td>
                     </tr>
                   
                </tbody>
            </table>
        </form>
    </div>

    
<?php
if(isset($_POST["updateimage"])){
    try {
        $tmpFile = $_FILES['pic']['tmp_name'];
        $id = $_POST["nationalnumber"];
        $newFile = 'C:/xampp/htdocs/Mekadv2.0/faceapi/images/'.$id.'.jpg';
        $result = move_uploaded_file($tmpFile, $newFile);
        echo $newFile;
        if ($result) {
             echo ' was uploaded<br />';
        } else {
             echo ' failed to upload<br />';
        }
        
    } catch (\Throwable $th) {
        //throw $th;
    }
   
    
}


?>

    
   
 
  
   
    <script src="../lib/JQuery/jquery-3.5.1.min.js"></script>
    <script src="../lib/Bootstrap/bootstrap-3.4.1-dist/js/bootstrap.js"></script>
    <!--  استدعاء ملفات الاجاكس  -->
    <!-- <script src="lib/ajax/ajax.js"></script> -->
    <script src="lib/ajax/updateuser/updateuser.js"></script>
    
</body>
</html>