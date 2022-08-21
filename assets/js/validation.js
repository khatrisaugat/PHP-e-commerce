// var email=document.querySelector(".email_val");
// var username=document.querySelector(".username_val");
// var password=document.querySelector(".password_val");
// var confirm_password=document.querySelector(".confirm_password_val");
// var phone=document.querySelector(".phone_val");
// var address=document.querySelector(".address_val");
// var city=document.querySelector(".city_val");
// var text=document.querySelector(".text_val");
// var error=document.querySelector(".error");
// var errorBool=false;
// email.addEventListener("focusout",function(e){
//     if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)){
//         email.style.border="1px solid red";
//         error.innerHTML="Please enter a valid email";
//         errorBool=true;
//     }
// });
// username.addEventListener("focusout",function(e){
//     if(username.value.length<3){
//         username.style.border="1px solid red";
//         error.innerHTML="Please enter a valid username";
//         errorBool=true;
//     }
// });
// password.addEventListener("focusout",function(e){
//     if(password.value.length<6){
//         password.style.border="1px solid red";
//         error.innerHTML="Please enter a valid password";
//         errorBool=true;
//     }
// });
// confirm_password.addEventListener("focusout",function(e){
//     if(confirm_password.value!=password.value){
//         confirm_password.style.border="1px solid red";
//         error.innerHTML="Password does not match";
//         errorBool=true;
//     }
// });
// text.addEventListener("focusout",function(e){
//     if(/^[a-zA-Z ]*$/.test(text.value)==false){
//         text.style.border="1px solid red";
//         error.innerHTML="Please enter a valid text";
//         errorBool=true;
//     }
// });
// document.querySelector(".form").addEventListener("submit",function(e){
//     if(errorBool==true){
//         e.preventDefault();
//     }
// });
