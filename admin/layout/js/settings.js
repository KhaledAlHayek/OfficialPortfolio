const pageHeaderMenu = document.querySelector(".todo .menu"); 
const dropDownMenu = document.querySelector(".todo .menu .others-drop-down");

pageHeaderMenu.addEventListener("mouseover", e => {
  const targetEl = e.target.className;
  if(targetEl == "others-menu"){
    dropDownMenu.classList.add("show-menu");
  }
});

pageHeaderMenu.addEventListener("mouseleave", () => {
  dropDownMenu.classList.remove("show-menu");
});