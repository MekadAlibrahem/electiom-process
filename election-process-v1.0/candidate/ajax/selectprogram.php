 <?php
   session_start();
   $CandidateID = $_SESSION["CandidateID"];

?> 

    <?php
      // $CandidateID = $_REQUEST["id"];
      //  الاصتال بقاعدة البيانات 
      include("../../../../lib/Php/connectdb.php");
  //   الاستعلام عن برامج مرشح عن طريق رقمه
        $sql2 = "select * from electionprograms where  CandidateID = $CandidateID " ;
        $query2 = mysqli_query($conn , $sql2);
        if($query2){
          if(mysqli_num_rows($query2)>0){
            $count = 0 ;
            while($row = mysqli_fetch_array($query2)){
              $count += 1;
                $num          = $row["IDProgram"];
                $program      = $row["Content"];
                $btnupnaem    = "btnup".$num ;
                $textname     = "text".$num ;
                $divid         = "div".$num ;
             
    //  عرض البرنامج الانتخابي
      echo '<div class="col-sm-12 col-md-6" ">
         <div class="thumbnail" >
          <div class="caption">
            <h3 > البرنامج الانتخابي رقم'. $count .' </h3>
            <p>
              <textarea name="" id="'.$textname.'" cols="10" rows="10"> '.$program.'</textarea>
            </p>
            <p>
              <button type="submit" class = "btn btn-primary" onclick="Edit('.$num.',document.getElementById(\''.$textname.'\').value);"  role="button">
              <span class="glyphicon glyphicon-edit" aria-hidden="true">
              </button> 
              <button type="submit" class="btn btn-danger" role="button" onclick="delet('.$num.');" >
               <span class="glyphicon glyphicon-trash" aria-hidden="true">
              </button>
            </p>
          </div>
        </div>
      </div>' ;
      
         }
         }
        }
         mysqli_close($conn) ;
      ?>
    
<script src="ajax.js"></script>