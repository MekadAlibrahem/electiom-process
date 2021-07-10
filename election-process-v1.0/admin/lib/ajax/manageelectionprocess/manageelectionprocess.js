// طلب  تسجيل عملية انتخابية 
function insert_election_process(){
    
    var id         = document.getElementById("number").value;
    var pname      = document.getElementById("pname").value ;
    var type       = document.getElementById("type").value ; 
    var startdate  = document.getElementById("startdate").value ;
    var enddate  = document.getElementById("enddate").value ; 
    var SCdate    = document.getElementById("SCdate").value ; 
    var ECdate   = document.getElementById("ECdate").value ;  
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
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/manageelectionprocess/insertelectionprocess.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&pname="+pname+"&type=" + type  +"&startdate=" + startdate  +"&enddate=" + enddate  +"&SCdate="+SCdate +"&ECdate="+ ECdate
    );
}
//-----------------------------------------------------------------------------
// طلب تعديل اسم عملية انتخابية 
function edit_process_name(){
    
    var id     = document.getElementById("number").value;
    var pname  = document.getElementById("pname").value;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("REPN");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/manageelectionprocess/eidtprocessname.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&pname="+pname);
}

// طلب لتعديل نوع العملية الانتخابية
function edit_process_type(){
    
    var id     = document.getElementById("number").value;
    var type  = document.getElementById("type").value;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("RETP");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/manageelectionprocess/eidttypeprocess.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&type="+type);
}


// طلب لتعديل تاريخ بداية العملية الانتخابية
function edit_process_start(){
    
    var id     = document.getElementById("number").value;
    var start  = document.getElementById("startdate").value;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("RESD");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/manageelectionprocess/eidtprocessstartdate.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&start="+start);
}
// طلب لتعديل تاريخ نهاية عملية انتخابية

function edit_process_end(){
    
    var id     = document.getElementById("number").value;
    var end  = document.getElementById("enddate").value;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("REED");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/manageelectionprocess/eidtprocessenddate.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&end="+end);
}
//  طلب تعديل تاريخ بداية الترشح
function edit_start_candidation(){
    
    var id     = document.getElementById("number").value;
    var start  = document.getElementById("SCdate").value;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("RESDC");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/manageelectionprocess/eidtprocessstartdatecandidation.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&start="+start);
}
// طلب لتعديل تاريخ نهاية عملية انتخابية

function edit_end_candidation(){
    
    var id     = document.getElementById("number").value;
    var end  = document.getElementById("ECdate").value;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("REEDC");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/manageelectionprocess/eidtprocessenddatecandidation.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&end="+end);
}
function delete_process(){
    
    var id     = document.getElementById("number").value;
   
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
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/manageelectionprocess/deleteprocess.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id );
}
function auto_select(id){
    
    
   
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("processinfo");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };
    myRequest.open("POST","http://localhost/Mekadv2.0/admin/lib/ajax/manageelectionprocess/autoselect.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id );
}