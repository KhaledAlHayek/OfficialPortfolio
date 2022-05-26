// filter managers
const search = document.querySelector(".delete-manager .search form input");
const managers = document.querySelectorAll(".managers .table .body .data");
search.addEventListener("keyup", e => {
  let value = e.target.value.toLowerCase();
  managers.forEach(manager => {
    let term = manager.querySelector(".manager-fullname").textContent;
    if(term.toLowerCase().indexOf(value) != -1){
      manager.style.display = "block";
    }
    else{
      // Array.slice(start,end) => return a copied array from start till end -1
      // if end not passed, return from start till the end of the array.
      manager.style.display = "none";
    }
  })
});

// copy password to clipboard
let sourceBox = document.querySelectorAll(".data .others .password");
sourceBox.forEach(box => {
  box.addEventListener("click", e => {
    const managerPassword = box.querySelector(".manager-password").textContent;
    const copyBox = box.querySelector(".copy .copy-msg");
    navigator.clipboard.writeText(managerPassword);
    copyBox.innerHTML = "Copied <i class='fas fa-check'></i>";
  });
});

// delete all managers
const selectAllManagers = document.querySelector(".delete-manager .select-all-managers");
const allManagersCheckbox = document.querySelectorAll(".managers .data .manager-checkbox");
const deleteAllManagers = document.querySelector(".total-mangers .delete-all"); 
selectAllManagers.addEventListener("change", () => {
  if(selectAllManagers.checked){
    allManagersCheckbox.forEach(checkbox => {
      deleteAllManagers.classList.add("attention");
      deleteAllManagers.classList.add("show");
      setTimeout(() => {
        deleteAllManagers.classList.remove("attention");
      }, 1000);
      checkbox.checked = true;
    });
  }
  else{
    deleteAllManagers.classList.remove("attention");
    deleteAllManagers.classList.remove("show");
    Array.from(allManagersCheckbox).map(checkbox => checkbox.checked = false);
  }
});

// disable select all managers checkbox if there is no manager found
// document.addEventListener("DOMContentLoaded", () => {
//   const totalManagers = Array.from(managers).length
//   if(totalManagers == 0){
//     selectAllManagers.classList.add("disabled");
//   }
// });

// show manager other information at small devices media
const managerOtherInfo = document.querySelectorAll(".delete-manager .managers .table .other-data .data-title");
Array.from(managerOtherInfo).map(info => {
  info.addEventListener("click", e => {
    info.classList.toggle("show-other-info");
    const targetBox = info.nextElementSibling;
    if(info.classList.contains("show-other-info")){
      targetBox.style.display = "block";
    }
    else{
      targetBox.style.display = "none";
    }
  });
});

const assets = document.querySelector(".delete-manager .assets");
window.onscroll = () => {
  if(window.scrollY > 270){
    assets.classList.add("fixed");
  }
  else{
    assets.classList.remove("fixed");
  }
};