<?php
/** الدوال الخاصة بالقيام بتسجيل عملية اقتارع للمواطنين */


/////////////
/**
 * خطوات الانتخاب 
 * 1- التحقق من الانتخاب ضمن التاريخ المحدد 
 * 2-  التحقق من امكانية هذا المواطن من الانتخاب
 * + التحقق من عمر الناخب اكبر من 18  
 * 3- التحقق من ان المواطن ينتخب ضمن دائرته الانتخابية 
 * 4- ادخال اصوات الناخب الى جميع  المرشحين المحددين  
 * 5- تغير حالة السماح للناخب الى ممنوع من الانتخاب لكي لا ينتخب مرة ثانية 
 * ملاحظة : العسكريين ممنوععين من الانتخاب في انتخابات مجلس الشعب و مجال الادارة المحلية 
 */
/** 
 *  دالة تحقق من عمر الناخب 
 * تحتاج وسيطين 
 * @param  $userid (int)| الرقم الوطني للناخب 
 * @param  $connecteddb (mysqli_connected()) |  معرف اتصال قاعدة البيانات 
 * @return  true |  العمر فوق 18 
 * @return  false |  العمر اقل من 18 
 
 */

function check_date_user($userID , $connectedDB){
    //   استعلام يعيد تاريخ ميلاد الناخب عن طريق الرقم الوطني 
    $check = "SELECT DATE(BirthDate) FROM `users` WHERE `NationalNumber` = '$userID' ";
    $query = mysqli_query($connectedDB,$check);
    if($query){
        //  الاستعلام صحيح
        if(mysqli_num_rows($query)>0){
            //  وجد نتيجة => وجد الناخب المطلوب  
            //  متغير لتخزين تاريخ الميلاد 
            $birthdate = null ; 
            //  عرض النتيجة 
            while($row = mysqli_fetch_array($query)){
                //  تخزين تاريخ الميلاد في متغير
                $birthdate = $row[0];
            }
            //  دالة تعيد التاريخ الحالي ( سنة - شهر - يوم ) القيمة المعادة من نمط محارف ( نصية )
            $date  = date("Y-m-d");
            //  قبل القيام بحساب عمر الناخب يجب تحويل القيم الى كائن من نمط تاريخ 
            //  تحويل القيم الى كائن من نمط تاريخ 
            $date1 = date_create($birthdate);
            $date2 = date_create($date);
            //  دالة تعيد الفرق بين تاريخين 
            $diff1 = date_diff($date1,$date2);
            //  إعادة الفرق بين التاريخين بالايام 
            $daysdiff = $diff1->format("%R%a");
            $daysdiff = abs($daysdiff);
            //  حساب العمر عن طريق تقسيم عدد الايام على 365 و إعادته من نمط رقم لكي يعيده دون فواصل 
            $age = intval($daysdiff /365) ;
            if($age >17 ){
                //  عمر الناخب اكبر من 17 سنة وبالتالي يحق له الانتخاب
                return true ;
            }else{}
        }else{}
    }else{}
    return false ;
}

 // 
/**
 * دالة التحقق من تاريخ الانتخاب 
 * تحتاج وسيطين 
 * @param $idprocess (int) |  رقم العملية الانتخابية  
 * @param $connecteddb (conn = mysqli_connected()) |  معرف الاتصال بقاعدة البيانات  
 * @return true |  في حال كان تاريخ الانتخاب صحيح
 * @return  false |  في حال كان التاريخ الحالي غير تاريخ الانتخاب 
 */ 
function check_date_process($idprocess , $connecteddb){
    if($idprocess>0 ){
        
        // $cheked  = " SELECT `IDProcess` FROM `electionprocess` WHERE DATE(`EndDate`)=< DATE(CURDATE()) AND DATE(`StartDate`) <= DATE(CURDATE())" ;
        //  استعلام يعيد رقم العمليات الانتخابية المتاحة للاقتارع 
        $cheked  = " SELECT `IDProcess` FROM `electionprocess` WHERE DATE(CURDATE()) BETWEEN DATE(`StartDate`) AND  DATE(`EndDate`)" ;
        $query = mysqli_query($connecteddb,$cheked);
        if($query){
            // الاستعلام صحيح
            if(mysqli_num_rows($query)>0){
                // وجد عمليات متاحة 
                while($row = mysqli_fetch_array($query)){
                    //  شرط يتحقق من ان النتيجة المعادة تساوي الرقم العملية الانتخابية المرر للدالة 
                    if($idprocess == $row["IDProcess"]){
                        //  العملية الانتخابية المحددة متاحة حاليا للاقتارع 
                       
                        return true ; 
                    }else{
                    
                    }
                }
                
            }else{
                // not found process
            }
        }else{
            //qeury : FALSE
        }
    }else{

    }
   
    return false ;
}
/**
 *  دالة تحقق من حالة الانتخاب للمواطن بحث 
 * الوسطاء  : 
 * @param int  $userID :  الرقم الوطني للناخب 
 * @param int $idprocess :  رقم العملية الانتخابية 
 * @param mysqli_connected $connecteddb : معرف الاتصال بقاعدة البيانات 
 * @return true  : مسموح له بالانتخاب
 * @return false :  غير مسموح له بالانتخاب  
 */
function checked_status($userID , $idprocess , $connecteddb){
    if($userID > 0 ){
        //  استعلام يعيد حالة السماح بالانتخاب لمستحدم 
        $cheked_status = "SELECT * FROM `electionstatus` WHERE `NationalNumber` = '$userID' AND `IDProcess` = '$idprocess' ";
        $query_checked_status = mysqli_query($connecteddb,$cheked_status);
        if($query_checked_status){
            //الاستعلام صحيح 
            if(mysqli_num_rows($query_checked_status)>0){
                // الاسم مسجل سابقا
                return false ;
            }else{
                //  لم يجد اي نتيجة وبالتالي المستخدم غير مسجل سابق لهذه العملية  ويمكنه الانتخاب
               
                return true ;
            }
        }else{
            // query false 
        }
    }else{
        // user id : false 
    }
    return false ;
}

/**
 * دالة التحقق من ان المواطن ينتخب ضمن دائرنه الانتخابية فقط 
 * @param int $userID  : الرقم الوطني 
 * @param int $idprocess : رقم العملية الانتخابية 
 * @param int $area :  الدائرة الانتخابية التي يريد المستخدم الاقتراع بها 
 * @param  $connectedDB :  معرف الاتصال بقاعدة البيانات 
 * @return  bool true  : الدائرة الانتخابية صحيحة 
 * @return bool  false : الدائرة الانتخابية غير صحيحة 
 */
function check_area($userID,$idprocess,$area ,$connectedDB){
    if($userID > 0 && $idprocess > 0){
        $get_area = "SELECT `electionareadatils`.`ElectionAreaID` AS 'Area' FROM `electionareadatils` INNER JOIN `electionareas` on `electionareas`.`ElectionAreaID` = `electionareadatils`.`ElectionAreaID` WHERE `IDTypeProcess` = (SELECT `IDTypeProcess` FROM `electionprocess` WHERE `IDProcess` = '$idprocess') AND `ResidentionAreaID` IN (SELECT `ResidentionAreaID` FROM `users` WHERE `users`.`NationalNumber` = '$userID' )" ;
        $query = mysqli_query($connectedDB,$get_area);
        if($query){
            if(mysqli_num_rows($query)>0){
                // find result 
                while($row = mysqli_fetch_array($query)){
                    $user_area = $row["Area"] ;
                    if($area == $user_area){
                        return true ;
                    }else{
                        return false ;
                    }
                }
            }else{
                //  not found any result 
                return false ;
            }
        }else{
            //  ERROR QUERY 
            return false ;
        }
    } 
}


/** 
 *  دالة توم بتسجيل الاصوات لناخبين 
 * تحتاج الى وسطاء  
 * @param $userID (int) :  الرقم الوطني للناخب 
 * @param $canditaionID (int) :  رقم المرشح 
 * @param $connecteddb :  معرف الاصتال بقاعدة البيانات 
 * @return 1 :  تم تسجيل الاقتراع
 * @return 0 : لم يتم تسجيل الاقتراع 
 */
function set_vote($userID , $canditaionID , $connecteddb){
    if($userID >0 && $canditaionID > 0 ){
        //     استعلام إضافة اقتراع 
            $set_voet = "INSERT INTO `results`(`NationalNumber`, `CandidateID`, `Status`) VALUES ('$userID','$canditaionID','1')";
            $query = mysqli_query($connecteddb,$set_voet);
            if($query){
                // الاستعلام صحيح 
                    if(mysqli_affected_rows($connecteddb)>0){
                        // تم تسجيل الاقتراع 
                        return 1 ;
                    }
            }else{
                //   يوجد خطأ لم يتم تسجيل الاقتراع 
                return 0 ;  
            }
    }else{
        // يوجد خطأ في الاستعلام 
    }
}
/**
 * دالة تسجيل انتخاب لعملية إستفتاء  
 * @param $userID (int) :  الرقم الوطني للناخب 
 * @param $vote (int) :  1 or 0  
 * @param int $idprocess : رقم العملية الانتخابية  
 * @param $connecteddb :  معرف الاصتال بقاعدة البيانات 
 * @return 1 :  تم تسجيل الاقتراع
 * @return 0 : لم يتم تسجيل الاقتراع 
 * 
 */
function set_vote2($userID , $voet , $idprocess,$connectedDB){
    if($userID >0 && $idprocess > 0 ){
        //     استعلام إضافة اقتراع 
            $set_voet = "INSERT INTO `results`(`NationalNumber`, `IDProcess`, `Status`) VALUES ('$userID','$idprocess','$voet')";
            $query = mysqli_query($connectedDB,$set_voet);
            if($query){
                // الاستعلام صحيح 
                    if(mysqli_affected_rows($connectedDB)>0){
                        // تم تسجيل الاقتراع 
                        return 1 ;
                    }
            }else{
                //   يوجد خطأ لم يتم تسجيل الاقتراع 
                return 0 ;  
            }
    }else{
        // يوجد خطأ في الاستعلام 
    }
}
/**
 * دالة تقوم بالتاكد من حالةعمل ناخب اذا كان عسكري او لاء و مسموح له بالانتخاب في هذه العملية الانتخابية 
 * @param int $iduser :  الرقم الوطني للناخب 
 * @param int $idprocess  :  رقم العملية الانتخابية 
 * @param int $connectedDB : معرف اتصال قاعدة البيانات 
 * @return true  :  اذا كان مسموح له بالانتخاب 
 * @return  false :  إذا كان غير مسموح له بالانتخاب
 * 
 */
function check_job($iduser,$idprocess,$connectedDB){
    $check_job = "SELECT * FROM `job` WHERE jobID = (SELECT jobID FROM `users` WHERE `users`.`NationalNumber` = '$iduser')";
    $query_check_job = mysqli_query($connectedDB,$check_job);
    if($query_check_job && mysqli_num_rows($query_check_job)>0){
        
            while($row = mysqli_fetch_array($query_check_job)){
                if ($row["jobID"]==3) {
                    $type_process = "SELECT `IDTypeProcess` FROM `electionprocess` WHERE `IDProcess` = '$idprocess'";
                    $query_type = mysqli_query($connectedDB,$type_process);
                    if($query_type && mysqli_num_rows($query_type)>0){
                        while($row = mysqli_fetch_array($query_type)){
                            if($row["IDTypeProcess"]  == 1 || $row["IDTypeProcess"]==2){
                                return false ;
                            }else{
                                return true ;
                            }
                        }
                    }

                } else {
                    return true ;
                }
                
            }
        
    }
    return false ;
}
/** 
 * دالة تقوم بتسجيل الناخب و العملية الانتخابية في جدول حالة الانتخاب لكي لا ينتخب مرة ثانية لهذه العملية الانتخابية 
 * @param $userID :  رقم الوطني للناخب 
 * @param $idprocess : رقم العملية الانتخابية  
 * @param $connecteddb :  معرق الاتصال بقاعدة البيانات 
 * @return true  :  تم تعديل حالة الانتخاب 
 * @return  false : لم يتم تعديل حالة الانتخاب
 */
function set_status($iduser ,$idprocess , $connecteddb){
    if($iduser>0){
        //  التحقق من ان الرقم الوطني غير فارغ 
        //  استعلام لتعديل حالة الانخاب الى 0 
        $set_status = "INSERT INTO `electionstatus`(`NationalNumber`, `IDProcess`, `status`) VALUES ('$iduser','$idprocess','1') ";
        $query_set_status = mysqli_query($connecteddb, $set_status);
        if($query_set_status){
            //  الاستتعلام صحيح 
                if(mysqli_affected_rows($connecteddb)>0){
                    // يوجد حقل متأثر و بالتالي تم التعديل بنجاح 
                        return true ; 
                }else{
                    // not fount any row affected  :: ERROR 
                }
        }else{
            //query : false 
        }
    }else{
        //iduser : false
    }
    return false ;
}
/**
 * 
 
 */
/** 
 * دالة تقوم بتسجيل عملية الاقتراع 
 * 
 * @param int $iduser :  الرقم الوطني للناخب  
 * @param int $canditaionID :  رقم المرشح ( ممككن مصفوفة تحوي ارقام المرشحين )  
 * @param int $idprocess :  رقم العملية الانتخابية 
 * @param int $area :  الدائرة الانتخابية التي سيتم الانتخاب بها 
 * @return int 1 : تم الانتخاب بنجاح 
 * @return int 401 : تاريخ الانتخاب غير صحيح
 * @return int 402 : حالة الانتخاب غير صحيحة ( تم الانتخاب سابقا)
 * @return int 403 : خطأ في تغير حالة الانتخاب
 * @return int 404 : خطأ في تسجيل الاصوات  
 * @return int 405 :  الدائرة الانتخابية غير صحيحة 
 * 
*/ 
function set_election($iduser ,$canditaionID = null,$voet=null, $idprocess,$area){
    // 1- connected db
    include("../../../../lib/Php/connectdb.php");
    if(check_date_user($iduser,$conn)){
        //  عمر الناخب  18 او اكبر 
            //2- التحقق من تاريخ الانتخاب 
        if(check_date_process($idprocess,$conn)){
            // date : true 
            // 3- التحقق من عمل الناخب 
            if(check_job($iduser,$idprocess,$conn)){
                 // 4- التحقق من سماحية الانتخاب للمنتخب 
                if(checked_status($iduser,$idprocess,$conn)){
                    //  التحقق من صحة الدائرة الانتخابية 
                    if(check_area($iduser,$idprocess,$area,$conn)){
                        // الدائرة الانتخابية صحيحة 

                        // /////////////////////////////////////////////////////////////
                        if($canditaionID != null){
                            //  التتحقق من ان رقم المرشح مصفوفة و بالتالي انتخاب اكثر من مرشح 
                            if(is_array($canditaionID)){
                                foreach($canditaionID as $i){
                                    set_vote($iduser,$i,$conn);
                                }
                                //  التحقق من ان رقم المرشح ليس مصفوفة و بالتالي انتخاب مرشح واحد فقط 
                            }else if(!is_array($canditaionID)){
                                set_vote($iduser,$canditaionID,$conn);
                            }else{
                                return 404 ;
                            }
                        }else if($voet != null){
                            set_vote2($iduser,$voet,$idprocess,$conn);
                        }
                        else{
                            return 408; 
                        }
                      
                    // /////////////////////////////////////////////////////////////////////
                    
                    // 5-  تغير حالة الانتخاب الى flase 
                    if(set_status($iduser,$idprocess ,$conn)){
                        // end 
                        return 1 ;
                    }else{
                        return 403 ;
                    }
                    }else{
                        // الدائرة الانتخابية غير صحيحة 
                        return 405 ;
                    }
                }else{
                    // status : false 
                    return 402;
                }
            }else{
                //  JOB ERROR 
                return 407 ;
            }
        }else{
            // date false 
            return 401 ;
        }
    }else{
        //  الناخب اصغر من 18 عام 
        return 406 ;
    }
      
    
}

?>