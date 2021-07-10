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
    <title>  ادارة البلدات  </title>

    <link rel="stylesheet" href="../lib/Bootstrap/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/css/employee.css">
    <!-- <link rel="stylesheet" href="lib/css/editpage.css"> -->
    <style>
        #button{
            padding: 2px;
        }
        .panel-primary{
            border-color: #337ab7;
            margin: inherit;
            text-align: center;
        }
        .panel-primary > .panel-heading {
            background-color: #2291f0;
            font-family: initial;
        }
        #cityID{
            font-size: large;
            text-align: right;
        }
        #EAID{
            font-size: large;
            text-align: right;
        }
        .btn{
            font-size: large;
        }


    </style>
</head>
<body>
<!--  تصميم البار العلوي من الصفحة  -->
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
        //  استدعاء ملف الدوال ا
            include("lib/php/edittown.php");
            //  برمجة زر الاإدخال 
                        if(isset($_POST['insert'])){
                            $id             = $_POST['townid'];
                            $name           = $_POST['nametown'];
                            $city           = $_POST['city'];
                            //  استدعاء دالة الإدخال 
                            insert($id,$name,$city);
                        }
                        //  برمجة زر الحذف 
                        if(isset($_POST["delete"])){
                            $id             = $_POST['townid'];
                            $name           = $_POST['nametown'];
                            $city           = $_POST['city'];
                            if(!empty($id) || !empty($name)){
                                ?>
                                    <script >
                                        result = confirm("هل انت متاكد من حذف المنطقة هذه  ");
                                        if(result){
                                            <?php 
                                                delet($id,$name,$city);
                                            ?>
                                        }
                                    </script>
                                <?php
                            }else{
                                $GLOBALS["RESULT"] = '<div class="alert alert-danger" role="alert">  يجب إدخال قيمة لرقم المنطقة  او اسم المنطقة مع المحافظة التابعة لها اولا   </div>';
                            }
                        }
        ?>
<div class="panel panel-primary">
        <div class="panel-heading"> إدارة المناطق    </div>
        <div class="panel-body">
            <form action="townpage.php" method="POST" accept-charset="utf-8">
            <table>
                <tr>
                    <td id="townid" colspan="2" >
                        <div class="alert alert-warning" role="alert">  يجب إضافة رقم المنطقة قبل القيام بأي تعديل </div>
                    </td>
                    
                <td  >
                        <input type="number"  id="numtown"  class ="form-control" name="townid" min="1" oninput="autoselecttown(this.value);"/>
                    </td>
                    <td class="td-small">
                        : رقم المنطقة    
                    </td>
                    
                    
                </tr>
                <tbody id="townselect">
                    <tr>
                        
                    <td id="RENT" >
                        <?php echo $GLOBALS['ERRORNAME'] ; ?>
                        </td>
                        <td class="td-small" >
                        <!-- زر يقوم بارسال طلب اجاكس لتعديل اسم المنطقة  -->
                            <button type="button" class="btn btn-primary" onclick='editname();' > 
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                            </button>
                        </td>
                            
                        
                        <td >
                            <input type="text"   id="town" class ="form-control" name="nametown" />
                        </td>
                        <td class = "td-small">
                            : اسم المنطقة   
                        </td>

                    </tr>
                    <tr>
                        <td id="REC" > <?php echo $GLOBALS['ERRORCITY'] ; ?> </td>
                        <td class="td-small" >
                        <!--  زر يقوم بارسال طلب اجاكس لتعديل اسم المحافظة التي تحتوي المنطقة المحددة  -->
                            <button type="button" class="btn btn-primary" onclick='editcity();' > 
                                <span class="glyphicon glyphicon-edit"  aria-hidden="true"></span> 
                            </button>
                        </td>
                        <td>
                        <!--  عرض اسماء المحافظات المسجلة  -->
                            <select  name='city'  id="cityID"  class='form-control'  >    
                                <?php  selectcity();  ?>
                            </select>
                        </td>
                        <td>
                            :  المحافطة
                        </td>
                    </tr>
                    
                </tbody>
                <tr>
                    <td class="td-small" ></td>
                    <td colspan="2"  id="button">
                        
                        <button type="sumit" class="btn btn-danger" name="delete" >
                                    حذف
                        </button>
                        <button type="reset" class="btn btn-defult" >
                                    إلغاء 
                        </button>
                        
                        <button type="submit "  class="btn btn-primary"  name="insert" >
                                    إدخال
                        </button>
                    </td>
                    <td></td>
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
    <!--  استدعاء  ملف ajax  -->
    <script src="lib/ajax/edittown/edittown.js"></script>
    
    
</body>
</html>