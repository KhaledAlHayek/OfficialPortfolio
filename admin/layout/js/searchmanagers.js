const searchInput = document.querySelector(".advanced-search .upper-search .filter");
const managersBox = document.querySelectorAll(".advanced-search .relevant-search .manager-action");
const suggestions = document.querySelector(".advanced-search .relevant-search");
searchInput.addEventListener("keyup", e => {
  let value = e.target.value.trim().toLowerCase();
  suggestions.style.display = "block";
  managersBox.forEach(manager => {
    let term = manager.querySelector(".name .manager-fullname").textContent;
    if(term.toLowerCase().indexOf(value) != -1){
      manager.style.display = "block";
    }
    else{
      manager.style.display = "none";
    }
  });
});