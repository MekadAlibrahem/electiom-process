<!DOCTYPE html>
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../lib/Bootstrap/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/css/employee.css">
</head>
<body>
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
            include("lib/php/start.php");
            
            if(isset($_POST['insert'])){
                $nationalnumber = $_POST['nationalnumber'] ;
                $fname          = strval($_POST['fname']);
                $lname          = strval($_POST['lname']);
                $fathername     = strval($_POST['fathername']);
                $mothername     = strval($_POST['mothername']);
                $birthdate      = $_POST['birthdate'];
                $adress         = $_POST['adress'];
                $idadress       = $_POST['idadress'];
                $gender         = $_POST['gender'];
                $job            = $_POST['job'];
                $town           = $_POST['town'];

                $imageuser      = $_FILES['pic']['tmp_name'];
                $GLOBALS['resultquery '] =  insertuser($nationalnumber, $fname, $lname, $fathername, $mothername, $birthdate, $adress, $idadress, $gender, $job, $town,$imageuser);
                $nationalnumber = "" ;
            }
        ?>
    <div class="content">
        <form action="homepage.php" enctype="multipart/form-data" method="POST"  accept-charset="utf-8" >
            <table>
                <tr>
                    <td><?php echo $GLOBALS['nationalnumbererror']; ?></td>
                    <td><input type="number" name="nationalnumber" class="form-control" min="1"  /> </td>
                    <td class="td-small" >  : الرقم الوطني </td>
                </tr>
                <tr>
                    <td><?php echo  $GLOBALS['fnameerror'] ; ?></td>
                    <td> <input type="text" name="fname" class="form-control"  /></td>
                    <td class="td-small" > : الاسم </td>
                </tr>
                <tr>
                    <td><?php echo  $GLOBALS['lnameerror']; ?></td>
                    <td><input type="text" name="lname" class="form-control" />  </td>
                    <td class="td-small" > : الكنية  </td>
                </tr>
                <tr>
                    <td><?php echo  $GLOBALS['fathernameerror']; ?></td>
                    <td><input type="text" name="fathername" class="form-control" />  </td>
                    <td class="td-small" > : اسم الاب </td>
                </tr>
                <tr>
                    <td><?php echo  $GLOBALS['mothernameerror']; ?></td>
                    <td><input type="text" name="mothername" class="form-control" /> </td>
                    <td class="td-small" > : اسم الام </td>
                </tr>
                </tr>
                <tr>
                    <td><?php echo   $GLOBALS['birthdateerror']; ?></td>
                    <td><input type="Date" name="birthdate" class="form-control" /> </td>
                    <td class="td-small" > : تاريخ الميلاد  </td>
                </tr>
                <tr>
                    <td><?php echo  $GLOBALS['adresserror'] ; ?></td>
                    <td><input type="text" name="adress" class="form-control" />  </td>
                    <td class="td-small" > : عنوان السكن </td>
                </tr>
                <tr>
                    <td><?php echo   $GLOBALS['IDerorr'] ; ?></td>
                    <td>
                        <input type="number" name="idadress" class="form-control" min="1">
                    </td>
                    <td class="td-small" > : رقم القيد </td>
                </tr>
                <tr>
                    <td><?php echo  $GLOBALS['gendererorr']; ?></td>
                    <td>
                        <input type="radio" name="gender" class="option" value="male" checked >  ذكر <br>
                        <input type="radio" name="gender" class="option" value="female" >  انثى 
                    </td>
                    <td class="td-small" > : الجنس </td>
                </tr>
                <tr>
                    <td><?php echo  $GLOBALS['joberror']; ?></td>
                    <td> <?php
                           selectjob();
                        ?> 
                    </td>
                    <td class="td-small" > :  حالة العمل  </td>
                </tr>
                <tr>
                    <td><?php echo  $GLOBALS['townerror']; ?></td>
                    <td> <?php
                            selectcity();
                        ?> 
                    </td>
                    <td class="td-small" > :  منطقة السكن  </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $GLOBALS["imgusererror"] ;  ?> 
                    </td>
                    <td>
                    <input type="file" name="pic" class="form-control" accept="image/*"/>
                    </td>
                    <td class="td-small" > :  الصورة الشخصية </td>
                </tr>
                
               </table>
               <button type="reset"   name = ""        class ="btn btn-danger"  > الغاء </button>
               <button type="submit"  name = "insert"   class ="btn btn-success" > تسجيل </button><br>
               <div  > <?php echo $GLOBALS['resultquery '] ; ?> </div>
               
        </form>
    </div>
   
    <script src="../lib/JQuery/jquery-3.5.1.min.js"></script>
    <script src="../lib/Bootstrap/bootstrap-3.4.1-dist/js/bootstrap.js"></script>
    <script src="lib/ajax/ajax.js"></script>
    
    
</body>
</html>