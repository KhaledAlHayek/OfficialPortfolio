const searchIcon=document.querySelector(".edit-manager .search-icon"),searchInput=document.querySelector(".edit-manager .search-for-edit"),closeSearch=document.querySelector(".edit-manager .search-input .close-search");searchIcon.addEventListener("click",()=>{searchInput.classList.add("show-search-bar")}),closeSearch.addEventListener("click",()=>{searchInput.classList.remove("show-search-bar")});const searchManager=document.querySelector(".edit-manager .search-input input"),theManagers=document.querySelectorAll(".edit-manager .total-found .the-manager");searchManager.addEventListener("keyup",e=>{let t=e.target.value.trim().toLowerCase();theManagers.forEach(e=>{-1!=e.querySelector(".fullname span").textContent.toLowerCase().indexOf(t)?e.style.display="block":e.style.display="none"})});const inputs=document.querySelectorAll(".edit-custom-user .body .input input");Array.from(inputs).map(e=>{const t=e.previousElementSibling;e.addEventListener("focus",()=>{t.classList.add("above-input")}),e.addEventListener("blur",()=>{e.value.length>0?console.log("have words or length "):t.classList.remove("above-input")})});const sumbitEditChangesButton=document.querySelector(".edit-custom-user .body form .submit .submit-form"),editFullnameInput=document.querySelector(".edit-fullname"),fullnameError=document.querySelector(".fullname-field .input-label .input-error"),inputAnimation=document.querySelector(".fullname-field .animate-on-focus");editFullnameInput.addEventListener("keyup",e=>{let t=e.target.value,s=/[a-zA-Z]{3,}\s[a-zA-Z]{3,}\s[a-zA-Z]{3,}/gi;t.length>0?(console.log(t.length),t.match(s)?(inputAnimation.style.backgroundColor="#007ae5",fullnameError.style.display="none",sumbitEditChangesButton.classList.remove("disabled")):(fullnameError.style.display="block",inputAnimation.style.backgroundColor="#f44336",sumbitEditChangesButton.classList.add("disabled"))):(inputAnimation.style.backgroundColor="#007ae5",fullnameError.style.display="none",sumbitEditChangesButton.classList.remove("disabled"))});const editEmailInput=document.querySelector(".edit-email"),emailError=document.querySelector(".email-field .input-label .input-error"),emailAnimation=document.querySelector(".email-field .animate-on-focus");editEmailInput.addEventListener("keyup",e=>{let t=e.target.value,s=/\w+@\w+.(com|org|net|edu)/gi;t.length>0?t.match(s)?(emailError.style.display="none",emailAnimation.style.backgroundColor="#007ae5",sumbitEditChangesButton.classList.remove("disabled")):(emailError.style.display="block",emailAnimation.style.backgroundColor="#f44336",sumbitEditChangesButton.classList.add("disabled")):(sumbitEditChangesButton.classList.remove("disabled"),emailError.style.display="none",emailAnimation.style.backgroundColor="#007ae5")});const editPasswordInput=document.querySelector(".edit-password"),passwordError=document.querySelector(".password-field .input-label .input-error"),passwordAnimation=document.querySelector(".password-field .animate-on-focus");editPasswordInput.addEventListener("keyup",e=>{let t=e.target.value,s=/\w+\W+\s?/gi;t.length>0?t.match(s)?(passwordError.style.display="none",passwordAnimation.style.backgroundColor="#007ae5",sumbitEditChangesButton.classList.remove("disabled")):(passwordError.style.display="block",passwordAnimation.style.backgroundColor="#f44336",sumbitEditChangesButton.classList.add("disabled")):(passwordError.style.display="none",passwordAnimation.style.backgroundColor="#007ae5",sumbitEditChangesButton.classList.remove("disabled"))});const showHideIcon=document.querySelector(".password-field .show-hide");showHideIcon.addEventListener("click",()=>{showHideIcon.classList.toggle("eye");const e=showHideIcon.firstElementChild;showHideIcon.classList.contains("eye")?(editPasswordInput.setAttribute("type","password"),e.className="",e.classList.add("fas","fa-eye")):(editPasswordInput.setAttribute("type","text"),e.className="",e.classList.add("fas","fa-eye-slash"))});const editCustomManager=document.querySelector(".edit-custom-user"),closeEditCustomManager=document.querySelector(".edit-custom-user .head .close");closeEditCustomManager.addEventListener("click",()=>{editCustomManager.classList.remove("show-for-edit")});