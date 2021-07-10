function selectcity(id){
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
    myRequest.onreadystatechange = function(){
        var idelement  = document.getElementById("cityname");
    if(this.readyState == 4 && this.status == 200){
        idelement.innerHTML = this.responseText;
    }else if (this.readyState > 0 && this.readyState < 4){
            //  idelement.innerHTML = "<option > plase wait </option> " ; 
    }else{
            idelement.innerHTML = "<option > ERORR IN YOUR REQUSET </option>" ;
    }
    };
  
    myRequest.open("GET","http://localhost/Mekadv2.0/employee/lib/ajax/city/selectcity.php?id="+id,true);
    myRequest.send();
}