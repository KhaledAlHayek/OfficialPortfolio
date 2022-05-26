const inputs = document.querySelectorAll(".admin-login .login form .input .has-placeholder");
const email = document.querySelector(".admin-login .login form .input .email");
const password = document.querySelector(".admin-login .login form .input .password");
const showHidePassword = document.querySelector(".admin-login .login form .input .show-hide")
const saveInfoLabel = document.querySelector(".admin-login .login form .save-info input");
const login = document.querySelector(".admin-login .login form .input .submit");

inputs.forEach(input => {
  input.addEventListener("input", e => {
    let length = e.target.value.length
    let placeholder = input.parentElement.querySelector(".placeholder");
    if(length > 0){
      placeholder.classList.add("above-input")
    }
    else{
      placeholder.classList.remove("above-input")
    }
  })
});

showHidePassword.addEventListener("click", () => {
  const password = showHidePassword.parentElement.querySelector("input")
  password.classList.toggle("show-hide");
  if(password.classList.contains("show-hide")){
    password.setAttribute("type", "text");
    showHidePassword.className = "";
    showHidePassword.classList.add("fas", "fa-eye-slash");
  }
  else{
    password.setAttribute("type", "password");
    showHidePassword.className = "";
    showHidePassword.classList.add("fas", "fa-eye");
  }
});

saveInfoLabel.addEventListener("change", () => {
  const label = saveInfoLabel.parentElement.querySelector("label");
  const defaultText = label.dataset.default;
  if(saveInfoLabel.checked){
    label.innerHTML = "Saved";
  }
  else{
    label.innerHTML = defaultText;
  }
})

email.addEventListener("keyup", e => {
  let value = e.target.value.trim().toLowerCase();
  const placeholder = e.target.nextElementSibling;
  const validate = /\w+@\w+.(com|org|net|edu)/ig;
  if(!value.match(validate)){
    email.classList.add("invalid");
    placeholder.classList.add("invalid");
    login.classList.add("disabled")
  }
  else{
    email.classList.remove("invalid");
    placeholder.classList.remove("invalid");
    login.classList.remove("disabled")
  }
})
password.addEventListener("keyup", e => {
  let value = e.target.value.trim().toLowerCase();
  const placeholder = e.target.nextElementSibling;
  const validate = /\w+\W+/ig;
  if(!value.match(validate)){
    password.classList.add("invalid");
    placeholder.classList.add("invalid");
    login.classList.add("disabled")
  }
  else{
    password.classList.remove("invalid");
    placeholder.classList.remove("invalid");
    login.classList.remove("disabled")
  }
})

window.onload = () => {
  inputs.forEach(input => {
    let inputValue = input.value.length;
    const placeholder = input.nextElementSibling;
    if(inputValue > 0){
      placeholder.classList.add("above-input");
    }
    else{
      placeholder.classList.remove("above-input");
    }
  });
}