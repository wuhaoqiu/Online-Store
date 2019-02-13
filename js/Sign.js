
function toValidSI(){
    
    
    var names=["username","email", "mailing_address", "security_question","answer", "password","passwordB"];
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
   document.getElementsByName(names[5])[0].onkeydown=function(e){
       document.getElementsByName(names[5])[0].classList.remove("highlight");
   }
   document.getElementsByName(names[6])[0].onkeydown=function(e){
       document.getElementsByName(names[6])[0].classList.remove("highlight");
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
       //check if the email format is correct. 
       var email = document.getElementsByName(names[1])[0].value;
       //invalid conditions: 为什么string.contains用不了。。。。所以只做了长度限制
        if(email.length<10 && email!=""){
           submit=false;
            document.getElementsByName(names
                                      [1])[0].classList.add("highlight");
           }
       
       //check if the two passwords are the same.
       var PA = document.getElementsByName("password")[0].value;
       
       var PB = document.getElementsByName("passwordB")[0].value;
       
       if(PA!=PB && (PA!=""||PB !="")){
           submit=false;
           
           document.getElementsByName("password")[0].classList.add("highlight");
           
           document.getElementsByName("passwordB")[0].classList.add("highlight");   
       }
           
    //All filled? submit!
    if(submit){
    document.forms[0].submit();
    }
    else{
      alert("The red marked blanks are incorrect!");  
    }
       
   }
}
window.onload = toValidSI;