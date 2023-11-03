navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   profile.classList.remove('active');
}

function loader(){
   document.querySelector('.loader').style.display = 'none';
}

function fadeOut(){
   setInterval(loader, 2000);
}

window.onload = fadeOut;

document.querySelectorAll('input[type="number"]').forEach(numberInput => {
   numberInput.oninput = () =>{
      if(numberInput.value.length > numberInput.maxLength) numberInput.value = numberInput.value.slice(0, numberInput.maxLength);
   };
});


/**************/

var swiper = new Swiper(".home-slider", {
   autoplay:{
     delay:7500,
     disableOnInteraction:false,
   },
   grabCursor:true,
   loop: true,
   centeredSlides:true,
   navigation: {
     nextEl: '.swiper-button-next',
     prevEl: '.swiper-button-prev',
   },
 });
 
 
 var swiper = new Swiper(".menu-slider", {
   grabCursor:true,
   loop: true,
   autoHeight:true,
   centeredSlides:true,
   spaceBetwwen:20,
   pagination: {
     el: '.swiper-pagination',
     clickable:true,
   },
 });