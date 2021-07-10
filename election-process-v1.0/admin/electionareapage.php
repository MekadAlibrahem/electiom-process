<?php
   session_start();
   $userid = $_SESSION["NationalNumber"]  ;
   include("../lib/Php/methods.php");
   
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
    <title>    إدارة الدوائر الانتخابية  </title>

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
<!--  تصميم البار العلوي  و روابط الانتقال بين الصفحات  -->
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
        include("lib/php/Basic.php")
     ?>
     <!--  تصميم نموذج إدخال  البيانات   -->
<div class="panel panel-primary">
        <div class="panel-heading">    إدارة الدوائر الانتخابية  </div>
        <div class="panel-body">
            <form action="" method="POST">
                <table>
                    <tr>
                        <td  colspan="2"  >
                            <div class="alert alert-warning" role="alert">  يجب إضافة رقم الدائرة الانتخابية  قبل القيام بأي تعديل </div>
                        </td>
                        <td>
                        <!--  عند تعديل القيمة يتم ارسال طلب اجاكس اجلب معلومات الدائرة الانتخابية   -->
                            <input type="number"  id="number" min="1" class ="form-control" oninput="get_info(this.value);"/>
                
                        </td>
                        <td class="td-small">
                           : رقم الدائرة الانتخابية
                        </td>
                    </tr>
                    <tbody id="autoselect">
                        <tr>
                            <td id="rename" >

                            </td  >
                            <td class="td-small">
                            <!--  زر ارسال طلب اجاكس لتعديل اسم الدائرة الانتخابية  -->
                                <button type="button" class="btn btn-primary" onclick="editName();" > 
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                                </button>
                            </td>
                            <td>
                                    <input type="text" name="" id="name" class="form-control">
                                    
                            </td>
                            <td class="td-small">
                                : اسم الدائرة الانتخابية
                            </td>
                        </tr>
                        <tr>
                            <td id="retype" >

                            </td  >
                            <td class="td-small">
                            <!--  زر ارسال طلب اجاكس لتعديل نوع الدائرة الانتخابية  -->
                                <button type="button" class="btn btn-primary" onclick="edittype();" > 
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                                </button>
                            </td>
                            <td>
                                    <select id="type" class="form-control"  >
                                            <?php
                                                //  دالة تعيد انواع العمليات الانتخابية 
                                                get_type_process(); 
                                            ?>
                                    </select>
                                
                            </td>
                            <td class="td-small">
                                : نوع الانتخابات  
                            </td>
                        </tr>
                        <tr>
                            <td id="recount" >

                            </td>
                            <td class="td-small">
                            <!--  زر ارسال طلب اجاكس  لتعديل عدد المقاعدة الانتخابية  -->
                                <button type="button" class="btn btn-primary" onclick="editacount();" > 
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                                </button>
                            </td>
                            <td>
                                    <input type="number" name="" id="count"  min="0" class="form-control">
                                
                            </td>
                            <td class="td-small">
                               : عدد المقاعد  
                            </td>
                        </tr>
                                          
                    </tbody>
                    <tr>
                    <td colspan="2"></td>
                        <td>
                        <!--  زر ارسال طلب اجاكس لحذف دائرة انتخابية  -->
                            <button type="button" class ="btn btn-danger" id="btn" onclick="delet();" >
                                    حذف 
                            </button>
                            <!--  زر ارسال طلب اجاكس لإضافة دائرة انتخابية  -->
                            <button  type="button" class="btn btn-primary" id="btn" onclick="set_election_area();">
                                    إضافة
                            </button>
                        </td>
                        <td></td>  
                    </tr>
                    <tr>
                    <td colspan="4" id="resultquery" ></td>
                    </tr>
                
                </table>
            
            </form>
        </div>
        
       
</div>

<!-- ------------------------------------------------------------------------------------ -->

    
    
    
   
   
    <script src="../lib/JQuery/jquery-3.5.1.min.js"></script>
    <script src="../lib/Bootstrap/bootstrap-3.4.1-dist/js/bootstrap.js"></script>
    <!--  استدعاء ملف اجاكس   -->
    <script src="lib/ajax/manageelectionarea/manageelectionarea.js"></script>
    


    
    
</body>
</html>


