function show_hide()
{
   var etat=document.getElementById("3");
   var txt=document.getElementById("choice");
   if(etat.checked)
   {
        txt.style.display="block";
   }
   else  
   {
       txt.style.display="none";
       etat.checked=false;
       for(var i=5;i<=7;i++)
       {
          document.getElementById(i).checked=false;
       }
       
   }
}
function checking(id,d,f)
{
   for(var i=d;i<=f;i++)
   {
        document.getElementById(i).checked=false;
   }
   document.getElementById(id).checked=true;
}
function myFunction() {
   var x = document.getElementById('password2');
   if (x.type === "password") {
     x.type = "text";
   } else {
     x.type = "password";
   }
 }