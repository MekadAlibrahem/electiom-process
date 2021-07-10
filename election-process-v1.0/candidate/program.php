<?php
//  جلسة تخزن رقم الوطني للمرشح 
session_start();

$nationalnumber = $_SESSION["NationalNumber"];
include("../../lib/Php/methods.php");

if($nationalnumber > 0 ){
  //  دالة تختبر الرقم الوطني لمرشح  لكي لا تسمح له بالدخول الى خذه الصفحة الا اذا كان حسابه مفعل
  testuserID($nationalnumber , 3);
}else{
  testuserID();
} 

$name           = $_SESSION['name']; 
    
?>
<html lang="ar">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>candidate page</title>
     
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
      <!--  تعديلات التصميم  -->
    <style>
      .nav-pills .nav-link:hover{
          border: 1px solid #0d6efd;
        
        border-radius:10px;

      }
      .nav .nav-pills{
          float: right;
      }
    </style>
    
      
      <!-- Custom styles for this template -->
      
      <link href="..\lib\Css\headers.css" rel="stylesheet">
      
      <link href="../lib/Bootstrap//bootstrap-3.4.1-dist/css/bootstrap.css" rel="stylesheet" >
      <link href="lib\css\program.css" rel="stylesheet">
</head>
<body >
<!--  تصميم البار العلوي في الصفحة  -->
    <div class="container" id="head">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        
    <a href="" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        
        <span class="fs-4"> <?php echo $name ;  ?> </span>
    </a>

    <ul class="nav nav-pills">
    <li class="nav-item"><a href="../index.php" class="nav-link">  <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>   </a></li>
            <li class="nav-item"><a href="../normaluser/homepage.php" class="nav-link">  <span class="glyphicon glyphicon-send" aria-hidden="true"></span>   </a></li>
            <li class="nav-item"><a href="../normaluser/result.php" class="nav-link">  <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>   </a></li>
        <li class="nav-item"><a href=""   onclick="autoselect(<?php $nationalnumber ?>);" class="nav-link "> <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a></li>
        <li class="nav-item"><a href="program.php" class="nav-link active"> <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></li>
        <li class="nav-item"><a href="HomePage.php" class="nav-link"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> </a></li>
            
        </ul> 
    </header>
    </div>
<!-- -------------------------------------------------------------------------------------- -->

    <?php
    //  الاتصال بقاعدة البيانات 
    include("../../lib/Php/connectdb.php");
     /*
        استعلام يعيد رقم المرشح عن طريق الرقم  الوطني
        تم استخدام الدالة max  => لانه ممكن ان يوجد نفس الشخص ترشح لاكثر من عملية انتخابية 
      و بالتالي الرقم المرشح الاكبر هو لاخر عملية انتخابية تم الترشح اليها 
      */
    $sql1 = "SELECT MAX(CandidateID) FROM `candidates` WHERE NationalNumber='$nationalnumber' " ;
    $query  = mysqli_query($conn,$sql1);
    if(mysqli_num_rows($query)==1){
      while( $row = mysqli_fetch_array($query)){
        $CandidateID = $row[0];
        $_SESSION['CandidateID']=$CandidateID ;
      }
    }
    mysqli_close($conn);
    ?>
<!-- -------------------------------------------------------------------------------- -->
<!--  تصميم لادخال البرنامج الجديد  -->
  <div  class ="row row-add"  >
    <div class="col-sm-12 col-md-12">
      <div class="thumbnail">
        <div class="caption" id="caption">
          <h3> إضافة برنامج انتخابي جديد </h3>
          <p>
          <!--  مربع إدخال بيانات لادخال نص البرنامج الانتخابي الجديد -->
            <textarea name="textprogram" id="textinsert" cols="10" rows="10"></textarea>
          </p>
          <p>
          <!--  زر لإضافة برنامج جديد  -->
          <?php echo '
            <button type="submit" class = "btn btn-primary"  onclick="autoinsert(document.getElementById(\'textinsert\').value, '.$CandidateID.');" role="button">
            ';
            ?> 
            <!--  لعرض ايقونة داخل الزر -->
              <span class="glyphicon glyphicon-plus" aria-hidden="true">
            </button> 
            <!--  زر الغاء حيث يتم افراغ حقل الإدخال و حذف البيانات  -->
            <button type="submit" class="btn btn-danger" role="button" onclick="document.getElementById('textinsert').value = '' ;">
              <!--  لعرض ايقونة داخل الزر -->
              <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
            </button>
          </p>
        </div>
      </div>
    </div>
  </div>
  <!--  اضافة البرامج الانتخابية الموجودة هنا -->
    <div class="row"  id = "selected" >
    
    </div>
    
    
    
   
    <br>
    <!--  استدعاء الدوال الخاصة ب   ajax   -->
    <script src="ajax/ajax.js">
     
    </script>
    <?php 
      echo "<script> autoselect(".$CandidateID.");  </script> " ;
      
    ?>
   
    <script src="../lib/JQuery/jquery-3.5.1.min.js"></script>
    <script src="../lib/Bootstrap/bootstrap-3.4.1-dist/js/bootstrap.js"></script>
   
    <script src="../lib/assets/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>