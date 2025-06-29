let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .nav');
let openBtn = document.querySelector("#open-btn");
let myForm = document.querySelector("#myForm");

menu.onclick = () => {
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
};

window.onscroll = () => {
  menu.classList.remove('fa-times');
  navbar.classList.remove('active');

  if (window.scrollY > 0) {
    document.querySelector('.header').classList.add('active');
  } else {
    document.querySelector('.header').classList.remove('active');
  }
};

if (openBtn && myForm) {
  openBtn.onclick = () => {
    myForm.style.display = "block";
  };
}

function closePopup() {
  if (myForm) {
    myForm.style.display = "none";
  }
}
