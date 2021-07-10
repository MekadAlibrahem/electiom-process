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
    <title>  حسابات المستخدمين  </title>

    <link rel="stylesheet" href="../lib/Bootstrap/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/css/stander.css">
    
    <style>
        .form-control{
            display: inline-table;
            width: 100%;
            font-size: 20px;
            text-align: center;
        }
    

    </style>
</head>
<body>
<!-- تصميم البار العلوي للصفحة و روابط الانتقال بين الصفحات  -->
    <ul class="nav nav-tabs">
       
        <li>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    الحسابات
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a  href="useraccountpage.php"> حسابات المستخدمين   </a></li>
                    <li><a  href="canditionpage.php"> المرشحين  </a></li>
                   

                </ul>
            </div>
        </li>
        <li>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            العمليات الانتخابية
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a  href="electionprocesspage.php">  ادارة العمليات الانتخابية   </a></li>
                    <li><a  href="typeprocesspage.php">  انواع العمليات الانتخابية   </a></li>
                   
                </ul>
            </div>
        </li>
        <li>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                           الدوائر الانتخابية
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a  href="electionareapage.php">   إدارة الدوائر الانتخابية    </a></li>
                    <li><a  href="electiontownpage.php">  المناطق الانتخابية   </a></li>
                   
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
    //   استدعاء ملف الدوال المستخدمة 
        include("lib/php/Basic.php");
          
        ?>
        <!--  تصميم نموذج إدخال البيانات  -->
<div class="panel panel-primary">
        <div class="panel-heading">   إدارة حسابات المستخدمين  </div>
        <div class="panel-body">
            <form action="useraccountpage.php" method="POST">
                <table>  
                        <tr>
                            <td  colspan="2"  >
                                <div class="alert alert-warning" role="alert">  يجب إضافة الرقم الوطني لمالك الحساب قبل القيام بأي تعديل </div>
                            </td>
                            <td>
                            <!--  عند التعديل على قيمة الحقل يرسل طلب اجاكس للاستعلام عن بيانات الحساب صاحب الرقم المدخل  -->
                                <input type="number"  id="number" min="1" class ="form-control" oninput="auto_select(this.value);"/>
                    
                            </td>
                            <td class="td-small">
                                : الرقم الوطني
                            </td>
                        </tr>
                        <tbody id="autoselectaccount">
                            <tr>
                                <td id="REAT" >

                                </td  >
                                <td class="td-small">
                                <!--  زر ارسال طلب اجاكس لتعديل نوع الحساب  -->
                                    <button type="button" class="btn btn-primary" onclick="edittypeaccount();" > 
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                                    </button>
                                </td>
                                <td>
                                <!-- -->
                                        <select id="type" class="form-control" >
                                                <?php 
                                                //  دالة تعيد انواع الحسابات المتاحة 
                                                    selecttypeaccount(); 
                                                ?>
                                        </select>
                                    
                                </td>
                                <td class="td-small">
                                    :  نوع الحساب 
                                </td>
                            </tr>
                            <tr>
                                <td id="REAS">
                                    
                                </td  >
                                <td class="td-small">
                                <!--  زر إرسال طلب اجاكس لتعديل حالة الحساب  -->
                                    <button type="button" class="btn btn-primary" onclick="editaccountstatus();" > 
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                                    </button>
                                </td>
                                <td>
                                    <input type="radio"  name="status"  value="1">      مفعل 
                                    <input type="radio"  name="status"  value="0"> غير مفعل 
                                </td>
                                <td class="td-small">
                                    : حالة الحساب 
                                </td>
                            </tr>
                        </tbody>
                </table>
            
            
            </form>
        
        </div>
        
       
</div>

<!-- ------------------------------------------------------------------------------------ -->

    
    
    
   
   
    <script src="../lib/JQuery/jquery-3.5.1.min.js"></script>
    <script src="../lib/Bootstrap/bootstrap-3.4.1-dist/js/bootstrap.js"></script>
    <!--  استدعاء ملف الاجاكس  -->
    <script src="lib/ajax//eidtuseraccount/edituseraccount.js"></script>
    
    
    
</body>
</html>


