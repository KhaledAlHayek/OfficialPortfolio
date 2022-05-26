const addNewDetail = document.querySelector(".experience .details-experience .add-new-details");
const detailInput = document.querySelectorAll(".experience .details-experience form .details-input .the-input input");
const detailsContainer = document.querySelector(".experience .details-experience form .inputs");

addNewDetail.addEventListener("click", () => {
  const startUp = document.querySelectorAll(".experience .details-experience form .details-input");
  let length = startUp.length;
  detailsContainer.innerHTML += `
    <div class="details-input">
      <div class="the-input" data-key="${length + 1}">
        <input 
          type="text" 
          name="detail-${length + 1}" 
          autocomplete="off"
          required>
        <span>Project Detail-${length + 1}</span>
      </div>
    </div>
  `;
})

detailInput.forEach(input => {
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
})

window.onload = () => {
  detailInput.forEach(input => {
    let length = input.value.length;
    const placeholder = input.nextElementSibling;
    if(length > 0){
      placeholder.classList.add("control");
      input.classList.add("has-value");
    }
    else{
      input.classList.remove("has-value");
      placeholder.classList.remove("control");
    }
  })
}

detailInput.forEach(input => {
  input.addEventListener("keyup", e => {
    let length = e.target.value.length;
    const parentEl = e.target.parentElement;
    if(length == 0){
      parentEl.classList.add("has-error");
    }
    else{
      parentEl.classList.remove("has-error");
    }
  });
});