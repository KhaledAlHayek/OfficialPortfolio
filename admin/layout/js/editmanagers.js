// show search bar on icon click
const searchIcon = document.querySelector(".edit-manager .search-icon");
const searchInput = document.querySelector(".edit-manager .search-for-edit");
const closeSearch = document.querySelector(".edit-manager .search-input .close-search");

searchIcon.addEventListener("click", () => {
  searchInput.classList.add("show-search-bar");
});
closeSearch.addEventListener("click", () => {
  searchInput.classList.remove("show-search-bar");
})

// filter managers
const searchManager = document.querySelector(".edit-manager .search-input input");
const theManagers = document.querySelectorAll(".edit-manager .total-found .the-manager");
searchManager.addEventListener("keyup", e => {
  let value = e.target.value.trim().toLowerCase();
  theManagers.forEach(manager => {
    let term = manager.querySelector(".fullname span").textContent;
    if(term.toLowerCase().indexOf(value) != -1){
      manager.style.display = "block";
    }
    else{
      manager.style.display = "none";
    }
  });
});

// edit manager inforamtion input focus
const inputs = document.querySelectorAll(".edit-custom-user .body .input input");
Array.from(inputs).map(input => {
  const moveOldData = input.previousElementSibling;
  input.addEventListener("focus", () => {
    moveOldData.classList.add("above-input");
  });
  input.addEventListener("blur", () => {
    if(input.value.length > 0){
      console.log("have words or length ");
    }
    else{
      moveOldData.classList.remove("above-input");
    }
  });
});

// validate editing manager fullname
const sumbitEditChangesButton = document.querySelector(".edit-custom-user .body form .submit .submit-form");
const editFullnameInput = document.querySelector(".edit-fullname");
const fullnameError = document.querySelector(".fullname-field .input-label .input-error");
const inputAnimation = document.querySelector(".fullname-field .animate-on-focus");
editFullnameInput.addEventListener("keyup", e => {
  let value = e.target.value;
  let fullnameRegex = /[a-zA-Z]{3,}\s[a-zA-Z]{3,}\s[a-zA-Z]{3,}/ig;
  if(value.length > 0){
    console.log(value.length);
    if(!value.match(fullnameRegex)){
      fullnameError.style.display = "block";
      inputAnimation.style.backgroundColor = "#f44336";
      sumbitEditChangesButton.classList.add("disabled");
    }
    else{
      inputAnimation.style.backgroundColor = "#007ae5";
      fullnameError.style.display = "none";
      sumbitEditChangesButton.classList.remove("disabled");
    }
  }
  else{
    inputAnimation.style.backgroundColor = "#007ae5";
    fullnameError.style.display = "none";
    sumbitEditChangesButton.classList.remove("disabled");
  }
});

// validate editing manager email
const editEmailInput = document.querySelector(".edit-email");
const emailError = document.querySelector(".email-field .input-label .input-error");
const emailAnimation = document.querySelector(".email-field .animate-on-focus");
editEmailInput.addEventListener("keyup", e => {
  let value = e.target.value;
  let emailRegex = /\w+@\w+.(com|org|net|edu)/ig;
  if(value.length > 0){
    if(!value.match(emailRegex)){
      emailError.style.display = "block";
      emailAnimation.style.backgroundColor = "#f44336";
      sumbitEditChangesButton.classList.add("disabled");
    }
    else{
      emailError.style.display = "none";
      emailAnimation.style.backgroundColor = "#007ae5";
      sumbitEditChangesButton.classList.remove("disabled");
    }
  }
  else{
    sumbitEditChangesButton.classList.remove("disabled");
    emailError.style.display = "none";
    emailAnimation.style.backgroundColor = "#007ae5";
  }
  
});

// validate editing manager password
const editPasswordInput = document.querySelector(".edit-password");
const passwordError = document.querySelector(".password-field .input-label .input-error");
const passwordAnimation = document.querySelector(".password-field .animate-on-focus");
editPasswordInput.addEventListener("keyup", e => {
  let value = e.target.value;
  let passwordRegex = /\w+\W+\s?/ig;
  if(value.length > 0){
    if(!value.match(passwordRegex)){
      passwordError.style.display = "block";
      passwordAnimation.style.backgroundColor = "#f44336";
      sumbitEditChangesButton.classList.add("disabled");
    }
    else{
      passwordError.style.display = "none";
      passwordAnimation.style.backgroundColor = "#007ae5";
      sumbitEditChangesButton.classList.remove("disabled"); 
    }
  }
  else{
    passwordError.style.display = "none";
    passwordAnimation.style.backgroundColor = "#007ae5";
    sumbitEditChangesButton.classList.remove("disabled"); 
  }
});

// show hide pass on edit manager page
const showHideIcon = document.querySelector(".password-field .show-hide");
showHideIcon.addEventListener("click", () => {
  showHideIcon.classList.toggle("eye");
  const eyeIcon = showHideIcon.firstElementChild;
  if(showHideIcon.classList.contains("eye")){
    editPasswordInput.setAttribute("type", "password");
    eyeIcon.className = "";
    eyeIcon.classList.add("fas", "fa-eye");
  }
  else{
    editPasswordInput.setAttribute("type", "text");
    eyeIcon.className = "";
    eyeIcon.classList.add("fas", "fa-eye-slash");
  }
});

const editCustomManager = document.querySelector(".edit-custom-user");
const closeEditCustomManager = document.querySelector(".edit-custom-user .head .close");
closeEditCustomManager.addEventListener("click", () => {
  editCustomManager.classList.remove("show-for-edit");
})