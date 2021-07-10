<?php
session_start();
$userid = $_SESSION["NationalNumber"]  ;
include("../../lib/Php/methods.php");

if($userid > 0 ){
  //  دالة تختبر الرقم الوطني لمرشح  لكي لا تسمح له بالدخول الى خذه ا`لصفحة الا اذا كان حسابه مفعل
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
    <title>  حسابات المرشحين   </title>

    <link rel="stylesheet" href="../lib/Bootstrap/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/css/stander.css">
    
    <style>
        
        .form-control{
            display: inline-table;
            width: 100%;
            font-size: 20px;
            text-align: center;
        }
        #btn{
            font-size:20px ;
        }
        #div-btn{
            text-align: center;
            margin-left: 20%;
            margin-bottom: 10px;
        }


    </style>
</head>
<body>
<!-- تصميم البار العلوي  للصفحة و روابط الانتقال بين الصفحات  -->
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
    //   استدعاء ملف الدوال الخاصة بالصفحة 
            include("lib/php/Basic.php")
     ?>
     <!--  تصميم نموذج  إدخال البيانات  -->
<div class="panel panel-primary">
        <div class="panel-heading">   إدارة حساب المرشح    </div>
        <div class="panel-body">
                <form action="canditionpage" method="POST">
                        <table>
                            <tr>
                                <td  colspan="2"  >
                                    <div class="alert alert-warning" role="alert">  يجب إدخال المعلومات المطلوبة قبل القيام بالحذف او الإضافة </div>
                                </td>
                                <td>
                                    <input type="number"  id="number" min="1"  class ="form-control"/>
                        
                                </td>
                                <td class="td-small">
                                    : الرقم الوطني
                                </td>
                            </tr>
                            <tr>
                                <td id="REEP" >

                                </td >
                                <td class="td-small">
                                    
                                </td>
                                <td>
                                        <select id="electionprocess" class="form-control" >
                                               <?php
                                             //  دالة تعيد  العمليات الانتخابية المتاحة   
                                               select_election_process(); 
                                               ?>
                                        </select>
                                    
                                </td>
                                <td class="td-small">
                                    : العملية الانتخابية 
                                </td>
                            </tr>
                        
                        </table>
                        <!--  
                            ازرار الاضافة و الحذف  عبر ارسال طلب ajax 
                         -->
                        <div  id="div-btn" >
                            <!-- <button type="button" class ="btn btn-danger" id="btn" onclick="delete_candidat_account();" >
                                    حذف 
                            </button> -->
                            <button  type="button" class="btn btn-primary" id="btn" onclick="insert_candidat_account(document.getElementById('number').value,document.getElementById('electionprocess').value)">
                                    إضافة
                            </button>
                            <div id="resultquery" ></div>
                         </div>
                         <div >
                            <?php
                                //  متغير يعرض رسالة تعبر حالة تنفيذ الإضافة و الحذف  
                                echo $GLOBALS["ERRORELECTIONPROCES"];  
                            ?>
                         </div>
                
                </form>    
        
        </div>
        
       
</div>

<div class="panel panel-primary">
        <div class="panel-heading">   المرشحين     </div>
        <div class="panel-body">
                <form action="canditionpage.php" method="POST">
                        <table>
                            <tr>
                                
                                <td id="allprocesss" >
                                        <select id="electionallprocess" class="form-control" onchange="get_cand(this.value);" >
                                               <option value="0"> يجب أختيار نوع  الانتخابات اولا </option>
                                        </select>
                                    
                                </td>
                                <td class="td-small">
                                    : العملية الانتخابية 
                                </td>
                                <td>
                                        <select id="type" class="form-control" onchange="get_all_process();" >
                                               <?php get_type_process(); ?>
                                        </select>
                                    
                                </td>
                                <td class="td-small">
                                   : نوع الانتخابات
                                </td>
                            </tr>
                        
                        </table>
                        <table border="1" id="getcand" >
                        
                        </table>
                        <div id="resultquerydelete" ></div>
                </form>    
        
        </div>
        
       
</div>

<!-- ------------------------------------------------------------------------------------ -->

    
   
    
   
   <!--  استدعاء ملف jquery  & javascript bootstrap  -->
    <script src="../lib/JQuery/jquery-3.5.1.min.js"></script>
    <script src="../lib/Bootstrap/bootstrap-3.4.1-dist/js/bootstrap.js"></script>
    <!--  استدعاء ملف طلبات  ajax   -->
    <script src="lib/ajax/candidationaccount/candidationaccount.js"></script>
    
    
    
</body>
</html>