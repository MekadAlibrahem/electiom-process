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
    <title>   ادارة العمليات الانتخابية  </title>

    <link rel="stylesheet" href="../lib/Bootstrap/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/css/stander.css">
    
    <style>

    </style>
</head>
<body>
<!--  تصميم البار العلوي  و روابط الانتقال بين الصفحات   -->
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
    //   استدعاء ملف الذي يحوي دوال 
        include("lib/php/Basic.php");
     ?>
     <!--  تصميم نموذج الادخال البيانات  -->
<div class="panel panel-primary">
        <div class="panel-heading">   إدارة الدوائر الانتخابية    </div>
        <div class="panel-body">
            <form action="electionprocesspage.php" method="POST">
                <table>
                     <tr>
                        <td  colspan="2"  >
                            <div class="alert alert-warning" role="alert">
                              يجب إضافة رقم العملية الانتخابية قبل القيام بأي تعديل او حذف  
                              </div>
                        </td>
                        <td>
                            <input type="number"  id="number"  class ="form-control"  oninput="auto_select(this.value);"/>
                
                        </td>
                        <td class="td-small">
                            : رقم العملية الانتخابية
                        </td>
                    </tr>
                    <tbody id="processinfo">
                    <tr>
                            <td id="REPN" >

                            </td  >
                            <td class="td-small">
                            <!--  زر يقومبارسال طلب اجاكس لتعديل اسم العملية الانتخابية  -->
                                <button type="button" class="btn btn-primary" onclick="edit_process_name();" > 
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                                </button>
                            </td>
                            <td>
                                    <input type="text" class="form-control"   id="pname" />
                                  
                            </td>
                            <td class="td-small">
                                 : اسم العملية الانتخابية
                            </td>
                        </tr>
                        <tr>
                            <td id="RETP" >

                            </td >
                            <td class="td-small">
                            <!--  زر يقوم بارسال طلب اجاكس لتعديل نوع عملية انتخابية  -->
                                <button type="button" class="btn btn-primary" onclick="edit_process_type();" > 
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                                </button>
                            </td>
                            <td>
                                    <select id="type" class="form-control" >
                                            <?php 
                                            //  دالة تعيد انوع العمليات الانتخابية 
                                            get_type_process();  
                                            ?>
                                    </select>
                                  
                            </td>
                            <td class="td-small">
                                : نوع العملية الانتخابية
                            </td>
                        </tr>
                        <tr>
                            <td id="RESD" >

                            </td  >
                            <td class="td-small">
                            <!--  زر يقوم بارسال طلب اجاكس لتعديل تاريخ بداية عملية انتخابية  -->
                                <button type="button" class="btn btn-primary" onclick="edit_process_start();" > 
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                                </button>
                            </td>
                            <td>
                                    <input type="date" class="form-control"   id="startdate" />
                                  
                            </td>
                            <td class="td-small">
                                 : تاريخ بداية الانتخاب
                            </td>
                        </tr>
                        <tr>
                            <td id="REED" >

                            </td  >
                            <td class="td-small">
                            <!--  زر يقوم بارسال طلب اجاكس لتعديل تاريخ نهاية عملية انتخابية   -->
                                <button type="button" class="btn btn-primary" onclick="edit_process_end();" > 
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                                </button>
                            </td>
                            <td>
                                    <input type="date" class="form-control"   id="enddate" />
                                  
                            </td>
                            <td class="td-small">
                                 : تاريخ نهاية الانتخاب
                            </td>
                        </tr>
                        <tr>
                            <td id="RESDC" >

                            </td  >
                            <td class="td-small">
                            <!--  زر يقوم بارسال طلب اجاكس لتعديل تاريخ بداية الترشح لعملية انتخابية   -->
                                <button type="button" class="btn btn-primary" onclick="edit_start_candidation();" > 
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                                </button>
                            </td>
                            <td>
                                    <input type="date" class="form-control"   id="SCdate" />
                                  
                            </td>
                            <td class="td-small">
                                : تاريخ بداية الترشح
                            </td>
                        </tr>
                   
                        <tr>
                            <td id="REEDC" >

                            </td  >
                            <td class="td-small">
                            <!--  زر يقوم بارسال طلب اجاكس لتعديل تاريخ نهاية الترشح لعملية انتخابية  -->
                                <button type="button" class="btn btn-primary" onclick="edit_end_candidation();" > 
                                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                                </button>
                            </td>
                            <td>
                                    <input type="date" class="form-control"   id="ECdate" />
                                  
                            </td>
                            <td class="td-small">
                                : تاريخ نهاية الترشح
                            </td>
                        </tr>
                        </tbody>
                </table>
                <div  id="div-btn" >
                <!-- زر لإرسال طلب اجاكس لحذف عملية انتخابية  -->
                            <button type="button" class ="btn btn-danger" id="btn" onclick="delete_process();" >
                                    حذف 
                            </button>
                            <!--  زر لإرسال طلب اجاكس لإضافة عملية انتخابية جديدة  -->
                            <button  type="button" class="btn btn-primary" id="btn" onclick="insert_election_process();">
                                    إضافة
                            </button>
                            <div id="resultquery" ></div>
                         </div>
                         
            </form>
        
        </div>
        
       
</div>

<!-- ------------------------------------------------------------------------------------ -->

    
   
    
   
   
    <script src="../lib/JQuery/jquery-3.5.1.min.js"></script>
    <script src="../lib/Bootstrap/bootstrap-3.4.1-dist/js/bootstrap.js"></script>
    <!--  استدعاء ملف اجاكس   -->
    <script src="lib/ajax//manageelectionprocess/manageelectionprocess.js"></script>
    
    
    
</body>
</html>