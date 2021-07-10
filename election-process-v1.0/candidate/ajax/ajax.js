function autoselect(id){
    
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
    myRequest.onreadystatechange = myselect ;
    // myRequest.open("GET","http://localhost/Mekadv2.0/candidate/ajax/selectprogram.php?id="+id, true);
    // myRequest.send();
    myRequest.open("POST","http://localhost/Mekadv2.0/candidate/ajax/selectprogram.php" , true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send("id="+ id  );
}
function myselect(){
    var idelement  = document.getElementById("selected");
    if(this.readyState == 4 && this.status == 200){
        idelement.innerHTML = this.responseText ;
    }else if (this.readyState > 0 && this.readyState < 4){
             idelement.innerHTML = "plase waiting " ; 
    }else{
            idelement.innerHTML = "ERORR IN YOUR REQUEST" ;
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
function autoinsert(text, id){
   
    // text = document.getElementById("textinsert").value ;
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");

    }
    myRequest.onreadystatechange = myinsert ;
    // myRequest.open("GET","http://localhost/Mekadv2.0/candidate/ajax/insertprogram.php?text="+text+"&id="+id , true);
    // myRequest.send();
    myRequest.open("POST","http://localhost/Mekadv2.0/candidate/ajax/insertprogram.php" , true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send("text="+ text+"&id="+ id );
}
function myinsert(){
    var idelement  = document.getElementById("selected");
    if(this.readyState == 4 && this.status == 200){
        idelement.innerHTML += this.responseText;
    }else if (this.readyState > 0 && this.readyState < 4){
            // idelement.innerHTML = "plase waiting " ; 
    }else{
            idelement.innerHTML = "ERORR IN YOUR REQUEST" ;
    }
}
function autodelete(id){
    
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");
    }
    myRequest.onreadystatechange = mydelete() ;
   
    myRequest.open("POST","http://localhost/Mekadv2.0/candidate/ajax/deleteprogram.php" , true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id );
   
}
function mydelete(){
    
    if(this.readyState == 4 && this.status == 200){
       
    }else if (this.readyState > 0 && this.readyState < 4){
            
    }else{
        
    }
}
function delet(id){
    result = confirm("هل انت متاكد من حذف البرنامج الانتخابي ");
    if(result==true){
        autodelete(id);
        autoselect();
        autoselect();
    }
}

function updateprogram(id,text){
    var myRequest ;
    if(window.XMLHttpRequest){
        myRequest = new XMLHttpRequest();

    }else{
        myRequest = new ActiveXObject("Microsoft.XMLHTTP");
    }
    myRequest.onreadystatechange =function(){
        if(this.readyState == 4 && this.status == 200){
            autoselect();
        }else if (this.readyState > 0 && this.readyState < 4){
                
        }else{
            
        }
    } ;
   
    myRequest.open("POST","http://localhost/Mekadv2.0/candidate/ajax/updateprogram.php" , true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send('id='+ id +"&text=" + text );
 
}

function Edit(id,text){
    result =  confirm("هل تريد تعديل البرنامج الانتخابي " );
    if(result){
        updateprogram(id,text);
    }
}

function clear(){
    document.getElementById('textinsert').value = '' ;
}