const password=document.querySelectorAll(".settings .setting .change-name form .password-field input"),showHidePassword=document.querySelector(".settings .setting .change-name form .show-password input"),showHideLabel=document.querySelector(".settings .setting .change-name form .show-password label");showHidePassword.addEventListener("change",e=>{showHidePassword.checked?(password.forEach(e=>{e.setAttribute("type","text")}),showHideLabel.innerHTML="Hide Password"):(password.forEach(e=>{e.setAttribute("type","password")}),showHideLabel.innerHTML="Show Password")});