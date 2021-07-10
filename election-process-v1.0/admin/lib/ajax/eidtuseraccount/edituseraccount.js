function edittypeaccount(){
    
    var id      = document.getElementById("number").value;
    var type    = document.getElementById("type").value ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("REAT");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
   
    myRequest.open("POST","Http:///localhost/Mekadv2.0/admin/lib/ajax/eidtuseraccount/edittypeaccount.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&type=" + type );
}
function editaccountstatus(){
    
    var id      = document.getElementById("number").value;
    var status    = get_value_status() ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("REAS");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
    myRequest.open("POST","Http:///localhost/Mekadv2.0/admin/lib/ajax/eidtuseraccount/editaccountstatus.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&status=" + status );
}

function get_value_status(){
    var nameelement = document.getElementsByName("status");
    for(var i = 0 ; i < nameelement.length ; i++){
        if(nameelement[i].checked){
            return nameelement[i].value ;
        }
    }
}

//---
function auto_select(id){
    
   
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("autoselectaccount");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
    myRequest.open("POST","Http:///localhost/Mekadv2.0/admin/lib/ajax/eidtuseraccount/autoselectaccount.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id );
}