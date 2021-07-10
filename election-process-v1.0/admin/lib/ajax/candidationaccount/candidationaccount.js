// function edit_election_process(){
    
//     var id                   = document.getElementById("number").value;
//     var electionprocess      = document.getElementById("electionprocess").value ;
//     var myRequest ;
//     if(window.XMLHttpRequest){
//         myRequest = new XMLHttpRequest();

//     }else{
//         myRequest = new ActiveXObject("Microsoft.XMLHTTP");

//     }
//         myRequest.onreadystatechange = function(){
//             var idelement  = document.getElementById("REEP");
//         if(this.readyState == 4 && this.status == 200){
//             idelement.innerHTML = this.responseText;
//         }else if (this.readyState > 0 && this.readyState < 4){
//                 idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
//         }else{
//                 idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
//         }
//     };
//     myRequest.open("POST","Http:///localhost/Mekadv2.0/admin/lib/ajax/candidationaccount/editelectionprocess.php",true);
//     myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     myRequest.send('id='+ id +"&electionprocess=" + electionprocess );
// }
//  طلب  اضافة حساب مرشح 
function insert_candidat_account(){
    //  جلب رقم المرشح و العملية الانتخابية المطلوبة  له 
    var id                   = document.getElementById("number").value;
    var electionprocess      = document.getElementById("electionprocess").value ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("resultquery");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
       
    };
    myRequest.open("POST","Http:///localhost/Mekadv2.0/admin/lib/ajax/candidationaccount/insertcandidation.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&electionprocess=" + electionprocess );
}
//
//  طلب حذف حساب مرشح 
function delete_candidat_account(id,electionprocess){
    
    
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("resultquerydelete");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
            // get_cand(electionprocess);
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
       
    };
    myRequest.open("POST","Http://localhost/Mekadv2.0/admin/lib/ajax/candidationaccount/deletecandidation.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id  );
}
function get_all_process(){
    
   
    var type      = document.getElementById("type").value ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("allprocesss");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
       
    };
    myRequest.open("POST","Http://localhost/Mekadv2.0/admin/lib/ajax/candidationaccount/getallprocess.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send("type=" + type );
}

function get_cand(process){
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("getcand");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
       
    };
    myRequest.open("POST","Http://localhost/Mekadv2.0/admin/lib/ajax/candidationaccount/getallcandidatus.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send("process=" + process );
}

