const actionsMenu = document.querySelector(".batch-assets form .the-actions");
window.onscroll = function() {
  if(window.scrollY >= 266){
    actionsMenu.classList.add("fixed-menu");
  }
  else{
    actionsMenu.classList.remove("fixed-menu");
  }
};