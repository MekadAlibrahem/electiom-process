<?php
// //  استدعاء ملف الدوال المستخدمة 
// include("lib/php/functions.php");
// $nationalnumber = 0 ;
// session_start();
// // فتح جلسة و جلب الرقم الوطني للناخب
//         $nationalnumber = $_SESSION["NationalNumber"];
//         if($nationalnumber > 0 ){
//           //  دالة تختبر الرقم الوطني لمرشح  لكي لا تسمح له بالدخول الى خذه الصفحة الا اذا كان حسابه مفعل
//           testuserID($nationalnumber , 4);
//       }else{
//           testuserID();
//       }
//       //  الاتصال بقاعدة البيانات 
//         include("../lib/Php/connectdb.php");
//         //  استعلام يعيد معلومات مستخدم عن طريق الرقم الوطني 
//         $sql = "SELECT * FROM `users` WHERE `NationalNumber` = '$nationalnumber' " ;
//         $query = mysqli_query($conn,$sql);
//         if(mysqli_num_rows($query)==1){
//             while($row = mysqli_fetch_array($query)){
//                 $fname              = $row['FName'] ; 
//                 $lname              = $row['LName'];
                
//             }
//         }
//         $_SESSION['name'] = $fname." ".$lname ;
        
        
        
?>
<!DOCTYPE html>
<html lang="ar">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> مساعدة </title>
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
    <link href="../lib/cheatsheet/cheatsheet.rtl.css" rel="stylesheet">
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
    <style>
      
    </style>

    
    <!-- Custom styles for this template -->
    
</head>
<body class="bg-light" >


<!--  تصميم البار العلوي و روابط الانتقال بين الصفحات  -->
    <div class="container" id="head">
     <header class="bd-header d-flex align-items-stretch py-3 mb-4 border-bottom ">
     <div class="container-fluid d-flex align-items-center">
        <!-- <a href="" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            
            <span class="fs-4"  style="font-size:20px !important;"> <?php ?> </span>
        </a> -->

        <ul class="nav nav-pills">
        <li class="nav-item"><a href="helppage.php" class="nav-link active"><span class="glyphicon glyphicon-help" aria-hidden="true"></span> </a></li>
            <li class="nav-item"><a href="../index.php" class="nav-link">  <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>   </a></li>
            <li class="nav-item"><a href="result.php" class="nav-link"> <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></li>
            <li class="nav-item"><a href="homepage.php" class="nav-link "><span class="glyphicon glyphicon-home" aria-hidden="true"></span> </a></li>
            
            
            </ul>
     </div>
        </header>
        <!-- <header class="bd-header bg-dark py-3 d-flex align-items-stretch border-bottom border-dark">
  <div class="container-fluid d-flex align-items-center">
    <h1 class="d-flex align-items-center fs-4 text-white mb-0">
      
      
    </h1>
    <ul class="nav nav-pills">
        <li class="nav-item"><a href="helppage.php" class="nav-link active"><span class="glyphicon glyphicon-help" aria-hidden="true"></span> </a></li>
            <li class="nav-item"><a href="../index.php" class="nav-link">  <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>   </a></li>
            <li class="nav-item"><a href="result.php" class="nav-link"> <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></li>
            <li class="nav-item"><a href="homepage.php" class="nav-link "><span class="glyphicon glyphicon-home" aria-hidden="true"></span> </a></li>
            
            
            </ul>
  </div>
</header> -->
       
       
 
    </div>
  <!-- <div>
  <aside class="bd-aside ">

  </aside>

  </div> -->
     <div>
    <aside class="bd-aside ">
  
  <nav class="small" >
    <ul class="list-unstyled">
      <li class="my-2">
        <button class="btn d-inline-flex align-items-center collapsed" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#contents-collapse" aria-controls="contents-collapse">Contents</button>
        <ul class="list-unstyled ps-3 collapse" id="contents-collapse">
          <li><a class="d-inline-flex align-items-center rounded" href="#typography">Typography</a></li>
          
        </ul>
      </li>
      <li class="my-2">
        <button class="btn d-inline-flex align-items-center collapsed" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#forms-collapse" aria-controls="forms-collapse">Forms</button>
        <ul class="list-unstyled ps-3 collapse" id="forms-collapse">
          <li><a class="d-inline-flex align-items-center rounded" href="#overview">Overview</a></li>
          
        </ul>
      </li>
      <li class="my-2">
        <button class="btn d-inline-flex align-items-center collapsed" data-bs-toggle="collapse" aria-expanded="false" data-bs-target="#components-collapse" aria-controls="components-collapse">Components</button>
        <ul class="list-unstyled ps-3 collapse" id="components-collapse">
          <li><a class="d-inline-flex align-items-center rounded" href="#accordion">Accordion</a></li>
          
        </ul>
      </li>
    </ul>
  </nav>
</aside>
<div>
    <script src="../lib/assets/dist/js/bootstrap.bundle.min.js"></script>

      <script src="../lib/cheatsheet/cheatsheet.js"></script>

</body>
</html>