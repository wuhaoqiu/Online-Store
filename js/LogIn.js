function toValidLI(){
   document.forms[0].onsubmit=function(e){
       e.preventDefault();
       checkForm();
   }
   
   document.getElementsByName("username")[0].onkeydown=function(e){
       document.getElementsByName("username")[0].className+=" clear";
   }
   
   document.getElementsByName("password")[0].onkeydown=function(e){
       document.getElementsByName("password")[0].className+=" clear";
   }
   
   function checkForm(){
       var submit = true;
       var names=["username","password"];
       
       //loop through all places that can be empty
    for(var i =0; i<names.length; i++){
        var valueAt = (document.getElementsByName(names[i]))[0].value;
        
       if(valueAt == ""){
    //when there is an empty, hightlight them.
           document.getElementsByName(names[i])[0].className+=" highlight";
    //when empty, do not submit
           submit=false;
        }
    }
       
    
    //All filled? submit!
    if(submit == true){
    document.forms[0].submit();
    }
    else{
      alert("The red marked blanks are empty!");  
    }
       
   }
}
window.onload = toValidLI;