let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .nav');
let obutton=document.querySelector("#open-btn");
let pform=document.querySelector("#myForm");
let cbutton=document.querySelector("#cancel-btn");
menu.onclick = () =>{
   menu.classList.toggle('fa-times');
   navbar.classList.toggle('active');
};

window.onscroll = () =>{
   menu.classList.remove('fa-times');
   navbar.classList.remove('active');

   if(window.scrollY > 0){
      document.querySelector('.header').classList.add('active');
   }else{
      document.querySelector('.header').classList.remove('active');
   }
}
 
function openPopup() {
   pform.style.display = "block";
 }
 
 // Close popup function
 function closePopup() {
   pform.style.display = "none";
 } 
