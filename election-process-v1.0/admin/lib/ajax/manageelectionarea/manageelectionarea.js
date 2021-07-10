function get_info(id){
    
    
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("autoselect");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
              //  idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
   
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/manageelectionarea/getelectionareainfo.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id);
}

function set_election_area(){
    
    var id      = document.getElementById("number").value;
    var name    = document.getElementById("name").value ;
    var type    = document.getElementById("type").value ;
    var count    = document.getElementById("count").value ;
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
   
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/manageelectionarea/setelectionarea.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id + "&name="+ name +"&type=" + type + "&count=" + count);
}
////////////////////////////////////////////////////////////
function editName(){
    
    var id      = document.getElementById("number").value;
    var name    = document.getElementById("name").value ;
  
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("rename");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
   
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/manageelectionarea/editname.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id + "&name="+ name );
}
//////////////////////////////////////////////////////////////
function edittype(){
    
    var id      = document.getElementById("number").value;
    var type    = document.getElementById("type").value ;
  
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("retype");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
   
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/manageelectionarea/edittype.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id + "&type="+ type );
}
//////////////////////////////////////////////////////////////////
function editacount(){
    
    var id      = document.getElementById("number").value;
    var count    = document.getElementById("count").value ;
  
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("recount");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
   
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/manageelectionarea/editcount.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id + "&count="+ count );
}
//////////////////////////////////////////////////////////////////
function delet(){
    
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
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
   
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/manageelectionarea/deleteelectionarea.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id );
}
