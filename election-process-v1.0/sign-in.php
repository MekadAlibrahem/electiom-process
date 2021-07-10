<?php 
//  فتح جلسة لارسال رقم الوطني للمستخدم و ارساله الى الصفحة المناسبة 
session_start();
// استدعاء الملف الذي يحوي الدوال المستخدمة في هذه الصفحة 
include("lib/Php/account.php");
//  تعريف متغير لتخزين رسالة الخطأ ضمنه في حال  حدوث خطأ اثناء تسجيل الدخول
  $nationalNumberErorr = " " ; 
?> 
<!doctype html>
<html lang="ar">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.82.0">
        <title>  Signin </title>

        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    

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

            
            <!-- Custom styles for this template -->
        <link href="lib/Css/signin.css" rel="stylesheet">
        <style>
            .form-signin{
                border: 1px solid #ddd;
               border-radius:10px;
               box-shadow:0px 0px 30px  30px #ccc;
            }
        </style>
  </head>
  <body class ="text-center" >


      <?php

    // //  برمجة زر تسجيل الدخول
    //   if(isset($_POST["signin"])){
          
    //     $nationalNumberErorr = " " ;
        
          
    //       $idnumber = $_POST["idnumber"];
    //       if(!empty($idnumber)){ // تحقق مو وجود قيمة
    //         //  استدعاء دالة تسجيل الدخول و هي تعيد نوع الحساب و بياناته 
    //         $info = login($idnumber);
    //         $NationalNumber =   $info[0];
    //         $pass           =   $info[1];
    //         $type           =   $info[2] ;
    //         $acountStatus   =   $info[3];
    //         $_SESSION["NationalNumber"] = $NationalNumber ;
    //         //  استدعاء دالة تقوم بارسال المستخدم الى الصفحة المناسبة له 
    //         chooseaccount($type,$acountStatus);
        
    //       }else{
    //         $nationalNumberErorr = " يجب ادخال الرقم الوطني " ;
    //       }
    //   }  
        
   
    ?>
 
   
 
    <main class="form-signin">
        <form action="faceapi/indexface.php" method="POST">
            <img class="mb-4" src="lib/assets/brand/syrialogo3.svg" alt="" width="150" height="75">
            <h1 class="h3 mb-3 fw-normal"> الرجاء تسجيل الدخول </h1>

            <div class="form-floating">
                <input type="number"  min="1" name="idnumber" class="form-control" id="floatingInput" placeholder="ادخل الرقم الوطني ">
                <label for="floatingInput"> الرقم الوطني </label> 
                <p style="color:red;" ><?php echo $nationalNumberErorr; ?></p>
                
            </div>
            <br>
        

            <input type="submit" name="signin" class="w-100 btn btn-lg-2 btn-primary"  value="تسجيل الدخول " ><br><br>
            <input type="button" name="" class="w-100 btn btn-lg-2 btn-danger"  value=" الغاء  "  onclick="cansel();" ><br><br>
            
        </form>
    </main>
        <script>
        function cansel(){
          location.href = "https://localhost/Mekadv2.0/index.php" ;
        }
        </script>
  </body>
</html>
