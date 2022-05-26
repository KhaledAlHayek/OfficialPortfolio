let profile = document.querySelectorAll(".mouse-event");
let header = document.querySelector(".header");
profile.forEach(el => {
  el.addEventListener("mousedown", e => {
    e.currentTarget.classList.add("mouse-down");
    e.currentTarget.classList.remove("mouse-leave");
  })
  el.addEventListener("mouseup", e => {
    e.currentTarget.classList.add("mouse-up");
    e.currentTarget.classList.remove("mouse-leave");
  })
  el.addEventListener("mouseleave", e => {
    e.currentTarget.classList.remove("mouse-down");
    e.currentTarget.classList.remove("mouse-up");
    e.currentTarget.classList.add("mouse-leave");
  })
});
header.onclick = removeBorders;

function removeBorders() {
  profile.forEach(el => {
    el.classList.remove("mouse-leave");
  })
}

let sideBarMenuItems = document.querySelectorAll(".admin-menu ul li a");
let sideBarSubMenus = document.querySelectorAll(".admin-menu ul .sub-menu");
sideBarMenuItems.forEach(li => {
  li.addEventListener("click", function(e) {
    sideBarMenuItems.forEach(li => {
      li.classList.remove("active")
    })
    e.currentTarget.classList.toggle("active");
    let currentElementSubMenu = e.currentTarget.parentElement.nextElementSibling;
    sideBarSubMenus.forEach(menu => {
      menu.classList.remove("show-sub-menu");
    })
    currentElementSubMenu.classList.add("show-sub-menu");
  })
})

let sideBar = document.querySelector(".content .side-bar");
sideBar.onclick = removeActiveFromLinksAndBorders;
sideBarMenuItems.forEach(li => {
  li.addEventListener("click", e => {
    e.stopPropagation();
  })
})

function removeActiveFromLinksAndBorders() {
  sideBarMenuItems.forEach(item => {
    item.classList.remove("active");
    item.classList.remove("mouse-leave");
  })
  sideBarSubMenus.forEach(menu => {
    menu.classList.remove("show-sub-menu");
  })
}
document.addEventListener("click", removeContextMenu)
function removeContextMenu() {
  let contextMenu = document.querySelectorAll(".context-menu");
  contextMenu.forEach(menu => {
    menu.style.display = "none";
  })
}
document.addEventListener("contextmenu", e => {
  e.preventDefault();
  let left = e.clientX > 1000 ? 1060 : e.clientX;
  let top = e.clientY;
  let mainDiv =  document.createElement("div");
  mainDiv.className = "context-menu";
  let contextMenuUl = document.createElement("ul");
  for(let i = 0; i < 3; i++){
    // LI
    let contextMenuLi = document.createElement("li");

    // a
    let contextMenuLink = document.createElement("a");
    contextMenuLink.className = "the-link mouse-event";
    contextMenuLink.setAttribute("href", "#");

    // Appending Link Content To The <a></a> Element
    let linkIcon = document.createElement("i");
    let linkText = document.createElement("div");
    contextMenuLink.appendChild(linkIcon);
    contextMenuLink.appendChild(linkText);

    linkIcon.className = "fas fa-arrow-alt-circle-right";
    linkText.className = "text";

    let newText = document.createElement("span");
    if(i == 0){
      newText.textContent = "New Experience";
    }
    else if(i == 1){
      newText.textContent = "New Education";
    }
    else if(i == 2){
      newText.textContent = "New Skill";
    }
    let newIcon = document.createElement("i");
    newIcon.className = "fas fa-plus";
    linkText.appendChild(newIcon);
    linkText.appendChild(newText);

    // Appending The Elements To The Ul
    contextMenuUl.appendChild(contextMenuLi);
    contextMenuLi.appendChild(contextMenuLink);

    // Appending <a></a> To The <li></li>
    contextMenuLink.appendChild(linkIcon);
  }
  // Appending Ul To The Main Div
  mainDiv.appendChild(contextMenuUl);
  // Styling The Div
  mainDiv.style.position = "fixed";
  mainDiv.style.left = `${left}px`;
  mainDiv.style.top = `${top}px`;
  mainDiv.style.width = "280px";
  mainDiv.style.padding = "10px 0";
  mainDiv.style.backgroundColor = "#fff";
  mainDiv.style.zIndex = "20";
  mainDiv.style.borderRadius = "4px";
  mainDiv.style.border = "1px solid #e8e8e8";
  mainDiv.style.boxShadow = "1px 5px 5px 2px #bebebe";
  document.body.appendChild(mainDiv);
})

let featuresBox = document.querySelectorAll(".customize-item .en-ds");
featuresBox.forEach(box => {
  let activateFeature = Array.from(box.children);
  activateFeature.forEach(item => {
    item.addEventListener("click", e => {
      activateFeature.forEach(item => {
        item.classList.remove("active");
      })
      e.currentTarget.classList.add("active");
      if(e.currentTarget.parentElement.classList.contains("header-fixed")){
        let theAction = e.currentTarget.dataset.action;
        let theTargetBox = document.querySelector(`.${e.currentTarget.dataset.target}`);
        let theContentDiv = document.querySelector(".content");
        if(theAction == "enable"){
          theTargetBox.classList.add("fixed");
          theContentDiv.classList.add("header-has-fixed-menu")
          if(theTargetBox.classList.contains("fixed") && theContentDiv.classList.contains("fixed-menu")){
            theContentDiv.classList.add("adjust-padding");
          }
        }
        else{
          theTargetBox.classList.remove("fixed");
          theContentDiv.classList.remove("header-has-fixed-menu")
          theContentDiv.classList.remove("adjust-padding");
        }
      }
      else if(e.currentTarget.parentElement.classList.contains("header-theme")){
        let theAction = e.currentTarget.dataset.action;
        let theTargetBox = document.querySelector(`.${e.currentTarget.getAttribute("data-target")}`);
        if(theAction == "enable"){
          theTargetBox.classList.add("dark-theme");
        }
        else{
          theTargetBox.classList.remove("dark-theme");
        }
      }
      else if(e.currentTarget.parentElement.classList.contains("side-bar-layout")){
        let theAction = e.currentTarget.getAttribute("data-action");
        let theTargetBox = document.querySelector(`.${e.currentTarget.getAttribute("data-target")}`);
        let tagertBoxParent = theTargetBox.parentElement;
        if(theAction == "enable"){
          tagertBoxParent.classList.add("fixed-menu");
          header.classList.add("content-has-fixed-menu");
          if(tagertBoxParent.classList.contains("fixed-menu") && header.classList.contains("fixed")){
            tagertBoxParent.classList.add("adjust-padding");
          }
        }
        else{
          tagertBoxParent.classList.remove("fixed-menu");
          header.classList.remove("content-has-fixed-menu");
          tagertBoxParent.classList.remove("adjust-padding");
        }
      }
      else if(e.currentTarget.parentElement.classList.contains("side-bar-theme")){
        let theAction = e.currentTarget.getAttribute("data-action");
        let theTargetBox = document.querySelector(`.${e.currentTarget.getAttribute("data-target")}`);
        if(theAction == "enable"){
          theTargetBox.classList.add("light-theme");
        }
        else{
          theTargetBox.classList.remove("light-theme");
        }
      }
      else if(e.currentTarget.parentElement.classList.contains("footer-layout")){
        let theAction = e.currentTarget.getAttribute("data-action");
        let theTargetBox = document.querySelector(`.${e.currentTarget.getAttribute("data-target")}`);
        if(theAction == "enable"){
          theTargetBox.classList.add("fixed-footer")
        }
        else{
          theTargetBox.classList.remove("fixed-footer")
        }
      }
      else if(e.currentTarget.parentElement.classList.contains("footer-theme")){
        let theAction = e.currentTarget.getAttribute("data-action");
        let theTargetBox = document.querySelector(`.${e.currentTarget.getAttribute("data-target")}`);
        if(theAction == "enable"){
          theTargetBox.classList.add("dark-theme")
        }
        else{
          theTargetBox.classList.remove("dark-theme")
        }
      }
    });
  })
})

let showCustomizeMenu = document.querySelectorAll(".customize");
let menus = document.querySelectorAll(".header .current-menu");
showCustomizeMenu.forEach(menu => {
  menu.addEventListener("click", e => {
    menus.forEach(item => {
      item.style.display = "none";
    })
    e.currentTarget.classList.toggle("active");
    let currentBox = e.currentTarget.dataset.show;
    if(e.currentTarget.classList.contains("active")){
      document.querySelector(`.${currentBox}`).style.display = "block";
    }
    else{
      document.querySelector(`.${currentBox}`).style.display = "none";
    }
  })
});

let labelForInputs = document.querySelectorAll(".to-do-list .to-do-text label");
let preventClickingInput = document.querySelectorAll(".to-do-list .to-do-text input[type='text']");
preventClickingInput.forEach(input => {
  input.addEventListener("click", e => {
    e.stopPropagation();
  })
})
labelForInputs.forEach(label => {
  label.addEventListener("click", e => {
    e.stopPropagation();
    let inputElement = e.currentTarget.parentElement.children[1];
    if(!label.classList.contains("completed")){
      inputElement.style.display = "block";
      label.style.display = "none";
    }
  })
})
let showLabel = document.querySelectorAll(".to-do");
showLabel.forEach(box => {
  box.addEventListener("click", e => {
    let theInput = e.currentTarget.children[2].children[1];
    let theLabel = e.currentTarget.children[2].children[2];
    theInput.style.display = "none";
    theLabel.style.display = "block";
  });
})
// completed
let taskCompleted = document.querySelectorAll(".to-do-list .to-do-text input[type='checkbox']");
taskCompleted.forEach(input => {
  input.addEventListener("click", e => {
    input.classList.toggle("checked");
    let labelElement = e.currentTarget.parentElement.children[2];
    if(input.classList.contains("checked")){
      labelElement.classList.add("completed");
    }
    else{
      labelElement.classList.remove("completed");
    }
  });
});

let collapseSideBar = document.querySelector(".toggle-menu");
collapseSideBar.onclick = collpaseMenu;

function collpaseMenu() {
  let sideBar = document.querySelector(".content .side-bar")
  this.classList.toggle("active")
  if(this.classList.contains("active")){
    sideBar.classList.add("collapsed");
  }
  else{
    sideBar.classList.remove("collapsed");
  }
}

// let expandSideBarOnHover = document.querySelector(".content .side-bar")
// expandSideBarOnHover.addEventListener("mouseover", () => {
//   if(expandSideBarOnHover.classList.contains("collapsed")){
//     expandSideBarOnHover.classList.remove("collapsed");
//   }
// });

const filterSkills = document.querySelector(".dashboard .my-skills");
const skillsBox = document.querySelector(".dashboard .my-skills .body");
const skillsButton = document.querySelectorAll(".dashboard .my-skills .head ul li");
filterSkills.addEventListener("click", e => {
  skillsButton.forEach(btn => {
    btn.classList.remove("active");
  });
  e.target.classList.add("active");
  let term = e.target.dataset.filter;
  let backSkills = skillsBox.querySelectorAll(".backend");
  let frontSkills = skillsBox.querySelectorAll(".frontend");
  if(term == "all"){
    backSkills.forEach(skill => skill.style.display = "block");
    frontSkills.forEach(skill => skill.style.display = "block");
  }
  if(term == "frontend"){
    backSkills.forEach(skill => skill.style.display = "none");
    frontSkills.forEach(skill => skill.style.display = "block");
  }
  if(term == "backend"){
    frontSkills.forEach(skill => skill.style.display = "none");
    backSkills.forEach(skill => skill.style.display = "block");
  }
});