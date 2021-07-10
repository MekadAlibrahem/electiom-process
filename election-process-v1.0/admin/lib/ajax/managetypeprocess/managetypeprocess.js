function insert_type(){
    
    var id      = document.getElementById("number").value;
    var type    = document.getElementById("type").value ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("resultquery");
        if(this.readyState == 4 && this.status == 200){
            auto_select_type();
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
   
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/managetypeprocess/inserttypeprocess.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&type=" + type );
}
function edit_type(){
    
    var id      = document.getElementById("number").value;
    var type    = document.getElementById("type").value ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("resultquery");
        if(this.readyState == 4 && this.status == 200){
            auto_select_type();
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
   
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/managetypeprocess/edittypeprocess.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&type=" + type );
}

function delete_type(){
    
    var id      = document.getElementById("number").value;
    
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("resultquery");
        if(this.readyState == 4 && this.status == 200){
            auto_select_type();
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
   
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/managetypeprocess/deletetypeprocess.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id  );
}
function auto_select_type(){
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("typeprocess");
        if(this.readyState == 4 && this.status == 200){
            
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
   
    myRequest.open("GET","http://localhost/Mekadv2.0/admin/lib/ajax/managetypeprocess/autoselecttype.php",true);
    myRequest.send();
}
auto_select_type();