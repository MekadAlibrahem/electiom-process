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
    <title>  انواع العمليات الانتخابية  </title>

    <link rel="stylesheet" href="../lib/Bootstrap/bootstrap-3.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/css/stander.css">
    
    <style>
        .result{
            text-align: center;
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
     
     <!--  تصميم نموذج إدخال البيانات  -->
<div class="panel panel-primary">
        <div class="panel-heading">   إدارة انواع العمليات الانتخابية   </div>
        <div class="panel-body">
            <form action="" method="POST">
                <table>
                <tr>
                        <td  colspan="2"  >
                            <div class="alert alert-warning" role="alert">
                              يجب إضافة رقم نوع العملية الانتخابية قبل القيام بأي تعديل او حذف  
                              </div>
                        </td>
                        <td>
                            <input type="number"  id="number" min="1"  class ="form-control"/>
                
                        </td>
                        <td class="td-small">
                            : رقم نوع العملية 
                        </td>
                    </tr>
                    <tr>
                            <td  colspan="2" >

                            </td>
                            
                            <td>
                                    <input type="text" class="form-control"   id="type" />
                                  
                            </td>
                            <td class="td-small">
                                 :  نوع العملية 
                            </td>
                        </tr>
                </table>
                <div  id="div-btn" >
                <!--  زر يرسل طلب اجاكس لحذف نوع عملية انتخابية  -->
                    <button type="button" class ="btn btn-danger" id="btn" onclick="delete_type();" >
                            حذف 
                    </button>
                    <!-- زر فرسال طلب اجاكس  لتعديل نوع العملية الانتخابية  -->
                    <button  type="button" class="btn btn-primary" id="btn" onclick="edit_type();">
                            تعديل
                    </button>
                    <!--  زر لإرسال  طلب اجاكس لإضافة نوع جديد -->
                    <button  type="button" class="btn btn-primary" id="btn" onclick="insert_type();">
                            إضافة
                    </button>
                    <div id="resultquery">  </div>
                </div>
            </form>
        
        </div>
        
       
</div>

<!-- ------------------------------------------------------------------------------------ -->
<!--  تصميم مكان اظهار النتيجة ( إظهار جميع انواع العمليات الانتخابية المسجلة ) -->
<div class="panel panel-primary">
        <div class="panel-heading">    انواع العمليات الانتخابية   </div>
        <div class="panel-body">
               <table border="1" >
                   <tr>
                        <th class="result">
                        نوع العملية الانتخابية
                        </th>
                        <th class="result">
                            رقم العملية الانتخابية
                        </th>
                    </tr>
                    <tbody id="typeprocess" >

                    </tbody>
               </table>     
        
        </div>
        
       
</div>

<!-- ------------------------------------------------------------------------------------ -->
   
    
   
   
    <script src="../lib/JQuery/jquery-3.5.1.min.js"></script>
    <script src="../lib/Bootstrap/bootstrap-3.4.1-dist/js/bootstrap.js"></script>
    <!--  استدعاء ملف الاجاكس -->
    <script src="lib/ajax//managetypeprocess/managetypeprocess.js"></script>
    
    
    
</body>
</html>