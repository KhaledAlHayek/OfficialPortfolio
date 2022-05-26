let current = 1;
const managers = Array.from(document.querySelectorAll(".view-managers-info .info-box .info-holder"));
const next = document.querySelector(".view-managers-info .info-box .arrow-next");
const prev = document.querySelector(".view-managers-info .info-box .arrow-prev");

const card = () => {
  managers.map(manager => manager.classList.remove("active-card"));
  managers[current - 1].classList.add("active-card");
  if(current == 1){
    prev.classList.add("disabled");
  }else{
    prev.classList.remove("disabled");
  }
  if(current == managers.length){
    next.classList.add("disabled");
  }
  else{
    next.classList.remove("disabled");
  }
};

const previousCard = () => {
  if(prev.classList.contains("disabled")){
    return false;
  }
  current--;
  card();
} 

const nextCard = () => {
  if(next.classList.contains("disabled")){
    return false;
  }
  current++;
  card();
} 
next.addEventListener("click", nextCard);
prev.addEventListener("click", previousCard);
card();

// copy manager token ID
managers.forEach(manager => {
  const copyToken = manager.querySelector(".head .head-holder .copy-token > i");
  const token = manager.querySelector(".head .head-holder .what-to-copy");
  copyToken.addEventListener("click", e => {
    e.target.className = "";
    e.target.classList.add("fas", "fa-check");
    navigator.clipboard.writeText(token.dataset.copy);
    const copiedMessage = token.firstElementChild;
    copiedMessage.innerHTML = "Copied.";
  });
});

// copy manager data
managers.forEach(manager => {
  const dataCopy = manager.querySelectorAll(".manager-card .body .data");
  dataCopy.forEach(data => {
    const copiedMsg = data.querySelector(".copy-tooltip");
    data.addEventListener("click", e => {
      const copyData = data.getAttribute("data-copydata");
      navigator.clipboard.writeText(copyData);
      copiedMsg.innerHTML = "<i class='fas fa-check'></i> Copied";
    });
  })
});