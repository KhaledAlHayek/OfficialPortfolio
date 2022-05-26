const password = document.querySelectorAll(".settings .setting .change-name form .password-field input");
const showHidePassword = document.querySelector(".settings .setting .change-name form .show-password input");
const showHideLabel = document.querySelector(".settings .setting .change-name form .show-password label");

showHidePassword.addEventListener("change", e => {
  if(showHidePassword.checked){
    password.forEach(input => {
      input.setAttribute("type", "text");
    });
    showHideLabel.innerHTML = "Hide Password";
  }
  else{
    password.forEach(input => {
      input.setAttribute("type", "password");
    });
    showHideLabel.innerHTML = "Show Password";
  }
});