
<?php
$GLOBALS["id"] = 0 ;
session_start();
if(isset($_POST["signin"])){
$_SESSION["NationalNumber"] = $_POST["idnumber"];
$GLOBALS["id"] = $_SESSION["NationalNumber"];

}
$id = $GLOBALS["id"];
?>
<!DOCTYPE html>
<html lang="ar">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>hey</title>
    <script  src="face.js"></script>
    <script  src="js/face-api.js"></script>
    
    <link rel="stylesheet" href="css/tempface.css" />
    <style>
      body {
        margin: 0;
        padding: 0;
        width: 110vw;
        height: 110vh;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      canvas {
        position: absolute;
      }
    </style>
  </head>
  <body>
  


    <video id="inputVideo" width="720" height="560" autoplay muted></video>


<script >
var id = <?php echo $id ; ?> ;

comperface(id);
</script>
  </body>
</html>

