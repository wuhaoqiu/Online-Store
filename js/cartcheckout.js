
function toValidSI(){
    
    
    var names=["cardname","cardnumber", "expmonth", "expyear", "cvv"];
   document.forms[0].onsubmit=function(e){
       e.preventDefault();
       checkForm();
   }
   

   document.getElementsByName(names[0])[0].onkeydown=function(e){
       document.getElementsByName(names[0])[0].classList.remove("highlight");
   }
   document.getElementsByName(names[1])[0].onkeydown=function(e){
       document.getElementsByName(names[1])[0].classList.remove("highlight");
   }
   document.getElementsByName(names[2])[0].onkeydown=function(e){
       document.getElementsByName(names[2])[0].classList.remove("highlight");
   }
   
   document.getElementsByName(names[3])[0].onkeydown=function(e){
       document.getElementsByName(names[3])[0].classList.remove("highlight");
   }
   
   document.getElementsByName(names[4])[0].onkeydown=function(e){
       document.getElementsByName(names[4])[0].classList.remove("highlight");
   }

   
   
   function checkForm(){
       
       var submit = true;
       //loop through all places that can be empty
    for(var i =0; i<names.length; i++){
        var valueAt = (document.getElementsByName(names[i]))[0].value;
        
       if(valueAt == ""){
    //when there is an empty, hightlight them.
           document.getElementsByName(names[i])[0].classList.add("highlight");
    //when empty, do not submit
           submit=false;
        }
    }
       
           
    //All filled? submit!
    if(submit){
    document.forms[0].submit();
    }
    else{
      alert("Some Fields are Empty");  
    }
       
   }
}
window.onload = toValidSI;