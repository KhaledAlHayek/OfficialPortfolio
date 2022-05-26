const SHOWSCROLLTOTOPAT = 400;
const ANIMATEBEFOREREACH = 300;
const whyChooseBox = document.querySelectorAll(".intro-text .why-choose-me .choose-box");
whyChooseBox.forEach(box => {
  const showBodyBox = box.querySelector(".choose-head");
  showBodyBox.addEventListener("click", () => {
    showBodyBox.classList.toggle("target-el");
    if(showBodyBox.classList.contains("target-el")){
      box.classList.add("choosen-item");
    }
    else{
      box.classList.remove("choosen-item");
    }
  });
});

const menuLinks = Array.from(document.querySelectorAll(".header .menu-items ul li a"));
menuLinks.forEach(link => {
  link.addEventListener("click", e => {
    menuLinks.map(link => {
      link.classList.remove("active");
    })
    e.target.classList.add("active");
    const element = e.target.dataset.target;
    const offset = document.getElementById(element).offsetTop;
    scrollTo({top: offset, behavior: "smooth"});
  });
});


const scrollToTop = document.querySelector(".scroll-top");
scrollToTop.addEventListener("click", () => {
  scrollTo({top: 0, behavior: "smooth"});
});

const menu = document.querySelector(".header .menu");
const animateIntroSection = document.querySelector(".intro .intro-text");
const animateSpecialsSection = document.querySelector(".specials");
const animateRecentSection = document.querySelector(".my-work");
const animateExperienceSection = document.querySelector(".experience");
window.onscroll = () => {
  // show scroll to top icon
  if(window.scrollY >= SHOWSCROLLTOTOPAT){
    scrollToTop.classList.add("show-scroll-box")
  }
  else{
    scrollToTop.classList.remove("show-scroll-box")
  }

  // menu fixed
  if(window.scrollY >= SHOWSCROLLTOTOPAT){
    menu.classList.add("fixed-menu");
  }
  else{
    menu.classList.remove("fixed-menu");
  }
  // animate intro section
  if(window.scrollY >= document.getElementById("introduce").offsetTop - ANIMATEBEFOREREACH){
    animateIntroSection.classList.add("animate-items");
  }

  // animate special section
  if(window.scrollY >= document.getElementById("why-iam-special").offsetTop - ANIMATEBEFOREREACH){
    animateSpecialsSection.classList.add("animate-items");
  }

  // animate recent section
  if(window.scrollY >= document.getElementById("recent-work").offsetTop - ANIMATEBEFOREREACH){
    animateRecentSection.classList.add("animate-items");
  }

  // animate experience section
  if(window.scrollY >= document.getElementById("my-experience").offsetTop - ANIMATEBEFOREREACH){
    animateExperienceSection.classList.add("animate-items");
  }
}

// gallery slider
let current = 1;
const slides = Array.from(document.querySelectorAll(".header .header-content .gallery-slider"));
const previuosSlide = document.querySelector(".header .header-content .previous");
const nextSlide = document.querySelector(".header .header-content .next");

changeImage();
function changeImage() {
  slides.forEach(slide => {
    slide.classList.remove("active");
  });
  slides[current - 1].classList.add("active");
  if(current == 1){
    previuosSlide.classList.add("disabled");
  }
  else{
    previuosSlide.classList.remove("disabled");
  }

  if(current == slides.length){
    nextSlide.classList.add("disabled");
  }
  else{
    nextSlide.classList.remove("disabled");
  }
}

function previous() {
  if(previuosSlide.classList.contains("disabled")){
    return false;
  }
  else{
    current--;
    console.log(current);
    changeImage();
  }
}
function next() {
  if(nextSlide.classList.contains("disabled")){
    return false;
  }
  else{
    current++;
    console.log(current);
    changeImage();
  }
}

previuosSlide.onclick = previous;
nextSlide.onclick = next;

const headerContents = document.querySelector(".header");
const showNav = document.querySelector(".bars");
const theMenu = document.querySelector(".header .menu .menu-items");
showNav.addEventListener("click", () => {
  theMenu.classList.add("show-menu");
  headerContents.classList.remove("header-content-above");
})
const collapseNav = document.querySelector(".collapse-menu");
collapseNav.addEventListener("click", () => {
  theMenu.classList.remove("show-menu");
  headerContents.classList.add("header-content-above");
});

// rate
const theRateBox = document.querySelector(".rate");
if(theRateBox){
  const closeRatePopup = document.querySelector(".close-rate-popup");
  const ratePopup = document.querySelector(".rate");

  closeRatePopup.addEventListener("click", () => {
    ratePopup.classList.add("dont-show-again");
  });
  const rateNumber = Array.from(document.querySelectorAll(".rate .rate-site-box .range-number .range-line .number span"));
  rateNumber.forEach(number => {
    number.addEventListener("click", e => {
      rateNumber.map(num => {
        num.parentElement.classList.remove("active");
      });
      e.target.parentElement.classList.add("active");
      let ratingNumber = document.querySelector(".rate .rate-site-box .submit .rating-number");
      let number = e.target.innerHTML;
      ratingNumber.value = number;
    });  
  });

  const rateBox = document.querySelector(".rate .rate-site-box");
  const showRateBox = document.querySelector(".rate .rate-now");
  const hideRateBox = document.querySelector(".rate .hide-msg");
  showRateBox.addEventListener("click", () => {
    showRateBox.classList.toggle("show-hide-box");
    let rateText = showRateBox.firstElementChild;
    if(showRateBox.classList.contains("show-hide-box")){
      rateText.innerHTML = "Hide Box";
      rateBox.style.display = "block";
    }
    else{
      rateText.innerHTML = "Rate Now";
      rateBox.style.display = "none";
    }
  });

  setTimeout(() => {
    theRateBox.classList.remove("dont-show-again");
  }, 60000);

  hideRateBox.addEventListener("click", () => {
    theRateBox.classList.add("dont-show-again");
  });
}

const viewDetails = document.querySelectorAll(".experience .experience-box");
viewDetails.forEach(box => {
  box.addEventListener("click", e => {
    const detailsBox = box.querySelector(".view-details");
    if(e.target.dataset.showbox == "view-more"){
      detailsBox.style.display = "block";
    }
    if(e.target.dataset.closebox == "close-box"){
      detailsBox.style.display = "none";
    }
  })
})