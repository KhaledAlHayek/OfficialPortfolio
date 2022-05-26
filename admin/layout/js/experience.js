const expInputs = document.querySelectorAll(".setting .experience .exp .exp-input input");
const submitBtn = document.querySelector(".setting .experience .exp .submit .submit-btn");
const typeError = document.querySelector(".setting .experience .exp form .type-error");
const nameError = document.querySelector(".setting .experience .exp form .exp-name-error");
const placeError = document.querySelector(".setting .experience .exp form .place-error");
const submit = document.querySelector(".experience .experience-list .the-experience .panel-body .submit-info .input-info input");

// control inputs behavior
const controlInput = (arr, inputclass, placeholderclass) => {
  arr.forEach(input => {
    input.addEventListener("input", e => {
      let length = e.target.value.length;
      const placeholder = input.nextElementSibling;
      if(length > 0){
        placeholder.classList.add(placeholderclass);
        input.classList.add(inputclass);
      }
      else{
        placeholder.classList.remove(placeholderclass);
        input.classList.remove(inputclass);
      }
    });
  });
}

// validate input value
const validate = (el, errclass) => {
  
}

Array.from(expInputs).forEach(input => {
  input.addEventListener("input", e => {
    let length = e.target.value.length;
    const placeholder = input.nextElementSibling;
    if(length > 0){
      placeholder.classList.add("control");
      input.classList.add("has-value");
    }
    else{
      input.classList.remove("has-value");
      placeholder.classList.remove("control");
    }
  });
});

Array.from(expInputs).map(input => {
  input.addEventListener("keyup", e => {
    const invalidMessage = "Information is not valid. Please give it another try.";
    let value = e.target.value;
    let term = /[a-zA-Z]{6,}(\W+)?(\s+)?/ig;
    const relatedError = e.target.parentElement.nextElementSibling;
    if(!value.match(term)){
      input.classList.add("has-error");
      submitBtn.classList.add("disabled");
      relatedError.innerHTML = invalidMessage;
    }
    else{
      input.classList.remove("has-error");
      submitBtn.classList.remove("disabled");
      relatedError.innerHTML = "";
    }
  });
});

(function(){
  expInputs.forEach(input => {
    const placeholder = input.parentElement.querySelector("span");
    let length = input.value.length
    if(length > 0){
      placeholder.classList.add("control");
      input.classList.add("has-value");
    }
    else{
      input.classList.remove("has-value");
      placeholder.classList.remove("control");
    }
  });
})()

const editExperienceCheckbox = document.querySelectorAll(".experience .experience-list .the-experience .panel-head .checkbox-exp");
const experienceInfo = document.querySelectorAll(".experience .experience-list .the-experience");

editExperienceCheckbox.forEach(checkbox => {
  checkbox.addEventListener("change", e => {
    removeCheck();
    e.target.checked = true;
    const panelHead = e.target.closest(".the-experience");
    if(e.target.checked){
      Array.from(experienceInfo).map(box => {
        box.classList.remove("control-panels");
      })
      panelHead.classList.add("control-panels");
      console.log("checked");
    }
    else{
      console.log("not checked");
      panelHead.classList.remove("control-panels");
    }
  });
});

const removeCheck = () => {
  editExperienceCheckbox.forEach(checkbox => {
    checkbox.checked = false;
  });
}

const editExperienceInputs = document.querySelectorAll(".experience .experience-list .the-experience .panel-body .input-info .main-input");
controlInput(editExperienceInputs, "has-value", "control-placeholder");

(function(){
  editExperienceInputs.forEach(input => {
    const placeholder = input.parentElement.querySelector("span");
    let length = input.value.length
    if(length > 0){
      placeholder.classList.add("control-placeholder");
      input.classList.add("has-value");
    }
    else{
      input.classList.remove("has-value");
      placeholder.classList.remove("control-placeholder");
    }
  });
})()

// editExperienceInputs.forEach(input => {
//   input.addEventListener("keyup", e => {
//     let term = e.target.value.length;
//     const icon = e.target.parentElement.parentElement.firstElementChild.children[0];
//     if(term == 0){
//       e.target.classList.add("error");
//       icon.style.display = "inline";
//       submit.classList.add("disabled");
//     }
//     else{
//       e.target.classList.remove("error");
//       icon.style.display = "none";
//       submit.classList.remove("disabled");
//     }
//   });
// })

const editDetails = document.querySelector(".experience .experience-list .the-experience .panel-body .project-details .add-new-experience-detail");
const editDetailsContainer = document.querySelector(".experience .experience-list .the-experience .panel-body .project-details .details"); 
let total = parseInt(editDetails.dataset.total);

editDetails.addEventListener("click", () => {
  newDetail(editDetailsContainer);
  const addedInputs = document.querySelectorAll(".experience .experience-list .the-experience .panel-body .input-info .main-input");
});

const newDetail = el => {
  el.innerHTML += `
    <div class="the-input">
      <div class="input-info">
        <input
          type="text"
          class="main-input"
          name="detail-${++total}"
          autocomplete="off"
          required>
        <span>Detail No. ${total}</span>
      </div>
    </div>
  `;
}

// watch changes in details container 
const config = {childList: true, subtree: true, attributes: true}

const watch = (list, observer) => {
  for(const item of list){
    if(item.type === "childList"){
      const addedInputs = document.querySelectorAll(".experience .experience-list .the-experience .panel-body .input-info .main-input");
      controlInput(addedInputs, "has-value", "control-placeholder");
    }
    else if(item.type === "attributes"){
      // element attribute changed
    }
    else{
      // subtree changed
      console.log("subtree");
    }
  }
};

const observer = new MutationObserver(watch);
observer.observe(editDetailsContainer, config);