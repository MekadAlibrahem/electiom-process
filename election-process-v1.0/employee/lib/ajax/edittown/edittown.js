//---------------------------------------------------
function editname(){
    id     = document.getElementById("numtown").value ;
    town   = document.getElementById("town").value   ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
    myRequest.onreadystatechange = function(){
        var idelement  = document.getElementById("RENT");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML = 'WAIT' ; 
        }else{
                idelement.innerHTML = 'ERROR IN YOUR REQUEST' ;
        }
    };
    myRequest.open("POST","http://localhost/Mekadv2.0/employee/lib/ajax/edittown/edittownname.php" ,true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&town=" + town );
}
//---------------------------------------------------
function editcity(){
    id     = document.getElementById("numtown").value ;
    city   = document.getElementById("cityID").value   ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
    myRequest.onreadystatechange = function(){
        var idelement  = document.getElementById("REC");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML = 'WAIT' ; 
        }else{
                idelement.innerHTML = 'ERROR IN YOUR REQUEST' ;
        }
    };
    myRequest.open("POST","http://localhost/Mekadv2.0/employee/lib/ajax/edittown/editcityname.php" ,true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&city=" + city );
}
//-----------------------------------------------
function autoselecttown(id){
   
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
    myRequest.onreadystatechange = function(){
        var idelement  = document.getElementById("townselect");
        if(this.readyState == 4 && this.status == 200){
            idelement.innerHTML = this.responseText;
        }else if (this.readyState > 0 && this.readyState < 4){
                idelement.innerHTML = 'WAIT' ; 
        }else{
                idelement.innerHTML = 'ERROR IN YOUR REQUEST' ;
        }
    };
    myRequest.open("POST","http://localhost/Mekadv2.0/employee/lib/ajax/edittown/autoselecttown.php" ,true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id );
}


