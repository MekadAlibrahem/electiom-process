<?php
session_start();

$nationalnumber = $_SESSION["NationalNumber"];
include("../../lib/Php/methods.php");

if($nationalnumber > 0 ){
  //  دالة تختبر الرقم الوطني لمرشح  لكي لا تسمح له بالدخول الى خذه الصفحة الا اذا كان حسابه مفعل
  testuserID($nationalnumber , 3);
}else{
  testuserID();
} 
// فتح جلسة و جلب الرقم الوطني للناخب
        
        //  الاتصال بقاعدة البيانات 
        include("../../lib/Php/connectdb.php");
        //  جلب اسم المرشح من جدول السمتخدمين 
        $sql = "SELECT * from users where NationalNumber = '$nationalnumber' " ;
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

    
    <title>candidate page</title>
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
   
       
    
    <!-- Custom styles for this template -->
    <link href="..\lib\Css\headers.css" rel="stylesheet">
    <!-- تعديلات تصيميم  -->
    <link href="lib/css/homepage.css" rel="stylesheet" >
</head>
<body>
<!--  تصميم البار العلوي في الصفحة  -->
    <div class="container" id="head">
     <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            
            <span class="fs-4"  style="font-size:20px !important;"> <?php echo $_SESSION['name']; ?> </span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="../index.php" class="nav-link">  <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>   </a></li>
            <li class="nav-item"><a href="../normaluser/homepage.php" class="nav-link">  <span class="glyphicon glyphicon-send" aria-hidden="true"></span>   </a></li>
            <li class="nav-item"><a href="../normaluser/result.php" class="nav-link">  <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>   </a></li>
            <li class="nav-item"><a href="program.php" class="nav-link"> <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></a></li>
            <li class="nav-item"><a href="HomePage.php" class="nav-link active"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> </a></li>
            
            
            </ul>
            
        </header>
    </div>
        <?php  
        //  استدعاء الملف الذي يحوي الدوال الخاصة بالصفحة 
            include("lib/php/updateinfo.php");
            //  متغيرات لتخزين نتيجة تعديل كل حقل في  في جدول المرشحين  
            $updateworkre       = "" ;
            $updateoldworkre    = "" ;
            $updatecartre       = "" ;
            $updateotherinfore  = "" ;
            //  برمجة زر تعديل العمل 
            if(isset($_POST["work"])){
                //  جلب قيمة حقل الادخال للعمل الجديد
                $work = $_POST['namework'];
                // استدعاء دالة تعديل العمل 
                $updateworkre = updatework($nationalnumber,$work);
            
            }else{
                // دالة تعيد الاعمل الحالي للمرشح 
                $work = selectwork($nationalnumber);
                
            }

            if(isset($_POST['oldwork'])){
                
                $oldwork = $_POST['nameoldwork'];
                //  دالة تعديل بيان العمل القديم للمرشح 
                $updateoldworkre = updateoldwork($nationalnumber,$oldwork);
            }else{
                //  دالة تعيد العمل القديم للمرشح
                $oldwork = selectoldwork($nationalnumber);
            }
            if(isset($_POST['cart'])){
                
                $cart = $_POST['namecart'];
                //  دالة تعديل الشهادة العلمية للمرشح 
                $updatecartre = updatecart($nationalnumber,$cart);
            }else{
                //  دالة تعيد الشهادة العلمية الخاصة بالمرشح 
                $cart = selectcart($nationalnumber);
            }
            if(isset($_POST['btn_infor'])){
                
                $otherinfo = $_POST['infor'];
                //  دالة تعديل البيانات الخاصة بالمرشح ( المعلومات العامة )
                $updateotherinfore = updateotherinfo($nationalnumber,$otherinfo);
            }else{
                //  دالة تعدي معلومات عن مرشح 
                $otherinfo = selectotherinfo($nationalnumber);
            }

        ?>

                        
                       
    <div class="jumbotron">
        <div class="container">
        <!--  
             accept-charset = utf-8    
            لجعل نموذج الادخال قيبل ارسال الاحرف العربية 
         -->
         <!--  
             نموذج الإدخال بيانات المرشج  حيث لكل بيان يوجد حقل إدخال يعرض القيمة المسجلة في قاعدة البانات 
             و يمكن التعديل عليها عن طريق غدخال قيمة جديدة و الضغط على الزر 
          -->
            <form action="HomePage.php" method="post" accept-charset="utf-8">
            <div class="well ">
                <h3>
                <!-- زر تعديل العمل الحالي  -->
                <button type="submit" class="btn btn-primary" name="work" > <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> </button>
                    <!-- حقل إدخال العمل الحالي -->
                <input type="text " class="form-control"  name="namework" value="<?php echo $work  ?>"/>
                    <span class="label label-default">:  العمل الحالي </span><br>
                    <!--  مكان طباعة نتيجة التفيذ عند التعديل على القيمة  -->
                    <?php  echo $updateworkre ; ?>
                </h3>
            </div>
            <div class="well ">
                <h3>    
                <!--  زر تعديل العمل القديم للمرشح  -->
                    <button type="submit" class="btn btn-primary" name="oldwork"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> </button>
                    <!--  حقل إدخال قيمة للعمل السابق  -->
                    <input type="text " class="form-control" name="nameoldwork" value="<?php echo $oldwork ?>" />
                    <span class="label label-default">: الاعمال السابقة </span><br>
                    <!--  طباعة نتيجة التنفيذ عند التعديل  -->
                    <?php echo $updateoldworkre ; ?>
                    
                </h3>
            </div>
            <div class="well">
                <h3>
                <!-- زر تعديل الشهادة العلمية  -->
                <button type="submit" class="btn btn-primary" name="cart"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> </button>
                    <!-- حقل إدخال للشهادة العلمية  -->
                    <input type="text " class="form-control" name="namecart"  value="<?php echo $cart ?>"/>
                    <span class="label label-default">: الشهادة العلمية </span><br>
                    <?php echo $updatecartre ; ?>
                </h3>
            </div>
            <div class="well ">
                <div id="mydiv">
                    <button type="submit" class="btn btn-primary" name="btn_infor"> 
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> 
                    </button>
                    <span class="label label-default">معلومات اخرى </span>
                </div>
                <h3>
                <textarea name="infor" class="form-control" cols="50" rows="10" id="textid"> <?php  echo  $otherinfo   ?> </textarea>
                </h3>
                
                <br> <?php echo $updateotherinfore ; ?>
            </div>
            </form>
        </div>
    </div>
   
    
    
   
    
   
    
    <br>
   
    <!-- <script src = "ajax/update.js" > </script> -->
    <script src ="../lib/assets/dist/js/bootstrap.bundle.min.js"></script>
    


    
    
</body>
</html>