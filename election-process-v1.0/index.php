<?php
session_start();
session_destroy();
session_start();
$_SESSION["NationalNumber"] = 0 ;
?>
<!doctype html>
<html lang="ar">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>start page</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/headers/">

    

    <!-- Bootstrap core CSS -->
    <link href="lib/assets/dist/css/bootstrap.min.css" rel="stylesheet">

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
      .nav-pills .nav-link:hover{
        background-color:#0dcaff;
        color :#fff;
      }
    </style>
      
      <!-- Custom styles for this template -->
      <link href="lib/Css/headers.css" rel="stylesheet">
  </head>
  <body>
    
<!--   روابط التنقل بين صفحات الموقع -->
<div class="container">
  <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    
  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
      
      <span class="fs-4"> موقع أتمتة انتخابات </span>
  </a>

  <ul class="nav nav-pills">

      <li class="nav-item"><a href="#" class="nav-link"> حول الموقع </a></li>
      <li class="nav-item"><a href="normaluser/result.php" class="nav-link">نتائج الانتخابات</a></li>
      <li class="nav-item"><a href="sign-in.php" class="nav-link">تسجيل الدخول</a></li>
      <li class="nav-item"><a href="#" class="nav-link active">الصفحة الرئيسية</a></li>
      
    </ul>
    
  </header>
</div>








    <script src="lib/assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
