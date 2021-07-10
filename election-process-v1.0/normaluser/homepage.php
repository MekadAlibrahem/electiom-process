<?php
//  استدعاء ملف الدوال المستخدمة 
include("lib/php/functions.php");
$nationalnumber = 0 ;
session_start();
// فتح جلسة و جلب الرقم الوطني للناخب
        $nationalnumber = $_SESSION["NationalNumber"];
        if($nationalnumber > 0 ){
          //  دالة تختبر الرقم الوطني لمرشح  لكي لا تسمح له بالدخول الى خذه الصفحة الا اذا كان حسابه مفعل
          testuserID($nationalnumber , 4);
      }else{
          testuserID();
      }
      //  الاتصال بقاعدة البيانات 
        include("../lib/Php/connectdb.php");
        //  استعلام يعيد معلومات مستخدم عن طريق الرقم الوطني 
        $sql = "SELECT * FROM `users` WHERE `NationalNumber` = '$nationalnumber' " ;
        $query = mysqli_query($conn,$sql);
        if(mysqli_num_rows($query)==1){
            while($row = mysqli_fetch_array($query)){
                $fname              = $row['FName'] ; 
                $lname              = $row['LName'];
                
            }
        }
        $_SESSION['name'] = $fname." ".$lname ;
        
        
        
?>
<!DOCTYPE html>
<html lang="ar">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> الصفحة الرئيسية</title>
    <link href="../lib/Bootstrap//bootstrap-3.4.1-dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/headers/">

    

    <!-- Bootstrap core CSS -->
    
    <link href="../lib/assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      
    </style>
   
       <style>
          body{
            margin: 0.5%;
            font-size: medium;
          }
         .dropdown-menu > li > a:focus, .dropdown-menu > li > a:hover {
            background-color: #3fb7f2bd;
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
         .form-control{
            display: inline-table;
            width: 100%;
            font-size: 18px !important;
            text-align: right;
          }
       </style>
    
    <!-- Custom styles for this template -->
    <link href="..\lib\Css\headers.css" rel="stylesheet">
    <link href="lib/css/stander.css" rel="stylesheet" >
    <style>
      #mymsg{
        position: fixed;
        top: 200px;
        width: -moz-available;
        margin-left: 20px;
        margin-right: 100px;
        word-wrap: break-word;
        box-shadow: 0 0 5px rgba(89, 86, 86, 0.927);
        border-radius: 7px;
        background-color: lightblue;
        text-align: center;
        z-index: 100001;
        opacity: 1;
        padding: 10px;
  }
    </style>
</head>
<body>


<!--  تصميم البار العلوي و روابط الانتقال بين الصفحات  -->
    <div class="container" id="head">
     <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        
        <a href="" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            
            <span class="fs-4"  style="font-size:20px !important;"> <?php echo $_SESSION['name']; ?> </span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="../index.php" class="nav-link">  <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>   </a></li>
            <li class="nav-item"><a href="result.php" class="nav-link"> <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></li>
            <li class="nav-item"><a href="homepage.php" class="nav-link active"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> </a></li>
            
            
            </ul>
            
        </header>
    </div>
       
    <!--  تصيمم نموذج إدخال و عرض البيانات -->
    <div class="panel panel-primary">
        <div class="panel-heading">    الانتخاب  </div>
        <div id="page" >
        <div class="panel-body">
            <form action="" method="">
               
                <table>
                  <tr>
                    <td id="electionarea" >
                      <!--  عند اختيار دائرة انتخابية  يتم إرسال طلب اجاكس يعيد المرشحين التابيعن لهذه الدائرة الانتخابية  -->
                      <select name="areaID" id="area" class="form-control" onchange="get_candidates(this.value);">
                          <option value="0"> اختر الدائرة الانتخابية  </option>
                      </select>
                    </td>
                    <td class="td-small"></td>
                    <td>
                      <!--  عند تغير قيمة العملية الانتخابية يتم ارسال طلب اجاكس يعيد الدوائر الانتخابية التابعة لها  -->
                      
                      <select name="processID" id="process" class="form-control"  onchange="get_areas(this.value);">
                          <?php
                          //  استدعاء دالة تعيد العمليات الانتخابية المتاحة
                            get_process() ?>
                      </select>
                    </td>
                  </tr>
                </table>
              </select> 
            </form>

            <!--  تصميم النموذج لعرض المرشحين  -->
            <form action="homepage.php" method="GET" name="">
              
              <div class="row" id="candidates">
                
              </div>
              <!--  زر يقوم بإرسال طلب اجاكس لتسجيل عملية الانتخاب -->
              <?php echo'
              <p class="set_btn " >  
                <button type="button" class="btn btn-primary" onclick="SETVOTE('.$nationalnumber.' );" >
                  الانتخاب   
                </button> 
              </p> '; 
              ?>
              <div id="resultsetelection" >  </div>
            
          </form>
        </div>
    </div>
   
    <form action="homepage.php" method="POST">
      
    <p class="set_btn ">  
                <button type="submit" class="btn btn-primary"  name="backpage" >
                   رجوع 
                </button> 
              </p> 
      </form>
      <?php
          if(isset($_POST["backpage"])){
            if($nationalnumber > 0 ){
              gotohomepage($nationalnumber);
            }else{
              gotohomepage();
            }
           
          }
      ?>
   
    </div> 
    <!--  مكان ظهور نتيجة عرض البرنامج الانتخابي لمرشح  -->
    <form action="" method="get">
    <div id="msg" >  </div>
    
    </form>
    
    <br>
    
    <script src ="../lib/assets/dist/js/bootstrap.bundle.min.js"></script>
    <!--  استدعاء ملف الاجاكس  -->
    <script src="lib/ajax/index.js"></script>
    
<script> 

 </script>


    

</body>
</html>