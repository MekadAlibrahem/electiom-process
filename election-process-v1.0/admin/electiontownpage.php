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
    <title>    المناطق الانتخابية  </title>

    <link rel="stylesheet" href="../lib/Bootstrap/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/css/stander.css">
    
    <style>
        .form-control{
            display: inline-table;
            width: 100%;
            font-size: 20px;
            text-align: center;
        }
        #towns{
            text-align: right;
        }
    

    </style>
</head>
<body>
<!--  تصميم البار العلوي و روابط التنقل بين الصفحات  -->
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
    //   استدعاء الملف الخاص بالدوال 
        include("lib/php/Basic.php")
     ?>
<div class="panel panel-primary">
        <div class="panel-heading">   إدارة المناطق الانتخابية  </div>
        <div class="panel-body">
            <table>
                <tr>
                    <td></td>
                    <td >
                    <!--  عند تغير  قيمة  يتم ارسال طلب  يعيد جميع المناطق الانتخابية التابعة لهذه الدائرة  -->
                        <select name="" id="area" class="form-control" onchange="get_areas(this.value);">
                            <?php
                                //  دالة تعيد جميع الدوائر الانتخابية المسجلة  
                                get_election_area();   
                            ?>
                        </select>
                    </td>
                    <td>
                         :  الدائرة الانتخابية
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td > 
                    <!--  عند تغير القيمة يتم ارسال طلب يعيد جميع المناطق التابعة لهذه المحافظة  -->
                        <select name="" id="city" class="form-control" onchange="get_towns(this.value);">
                            <?php 
                                //  دالة تعيد جميع المحافظات المسجلة 
                                get_city(); 
                            ?>
                        </select>
                    </td>
                    <td>
                        :  المحافظة  
                    </td>
                    
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <select name="" id="towns" class="form-control" >
                        
                        </select>
                    </td>
                    <td>
                        :  المناطق
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    <!--  زر ارسال طلب اجاكس لحذف منطقة   -->
                    <button type="button" class ="btn btn-danger" id="btn" onclick="delete_town();" >
                            حذف 
                    </button>
                    <!--  زر لارسال طلب اجاكس  لإضافة منطقة جديدة  -->
                    <button  type="button" class="btn btn-primary" id="btn" onclick="insert_town();">
                           منطقة إضافة
                    </button>
                    <button  type="button" class="btn btn-primary" id="btn" onclick="insert_all_town_in_city();">
                            إضافة محافظة 
                    </button>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td  colspan="3" id="resultquery">
                    
                    </td>
                </tr>
                
            </table>
            <div id="" >
            </div>
        </div>
        
       
</div>
<!--  تصميم لعرض جميع المناطق الانتخابية التابعة لعملية انتخابية ما  -->
<div class="panel panel-primary">
        <div class="panel-heading">   معلومات المناطق الانتخابية  </div>
        <div class="panel-body" >
            <table  id="get_area" >
            
            </table>
            
            
        </div>
        
       
</div>


<!-- ------------------------------------------------------------------------------------ -->

    
   
    
   
   
    <script src="../lib/JQuery/jquery-3.5.1.min.js"></script>
    <script src="../lib/Bootstrap/bootstrap-3.4.1-dist/js/bootstrap.js"></script>
    <script src="lib/ajax/managelectiontown/managelectiontown.js"></script>
    


    
    
</body>
</html>


