function get_areas(id){

    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");
       }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("electionarea");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
       
    };
  //  C:\xampp\htdocs\Mekadv2.0\normaluser\lib\ajax\getareas.php
    myRequest.open("GET","http://localhost/Mekadv2.0/normaluser/lib/ajax/getareas.php?id="+ id,true);
    myRequest.send();
    // myRequest.open("POST","Http:///localhost/Mekadv2.0/admin/lib/ajax/candidationaccount/insertcandidation.php",true);
    // myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // myRequest.send('id='+ id +"&electionprocess=" + electionprocess );
}

function get_candidates(id){ 
   
    var process = document.getElementById("process").value;
    var myRequest ;
    if(window.XMLHttpRequest){
       
        myRequest = new XMLHttpRequest();

    }else{
       
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
   
        myRequest.onreadystatechange = function(){
           
            var idelement  = document.getElementById("candidates");
        if(this.readyState == 4 && this.status == 200){
            
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
       
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
           
                idelement.innerHTML = '<div class="alert alert-danger" role="alert">       يوجد خطأ في الطلب </div>';
        }
       
    };
 
    // myRequest.open("GET","Http:///localhost/Mekadv2.0/normaluser/lib/ajax/getcandition.php?id="+ id+"p="+ process,true);

    // myRequest.send();
    myRequest.open("POST","http://localhost/Mekadv2.0/normaluser/lib/ajax/getcandition.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&p=" + process );
}

//
function  show_programs(id){ 
    var process = document.getElementById("process").value;
    var myRequest ;
    if(window.XMLHttpRequest){
       
        myRequest = new XMLHttpRequest();

    }else{
       
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
   
        myRequest.onreadystatechange = function(){
           
            var idelement  = document.getElementById("msg");
        if(this.readyState == 4 && this.status == 200){
            var info = this.responseText ;
            alert_message(info);
           // idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
       
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
           
                idelement.innerHTML = '<div class="alert alert-danger" role="alert">       يوجد خطأ في الطلب </div>';
        }
       
    };
 
    myRequest.open("GET","http://localhost/Mekadv2.0/normaluser/lib/ajax/showprogram.php?id="+ id,true);

    myRequest.send();
}
//
function  set_voet(id){ 
   
    
    //  دالة تعيد القيم المختارة من checkbox || radio button 
    var vets =     get_vote();
   
    var process = document.getElementById("process").value;
    var area    = document.getElementById("area").value ;

    
    var myRequest ;
    if(window.XMLHttpRequest){
       
        myRequest = new XMLHttpRequest();

    }else{
       
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
   
        myRequest.onreadystatechange = function(){
           
            var idelement  = document.getElementById("resultsetelection");
        if(this.readyState == 4 && this.status == 200){
            
         idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
       
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
           
                idelement.innerHTML = '<div class="alert alert-danger" role="alert">       يوجد خطأ في الطلب </div>';
        }
       
    };
 
    myRequest.open("POST","http://localhost/Mekadv2.0/normaluser/lib/ajax/setvets.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&vets=" + vets +"&process=" +process +"&area=" + area );


}
function get_vote() {
    var vote ;
    try {
        var nameelement = document.getElementsByName("radiovets");
        for(var i = 0 ; i < nameelement.length ; i++){
            if(nameelement[i].checked){
                vote =  nameelement[i].value ;
                return vote ;
            }
        }
    } catch (error) {
       console.log("error in radio button ");
        
    } 
    try {
        var canditations = []
        var checkboxes = document.querySelectorAll('input[type=checkbox]:checked')
        
        for (var i = 0; i < checkboxes.length; i++) {
            canditations.push(checkboxes[i].value)
        }
        vote = canditations ;
        return vote ;

    } catch (error) {
        console.log("error in check box");
    }
}
function SETVOTE(id){
    var r = confirm("هل انت متأكد انك تريد الانتخاب لن تستطيع  تغير  ذلك  مرة ثانية ");
    if (r == true) {
      set_voet(id);
    } else {
    
  }
  }
// 
// function get all value cheked in checkbox 
function getCheckedBoxes(chkboxName) {
    var checkboxes = document.getElementsByName(chkboxName);
    var checkboxesChecked = [];
    // loop over them all
    for (var i=0; i<checkboxes.length; i++) {
       // And stick the checked ones onto an array...
       if (checkboxes[i].checked) {
          checkboxesChecked.push(checkboxes[i]);
       }
    }
    // Return the array if it is non-empty, or null
    return checkboxesChecked.length > 0 ? checkboxesChecked : null;
  }
  

//----------------------------------------------------
//// functinon  alert 
var bg ;
function alert_message(info = "my program"){
    var L = (document.body.clientWidth - 300) /2 ;
    window.page.style.opacity = 0.2;
    document.body.style.zIndex = 0 ;
    bg = document.body.style.backgroundColor ; 
    document.body.style.backgroundColor = "ddd";
    var strMsg = "";
    strMsg += "<div id='mymsg'>"+  info  +" <br> <br>  <Button  onclick='hideMsg();'> تم </Button class='btn btn-primary'> </div>  ";
    window.msg.innerHTML = strMsg ;
    window.mymsg.style.left = L ;
}
// 
function hideMsg(){
    window.msg.innerHTML = "";
    window.page.style.opacity = 1 ;
    document.body.style.backgroundColor = bg ;  
}
function get_area(id){

    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("electionarea");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
       
    };
  
    myRequest.open("GET","http://localhost/Mekadv2.0/normaluser/lib/ajax/getarea.php?id="+ id,true);
    myRequest.send();

}
// 
// 
function get_result(id){
    var process = document.getElementById("process").value;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("result");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
       
    };
    myRequest.open("POST","http://localhost/Mekadv2.0/normaluser/lib/ajax/getresult.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&process=" +process );

}
