/*----- show menu -----*/ 
const navMenu = document.getElementById('nav_menu'),
      navToggle = document.getElementById('nav-toggle'),
      navClose = document.getElementById('nav-close')

/*----- menu show ------*/
/* ------ (validate if consistant exists) --------*/
if(navToggle) {
  navToggle.addEventListener("click", () => {
    navMenu.classList.add('show-menu')
  })
}

/*----- menu hidden ------*/
/* ------ (validate if consistant exists) --------*/
if(navClose) {
  navClose.addEventListener("click", () => {
    navMenu.classList.remove('show-menu')
  })
}

/*----- home swiper -----*/
var homeSwiper = new Swiper(".home-swiper", {
    spaceBetween: 30,
    loop: 'true',

    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  }); 

/*---- change background header -----*/
function scrollHeader() {
    const header =document.getElementById('header')

    if(this.scrollY >= 50) 
      header.classList.add('scroll-header'); 
    else 
      header.classList.remove('scroll-header')
}    
  window.addEventListener('scroll', scrollHeader)


/*----- new swiper -----*/
var newSwiper = new Swiper(".new-swiper", {
  spaceBetween: 10,
  /*centeredSlides: true,*/
  slidesPerView: "auto",
  loop: 'true',
});

/*---- show scroll up----*/
function scrollUp() {
  const scrollUp = document.getElementById('scroll-up');

  if(this.scrollY >= 350) 
    scrollUp.classList.add('show-scroll'); 
  else 
  scrollUp.classList.remove('show-scroll')
}
 window.addEventListener('scroll', scrollUp)

/*----- style switcher -----*/
const styleSwitcherToggle = document.querySelector(".style__switcher-toggler");
styleSwitcherToggle.addEventListener("click", () => {
  document.querySelector(".style__switcher").classList.toggle("open"); 
})

/*----- hide style switcher on scroll-----*/
window.addEventListener("scroll", () => {
  if(document.querySelector(".style__switcher").classList.contains("open")) {
    document.querySelector(".style__switcher").classList.remove("open");
  }
})

/*------ theme color ----*/
function themeColors() {
  const colorStyle = document.querySelector(".js-color-style"),
    themeColorsContainer = document.querySelector(".js-theme-colors");

    themeColorsContainer.addEventListener("click", ({target}) => {
      if(target.classList.contains("js-theme-color-item")) {
      localStorage.setItem("color", target.getAttribute("data-js-theme-color"));
      setColors();
    }
    })

    function setColors() {
    let path = colorStyle.getAttribute("href").split("/");
    path = path.slice(0, path.length -1);
    colorStyle.setAttribute("href", path.join("/") + "/" + localStorage.getItem("color") + ".css");

    if(document.querySelector(".js-theme-color-item.active")) {
      document.querySelector(".js-theme-color-item.active").classList.remove("active");
    }
  
    document.querySelector("[data-js-theme-color=" + localStorage.getItem("color") + "]").classList.add("active");
  }

  if(localStorage.getItem("color") !== null) {
    setColors();
  }
  else {
    const defultColor = colorStyle.getAttribute("href").split("/").pop().split(".").shift();
    document.querySelector("[data-js-theme-color" + defultColor + "]").classList.add("active");
  }

}

themeColors();

/*---------------account ---------*/
const tabs = document.querySelectorAll('[data-target]'),
    tabContents = document.querySelectorAll('[content]');

tabs.forEach((tab) => {
    tab.addEventListener('click', () => {
        const target =document.querySelector(tab.dataset.target);

        tabContents.forEach((tabContent) => {
            tabContent.classList.remove('active__tab');
        });

        target.classList.add('active__tab');

        tabs.forEach((tab) => {
            tab.classList.remove('active__tab');
        });

        tab.classList.add('active__tab');
    });

});

/*--------------- show message ---------*/
// Select the message element
const message = document.querySelector('.message');

// Function to remove the message after a certain duration
const removeMessage = () => {
    message.style.display = 'none';
};

// Set a timeout to remove the message after 5 seconds (5000 milliseconds)
setTimeout(removeMessage, 5000);

// Select the message element
const message__error = document.querySelector('.message__error');

// Function to remove the message after a certain duration
const remove_errorMessage = () => {
  message__error.style.display = 'none';
};

// Set a timeout to remove the message after 5 seconds (5000 milliseconds)
setTimeout(remove_errorMessage, 5000);