//  طلب لتعديل الاسم
function updatefname(){
    
    var id      = document.getElementById("number").value;
     var fname   = document.getElementById("fnameid").value ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("RUFN");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };

    myRequest.open("POST","Http:///localhost/Mekadv2.0/employee/lib/ajax/updateuser/updatefname.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&fname=" + fname );
}
///  طلب لتعديل الكنية

function updatelname(){
    
    var id      = document.getElementById("number").value;
    var lname   = document.getElementById("lnameid").value ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("RULN");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };

    myRequest.open("POST","Http:///localhost/Mekadv2.0/employee/lib/ajax/updateuser/updatelname.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&lname=" + lname );
}   
// طلب تعديل اسم الاب

function updatefathername(){
    
    var id      = document.getElementById("number").value;
    var fname   = document.getElementById("fathernameid").value ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("RUFAN");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };

    myRequest.open("POST","Http:///localhost/Mekadv2.0/employee/lib/ajax/updateuser/updatefathername.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&fname=" + fname );
}

// طلب تعديل اسم الام

function updatemothername(){
    
    var id      = document.getElementById("number").value;
    var mname   = document.getElementById("mothernameid").value ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("RUMN");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };

    myRequest.open("POST","Http:///localhost/Mekadv2.0/employee/lib/ajax/updateuser/updatemothername.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&mname=" + mname );
}  

// طلب تعديل تاريخ الميلاد 

function updatebirthdate(){
    
    var id      = document.getElementById("number").value;
    var bdate   = document.getElementById("birthdateid").value ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("RUBD");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };

    myRequest.open("POST","Http:///localhost/Mekadv2.0/employee/lib/ajax/updateuser/updatebarthdate.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&bdate=" + bdate );
}  

// طلب تعديل عنوان السكن
function updateadress(){
    
    var id       = document.getElementById("number").value;
    var adress   = document.getElementById("adressid").value ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("RUA");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };

    myRequest.open("POST","Http:///localhost/Mekadv2.0/employee/lib/ajax/updateuser/updateadress.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&adress=" + adress );
}  

// طلب تعديل رقم القيد 
function updateidadress(){
    
    var id       = document.getElementById("number").value;
    var idadress   = document.getElementById("adressnumber").value ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("RUID");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };

    myRequest.open("POST","Http:///localhost/Mekadv2.0/employee/lib/ajax/updateuser/updateidadress.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&idadress=" + idadress );
}  
//
function updategender(gender){
    
    var id       = document.getElementById("number").value;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("RUG");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText ;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };

    myRequest.open("POST","Http:///localhost/Mekadv2.0/employee/lib/ajax/updateuser/updategender.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&gender=" + gender );
}  
// طلب تعديل العمل  
function updatejob(){
    
    var id       = document.getElementById("number").value;
    var job      = document.getElementById("jobid").value ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("RUJ");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText ;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };

    myRequest.open("POST","Http:///localhost/Mekadv2.0/employee/lib/ajax/updateuser/updatejob.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&job=" + job );
}  


//------------
function updatetown(){
    
    var id       = document.getElementById("number").value;
    var town     = document.getElementById("selecttown").value ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("RUT");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText ;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };

    myRequest.open("POST","Http:///localhost/Mekadv2.0/employee/lib/ajax/updateuser/updatetown.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&town=" + town );
}
function updatestatus(status){
    
    var id       = document.getElementById("number").value;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("RUS");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText ;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };

    myRequest.open("POST","Http:///localhost/Mekadv2.0/employee/lib/ajax/updateuser/updatestatus.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&status=" + status );
}
function select_user(){
    var id  =document.getElementById("number").value ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("selectuser");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText ;
        }else if (this.readyState > 0 && this.readyState < 4){
                // idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
        }else{
                idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
        }
    };

    myRequest.open("POST","Http:///localhost/Mekadv2.0/employee/lib/ajax/updateuser/selectuser.php",true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id );
}   
    //  طلب تعديل صورة 
    function updateimage(){
    
        var id      = document.getElementById("number").value;
         var pic   = document.getElementById("userimge").value ;
         alert(pic);
        var myRequest ;
        if(window.XMLHttpRequest){
            myRequest = new XMLHttpRequest();
    
        }else{
            myRequest = new ActiveXObject("Microsoft.XMLHTTP");
    
        }
            myRequest.onreadystatechange = function(){
                var idelement  = document.getElementById("RUIMG");
            if(this.readyState == 4 && this.status == 200){
                idelement.innerHTML = this.responseText;
            }else if (this.readyState > 0 && this.readyState < 4){
                    idelement.innerHTML =  '<div class="alert alert-info" role="alert"> الرجاء الانتظار قليلا </div>' ;
            }else{
                    idelement.innerHTML = '<div class="alert alert-danger" role="alert"> يوجد خطأ في الطلب </div>';
            }
        };
    
        myRequest.open("POST","Http:///localhost/Mekadv2.0/employee/lib/ajax/updateuser/updateimage.php",true);
        myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        myRequest.send('id='+ id +"&pic=" + pic );
    }

    function autoselecttown(id){
        var myRequest ;
        if(window.XMLHttpRequest){
            myRequest = new XMLHttpRequest();
    
        }else{
            myRequest = new ActiveXObject("Microsoft.XMLHTTP");
    
        }
        myRequest.onreadystatechange = function(){
            var idelement  = document.getElementById("selecttown");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                 idelement.innerHTML = "<option > plase wait </option> " ; 
        }else{
                idelement.innerHTML = "<option > ERORR IN YOUR REQUSET </option>" ;
        }
        };
        myRequest.open("GET","http://localhost/Mekadv2.0/employee/lib/ajax/selecttown.php?id="+id,true);
        myRequest.send();
    }