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
//  طلب ليعيد معلومات عن القيد عن طريق الرقم 
function auto_select_ID(id){
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
    myRequest.onreadystatechange = function(){
        var idelement  = document.getElementById("select_result");
    if(this.readyState == 4 && this.status == 200){
        idelement.innerHTML = this.responseText;
    }else if (this.readyState > 0 && this.readyState < 4){
            //  idelement.innerHTML = "<option > plase wait </option> " ; 
    }else{
            idelement.innerHTML = " ERORR IN YOUR REQUSET " ;
    }
    };
    myRequest.open("GET","http://localhost/Mekadv2.0/employee/lib/ajax/autoselectid.php?id="+id,true);
    myRequest.send();
}
function auto_select_job(id){
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
    myRequest.onreadystatechange = function(){
        var idelement  = document.getElementById("select_job");
    if(this.readyState == 4 && this.status == 200){
        idelement.innerHTML = this.responseText;
    }else if (this.readyState > 0 && this.readyState < 4){
            //  idelement.innerHTML = "<option > plase wait </option> " ; 
    }else{
            idelement.innerHTML = " ERORR IN YOUR REQUSET " ;
    }
    };
    myRequest.open("GET","http://localhost/Mekadv2.0/employee/lib/ajax/autoselectjob.php?id="+id,true);
    myRequest.send();
}

