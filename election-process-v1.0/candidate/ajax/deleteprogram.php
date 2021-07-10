<?php
//  جلب قيمة رقم البرنامج الانتخابي من طلب اجاكس  
    $idprogram = $_REQUEST['id'];
    $number    = $_REQUEST["number"];
    //  الاتصال بقاعدة البيانات 
    include("../../../../lib/Php/connectdb.php");
    //  الاستعلام الخاص بحذف برنامج انتخابي 
    $sql = "DELETE FROM `electionprograms` WHERE `IDProgram` ='$idprogram'" ;
    $query = mysqli_query($conn , $sql);
    if($query){
            //  تم تنفيذ الاستعلام 
            if(mysqli_affected_rows($conn)>0 ){
                //   يوجد حقل تأثر بالاستعلام  و بالتالي تم الحذف 
            }else{
                //  لم يتأثر اي حقل بلاستعلام و بالتالي للم يتم الحذف لانه لم يجد البرنامج المطلوب 
                //  لا يمكن ان يتم ذلك لانه الحذف يتم عن طريق زر خاص بكل برنامج انتخابي 
            }
    }else{
        //  لم يتم تنفيذ الاستعلام 
    }
    mysqli_close($conn)
    
?>
<?php echo '
<script src="ajax.js">
    autoselect('.$number.');
</script>'; ?>
